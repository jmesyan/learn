# PHP - ArrayAccess接口详解

 PHP  ArrayAccess接口又叫数组式访问接口，该接口的作用是提供像访问数组一样访问对象的能力。
接口摘要如下：
````
[php] view plain copy
ArrayAccess {  
    // 获取一个偏移位置的值  
    abstract public mixed offsetGet ( mixed $offset )  
    // 设置一个偏移位置的值  
    abstract public void offsetSet ( mixed $offset , mixed $value )  
    // 检查一个偏移位置是否存在  
    abstract public boolean offsetExists ( mixed $offset )  
    // 复位一个偏移位置的值  
    abstract public void offsetUnset ( mixed $offset )  
}  
````
例子说明：
````
<?php  
/** 
* ArrayAndObjectAccess 
* 该类允许以数组或对象的方式进行访问 
* 
* @author 疯狂老司机 
*/  
class ArrayAndObjectAccess implements ArrayAccess {  
  
    /** 
     * 定义一个数组用于保存数据 
     * 
     * @access private 
     * @var array 
     */  
    private $data = [];  
  
    /** 
     * 以对象方式访问数组中的数据 
     * 
     * @access public 
     * @param string 数组元素键名 
     */  
    public function __get($key) {  
        return $this->data[$key];  
    }  
  
    /** 
     * 以对象方式添加一个数组元素 
     * 
     * @access public  
     * @param string 数组元素键名 
     * @param mixed  数组元素值 
     * @return mixed 
     */  
    public function __set($key,$value) {  
        $this->data[$key] = $value;  
    }  
  
    /** 
     * 以对象方式判断数组元素是否设置 
     * 
     * @access public 
     * @param 数组元素键名 
     * @return boolean 
     */  
    public function __isset($key) {  
        return isset($this->data[$key]);  
    }  
  
    /** 
     * 以对象方式删除一个数组元素 
     * 
     * @access public 
     * @param 数组元素键名 
     */  
    public function __unset($key) {  
        unset($this->data[$key]);  
    }  
  
    /** 
     * 以数组方式向data数组添加一个元素 
     * 
     * @access public 
     * @abstracting ArrayAccess 
     * @param string 偏移位置 
     * @param mixed  元素值 
     */  
    public function offsetSet($offset,$value) {  
        if (is_null($offset)) {  
            $this->data[] = $value;  
        } else {  
            $this->data[$offset] = $value;  
        }  
    }  
  
    /** 
     * 以数组方式获取data数组指定位置元素 
     * 
     * @access public    
     * @abstracting ArrayAccess        
     * @param 偏移位置 
     * @return mixed 
     */  
    public function offsetGet($offset) {  
        return $this->offsetExists($offset) ? $this->data[$offset] : null;  
    }  
  
    /** 
     * 以数组方式判断偏移位置元素是否设置 
     * 
     * @access public 
     * @abstracting ArrayAccess 
     * @param 偏移位置 
     * @return boolean 
     */  
    public function offsetExists($offset) {  
        return isset($this->data[$offset]);  
    }  
  
    /** 
     * 以数组方式删除data数组指定位置元素 
     * 
     * @access public 
     * @abstracting ArrayAccess      
     * @param 偏移位置 
     */  
    public function offsetUnset($offset) {  
        if ($this->offsetExists($offset)) {  
            unset($this->data[$offset]);  
        }  
    }  
  
}  
  
$animal = new ArrayAndObjectAccess();  
  
$animal->dog = 'dog'; // 调用ArrayAndObjectAccess::__set  
$animal['pig'] = 'pig'; // 调用ArrayAndObjectAccess::offsetSet  
var_dump(isset($animal->dog)); // 调用ArrayAndObjectAccess::__isset  
var_dump(isset($animal['pig'])); // 调用ArrayAndObjectAccess::offsetExists  
var_dump($animal->pig); // 调用ArrayAndObjectAccess::__get  
var_dump($animal['dog']); // 调用ArrayAndObjectAccess::offsetGet  
unset($animal['dog']); // 调用ArrayAndObjectAccess::offsetUnset  
unset($animal->pig); // 调用ArrayAndObjectAccess::__unset  
var_dump($animal['pig']); // 调用ArrayAndObjectAccess::offsetGet  
var_dump($animal->dog); // 调用ArrayAndObjectAccess::__get  
  
?>  
````

以上输出：
````
boolean true
boolean true
string 'pig' (length=3)
string 'dog' (length=3)
null
null
````