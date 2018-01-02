*只有在规定了 !DOCTYPE 时，IE7 和 IE8 才支持属性选择器。在 IE6 及更低的版本中，不支持属性选择。*
## 样例
``
[title]
{
color:red;
}
``

lang属性默认包含en

属性选择器在为不带有 class 或 id 的表单设置样式时特别有用：

`` 
input[type="text"]
{
  width:150px;
  display:block;
  margin-bottom:10px;
  background-color:yellow;
  font-family: Verdana, Arial;
}

input[type="button"]
{
  width:120px;
  margin-left:35px;
  display:block;
  font-family: Verdana, Arial;
}
``