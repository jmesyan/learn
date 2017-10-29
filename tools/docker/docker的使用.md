# docker Hello world

Docker 允许你在容器内运行应用程序， 使用 docker run 命令来在容器内运行一个应用程序。
输出Hello world
````
runoob@runoob:~$ docker run ubuntu:15.10 /bin/echo "Hello world"
Hello world
````
各个参数解析：

- docker: Docker 的二进制执行文件。
- run:与前面的 docker 组合来运行一个容器。
- ubuntu:15.10指定要运行的镜像，Docker首先从本地主机上查找镜像是否存在，如果不存在，Docker 就会从镜像仓库 Docker Hub 下载公共镜像。
- /bin/echo "Hello world": 在启动的容器里执行的命令

以上命令完整的意思可以解释为：Docker 以 ubuntu15.10 镜像创建一个新容器，然后在容器里执行 bin/echo "Hello world"，然后输出结果。

##  运行交互式的容器
我们通过docker的两个参数 -i -t，让docker运行的容器实现"对话"的能力
````
runoob@runoob:~$ docker run -i -t ubuntu:15.10 /bin/bash
root@dc0050c79503:/#
````
各个参数解析：
* -t:在新容器内指定一个伪终端或终端。
* -i:允许你对容器内的标准输入 (STDIN) 进行交互。

此时我们已进入一个 ubuntu15.10系统的容器
我们尝试在容器中运行命令 ``cat /proc/version和ls``,
分别查看当前系统的版本信息和当前目录下的文件列表
- cat /proc/version 虚拟终端和现实终端现实一样，都是
````
Linux version 4.9.0-deepin12-amd64 (yangbo@deepin.com) (gcc version 6.3.0 20170321 (Debian 6.3.0-11) ) #1 SMP PREEMPT Deepin 4.9.40-3 (2017-09-19)
````
- ls 操作虚拟终端和现实终端显示不同
  1-虚拟终端
  ````
  bin  boot  dev  etc  home  lib  lib64  media  mnt  opt  proc  root  run  sbin  srv  sys  tmp  usr  var
````
2-现实终端
````
Desktop  Documents  Downloads  Music  Pictures  Steam  Templates  Videos  Wallpaper
````
可见容器和linux公用一个源头，但是里面的内容是虚拟化的ubantu
我们可以通过运行exit命令或者使用CTRL+D来退出容器。

## 启动容器（后台模式）
使用以下命令创建一个以进程方式运行的容器
````
runoob@runoob:~$ docker run -d ubuntu:15.10 /bin/sh -c "while true; do echo hello world; sleep 1; done"
a5fd0d16fb17717760bea67c344adf69bc1f3e0593923d2ef570ff760ffac242
````
在输出中，我们没有看到期望的"hello world"，而是一串长字符
````
a5fd0d16fb17717760bea67c344adf69bc1f3e0593923d2ef570ff760ffac242
````
这个长字符串叫做*容器ID*，对每个容器来说都是唯一的，我们可以通过容器ID来查看对应的容器发生了什么。
首先，我们需要确认容器有在运行，可以通过 docker ps 来查看
````
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS               NAMES
a5fd0d16fb17        ubuntu:15.10        "/bin/sh -c 'while..."   15 seconds ago      Up 14 seconds                           practical_engelbart
````
CONTAINER ID:容器ID
NAMES:自动分配的容器名称

在容器内使用docker logs命令，查看容器内的标准输出
````
runoob@runoob:~$ docker logs a5fd0d16fb17
````
或者通过names查看
````
runoob@runoob:~$ docker logs practical_engelbart
````

## 停止容器
我们使用 docker stop ID 命令来停止容器:

通过docker ps查看，容器已经停止工作:
````
runoob@runoob:~$ docker ps
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES
````
也可以用下面的命令来停止:
````
runoob@runoob:~$ docker stop practical_engelbart
````

# Docker容器使用
Docker 客户端
docker 客户端非常简单 ,我们可以直接输入 docker 命令来查看到 Docker 客户端的所有命令选项。
````
runoob@runoob:~# docker
````
可以通过命令 docker command --help 更深入的了解指定的 Docker 命令使用方法。
例如我们要查看 docker stats 指令的具体使用方法：
````
runoob@runoob:~# docker stats --help
Usage:	docker stats [OPTIONS] [CONTAINER...]

