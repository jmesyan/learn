# CSS 水平对齐

在 CSS 中，可以使用多种属性来水平对齐元素。

## 对齐块元素
块元素指的是占据全部可用宽度的元素，并且在其前后都会换行。

### 使用 margin 属性来水平对齐
可通过将左和右外边距设置为 "auto"，来对齐块元素。
注释：除非已经声明了 !DOCTYPE，否则使用 margin:auto 在 IE8 以及更早的版本中是无效的。
把左和右外边距设置为 auto，规定的是均等地分配可用的外边距。结果就是居中的元素：

实例
```
.center
{
margin-left:auto;
margin-right:auto;
width:70%;
background-color:#b0e0e6;
}
```
*提示：如果宽度是 100%，则对齐没有效果。*

注释：在 IE5 中，对于块元素存在一个外边距处理方面的 BUG。如需使上面的例子在 IE5 中有效，请添加一些额外的代码

### 使用 position 属性进行左和右对齐
对齐元素的方法之一是使用绝对定位：
实例
```
.right
{
position:absolute;
right:0px;
width:300px;
background-color:#b0e0e6;
}
```
*注释：绝对定位元素会被从正常流中删除，并且能够交叠元素。*

## 使用 float 属性来进行左和右对齐
对齐元素的另一种方法是使用 float 属性：
实例
```
.right
{
float:right;
width:300px;
background-color:#b0e0e6;
}
```

## 跨浏览器兼容性问题
当像这样对齐元素时，对 &lt;body> 元素的外边距和内边距进行预定义是一个好主意。
这样可以避免在不同的浏览器中出现可见的差异。

当使用 position 属性时，IE8 以及更早的版本存在一个问题。如果容器元素（在我们的案例中是 &lt;div class="container">）设置了指定的宽度，并且省略了 !DOCTYPE 声明，那么 IE8 以及更早的版本会在右侧增加 17px 的外边距。这似乎是为滚动条预留的空间。

*当使用 position 属性时，请始终设置 !DOCTYPE 声明：*

实例
```
body
{
margin:0;
padding:0;
}
.container
{
position:relative;
width:100%;
}
.right
{
position:absolute;
right:0px;
width:300px;
background-color:#b0e0e6;
}
```

# CSS 尺寸 (Dimension)
CSS 尺寸 (Dimension) 属性允许你控制元素的高度和宽度。同样，它允许你增加行间距

CSS 尺寸属性允许你控制元素的高度和宽度。同样，还允许你增加行间距。
```
属性	描述
height	设置元素的高度。
line-height	设置行高。
max-height	设置元素的最大高度。
max-width	设置元素的最大宽度。
min-height	设置元素的最小高度。
min-width	设置元素的最小宽度。
width	设置元素的宽度。
```

# CSS 分类 (Classification)
CSS 分类属性允许你规定如何以及在何处显示元素。

CSS 分类属性允许你控制如何显示元素，设置图像显示于另一元素中的何处，相对于其正常位置来定位元素，使用绝对值来定位元素，以及元素的可见度。
```
属性	描述
clear	设置一个元素的侧面是否允许其他的浮动元素。
cursor	规定当指向某元素之上时显示的指针类型。
display	设置是否及如何显示元素。
float	定义元素在哪个方向浮动。
position	把元素放置到一个静态的、相对的、绝对的、或固定的位置中。
visibility	设置元素是否可见或不可见。
```

# CSS 导航条

## 导航栏
拥有易用的导航条对于任何网站都很重要。
通过 CSS，您能够把乏味的 HTML 菜单转换为漂亮的导航栏。

## 导航栏 = 链接列表
导航栏需要标准的 HTML 作为基础。

在我们的例子中，将用标准的 HTML 列表来构建导航栏。

导航栏基本上是一个链接列表，因此使用 &lt;ul> 和 &lt;li> 元素是非常合适的

## 垂直导航栏
如需构建垂直导航栏，我们只需要定义 &lt;a> 元素的样式，除了上面的代码之外：
实例
```
a
{
display:block;
width:60px;
}

```

display:block - 把链接显示为块元素可使整个链接区域可点击（不仅仅是文本），同时也允许我们规定宽度。
width:60px - 块元素默认占用全部可用宽度。我们需要规定 60 像素的宽度

## 水平导航栏

有两种创建水平导航栏的方法。使用行内或浮动列表项。

两种方法都不错，但是如果您希望链接拥有相同的尺寸，就必须使用浮动方法。

### 行内列表项
除了上面的“标准”代码，构建水平导航栏的方法之一是将 &lt;li> 元素规定为行内元素：
实例
```
li
{
 display:inline;
}
```
display:inline; - 默认地，&lt;li> 元素是块元素。在这里，我们去除了每个列表项前后的换行，以便让它们在一行中显示。

