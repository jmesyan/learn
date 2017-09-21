# CSS 元素选择器

最常见的 CSS 选择器是元素选择器。换句话说，文档的元素就是最基本的选择器。
如果设置 HTML 的样式，选择器通常将是某个 HTML 元素，比如 p、h1、em、a，甚至可以是 html 本身

`` html {color:black;}``

## 类型选择器

在 W3C 标准中，元素选择器又称为类型选择器（type selector）。
“类型选择器匹配文档语言元素类型的名称。类型选择器匹配文档树中该元素类型的每一个实例。”
下面的规则匹配文档树中所有 h1 元素：

``h1 {font-family: sans-serif;}``


# CSS 分组

假设希望 h2 元素和段落都有灰色。为达到这个目的，最容易的做法是使用以下声明：

``h2, p {color:gray;}``

*提示：通过分组，创作者可以将某些类型的样式“压缩”在一起，这样就可以得到更简洁的样式表。*

## 通配符选择器
CSS2 引入了一种新的简单选择器 - 通配选择器（universal selector），显示为一个星号（*）。该选择器可以与任何元素匹配，就像是一个通配符。
例如，下面的规则可以使文档中的每个元素都为红色：

``*{color:red;}``

## 声明分组
我们既可以对选择器进行分组，也可以对声明分组。
假设您希望所有 h1 元素都有红色背景，并使用 28 像素高的 Verdana 字体显示为蓝色文本，可以写以下样式：
``
h1 {font: 28px Verdana;}
h1 {color: blue;}
h1 {background: red;}
``
但是上面这种做法的效率并不高。尤其是当我们为一个有多个样式的元素创建这样一个列表时会很麻烦。相反，我们可以将声明分组在一起：
``h1 {font: 28px Verdana; color: white; background: black;}``

*提示：在规则的最后一个声明后也加上分号是一个好习惯。在向规则增加另一个声明时，就不必担心忘记再插入一个分号*

## 结合选择器和声明的分组
我们可以在一个规则中结合选择器分组和声明分组，就可以使用很少的语句定义相对复杂的样式。
下面的规则为所有标题指定了一种复杂的样式：

``
h1, h2, h3, h4, h5, h6 {
  color:gray;
  background: white;
  padding: 10px;
  border: 1px solid black;
  font-family: Verdana;
  }
  ``
  上面这条规则将所有标题的样式定义为带有白色背景的灰色文本，其内边距是 10 像素，并带有 1 像素的实心边框，文本字体是 Verdana。


# CSS 类选择器详解
类选择器允许以一种独立于文档元素的方式来指定样式。

## CSS 类选择器
类选择器允许以一种独立于文档元素的方式来指定样式。
该选择器可以单独使用，也可以与其他元素结合使用。

*提示：只有适当地标记文档后，才能使用这些选择器，所以使用这两种选择器通常需要先做一些构想和计划。要应用样式而不考虑具体设计的元素，最常用的方法就是使用类选择器。*

## 修改 HTML 代码

在使用类选择器之前，需要修改具体的文档标记，以便类选择器正常工作。
为了将类选择器的样式与元素关联，必须将 class 指定为一个适当的值。请看下面的 HTML 代码：

&lt;h1 class="important">
This heading is very important.
&lt;/h1>

&lt;p class="important">
This paragraph is very important.
&lt;/p>

在上面的代码中，两个元素的 class 都指定为 important：第一个标题（ h1 元素），第二个段落（p 元素）。 

## 语法

然后我们使用以下语法向这些归类的元素应用样式，即类名前有一个点号（.），然后结合通配选择器：

``*.important {color:red;}``

如果您只想选择所有类名相同的元素，可以在类选择器中忽略通配选择器，这没有任何不好的影响：

``.important {color:red;}``

## 结合元素选择器