Display a live stream of container(s) resource usage statistics

Options:
  -a, --all             Show all containers (default shows just running)
      --format string   Pretty-print images using a Go template
      --help            Print usage
      --no-stream       Disable streaming stats and only pull the first result
````
## 运行一个web应用
前面我们运行的容器并没有一些什么特别的用处。
接下来让我们尝试使用 docker 构建一个 web

我们将在docker容器中运行一个 Python Flask 应用来运行一个web应用。
````
runoob@runoob:~# docker run -d -P training/webapp python app.py
````
参数说明:
* -d:让容器在后台运行。
* -P:将容器内部使用的网络端口映射到我们使用的主机上。

## 查看 WEB 应用容器
使用 docker ps 来查看我们正在运行的容器
````
runoob@runoob:~$ docker ps
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS                     NAMES
a41a21867d7a        training/webapp     "python app.py"     29 seconds ago      Up 28 seconds       0.0.0.0:32768->5000/tcp   angry_shirley
````

这里多了端口信息, Docker 开放了 5000 端口（默认 Python Flask 端口）映射到主机端口 32768 上。
这时我们可以通过浏览器访问WEB应用

使用命令 查看ip：
- 1-内网ip 100.76.99.213
- 2-docker0 Ip- 172.17.0.1

分别使用http://172.17.0.1:32768/ 或者 http://100.76.99.213:32768/， 浏览器均能正确打印
````
Hello world!
````
我们也可以指定 -p 标识来绑定指定端口。
````
runoob@runoob:~$ docker run -d -p 5000:5000 training/webapp python app.py
````
使用docker ps查看：
````
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS                     NAMES
d49938511c26        training/webapp     "python app.py"     15 seconds ago      Up 14 seconds       0.0.0.0:5000->5000/tcp    suspicious_nightingale
a41a21867d7a        training/webapp     "python app.py"     14 minutes ago      Up 14 minutes       0.0.0.0:32768->5000/tcp   angry_shirley
````
有一个容器进程内部的 5000 端口映射到我们本地主机的 5000 端口上。

## 网络端口的快捷方式
通过docker ps 命令可以查看到容器的端口映射，
docker还提供了另一个快捷方式：docker port,
使用 docker port 可以查看指定 （ID或者名字）容器的某个确定端口映射到宿主机的端口号。
上面我们创建的web应用容器ID为:d49938511c26 名字为：suspicious_nightingale
我可以使用docker port d49938511c26 或docker port suspicious_nightingale 来查看容器端口的映射情况
````
runoob@runoob:~$ docker port d49938511c26
5000/tcp -> 0.0.0.0:5000
runoob@runoob:~$ docker port suspicious_nightingale
5000/tcp -> 0.0.0.0:5000
````
## 查看WEB应用程序日志
docker logs [ID或者名字] 可以查看容器内部的标准输出。
````
runoob@runoob:~$ docker logs -f 7a38a1ad55c6
 * Running on http://0.0.0.0:5000/ (Press CTRL+C to quit)
192.168.239.1 - - [09/May/2016 16:30:37] "GET / HTTP/1.1" 200 -
192.168.239.1 - - [09/May/2016 16:30:37] "GET /favicon.ico HTTP/1.1" 404
````
-f:让 dokcer logs 像使用 tail -f 一样来输出容器内部的标准输出。

从上面，我们可以看到应用程序使用的是 5000 端口并且能够查看到应用程序的访问日志。
查看WEB应用程序容器的进程

