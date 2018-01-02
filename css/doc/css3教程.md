# CSS3 简介

CSS3 完全向后兼容，因此您不必改变现有的设计。浏览器通常支持 CSS2。
## CSS3 模块
CSS3 被划分为模块。
其中最重要的 CSS3 模块包括：
```
选择器
框模型
背景和边框
文本效果
2D/3D 转换
动画
多列布局
用户界面
```
## CSS3 标准
W3C 仍然在对 CSS3 规范进行开发。
不过，现代浏览器已经实现了相当多的 CSS3 属性。

# CSS3 边框

## CSS3 边框
通过 CSS3，您能够创建圆角边框，向矩形添加阴影，使用图片来绘制边框 - 并且不需使用设计软件，比如 PhotoShop。
在本章中，您将学到以下边框属性：
>border-radius
box-shadow
border-image

Internet Explorer 9+ 支持 border-radius 和 box-shadow 属性。
Firefox、Chrome 以及 Safari 支持所有新的边框属性。
注释：对于 border-image，Safari 5 以及更老的版本需要前缀 -webkit-。
Opera 支持 border-radius 和 box-shadow 属性，但是对于 border-image 需要前缀 -o-

## CSS3 圆角边框
在 CSS2 中添加圆角矩形需要技巧。我们必须为每个圆角使用不同的图片。
在 CSS3 中，创建圆角是非常容易的。
在 CSS3 中，border-radius 属性用于创建圆角

``
border-radius:25px;
-moz-border-radius:25px; /* Old Firefox */
``

## CSS3 边框阴影
在 CSS3 中，box-shadow 用于向方框添加阴影：  
``box-shadow: 10px 10px 5px #888888;``

## CSS3 边框图片
通过 CSS3 的 border-image 属性，您可以使用图片来创建边框：
```
div
{
border-image:url(border.png) 30 30 round;
-moz-border-image:url(border.png) 30 30 round; /* 老的 Firefox */
-webkit-border-image:url(border.png) 30 30 round; /* Safari 和 Chrome */
-o-border-image:url(border.png) 30 30 round; /* Opera */
}
```

# CSS3 背景

## CSS3 背景
CSS3 包含多个新的背景属性，它们提供了对背景更强大的控制。
在本章，您将学到以下背景属性：
>background-size
background-origin  
*Internet Explorer 9+、Firefox、Chrome、Safari 以及 Opera 支持新的背景属性。*

## CSS3 background-size 属性
background-size 属性规定背景图片的尺寸。
在 CSS3 之前，背景图片的尺寸是由图片的实际尺寸决定的。
在 CSS3 中，可以规定背景图片的尺寸，这就允许我们在不同的环境中重复使用背景图片。
您能够以像素或百分比规定尺寸。如果以百分比规定尺寸，那么尺寸相对于父元素的宽度和高度。

### 例子 1
调整背景图片的大小：
```
div
{
background:url(bg_flower.gif);
-moz-background-size:63px 100px; /* 老版本的 Firefox */
background-size:63px 100px;
background-repeat:no-repeat;
}
```
### 例子 2
对背景图片进行拉伸，使其完成填充内容区域：
```
div
{
background:url(bg_flower.gif);
-moz-background-size:40% 100%; /* 老版本的 Firefox */
background-size:40% 100%;
background-repeat:no-repeat;
}
```
## CSS3 background-origin 属性
background-origin 属性规定背景图片的定位区域。
背景图片可以放置于 content-box、padding-box 或 border-box 区域。

![](../images/background-origin.gif)

实例
在 content-box 中定位背景图片：
```
div
{
background:url(bg_flower.gif);
background-repeat:no-repeat;
background-size:100% 100%;
-webkit-background-origin:content-box; /* Safari */
background-origin:content-box;
}
```

## CSS3 多重背景图片
CSS3 允许您为元素使用多个背景图像。
实例
为 body 元素设置两幅背景图片：
```
body
{ 
background-image:url(bg_flower.gif),url(bg_flower_2.gif);
}
```

