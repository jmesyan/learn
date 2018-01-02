#  Windows环境配置xdebug调试PHP

## 1.版本对应
php版本，TS 和NTS，VC9和VC11，32位和64位都需要正确才可以。
首先用phpinfo查看PHP安装版本


## 2.下载对应版本
https://xdebug.org/download.php

比如下载的是32位的TS版本：php_xdebug-2.4.1-5.4-vc9.dll，这个文件复制进任意目录都可以。

## 3.配置相关文件
###  配置nginx.conf文件
````
 location ~ \.php$ { #by djs -------
        root           html;            #php文件路径，同上
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
        fastcgi_read_timeout  1d;            #新增，xdebug调试时长
 }
 ````
### php.ini文件
````
zend_extension_nts="C:/Wnmp/php/ext/php_xdebug.dll"

xdebug.profiler_enable=1
xdebug.profiler_output_dir="c/debug"
xdebug.remote_enable         = 1
xdebug.remote_host           = "localhost"
xdebug.remote_port           = "10000"
xdebug.remote_handler        = "dbgp"
xdebug.remote_autostart      = 1
xdebug.remote_connect_back   = 1

xdebug.auto_trace            = 1
xdebug.collect_includes      = 1
xdebug.collect_params        = 1
xdebug.collect_return        = 1
xdebug.default_enable        = 1
xdebug.collect_assignments   = 1
xdebug.collect_vars          = 1
xdebug.show_local_vars       = 1
xdebug.show_exception_trace  = 0  
xdebug.idekey = "PHPSTORM"
````
注意，
*xdebug.remote_host，port，handler，idekey的参数设置。其中端口号不能使用9000（已被php和nginx通讯占用），这些都要和phpStorm的设置一致。*
## 4.重启php
查看phpinfo()有无加载好xdebug扩展

说明：如果没有这个说明配置不对或者版本不对

## 5.配置netbean 或者 phpstorm 这类IDE

[phpstorm配置查看链接](http://www.jianshu.com/p/e12b7fa62f2c)

## 6.打断点开始调试