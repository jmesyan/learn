# PHP中VC6、VC9、TS、NTS版本的区别与用法详解

## 1． VC6与VC9的区别：
VC6版本是使用Visual Studio 6编译器编译的，如果你的PHP是用Apache来架设的，那你就选择VC6版本。
VC9版本是使用Visual Studio 2008编译器编译的，如果你的PHP是用IIS来架设的，那你就选择 VC9版本。
VC9版本是针对IIS服务器的版本，没有对APACHE的支持，而VC6版本对IIS和apache都提供了支持
## 2．Ts与nts的区别：
Windows版的PHP从版本5.2.1开始有Thread Safe和NoneThread Safe之分。
先从字面意思上理解，Thread Safe是线程安全，执行时会进行线程（Thread）安全检查，以防止有新要求就启动新线程的CGI执行方式而耗尽系统资源。Non Thread Safe是非线程安全，在执行时不进行线程（Thread）安全检查。
## 3．PHP的两种执行方式：ISAPI和FastCGI。
ISAPI执行方式是以DLL动态库的形式使用，可以在被用户请求后执行，在处理完一个用户请求后不会马上消失，所以需要进行线程安全检查，这样来提高程序的执行效率，所以如果是以ISAPI来执行PHP，建议选择ThreadSafe版本；
而FastCGI执行方式是以单一线程来执行操作，所以不需要进行线程的安全检查，除去线程安全检查的防护反而可以提高执行效率，所以，如果是以FastCGI来执行PHP，建议选择NonThread Safe版本。
通过phpinfo(); 查看其中的 Thread Safety 项，这个项目就是查看是否是线程安全，如果是：enabled，一般来说应该是ts版，否则是nts版。