## 新的背景属性
```
属性	描述	CSS
background-clip	规定背景的绘制区域。	3
background-origin	规定背景图片的定位区域。	3
background-size	规定背景图片的尺寸。	3
```
# CSS3 文本效果
CSS3 文本效果
CSS3 包含多个新的文本特性。
在本章中，您将学到如下文本属性：
>text-shadow
word-wrap

Internet Explorer 10、Firefox、Chrome、Safari 以及 Opera 支持 text-shadow 属性。

*所有主流浏览器都支持 word-wrap 属性。*

注释：Internet Explorer 9 以及更早的版本，不支持 text-shadow 属性。

## CSS3 文本阴影
在 CSS3 中，text-shadow 可向文本应用阴影。
文本阴影效果
您能够规定水平阴影、垂直阴影、模糊距离，以及阴影的颜色：
实例
向标题添加阴影：
```
h1
{
text-shadow: 5px 5px 5px #FF0000;
}
```

## CSS3 自动换行
单词太长的话就可能无法超出某个区域：
在 CSS3 中，word-wrap 属性允许您允许文本强制文本进行换行 - 即使这意味着会对单词进行拆分：

``p {word-wrap:break-word;}``

## 新的文本属性
```
属性	描述	CSS
hanging-punctuation	规定标点字符是否位于线框之外。	3
punctuation-trim	规定是否对标点字符进行修剪。	3
text-align-last	设置如何对齐最后一行或紧挨着强制换行符之前的行。	3
text-emphasis	向元素的文本应用重点标记以及重点标记的前景色。	3
text-justify	规定当 text-align 设置为 "justify" 时所使用的对齐方法。	3
text-outline	规定文本的轮廓。	3
text-overflow	规定当文本溢出包含元素时发生的事情。	3
text-shadow	向文本添加阴影。	3
text-wrap	规定文本的换行规则。	3
word-break	规定非中日韩文本的换行规则。	3
word-wrap	允许对长的不可分割的单词进行分割并换行到下一行。	3
```

# CSS3 字体

通过 CSS3，Web 设计师再也不必被迫使用“web-safe”字体了。
## CSS3 @font-face 规则
在 CSS3 之前，web 设计师必须使用已在用户计算机上安装好的字体。
通过 CSS3，web 设计师可以使用他们喜欢的任意字体。
当您您找到或购买到希望使用的字体时，可将该字体文件存放到 web 服务器上，它会在需要时被自动下载到用户的计算机上。
您“自己的”的字体是在 CSS3 @font-face 规则中定义的。

Firefox、Chrome、Safari 以及 Opera 支持 .ttf (True Type Fonts) 和 .otf (OpenType Fonts) 类型的字体。
Internet Explorer 9+ 支持新的 @font-face 规则，但是仅支持 .eot 类型的字体 (Embedded OpenType)。
注释：Internet Explorer 8 以及更早的版本不支持新的 @font-face 规则。

## 使用您需要的字体
在新的 @font-face 规则中，您必须首先定义字体的名称（比如 myFirstFont），然后指向该字体文件。
如需为 HTML 元素使用字体，请通过 font-family 属性来引用字体的名称 (myFirstFont)：
实例
```
<style> 
@font-face
{
font-family: myFirstFont;
src: url('Sansation_Light.ttf'),
     url('Sansation_Light.eot'); /* IE9+ */
}

div
{
font-family:myFirstFont;
}
</style>
```

## 使用粗体字体
您必须为粗体文本添加另一个包含描述符的 @font-face：
实例
```
@font-face
{
font-family: myFirstFont;
src: url('Sansation_Bold.ttf'),
     url('Sansation_Bold.eot'); /* IE9+ */
font-weight:bold;
}
```
文件 "Sansation_Bold.ttf" 是另一个字体文件，它包含了 Sansation 字体的粗体字符。
只要 font-family 为 "myFirstFont" 的文本需要显示为粗体，浏览器就会使用该字体。
通过这种方式，我们可以为相同的字体设置许多 @font-face 规则。

## CSS3 字体描述符
略

# CSS3 2D 转换

