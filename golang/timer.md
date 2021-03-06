# go语言示例-Timer计时器的用法

````
计时器用来定时执行任务，分享一段代码：

package main

 

import "time"

import "fmt"

 

func main() {

//新建计时器，两秒以后触发，go触发计时器的方法比较特别，就是在计时器的channel中发送值

timer1 := time.NewTimer(time.Second * 2)

//此处在等待channel中的信号，执行此段代码时会阻塞两秒

<-timer1.C

fmt.Println("Timer 1 expired")

 

//新建计时器，一秒后触发

timer2 := time.NewTimer(time.Second)

//新开启一个线程来处理触发后的事件

go func() {

//等触发时的信号

<-timer2.C

fmt.Println("Timer 2 expired")

}()

//由于上面的等待信号是在新线程中，所以代码会继续往下执行，停掉计时器

stop2 := timer2.Stop()

if stop2 {

fmt.Println("Timer 2 stopped")

}

}
````
代码解读见注释。

最终输出结果为：

Timer 1 expired

Timer 2 stopped

因为Timer 2的处理线程在等到信号前已经被停止掉了，所以会打印出Timer 2 stopped而不是Timer 2 expired