类选择器可以结合元素选择器来使用。
例如，您可能希望只有段落显示为红色文本：
``
p.important {color:red;}
``
选择器现在会匹配 class 属性包含 important 的所有 p 元素，但是其他任何类型的元素都不匹配，不论是否有此 class 属性。选择器 p.important 解释为：“其 class 属性值为 important 的所有段落”。 因为 h1 元素不是段落，这个规则的选择器与之不匹配，因此 h1 元素不会变成红色文本。
如果你确实希望为 h1 元素指定不同的样式，可以使用选择器 h1.important：
``
p.important {color:red;}
h1.important {color:blue;}
``
## CSS 多类选择器
在上一节中，我们处理了 class 值中包含一个词的情况。在 HTML 中，一个 class 值中可能包含一个词列表，各个词之间用空格分隔。例如，如果希望将一个特定的元素同时标记为重要（important）和警告（warning），就可以写作：`` class="important warning" ``

我们假设 class 为 important 的所有元素都是粗体，而 class 为 warning 的所有元素为斜体，class 中同时包含 important 和 warning 的所有元素还有一个银色的背景 。就可以写作：

``
.important {font-weight:bold;}
.warning {font-style:italic;}
.important.warning {background:silver;}
``

*通过把两个类选择器链接在一起，仅可以选择同时包含这些类名的元素（类名的顺序不限）。
如果一个多类选择器包含类名列表中没有的一个类名，匹配就会失败*

如果一个多类选择器包含类名列表中没有的一个类名，匹配就会失败。请看下面的规则：
``.important.urgent {background:silver;}``
不出所料，这个选择器将只匹配 class 属性中包含词 important 和 urgent 的 p 元素。因此，如果一个 p 元素的 class 属性中只有词 important 和 warning，将不能匹配。不过，它能匹配以下元素：
&lt;p class="important urgent warning">
This paragraph is a very important and urgent warning.
&lt;/p>

*重要事项：在 IE7 之前的版本中，不同平台的 Internet Explorer 都不能正确地处理多类选择器。*


# CSS ID 选择器详解
ID 选择器允许以一种独立于文档元素的方式来指定样式。

## CSS ID 选择器
在某些方面，ID 选择器类似于类选择器，不过也有一些重要差别。

## 语法
首先，ID 选择器前面有一个 # 号 - 也称为棋盘号或井号。
请看下面的规则：
``*#intro {font-weight:bold;}``
与类选择器一样，ID 选择器中可以忽略通配选择器。前面的例子也可以写作：
``#intro {font-weight:bold;}``
这个选择器的效果将是一样的。

## 类选择器还是 ID 选择器？
在类选择器这一章中我们曾讲解过，可以为任意多个元素指定类。前一章中类名 important 被应用到 p 和 h1 元素，而且它还可以应用到更多元素。

>区别 1：只能在文档中使用一次

与类不同，在一个 HTML 文档中，ID 选择器会使用一次，而且仅一次。
>区别 2：不能使用 ID 词列表

不同于类选择器，ID 选择器不能结合使用，因为 ID 属性不允许有以空格分隔的词列表。
>区别 3：ID 能包含更多含义

类似于类，可以独立于元素来选择 ID。有些情况下，您知道文档中会出现某个特定 ID 值，但是并不知道它会出现在哪个元素上，所以您想声明独立的 ID 选择器。例如，您可能知道在一个给定的文档中会有一个 ID 值为 mostImportant 的元素。您不知道这个最重要的东西是一个段落、一个短语、一个列表项还是一个小节标题。您只知道每个文档都会有这么一个最重要的内容，它可能在任何元素中，而且只能出现一个。在这种情况下，可以编写如下规则：
``#mostImportant {color:red; background:yellow;}``

这个规则会与以下各个元素匹配（这些元素不能在同一个文档中同时出现，因为它们都有相同的 ID 值）：

&lt;h1 id="mostImportant">This is important!</h1>

&lt;em id="mostImportant">This is important!</em>

&lt;ul id="mostImportant">This is important!</ul>

## 区分大小写
请注意，类选择器和 ID 选择器可能是区分大小写的。这取决于文档的语言。HTML 和 XHTML 将类和 ID 值定义为区分大小写，所以类和 ID 值的大小写必须与文档中的相应值匹配。
因此，对于以下的 CSS 和 HTML，元素不会变成粗体：
``#intro {font-weight:bold;}``

&lt;p id="Intro">This is a paragraph of introduction.&lt;/p>