## CSS3 转换
通过 CSS3 转换，我们能够对元素进行移动、缩放、转动、拉长或拉伸。

## 它如何工作？
转换是使元素改变形状、尺寸和位置的一种效果。
您可以使用 2D 或 3D 转换来转换您的元素。

Internet Explorer 10、Firefox 以及 Opera 支持 transform 属性。
Chrome 和 Safari 需要前缀 -webkit-。
注释：Internet Explorer 9 需要前缀 -ms-。

## 2D 转换
在本章中，您将学到如下 2D 转换方法：
>translate()
rotate()
scale()
skew()
matrix()

### translate() 方法
通过 translate() 方法，元素从其当前位置移动，根据给定的 left（x 坐标） 和 top（y 坐标） 位置参数：
实例
```
div
{
transform: translate(50px,100px);
-ms-transform: translate(50px,100px);		/* IE 9 */
-webkit-transform: translate(50px,100px);	/* Safari and Chrome */
-o-transform: translate(50px,100px);		/* Opera */
-moz-transform: translate(50px,100px);		/* Firefox */
}
```
值 translate(50px,100px) 把元素从左侧移动 50 像素，从顶端移动 100 像素。

### rotate() 方法
通过 rotate() 方法，元素顺时针旋转给定的角度。允许负值，元素将逆时针旋转。
实例
```
div
{
transform: rotate(30deg);
-ms-transform: rotate(30deg);		/* IE 9 */
-webkit-transform: rotate(30deg);	/* Safari and Chrome */
-o-transform: rotate(30deg);		/* Opera */
-moz-transform: rotate(30deg);		/* Firefox */
}
```
值 rotate(30deg) 把元素顺时针旋转 30 度。

### scale() 方法
通过 scale() 方法，元素的尺寸会增加或减少，根据给定的宽度（X 轴）和高度（Y 轴）参数：
实例
```
div
{
transform: scale(2,4);
-ms-transform: scale(2,4);	/* IE 9 */
-webkit-transform: scale(2,4);	/* Safari 和 Chrome */
-o-transform: scale(2,4);	/* Opera */
-moz-transform: scale(2,4);	/* Firefox */
}
```
值 scale(2,4) 把宽度转换为原始尺寸的 2 倍，把高度转换为原始高度的 4 倍。

### skew() 方法
通过 skew() 方法，元素翻转给定的角度，根据给定的水平线（X 轴）和垂直线（Y 轴）参数：
实例
```
div
{
transform: skew(30deg,20deg);
-ms-transform: skew(30deg,20deg);	/* IE 9 */
-webkit-transform: skew(30deg,20deg);	/* Safari and Chrome */
-o-transform: skew(30deg,20deg);	/* Opera */
-moz-transform: skew(30deg,20deg);	/* Firefox */
}
```
值 skew(30deg,20deg) 围绕 X 轴把元素翻转 30 度，围绕 Y 轴翻转 20 度

### matrix() 方法
matrix() 方法把所有 2D 转换方法组合在一起。
matrix() 方法需要六个参数，包含数学函数，允许您：旋转、缩放、移动以及倾斜元素。
实例
如何使用 matrix 方法将 div 元素旋转 30 度：
```
div
{
transform:matrix(0.866,0.5,-0.5,0.866,0,0);
-ms-transform:matrix(0.866,0.5,-0.5,0.866,0,0);		/* IE 9 */
-moz-transform:matrix(0.866,0.5,-0.5,0.866,0,0);	/* Firefox */
-webkit-transform:matrix(0.866,0.5,-0.5,0.866,0,0);	/* Safari and Chrome */
-o-transform:matrix(0.866,0.5,-0.5,0.866,0,0);		/* Opera */
}
```