### 对列表项进行浮动
在上面的例子中，链接的宽度是不同的。

为了让所有链接拥有相等的宽度，浮动 &lt;li> 元素并规定 &lt;a> 元素的宽度：
实例
```
li
{
    float:left;
}
a
{
    display:block;
    width:60px;
}
```

例子解释：
>float:left - 使用 float 来把块元素滑向彼此。
<br/>display:block - 把链接显示为块元素可使整个链接区域可点击（不仅仅是文本），同时也允许我们规定宽度。
<br/>width:60px - 由于块元素默认占用全部可用宽度，链接无法滑动至彼此相邻。我们需要规定 60 像素的宽度。


# CSS 图片库

## 图片库
下面的图片库是由 CSS 创建的：
实例
```
<!doctype html>
<html>
<head>
<style>
div.img
  {
  margin:3px;
  border:1px solid #bebebe;
  height:auto;
  width:auto;
  float:left;
  text-align:center;
  }
div.img img
  {
  display:inline;
  margin:3px;
  border:1px solid #bebebe;
  }
div.img a:hover img
  {
  border:1px solid #333333;
  }
div.desc
  {
  text-align:center;
  font-weight:normal;
  width:150px;
  font-size:12px;
  margin:10px 5px 10px 5px;
  }
</style>
</head>
<body>

<div class="img">
  <a target="_blank" href="/i/tulip_ballade.jpg">
  <img src="/i/tulip_ballade_s.jpg" alt="Ballade" width="160" height="160">
  </a>
  <div class="desc">在此处添加对图像的描述</div>
</div>

<div class="img">
  <a target="_blank" href="/i/tulip_flaming_club.jpg">
  <img src="/i/tulip_flaming_club_s.jpg" alt="Ballade" width="160" height="160">
  </a>
  <div class="desc">在此处添加对图像的描述</div>
</div>

<div class="img">
  <a target="_blank" href="/i/tulip_fringed_family.jpg">
  <img src="/i/tulip_fringed_family_s.jpg" alt="Ballade" width="160" height="160">
  </a>
  <div class="desc">在此处添加对图像的描述</div>
</div>

<div class="img">
  <a target="_blank" href="/i/tulip_peach_blossom.jpg">
  <img src="/i/tulip_peach_blossom_s.jpg" alt="Ballade" width="160" height="160">
  </a>
  <div class="desc">在此处添加对图像的描述</div>
</div>

</body>
</html>
```

# CSS 图像透明度

通过 CSS 创建透明图像是很容易的。

注释：CSS opacity 属性是 W3C CSS 推荐标准的一部分。

## 实例 1 - 创建透明图像
定义透明效果的 CSS3 属性是 opacity。

首先，我们将展示如何通过 CSS 来创建透明图像。

请看下面的 CSS：
```
img
{
opacity:0.4;
filter:alpha(opacity=40); /* 针对 IE8 以及更早的版本 */
}
```
IE9, Firefox, Chrome, Opera 和 Safari 使用属性 opacity 来设定透明度。
opacity 属性能够设置的值从 0.0 到 1.0。值越小，越透明。

*IE8 以及更早的版本使用滤镜 filter:alpha(opacity=x)。x 能够取的值从 0 到 100。值越小，越透明。*

## 实例 2 - 图像透明度 - Hover 效果
请把鼠标指针移动到图像上：
CSS 是这样的：
```
img
{
opacity:0.4;
filter:alpha(opacity=40); /* 针对 IE8 以及更早的版本 */
}
img:hover
{
opacity:1.0;
filter:alpha(opacity=100); /* 针对 IE8 以及更早的版本 */
}
```
第一个 CSS 代码块类似实例 1 中的代码。
此外，我们已经设置了当鼠标指针位于图像上时的样式。
在这个例子中，当指针移动到图像上时，我们希望图像是不透明的。
对应的 CSS 是：opacity=1。
IE8 以及更早的浏览器：filter:alpha(opacity=100)。
当鼠标指针移出图像后，图像会再次透明。

## 实例 3 - 透明框中的文本

源代码是这样的：
```
<!DOCTYPE html>
<html>
<head>
<style>
div.background
{
  width: 400px;
  height: 266px;
  background: url('/i/tulip_peach_blossom_w.jpg') no-repeat;
  border: 1px solid black;
}

div.transbox
{
  width: 338px;
  height: 204px;
  margin:30px;
  background-color: #ffffff;
  border: 1px solid black;
  /* for IE */
  filter:alpha(opacity=60);
  /* CSS3 standard */
  opacity:0.6;
}

div.transbox p
{
  margin: 30px 40px;
}
</style>
</head>

<body>

<div class="background">
<div class="transbox">
<p>
This is some text that is placed in the transparent box.
This is some text that is placed in the transparent box.
This is some text that is placed in the transparent box.
This is some text that is placed in the transparent box.
This is some text that is placed in the transparent box.
</p>
</div>
</div>

</body>
</html>
```
>首先，我们创建一个 div 元素 (class="background")，它有固定的高度和宽度、背景图像，以及边框。
<br/>然后我们在第一个 div 内创建稍小的 div (class="transbox")。"transbox" div 有固定的宽度、背景色和边框 - 并且它是透明的。在透明 div 内部，我们在 p 元素中加入了一些文本。