由于字母 i 的大小写不同，所以选择器不会匹配上面的元素。


# CSS 属性选择器详解
CSS 2 引入了属性选择器。
属性选择器可以根据元素的属性及属性值来选择元素。

## 简单属性选择
如果希望选择有某个属性的元素，而不论属性值是什么，可以使用简单属性选择器。
如果您希望把包含标题（title）的所有元素变为红色，可以写作：

``*[title] {color:red;}``

与上面类似，可以只对有 href 属性的锚（a 元素）应用样式：

``a[href] {color:red;}``

还可以根据多个属性进行选择，只需将属性选择器链接在一起即可。
例如，为了将同时有 href 和 title 属性的 HTML 超链接的文本设置为红色，可以这样写：

``a[href][title] {color:red;}``

可以采用一些创造性的方法使用这个特性。
例如，可以对所有带有 alt 属性的图像应用样式，从而突出显示这些有效的图像：

``img[alt] {border: 5px solid red;}``
### 为 XML 文档使用属性选择器

属性选择器在 XML 文档中相当有用，因为 XML 语言主张要针对元素和属性的用途指定元素名和属性名。
假设我们为描述太阳系行星设计了一个 XML 文档。如果我们想选择有 moons 属性的所有 planet 元素，使之显示为红色，以便能更关注有 moons 的行星，就可以这样写：

``planet[moons] {color:red;}``

## 根据具体属性值选择
除了选择拥有某些属性的元素，还可以进一步缩小选择范围，只选择有特定属性值的元素。
例子 1
例如，假设希望将指向 Web 服务器上某个指定文档的超链接变成红色，可以这样写：
``a[href="http://www.w3school.com.cn/about_us.asp"] {color: red;}``

与简单属性选择器类似，可以把多个属性-值选择器链接在一起来选择一个文档。

``a[href="http://www.w3school.com.cn/"][title="W3School"] {color: red;}``

## 属性与属性值必须完全匹配

请注意，这种格式要求必须与属性值完全匹配。
如果属性值包含用空格分隔的值列表，匹配就可能出问题。

请考虑一下的标记片段：
``<p class="important warning">This paragraph is a very important warning.</p>``
如果写成 ``p[class="important"]``，那么这个规则不能匹配示例标记。
要根据具体属性值来选择该元素，必须这样写：
``p[class="important warning"] {color: red;}``

## 根据部分属性值选择

如果需要根据属性值中的词列表的某个词进行选择，则需要使用波浪号（~）。
假设您想选择 class 属性中包含 important 的元素，可以用下面这个选择器做到这一点：

``p[class~="important"] {color: red;}``

## 部分值属性选择器与点号类名记法的区别
该选择器等价于我们在类选择器中讨论过的点号类名记法。
也就是说，p.important 和 p[class="important"] 应用到 HTML 文档时是等价的。
那么，为什么还要有 "~=" 属性选择器呢？因为它能用于任何属性，而不只是 class。

例如，可以有一个包含大量图像的文档，其中只有一部分是图片。对此，可以使用一个基于 title 文档的部分属性选择器，只选择这些图片：
img[title~="Figure"] {border: 1px solid gray;}
这个规则会选择 title 文本包含 "Figure" 的所有图像。没有 title 属性或者 title 属性中不包含 "Figure" 的图像都不会匹配。

## 子串匹配属性选择器

下面为您介绍一个更高级的选择器模块，它是 CSS2 完成之后发布的，其中包含了更多的部分值属性选择器。按照规范的说法，应该称之为“子串匹配属性选择器”。
很多现代浏览器都支持这些选择器，包括 IE7。
下表是对这些选择器的简单总结：
>类型	描述
<br/>[abc^="def"]	选择 abc 属性值以 "def" 开头的所有元素
<br/>[abc$="def"]	选择 abc 属性值以 "def" 结尾的所有元素
<br/>[abc*="def"]	选择 abc 属性值中包含子串 "def" 的所有元素

## 特定属性选择类型
最后为您介绍特定属性选择器。请看下面的例子：

``*[lang|="en"] {color: red;}``

上面这个规则会选择 lang 属性等于 en 或以 en- 开头的所有元素