我们还可以使用 docker top 来查看容器内部运行的进程
````
runoob@runoob:~$ docker top suspicious_nightingale
UID                 PID                 PPID                C                   STIME               TTY                 TIME                CMD
root                26186               26169               0                   18:12               ?                   00:00:00            python app.py
````
## 检查WEB应用程序
使用 docker inspect 来查看Docker的底层信息。它会返回一个 JSON 文件记录着 Docker 容器的配置和状态信息。
````
runoob@runoob:~$ docker inspect determined_swanson
[
    {
        "Id": "7a38a1ad55c6914b360b565819604733db751d86afd2575236a70a2519527361",
        "Created": "2016-05-09T16:20:45.427996598Z",
        "Path": "python",
        "Args": [
            "app.py"
        ],
        "State": {
            "Status": "running",
......
````
## 停止WEB应用容器
````
runoob@runoob:~$ docker stop determined_swanson   
determined_swanson
````

## 重启WEB应用容器
- 已经停止的容器，我们可以使用命令 docker start 来启动。
````
runoob@runoob:~$ docker start determined_swanson
determined_swanson
````
docker ps -l 查询最后一次创建的容器：
````
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS                    NAMES
d49938511c26        training/webapp     "python app.py"     20 minutes ago      Up 20 minutes       0.0.0.0:5000->5000/tcp   suspicious_nightingale
````
- 正在运行的容器，我们可以使用 docker restart 命令来重启

## 移除WEB应用容器
我们可以使用 docker rm 命令来删除不需要的容器
````
runoob@runoob:~$ docker rm determined_swanson  
determined_swanson
````
删除容器时，容器必须是停止状态，否则会报如下错误
````
runoob@runoob:~$ docker rm determined_swanson
Error response from daemon: You cannot remove a running container 7a38a1ad55c6914b360b565819604733db751d86afd2575236a70a2519527361. Stop the container before attempting removal or use -f
````
# Docker镜像使用

当运行容器时，使用的镜像如果在本地中不存在，docker 就会自动从 docker 镜像仓库中下载，默认是从 Docker Hub 公共镜像源下载。
下面我们来学习：
- 1、管理和使用本地 Docker 主机镜像
- 2、创建镜像
列出镜像列表

我们可以使用 docker images 来列出本地主机上的镜像。
````
runoob@runoob:~$ docker images           
REPOSITORY          TAG                 IMAGE ID            CREATED             SIZE
ubuntu              14.04               90d5884b1ee0        5 days ago          188 MB
php                 5.6                 f40e9e0f10c8        9 days ago          444.8 MB
nginx               latest              6f8d099c3adc        12 days ago         182.7 MB
mysql               5.6                 f2e8d6c772c0        3 weeks ago         324.6 MB
httpd               latest              02ef73cf1bc0        3 weeks ago         194.4 MB
ubuntu              15.10               4e3b13c8a266        4 weeks ago         136.3 MB
hello-world         latest              690ed74de00f        6 months ago        960 B
training/webapp     latest              6fae60ef3446        11 months ago       348.8 MB
````
各个选项说明:
- REPOSITORY：表示镜像的仓库源
- TAG：镜像的标签
- IMAGE ID：镜像ID
- CREATED：镜像创建时间
- SIZE：镜像大小

同一仓库源可以有多个 TAG，代表这个仓库源的不同个版本，如ubuntu仓库源里，有15.10、14.04等多个不同的版本，我们使用 REPOSITORY:TAG 来定义不同的镜像。

所以，我们如果要使用版本为15.10的ubuntu系统镜像来运行容器时，命令如下：
````
runoob@runoob:~$ docker run -t -i ubuntu:15.10 /bin/bash
root@d77ccb2e5cca:/#
````
如果要使用版本为14.04的ubuntu系统镜像来运行容器时，命令如下：
````
runoob@runoob:~$ docker run -t -i ubuntu:14.04 /bin/bash
root@39e968165990:/#
````
*如果你不指定一个镜像的版本标签，例如你只使用 ubuntu，docker 将默认使用 ubuntu:latest 镜像。*

##  获取一个新的镜像
当我们在本地主机上使用一个不存在的镜像时 Docker 就会自动下载这个镜像。如果我们想预先下载这个镜像，我们可以使用 docker pull 命令来下载它。
````
Crunoob@runoob:~$ docker pull ubuntu:13.10
13.10: Pulling from library/ubuntu
6599cadaf950: Pull complete
23eda618d451: Pull complete
f0be3084efe9: Pull complete
52de432f084b: Pull complete
a3ed95caeb02: Pull complete
Digest: sha256:15b79a6654811c8d992ebacdfbd5152fcf3d165e374e264076aa435214a947a3
Status: Downloaded newer image for ubuntu:13.10
````
下载完成后，我们可以直接使用这个镜像来运行容器。
## 查找镜像

我们可以从 Docker Hub 网站来搜索镜像，Docker Hub 网址为： https://hub.docker.com/
我们也可以使用 docker search 命令来搜索镜像。比如我们需要一个httpd的镜像来作为我们的web服务。我们可以通过 docker search 命令搜索 httpd 来寻找适合我们的镜像。
runoob@runoob:~$  docker search httpd

NAME:镜像仓库源的名称
DESCRIPTION:镜像的描述
OFFICIAL:是否docker官方发布
拖取镜像
我们决定使用上图中的httpd 官方版本的镜像，使用命令 docker pull 来下载镜像。
runoob@runoob:~$ docker pull httpd
Using default tag: latest
latest: Pulling from library/httpd
8b87079b7a06: Pulling fs layer
a3ed95caeb02: Download complete
0d62ec9c6a76: Download complete
a329d50397b9: Download complete
ea7c1f032b5c: Waiting
be44112b72c7: Waiting
下载完成后，我们就可以使用这个镜像了。
runoob@runoob:~$ docker run httpd
创建镜像
当我们从docker镜像仓库中下载的镜像不能满足我们的需求时，我们可以通过以下两种方式对镜像进行更改。
1.从已经创建的容器中更新镜像，并且提交这个镜像
2.使用 Dockerfile 指令来创建一个新的镜像
更新镜像
更新镜像之前，我们需要使用镜像来创建一个容器。
runoob@runoob:~$ docker run -t -i ubuntu:15.10 /bin/bash
root@e218edb10161:/# 在运行的容器内使用 apt-get update 命令进行更新。
在完成操作之后，输入 exit命令来退出这个容器。
此时ID为e218edb10161的容器，是按我们的需求更改的容器。我们可以通过命令 docker commit来提交容器副本。
runoob@runoob:~$ docker commit -m="has update" -a="runoob" e218edb10161 runoob/ubuntu:v2
sha256:70bf1840fd7c0d2d8ef0a42a817eb29f854c1af8f7c59fc03ac7bdee9545aff8
各个参数说明：
-m:提交的描述信息
-a:指定镜像作者
e218edb10161：容器ID
runoob/ubuntu:v2:指定要创建的目标镜像名
我们可以使用 docker images 命令来查看我们的新镜像 runoob/ubuntu:v2：
runoob@runoob:~$ docker images
REPOSITORY          TAG                 IMAGE ID            CREATED             SIZE
runoob/ubuntu       v2                  70bf1840fd7c        15 seconds ago      158.5 MB
ubuntu              14.04               90d5884b1ee0        5 days ago          188 MB
php                 5.6                 f40e9e0f10c8        9 days ago          444.8 MB
nginx               latest              6f8d099c3adc        12 days ago         182.7 MB
mysql               5.6                 f2e8d6c772c0        3 weeks ago         324.6 MB
httpd               latest              02ef73cf1bc0        3 weeks ago         194.4 MB
ubuntu              15.10               4e3b13c8a266        4 weeks ago         136.3 MB
hello-world         latest              690ed74de00f        6 months ago        960 B
training/webapp     latest              6fae60ef3446        12 months ago       348.8 MB
使用我们的新镜像 runoob/ubuntu 来启动一个容器
runoob@runoob:~$ docker run -t -i runoob/ubuntu:v2 /bin/bash                            
root@1a9fbdeb5da3:/#
构建镜像
我们使用命令 docker build ， 从零开始来创建一个新的镜像。为此，我们需要创建一个 Dockerfile 文件，其中包含一组指令来告诉 Docker 如何构建我们的镜像。
runoob@runoob:~$ cat Dockerfile
FROM    centos:6.7
MAINTAINER      Fisher "fisher@sudops.com"

RUN     /bin/echo 'root:123456' |chpasswd
RUN     useradd runoob
RUN     /bin/echo 'runoob:123456' |chpasswd
RUN     /bin/echo -e "LANG=\"en_US.UTF-8\"" >/etc/default/local
EXPOSE  22
EXPOSE  80
CMD     /usr/sbin/sshd -D
每一个指令都会在镜像上创建一个新的层，每一个指令的前缀都必须是大写的。
第一条FROM，指定使用哪个镜像源
RUN 指令告诉docker 在镜像内执行命令，安装了什么。。。
然后，我们使用 Dockerfile 文件，通过 docker build 命令来构建一个镜像。
runoob@runoob:~$ docker build -t runoob/centos:6.7 .
Sending build context to Docker daemon 17.92 kB
Step 1 : FROM centos:6.7
 ---&gt; d95b5ca17cc3
Step 2 : MAINTAINER Fisher "fisher@sudops.com"
 ---&gt; Using cache
 ---&gt; 0c92299c6f03
Step 3 : RUN /bin/echo 'root:123456' |chpasswd
 ---&gt; Using cache
 ---&gt; 0397ce2fbd0a
Step 4 : RUN useradd runoob
......
参数说明：
-t ：指定要创建的目标镜像名
. ：Dockerfile 文件所在目录，可以指定Dockerfile 的绝对路径
使用docker images 查看创建的镜像已经在列表中存在,镜像ID为860c279d2fec
runoob@runoob:~$ docker images
REPOSITORY          TAG                 IMAGE ID            CREATED              SIZE
runoob/centos       6.7                 860c279d2fec        About a minute ago   190.6 MB
runoob/ubuntu       v2                  70bf1840fd7c        17 hours ago         158.5 MB
ubuntu              14.04               90d5884b1ee0        6 days ago           188 MB
php                 5.6                 f40e9e0f10c8        10 days ago          444.8 MB
nginx               latest              6f8d099c3adc        12 days ago          182.7 MB
mysql               5.6                 f2e8d6c772c0        3 weeks ago          324.6 MB
httpd               latest              02ef73cf1bc0        3 weeks ago          194.4 MB
ubuntu              15.10               4e3b13c8a266        5 weeks ago          136.3 MB
hello-world         latest              690ed74de00f        6 months ago         960 B
centos              6.7                 d95b5ca17cc3        6 months ago         190.6 MB
training/webapp     latest              6fae60ef3446        12 months ago        348.8 MB
我们可以使用新的镜像来创建容器
runoob@runoob:~$ docker run -t -i runoob/centos:6.7  /bin/bash
[root@41c28d18b5fb /]# id runoob
uid=500(runoob) gid=500(runoob) groups=500(runoob)
从上面看到新镜像已经包含我们创建的用户runoob
设置镜像标签
我们可以使用 docker tag 命令，为镜像添加一个新的标签。
runoob@runoob:~$ docker tag 860c279d2fec runoob/centos:dev
docker tag 镜像ID，这里是 860c279d2fec ,用户名称、镜像源名(repository name)和新的标签名(tag)。
使用 docker images 命令可以看到，ID为860c279d2fec的镜像多一个标签。
runoob@runoob:~$ docker images
REPOSITORY          TAG                 IMAGE ID            CREATED             SIZE
runoob/centos       6.7                 860c279d2fec        5 hours ago         190.6 MB
runoob/centos       dev                 860c279d2fec        5 hours ago         190.6 MB
runoob/ubuntu       v2                  70bf1840fd7c        22 hours ago        158.5 MB
ubuntu              14.04               90d5884b1ee0        6 days ago          188 MB
php                 5.6                 f40e9e0f10c8        10 days ago         444.8 MB
nginx               latest              6f8d099c3adc        13 days ago         182.7 MB
mysql               5.6                 f2e8d6c772c0        3 weeks ago         324.6 MB
httpd               latest              02ef73cf1bc0        3 weeks ago         194.4 MB
ubuntu              15.10               4e3b13c8a266        5 weeks ago         136.3 MB
hello-world         latest              690ed74de00f        6 months ago        960 B
centos              6.7                 d95b5ca17cc3        6 months ago        190.6 MB
training/webapp     latest              6fae60ef3446        12 months ago       348.8 MB