## 新的转换属性
### 新的转换属性
下面的表格列出了所有的转换属性：
```
属性	描述	CSS
transform	向元素应用 2D 或 3D 转换。	3
transform-origin	允许你改变被转换元素的位置。	3
```
### 2D Transform 方法
```
函数	描述
matrix(n,n,n,n,n,n)	定义 2D 转换，使用六个值的矩阵。
translate(x,y)	定义 2D 转换，沿着 X 和 Y 轴移动元素。
translateX(n)	定义 2D 转换，沿着 X 轴移动元素。
translateY(n)	定义 2D 转换，沿着 Y 轴移动元素。
scale(x,y)	定义 2D 缩放转换，改变元素的宽度和高度。
scaleX(n)	定义 2D 缩放转换，改变元素的宽度。
scaleY(n)	定义 2D 缩放转换，改变元素的高度。
rotate(angle)	定义 2D 旋转，在参数中规定角度。
skew(x-angle,y-angle)	定义 2D 倾斜转换，沿着 X 和 Y 轴。
skewX(angle)	定义 2D 倾斜转换，沿着 X 轴。
skewY(angle)	定义 2D 倾斜转换，沿着 Y 轴。
```

# CSS3 3D 转换

## 3D 转换
CSS3 允许您使用 3D 转换来对元素进行格式化。
在本章中，您将学到其中的一些 3D 转换方法：
>rotateX()
rotateY()

点击下面的元素，来查看 2D 转换与 3D 转换之间的不同之处：

## 它如何工作？
转换是使元素改变形状、尺寸和位置的一种效果。
您可以使用 2D 或 3D 转换来转换您的元素。

Internet Explorer 10 和 Firefox 支持 3D 转换。
Chrome 和 Safari 需要前缀 -webkit-。
Opera 仍然不支持 3D 转换（它只支持 2D 转换）。

## rotateX() 方法
通过 rotateX() 方法，元素围绕其 X 轴以给定的度数进行旋转。
实例
```
div
{
transform: rotateX(120deg);
-webkit-transform: rotateX(120deg);	/* Safari 和 Chrome */
-moz-transform: rotateX(120deg);	/* Firefox */
}
```

rotateY() 旋转
通过 rotateY() 方法，元素围绕其 Y 轴以给定的度数进行旋转。
实例
```
div
{
transform: rotateY(130deg);
-webkit-transform: rotateY(130deg);	/* Safari 和 Chrome */
-moz-transform: rotateY(130deg);	/* Firefox */
}
```

## 转换属性
下面的表格列出了所有的转换属性：
```
属性	描述	CSS
transform	向元素应用 2D 或 3D 转换。	3
transform-origin	允许你改变被转换元素的位置。	3
transform-style	规定被嵌套元素如何在 3D 空间中显示。	3
perspective	规定 3D 元素的透视效果。	3
perspective-origin	规定 3D 元素的底部位置。	3
backface-visibility	定义元素在不面对屏幕时是否可见。	3
```
2D Transform 方法
```
函数	描述
matrix3d(n,n,n,n,n,n,
n,n,n,n,n,n,n,n,n,n)	定义 3D 转换，使用 16 个值的 4x4 矩阵。
translate3d(x,y,z)	定义 3D 转化。
translateX(x)	定义 3D 转化，仅使用用于 X 轴的值。
translateY(y)	定义 3D 转化，仅使用用于 Y 轴的值。
translateZ(z)	定义 3D 转化，仅使用用于 Z 轴的值。
scale3d(x,y,z)	定义 3D 缩放转换。
scaleX(x)	定义 3D 缩放转换，通过给定一个 X 轴的值。
scaleY(y)	定义 3D 缩放转换，通过给定一个 Y 轴的值。
scaleZ(z)	定义 3D 缩放转换，通过给定一个 Z 轴的值。
rotate3d(x,y,z,angle)	定义 3D 旋转。
rotateX(angle)	定义沿 X 轴的 3D 旋转。
rotateY(angle)	定义沿 Y 轴的 3D 旋转。
rotateZ(angle)	定义沿 Z 轴的 3D 旋转。
perspective(n)	定义 3D 转换元素的透视视图
```

# CSS3 过渡

## CSS3 过渡
通过 CSS3，我们可以在不使用 Flash 动画或 JavaScript 的情况下，当元素从一种样式变换为另一种样式时为元素添加效果。

