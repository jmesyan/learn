# javascript对url进行encode的两种方式

javascript可以使用的内置函数有
````
encodeURI()

encodeURIComponent()
````

他们都是用utf-8的编码方式

 

encodeURI()，用来encode整个URL，不会对下列字符进行编码：+ : / ; ?&。*它只会对汉语等特殊字符进行编码*

encodeURIComponent ()，用来enode URL中想要传输的字符串，它会对所有url敏感字符进行encode

## 在对url做encode操作时，一定要根据情况选择不同的方法。

### 例如url = 'www.xxx.com/aaa/bbb.do?parm1=罗'

此时可以用encodeURI(url)

当你的参数中包含+ : / ; ?&请使用 encodeURIComponent 方法对这些参数单独进行编码。

### 例如url = 'www.xxx.com/aaa/bbb.do?parm1=www.xxx.com/ccc/ddd?param=abcd'

encodeURI(url)绝对无法满足要求，因为param1=www.xxx.com/ccc/ddd?param=abcd，这个参数是不能按照我们的要求encode的，

此时应该这样单独对参数进行encode

url = 'www.xxx.com/aaa/bbb.do?parm1=' + encodeURIComponent('www.xxx.com/ccc/ddd?param=abcd')


编码后的url的值为

www.xxx.com/aaa/bbb.do?parm1=www.xxx.com%2Fccc%2Fddd%3Fparam%3Dabcd

此时接受此请求的服务端就能够成功取得param1=www.xxx.com/ccc/ddd?param=abcd