一般来说，[att|="val"] 可以用于任何属性及其值。

假设一个 HTML 文档中有一系列图片，其中每个图片的文件名都形如 figure-1.jpg 和 figure-2.jpg。就可以使用以下选择器匹配所有这些图像：
img[src|="figure"] {border: 1px solid gray;}
>[attribute~=value]	用于选取属性值中包含指定词汇的元素。
<br/>[attribute|=value]	用于选取带有以指定值开头的属性值的元素，该值必须是整个单词。
<br/>[attribute^=value]	匹配属性值以指定值开头的每个元素


# CSS 后代选择器

后代选择器（descendant selector）又称为包含选择器。
后代选择器可以选择作为某元素后代的元素。

## 根据上下文选择元素
我们可以定义后代选择器来创建一些规则，使这些规则在某些文档结构中起作用，而在另外一些结构中不起作用。
举例来说，如果您希望只对 h1 元素中的 em 元素应用样式，可以这样写：
``h1 em {color:red;}``
上面这个规则会把作为 h1 元素后代的 em 元素的文本变为 红色。其他 em 文本（如段落或块引用中的 em）则不会被这个规则选中：

## 语法解释
在后代选择器中，规则左边的选择器一端包括两个或多个用空格分隔的选择器。选择器之间的空格是一种结合符（combinator）。每个空格结合符可以解释为“... 在 ... 找到”、“... 作为 ... 的一部分”、“... 作为 ... 的后代”，但是要求必须从右向左读选择器。
因此，h1 em 选择器可以解释为 “作为 h1 元素后代的任何 em 元素”。如果要从左向右读选择器，可以换成以下说法：“包含 em 的所有 h1 会把以下样式应用到该 em”。

## 具体应用
后代选择器的功能极其强大。有了它，可以使 HTML 中不可能实现的任务成为可能。

假设有一个文档，其中有一个边栏，还有一个主区。边栏的背景为蓝色，主区的背景为白色，这两个区都包含链接列表。不能把所有链接都设置为蓝色，因为这样一来边栏中的蓝色链接都无法看到。

解决方法是使用后代选择器。在这种情况下，可以为包含边栏的 div 指定值为 sidebar 的 class 属性，并把主区的 class 属性值设置为 maincontent。然后编写以下样式：

>div.sidebar {background:blue;}
<br>div.maincontent {background:white;}
<br>div.sidebar a:link {color:white;}
<br>div.maincontent a:link {color:blue;}

*有关后代选择器有一个易被忽视的方面，即两个元素之间的层次间隔可以是无限的。
例如，如果写作 ul em，这个语法就会选择从 ul 元素继承的所有 em 元素，而不论 em 的嵌套层次多深*

# CSS 子元素选择器
与后代选择器相比，子元素选择器（Child selectors）只能选择作为某元素子元素的元素。
##  选择子元素
如果您不希望选择任意的后代元素，而是希望缩小范围，只选择某个元素的子元素，请使用子元素选择器（Child selector）。

例如，如果您希望选择只作为 h1 元素子元素的 strong 元素，可以这样写：
h1 > strong {color:red;}
这个规则会把第一个 h1 下面的两个 strong 元素变为红色，但是第二个 h1 中的 strong 不受影响

&lt;h1>This is &lt;strong>very&lt;/strong> &lt;strong>very&lt;/strong> important.&lt;/h1>
&lt;h1>This is &lt;em>really &lt;strong>very&lt;/strong>&lt;/em> important.&lt;/h1>

## 语法解释
您应该已经注意到了，子选择器使用了大于号（子结合符）。
子结合符两边可以有空白符，这是可选的

## 结合后代选择器和子选择器
请看下面这个选择器：

``table.company td > p``

上面的选择器会选择作为 td 元素子元素的所有 p 元素，这个 td 元素本身从 table 元素继承，该 table 元素有一个包含 company 的 class 属性。

# CSS 相邻兄弟选择器

相邻兄弟选择器（Adjacent sibling selector）可选择紧接在另一元素后的元素，且二者有相同父元素。