Internet Explorer 10、Firefox、Chrome 以及 Opera 支持 transition 属性。
Safari 需要前缀 -webkit-。
注释：Internet Explorer 9 以及更早的版本，不支持 transition 属性。
注释：Chrome 25 以及更早的版本，需要前缀 -webkit-。

## 它如何工作？
CSS3 过渡是元素从一种样式逐渐改变为另一种的效果。
要实现这一点，必须规定两项内容：
规定您希望把效果添加到哪个 CSS 属性上
规定效果的时长
实例

应用于宽度属性的过渡效果，时长为 2 秒：
```
div
{
transition: width 2s;
-moz-transition: width 2s;	/* Firefox 4 */
-webkit-transition: width 2s;	/* Safari 和 Chrome */
-o-transition: width 2s;	/* Opera */
}
```
*注释：如果时长未规定，则不会有过渡效果，因为默认值是 0。*

效果开始于指定的 CSS 属性改变值时。
CSS 属性改变的典型时间是鼠标指针位于元素上时：
实例
规定当鼠标指针悬浮于 &lt;div> 元素上时：
```
div:hover
{
width:300px;
}
```
注释：当指针移出元素时，它会逐渐变回原来的样式。

## 多项改变
如需向多个样式添加过渡效果，请添加多个属性，由逗号隔开：
实例
向宽度、高度和转换添加过渡效果：
```
div
{
transition: width 2s, height 2s, transform 2s;
-moz-transition: width 2s, height 2s, -moz-transform 2s;
-webkit-transition: width 2s, height 2s, -webkit-transform 2s;
-o-transition: width 2s, height 2s,-o-transform 2s;
}
```

## 过渡属性
下面的表格列出了所有的转换属性：
```
属性	描述	CSS
transition	简写属性，用于在一个属性中设置四个过渡属性。	3
transition-property	规定应用过渡的 CSS 属性的名称。	3
transition-duration	定义过渡效果花费的时间。默认是 0。	3
transition-timing-function	规定过渡效果的时间曲线。默认是 "ease"。	3
transition-delay	规定过渡效果何时开始。默认是 0。	3
```

实例
在一个例子中使用所有过渡属性：
```
div
{
transition-property: width;
transition-duration: 1s;
transition-timing-function: linear;
transition-delay: 2s;
/* Firefox 4 */
-moz-transition-property:width;
-moz-transition-duration:1s;
-moz-transition-timing-function:linear;
-moz-transition-delay:2s;
/* Safari 和 Chrome */
-webkit-transition-property:width;
-webkit-transition-duration:1s;
-webkit-transition-timing-function:linear;
-webkit-transition-delay:2s;
/* Opera */
-o-transition-property:width;
-o-transition-duration:1s;
-o-transition-timing-function:linear;
-o-transition-delay:2s;
}
```

实例
与上面的例子相同的过渡效果，但是使用了简写的 transition 属性：
```
div
{
transition: width 1s linear 2s;
/* Firefox 4 */
-moz-transition:width 1s linear 2s;
/* Safari and Chrome */
-webkit-transition:width 1s linear 2s;
/* Opera */
-o-transition:width 1s linear 2s;
}
```

# CSS3 动画
通过 CSS3，我们能够创建动画，这可以在许多网页中取代动画图片、Flash 动画以及 JaaScript。

## CSS3 @keyframes 规则
如需在 CSS3 中创建动画，您需要学习 @keyframes 规则。
@keyframes 规则用于创建动画。在 @keyframes 中规定某项 CSS 样式，就能创建由当前样式逐渐改为新样式的动画效果。

Internet Explorer 10、Firefox 以及 Opera 支持 @keyframes 规则和 animation 属性。
Chrome 和 Safari 需要前缀 -webkit-。
注释：Internet Explorer 9，以及更早的版本，不支持 @keyframe 规则或 animation 属性

