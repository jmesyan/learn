在高并发或者海量数据的生产环境中，我们会遇到很多问题，GC（garbage collection，中文译成垃圾回收）就是其中之一。说起优化GC我们首先想到的肯定是让对象可重用，这就需要一个对象池来存储待回收对象，等待下次重用，从而减少对象产生数量。

## 标准库原生的对象池

在Golang1.3版本便已新增了sync.Pool功能，它就是用来保存和复用临时对象，以减少内存分配，降低CG压力，下面就来讲讲sync.Pool的基本用法。
````
type Pool struct {
     local unsafe.Pointer
     localSize uintptr
     New func() interface{}
}
````
很简洁，最常用的两个函数Get/Put
````
var pool = &sync.Pool{New:func()interface{}{return NewObject()}}
pool.Put()
Pool.Get()
````
对象池在Get的时候没有里面没有对象会返回nil，所以我们需要New function来确保当获取对象对象池为空时，重新生成一个对象返回
````
if p.New != nil {
     return p.New()
 }
````
在实现过程中还要特别注意的是Pool本身也是一个对象，要把Pool对象在程序开始的时候初始化为全局唯一。
对象池使用是较简单的，但原生的sync.Pool有个较大的问题：我们不能自由控制Pool中元素的数量，放进Pool中的对象每次GC发生时都会被清理掉。这使得sync.Pool做简单的对象池还可以，但做连接池就有点心有余而力不足了，比如：在高并发的情景下一旦Pool中的连接被GC清理掉，那每次连接DB都需要重新三次握手建立连接，这个代价就较大了。

既然存在问题，那我们就自行构建一个对象池吧。

对象池底层数据结构

我们选择用Golang的container标准包中的链表来做对象池的底层数据结构，它被封装在container/list标准包里：
````
type Element struct {
      next, prev *Element
      list *List     
      Value interface{}
 }
 ````
这里是定义了链表中的元素，这个标准库实现的是一个双向链表，并且已经为我们封装好了各种Front/Back方法。不过Front方法的实现和我们需要的还是有点差异，它只是返回链表中的第一个元素，但这个元素依然会链接在链表里，所以我们需要自行将它从链表中删除，remove方法如下：
````
func (l *List) remove(e *Element) *Element {
      e.prev.next = e.next
        e.next.prev = e.prev
        e.next = nil
        e.prev = nil
        e.list = nil
        l.len--
        return e
 }
 ````
这样对象池的核心部分就完成了，但注意一下，从remove函数可以看出，container/list并不是线程安全的，所以在对象池的对象个数统计等一些功能会有问题。

原子操作并发安全

下面我们来自行解决并发安全的问题。Golang的sync标准包封装了常用的原子操作和锁操作。
sync/atomic封装了常用的原子操作。所谓原子操作就是在针对某个值进行操作的整个过程中，为了实现严谨性必须由一个独立的CPU指令完成，该过程不能被其他操作中断，以保证该操作的并发安全性。
````
type ConnPool struct {
    conns []*conn
    mu sync.Mutex // lock protected
    len int32
}
````
在Golang中，我们常用的数据类型除了channel之外都不是线程安全的，所以在这里我们需要对数量（len）和切片（conns []*conn）做并发保护。至于需要几把锁做保护，取决于实际场景，合理控制锁的粒度。
接着介绍一下锁操作，我们在Golang中常用的锁——互斥锁（Lock）和读写锁（RWLock）,
互斥锁和读写锁的区别是：
- 互斥锁无论是读操作还是写操作都会对目标加锁也就是说所有的操作都需要排队进行
- 读写锁是加锁后写操作只能排队进行但是可以并发进行读操作，要注意一点就是读的时候写操作是阻塞的，写操作进行的时候读操作是阻塞的。类型sync.Mutex/sync.RWMutex的零值表示了未被锁定的互斥量。也就是说，它是一个开箱即用的工具。只需对它进行简单声明就可以正常使用了，例如（在这里以Mutex为例，相对于RWMutex也是同理）：
````
var mu sync.Mutex
mu.Lock()
mu.Unlock()
````
锁操作一定要成对出现，也就是说在加锁之后操作的某一个地方一定要记得释放锁，否则再次加锁会造成死锁问题

fatal error: all goroutines are asleep - deadlock
不过在Golang里这种错误发生的几率会很少，因为有defer延时函数的存在
上面的代码可以改写为
````
var mu sync.Mutex
mu.Lock()
defer mu.Unlock()
````
在加锁之后马上用defer函数进行解锁操作，这样即使下面我们只关心函数逻辑而在函数退出的时候忘记Unlock操作也不会造成死锁，因为在函数退出的时候会自动执行defer延时函数释放锁。

## 标准库中的并发控制-WaitGroup

sync标准包还封装了其他很有用的功能，比如WaitGroup，它能够一直等到所有的goroutine执行完成，并且阻塞主线程的执行，直到所有的goroutine（Golang中并发执行的协程）执行完成。文章开始我们说过，Golang是支持并发的语言，在其他goroutine异步运行的时候主协程并不知道其他协程是否运行结束，一旦主协程退出那所有的协程就会退出，这时我们需要控制主协程退出的时间，常用的方法：
- 1、time.Sleep()

让主协程睡一会，好方法，但是睡多久呢？不确定（最简单暴力）

- 2、channel

在主协程一直阻塞等待一个退出信号，在其他协程完成任务后给主协程发送一个信号，主协程收到这个信号后退出
````
e := make(chan bool)
 go func() {
      fmt.Println("hello")
      e <- true
 }()
 <-e
 ````
- 3、waitgroup

给一个类似队列似得东西初始化一个任务数量，完成一个减少一个
````
  var wg sync.WaitGroup
     func main() {
          wg.Add(1)
          go func() {
               fmt.Println("hello")
               wg.Done() //完成
          }()
          wg.Wait()
     }
 ````
这里要特别主要一下，如果waitGroup的add数量最终无法变成0，会造成死锁，比如上面例子我add(2)但是我自始至终只有一个Done,那剩下的任务一直存在于wg队列中，主协程会认为还有任务没有完成便会一直处于阻塞Wait状态，造成死锁。
wg.Done方法其实在底层调用的也是wg.Add方法，只是Add的是-1
````
func (wg *WaitGroup) Done() {
        wg.Add(-1)
}
````
我们看sync.WaitGroup的Add方法源码可以发现，底层的加减操作用的是我们上面提到的sync.atomic标准包来确保原子操作，所以sync.WaitGroup是并发安全的。