## 选择相邻兄弟
如果需要选择紧接在另一个元素后的元素，而且二者有相同的父元素，可以使用相邻兄弟选择器（Adjacent sibling selector）。

例如，如果要增加紧接在 h1 元素后出现的段落的上边距，可以这样写：
h1 + p {margin-top:50px;}

这个选择器读作：“选择紧接在 h1 元素后出现的段落，h1 和 p 元素拥有共同的父元素”。

## 语法解释
相邻兄弟选择器使用了加号（+），即相邻兄弟结合符（Adjacent sibling combinator）。

*注释：与子结合符一样，相邻兄弟结合符旁边可以有空白符。*

请看下面这个文档树片段：
<div>
  <ul>
    <li>List item 1</li>
    <li>List item 2</li>
    <li>List item 3</li>
  </ul>
  <ol>
    <li>List item 1</li>
    <li>List item 2</li>
    <li>List item 3</li>
  </ol>
</div>
在上面的片段中，div 元素中包含两个列表：一个无序列表，一个有序列表，每个列表都包含三个列表项。这两个列表是相邻兄弟，列表项本身也是相邻兄弟。不过，第一个列表中的列表项与第二个列表中的列表项不是相邻兄弟，因为这两组列表项不属于同一父元素（最多只能算堂兄弟）。
请记住，用一个结合符只能选择两个相邻兄弟中的第二个元素。请看下面的选择器：

``li + li {font-weight:bold;}``

上面这个选择器只会把列表中的第二个和第三个列表项变为粗体。第一个列表项不受影响。

## 结合其他选择器
相邻兄弟结合符还可以结合其他结合符：

``html > body table + ul {margin-top:20px;}``

这个选择器解释为：选择紧接在 table 元素后出现的所有兄弟 ul 元素，该 table 元素包含在一个 body 元素中，body 元素本身是 html 元素的子元素。

# CSS 伪类 (Pseudo-classes)

CSS 伪类用于向某些选择器添加特殊的效果。

## 语法
伪类的语法：

``selector : pseudo-class {property: value}``

CSS 类也可与伪类搭配使用。

``selector.class : pseudo-class {property: value}``

## 锚伪类
在支持 CSS 的浏览器中，链接的不同状态都可以不同的方式显示，这些状态包括：活动状态，已被访问状态，未被访问状态，和鼠标悬停状态。