实例
```
@keyframes myfirst
{
from {background: red;}
to {background: yellow;}
}

@-moz-keyframes myfirst /* Firefox */
{
from {background: red;}
to {background: yellow;}
}

@-webkit-keyframes myfirst /* Safari 和 Chrome */
{
from {background: red;}
to {background: yellow;}
}

@-o-keyframes myfirst /* Opera */
{
from {background: red;}
to {background: yellow;}
}
``` 

## CSS3 动画
当您在 @keyframes 中创建动画时，请把它捆绑到某个选择器，否则不会产生动画效果。
通过规定至少以下两项 CSS3 动画属性，即可将动画绑定到选择器：
规定动画的名称
规定动画的时长
实例
把 "myfirst" 动画捆绑到 div 元素，时长：5 秒：
```
div
{
animation: myfirst 5s;
-moz-animation: myfirst 5s;	/* Firefox */
-webkit-animation: myfirst 5s;	/* Safari 和 Chrome */
-o-animation: myfirst 5s;	/* Opera */
}
```
*注释：您必须定义动画的名称和时长。如果忽略时长，则动画不会允许，因为默认值是 0。*


## 什么是 CSS3 中的动画？
动画是使元素从一种样式逐渐变化为另一种样式的效果。
您可以改变任意多的样式任意多的次数。
请用百分比来规定变化发生的时间，或用关键词 "from" 和 "to"，等同于 0% 和 100%。
0% 是动画的开始，100% 是动画的完成。
*为了得到最佳的浏览器支持，您应该始终定义 0% 和 100% 选择器。*
实例
当动画为 25% 及 50% 时改变背景色，然后当动画 100% 完成时再次改变：
```
@keyframes myfirst
{
0%   {background: red;}
25%  {background: yellow;}
50%  {background: blue;}
100% {background: green;}
}

@-moz-keyframes myfirst /* Firefox */
{
0%   {background: red;}
25%  {background: yellow;}
50%  {background: blue;}
100% {background: green;}
}

@-webkit-keyframes myfirst /* Safari 和 Chrome */
{
0%   {background: red;}
25%  {background: yellow;}
50%  {background: blue;}
100% {background: green;}
}

@-o-keyframes myfirst /* Opera */
{
0%   {background: red;}
25%  {background: yellow;}
50%  {background: blue;}
100% {background: green;}
}
```

## CSS3 动画属性
下面的表格列出了 @keyframes 规则和所有动画属性：
```
属性	描述	CSS
@keyframes	规定动画。	3
animation	所有动画属性的简写属性，除了 animation-play-state 属性。	3
animation-name	规定 @keyframes 动画的名称。	3
animation-duration	规定动画完成一个周期所花费的秒或毫秒。默认是 0。	3
animation-timing-function	规定动画的速度曲线。默认是 "ease"。	3
animation-delay	规定动画何时开始。默认是 0。	3
animation-iteration-count	规定动画被播放的次数。默认是 1。	3
animation-direction	规定动画是否在下一周期逆向地播放。默认是 "normal"。	3
animation-play-state	规定动画是否正在运行或暂停。默认是 "running"。	3
animation-fill-mode	规定对象动画时间之外的状态。	3
```

实例
与上面的动画相同，但是使用了简写的动画 animation 属性：
```
div
{
animation: myfirst 5s linear 2s infinite alternate;
/* Firefox: */
-moz-animation: myfirst 5s linear 2s infinite alternate;
/* Safari 和 Chrome: */
-webkit-animation: myfirst 5s linear 2s infinite alternate;
/* Opera: */
-o-animation: myfirst 5s linear 2s infinite alternate;
}
```

# CSS3 多列

## CSS3 多列
通过 CSS3，您能够创建多个列来对文本进行布局 - 就像报纸那样！
在本章中，您将学习如下多列属性：
>column-count
column-gap
column-rule

Internet Explorer 10 和 Opera 支持多列属性。
Firefox 需要前缀 -moz-。
Chrome 和 Safari 需要前缀 -webkit-。
注释：Internet Explorer 9 以及更早的版本不支持多列属性。