# CSS2 媒介类型

媒介类型(Media Types)允许你定义以何种媒介来提交文档。文档可以被显示在显示器、纸媒介或者听觉浏览器等等。

## 媒介类型
某些 CSS 属性仅仅被设计为针对某些媒介。比方说 "voice-family" 属性被设计为针对听觉用户终端。其他的属性可被用于不同的媒介。例如，"font-size" 属性可被用于显示器以及印刷媒介，但是也许会带有不同的值。显示器上面的显示的文档通常会需要比纸媒介文档更大的字号，同时，在显示器上，sans-serif 字体更易阅读，而在纸媒介上，serif 字体更易阅读。

## @media规则
@media 规则使你有能力在相同的样式表中，使用不同的样式规则来针对不同的媒介。
下面这个例子中的样式告知浏览器在显示器上显示 14 像素的 Verdana 字体。但是假如页面需要被打印，将使用 10 个像素的 Times 字体。注意：font-weight 被设置为粗体，不论显示器还是纸媒介：
```
<html>
<head>

<style>
@media screen
{
p.test {font-family:verdana,sans-serif; font-size:14px}
}

@media print
{
p.test {font-family:times,serif; font-size:10px}
}

@media screen,print
{
p.test {font-weight:bold}
}
</style>

</head>

<body>....</body>

</html>
```
## 不同的媒介类型
注释：媒介类型名称对大小写不敏感。
```
媒介类型	描述
all	用于所有的媒介设备。
aural	用于语音和音频合成器。
braille	用于盲人用点字法触觉回馈设备。
embossed	用于分页的盲人用点字法打印机。
handheld	用于小的手持的设备。
print	用于打印机。
projection	用于方案展示，比如幻灯片。
screen	用于电脑显示器。
tty	用于使用固定密度字母栅格的媒介，比如电传打字机和终端。
tv	用于电视机类型的设备。
```

# CSS 注意事项

本节列出了在使用 CSS 时尽量避免使用的技术。

## Internet Explorer Behaviors
它是什么？Internet Explorer 5 引入了行为 (behaviors)。behaviors 是一种通过使用 CSS 向 HTML 元素添加行为的方法。

为什么要避免它？只有 Internet Explorer 支持 behavior 属性。

用什么代替？请使用 JavaScript 和 HTML DOM 取而代之。

## 例子 1 - Mouseover Highlight
下面的 HTML 文件中有一个 &lt;style> 元素，它为 &lt;h1> 元素定义了一个行为：
```
<html>
<head>
<style type="text/css">
h1 { behavior: url(behave.htc) }
</style>
</head>

<body>
<h1>Mouse over me!!!</h1>
</body>
</html>
```
下面是 XML 文档 "behave.htc"：
```
<attach for="element" event="onmouseover" handler="hig_lite" />
<attach for="element" event="onmouseout" handler="low_lite" />

<script type="text/javascript">
function hig_lite()
{
element.style.color='red';
}

function low_lite()
{
element.style.color='blue';
}
</script>
```

behavior 文件包含了针对元素的 JavaScript 和 事件句柄

## 例子 2 - Typewriter Simulation
下面的 HTML 文件中有一个 &lt;style> 元素，它为 id 为 "typing" 的元素定义了一个行为：
```
<html>
<head>
<style type="text/css">
#typing
{
behavior:url(behave_typing.htc);
font-family:'courier new';
}
</style>
</head>

<body>
<span id="typing" speed="100">IE5 introduced DHTML behaviors.
Behaviors are a way to add DHTML functionality to HTML elements
with the ease of CSS.<br /><br />How do behaviors work?<br />
By using XML we can link behaviors to any element in a web page
and manipulate that element.</p>
</span>
</body>
</html>
```
下面是 XML 文档 "behave.htc"：
```
<attach for="window" event="onload" handler="beginTyping" />
<method name="type" />

<script type="text/javascript">
var i,text1,text2,textLength,t;

function beginTyping()
{
i=0;
text1=element.innerText;
textLength=text1.length;
element.innerText="";
text2="";
t=window.setInterval(element.id+".type()",speed);
}

function type()
{
text2=text2+text1.substring(i,i+1);
element.innerText=text2;
i=i+1;
if (i==textLength)
  {
  clearInterval(t);
  }
}
```
</script>