>a:link {color: #FF0000}		/* 未访问的链接 */
<br/>a:visited {color: #00FF00}	/* 已访问的链接 */
<br/>a:hover {color: #FF00FF}	/* 鼠标移动到链接上 */
<br/>a:active {color: #0000FF}	/* 选定的链接 */

*提示：在 CSS 定义中，a:hover 必须被置于 a:link 和 a:visited 之后，才是有效的。*

*提示：在 CSS 定义中，a:active 必须被置于 a:hover 之后，才是有效的。*

*提示：伪类名称对大小写不敏感。*

## 伪类与 CSS 类
伪类可以与 CSS 类配合使用：

``a.red : visited {color: #FF0000}``

&lt;a class="red" href="css_syntax.asp">CSS Syntax&lt;/a>

假如上面的例子中的链接被访问过，那么它将显示为红色。

## CSS2 - :first-child 伪类
您可以使用 :first-child 伪类来选择元素的第一个子元素。这个特定伪类很容易遭到误解，所以有必要举例来说明。考虑以下标记：
<div>
<p>These are the necessary steps:</p>
<ul>
<li>Intert Key</li>
<li>Turn key <strong>clockwise</strong></li>
<li>Push accelerator</li>
</ul>
<p>Do <em>not</em> push the brake at the same time as the accelerator.</p>
</div>
在上面的例子中，作为第一个元素的元素包括第一个 p、第一个 li 和 strong 和 em 元素。
给定以下规则：

``p:first-child {font-weight: bold;}``

``li:first-child {text-transform:uppercase;}``

第一个规则将作为某元素第一个子元素的所有 p 元素设置为粗体。

第二个规则将作为某个元素（在 HTML 中，这肯定是 ol 或 ul 元素）第一个子元素的所有 li 元素变成大写。


*提示：最常见的错误是认为 p:first-child 之类的选择器会选择 p 元素的第一个子元素。*

注释：必须声明 <!DOCTYPE>，这样 :first-child 才能在 IE 中生效。

## CSS2 - :lang 伪类
:lang 伪类使你有能力为不同的语言定义特殊的规则。在下面的例子中，:lang 类为属性值为 no 的 q 元素定义引号的类型：

``
q:lang(no)
   {
   quotes: "~" "~"
   }
  ``

  `` 
  文字<q lang="no">段落中的引用的文字</q>文字
 ``

 ## 伪类
 W3C："W3C" 列指示出该属性在哪个 CSS 版本中定义（CSS1 还是 CSS2）。
>属性	描述	CSS
<br/>:active	向被激活的元素添加样式。	1
<br/>:focus	向拥有键盘输入焦点的元素添加样式。	2
<br/>:hover	当鼠标悬浮在元素上方时，向元素添加样式。	1
<br/>:link	向未被访问的链接添加样式。	1
<br/>:visited	向已被访问的链接添加样式。	1
<br/>:first-child	向元素的第一个子元素添加样式。	2
<br/>:lang	向带有指定 lang 属性的元素添加样式。	2

# CSS 伪元素 (Pseudo-elements)

CSS 伪元素用于向某些选择器设置特殊效果。

## 语法
伪元素的语法：

``selector:pseudo-element {property:value;}``

CSS 类也可以与伪元素配合使用：

``selector.class:pseudo-element {property:value;}``

## :first-line 伪元素
"first-line" 伪元素用于向文本的首行设置特殊样式。

在下面的例子中，浏览器会根据 "first-line" 伪元素中的样式对 p 元素的第一行文本进行格式化：
实例
``p:first-line
  {
  color:#ff0000;
  font-variant:small-caps;
  }
``

*注释："first-line" 伪元素只能用于块级元素。*

注释：下面的属性可应用于 "first-line" 伪元素：
>font
color
background
word-spacing
letter-spacing
text-decoration
vertical-align
text-transform
line-height
clear

## :first-letter 伪元素
"first-letter" 伪元素用于向文本的首字母设置特殊样式：

``
p:first-letter
  {
  color:#ff0000;
  font-size:xx-large;
  }
  ``

*注释："first-letter" 伪元素只能用于块级元素。*

注释：下面的属性可应用于 "first-letter" 伪元素：
>font
color
background
margin
padding
border
text-decoration
vertical-align (仅当 float 为 none 时)
text-transform
line-height
float
clear

## 伪元素和 CSS 类
伪元素可以与 CSS 类配合使用：

``
p.article:first-letter
  {
  color: #FF0000;
  }
``

``<p class="article">This is a paragraph in an article。</p>``

上面的例子会使所有 class 为 article 的段落的首字母变为红色。

## 多重伪元素
可以结合多个伪元素来使用。
在下面的例子中，段落的第一个字母将显示为红色，其字体大小为 xx-large。第一行中的其余文本将为蓝色，并以小型大写字母显示。段落中的其余文本将以默认字体大小和颜色来显示：
```
  p:first-letter
  {
  color:#ff0000;
  font-size:xx-large;
  }

  p:first-line
  {
  color:#0000ff;
  font-variant:small-caps;
  }

```

## CSS2 - :before 伪元素

":before" 伪元素可以在元素的内容前面插入新内容。
下面的例子在每个 &lt;h1> 元素前面插入一幅图片：
```
h1:before
  {
  content:url(logo.gif);
  }
```

## CSS2 - :after 伪元素
":after" 伪元素可以在元素的内容之后插入新内容。
下面的例子在每个 &lt;h1> 元素后面插入一幅图片：
```
  h1:after
  {
  content:url(logo.gif);
  }
```

## 伪元素
W3C："W3C" 列指示出该属性在哪个 CSS 版本中定义（CSS1 还是 CSS2）。
>属性	描述	CSS
<br/>:first-letter	向文本的第一个字母添加特殊样式。	1
<br/>:first-line	向文本的首行添加特殊样式。	1
<br/>:before	在元素之前添加内容。	2
<br/>:after	在元素之后添加内容。	2