## CSS3 创建多列
column-count 属性规定元素应该被分隔的列数：
实例
把 div 元素中的文本分隔为三列：
```
div
{
-moz-column-count:3; 	/* Firefox */
-webkit-column-count:3; /* Safari 和 Chrome */
column-count:3;
}
```

## CSS3 规定列之间的间隔
column-gap 属性规定列之间的间隔：
实例
规定列之间 40 像素的间隔：
```
div
{
-moz-column-gap:40px;		/* Firefox */
-webkit-column-gap:40px;	/* Safari 和 Chrome */
column-gap:40px;
}
```

## CSS3 列规则
column-rule 属性设置列之间的宽度、样式和颜色规则。
实例
规定列之间的宽度、样式和颜色规则：
```
div
{
-moz-column-rule:3px outset #ff0000;	/* Firefox */
-webkit-column-rule:3px outset #ff0000;	/* Safari and Chrome */
column-rule:3px outset #ff0000;
}
```

## 新的多列属性
下面的表格列出了所有的转换属性：
```
属性	描述	CSS
column-count	规定元素应该被分隔的列数。	3
column-fill	规定如何填充列。	3
column-gap	规定列之间的间隔。	3
column-rule	设置所有 column-rule-* 属性的简写属性。	3
column-rule-color	规定列之间规则的颜色。	3
column-rule-style	规定列之间规则的样式。	3
column-rule-width	规定列之间规则的宽度。	3
column-span	规定元素应该横跨的列数。	3
column-width	规定列的宽度。	3
columns	规定设置 column-width 和 column-count 的简写属性。	3
```

# CSS3 用户界面
CSS3 用户界面
在 CSS3 中，新的用户界面特性包括重设元素尺寸、盒尺寸以及轮廓等。
在本章中，您将学到以下用户界面属性：
>resize
box-sizing
outline-offset

Firefox、Chrome 以及 Safari 支持 resize 属性。
Internet Explorer、Chrome、Safari 以及 Opera 支持 box-sizing 属性。Firefox 需要前缀 -moz-。
所有主流浏览器都支持 outline-offset 属性，除了 Internet Explorer。
## CSS3 Resizing
在 CSS3，resize 属性规定是否可由用户调整元素尺寸。
这个 div 元素可由用户调整尺寸（在 Firefox 4+、Chrome 以及 Safari 中）。
CSS 代码如下：
实例
规定 div 元素可由用户调整大小：
```
div
{
resize:both;
overflow:auto;
}
```

## CSS3 Box Sizing
box-sizing 属性允许您以确切的方式定义适应某个区域的具体内容。
实例
规定两个并排的带边框方框：
```
div
{
box-sizing:border-box;
-moz-box-sizing:border-box;	/* Firefox */
-webkit-box-sizing:border-box;	/* Safari */
width:50%;
float:left;
}
```
## CSS3 Outline Offset
outline-offset 属性对轮廓进行偏移，并在超出边框边缘的位置绘制轮廓。
轮廓与边框有两点不同：
>轮廓不占用空间
<br/>轮廓可能是非矩形

CSS 代码如下：
实例
规定边框边缘之外 15 像素处的轮廓：
```
div
{
margin:20px;
width:150px; 
padding:10px;
height:70px;
border:2px solid black;
outline:2px solid red;
outline-offset:15px;
} 
```

## 新的用户界面属性
下面的表格列出了所有的转换属性：
```
属性	描述	CSS
appearance	允许您将元素设置为标准用户界面元素的外观	3
box-sizing	允许您以确切的方式定义适应某个区域的具体内容。	3
icon	为创作者提供使用图标化等价物来设置元素样式的能力。	3
nav-down	规定在使用 arrow-down 导航键时向何处导航。	3
nav-index	设置元素的 tab 键控制次序。	3
nav-left	规定在使用 arrow-left 导航键时向何处导航。	3
nav-right	规定在使用 arrow-right 导航键时向何处导航。	3
nav-up	规定在使用 arrow-up 导航键时向何处导航。	3
outline-offset	对轮廓进行偏移，并在超出边框边缘的位置绘制轮廓。	3
resize	规定是否可由用户对元素的尺寸进行调整。	3
```