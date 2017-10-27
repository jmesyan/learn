数据收集并妥善管理数据是网络应用共同的必要。CRUD 允许我们生成页面列表，并编辑数据库记录。本教程将向你演示如何使用 jQuery EasyUI 框架实现一个 CRUD DataGrid。
我们将使用下面的插件：
>datagrid：向用户展示列表数据。
<br/>dialog：创建或编辑一条单一的用户信息。
<br/>form：用于提交表单数据。
<br/>messager：显示一些操作信息。

[源码内容详见](../example/curd/curd1.php)

## 步骤 1：准备数据库
我们将使用 MySql 数据库来存储用户信息。创建数据库和 'users' 表。

``id firstname lastname phone email``

## 步骤 2：创建 DataGrid 来显示用户信息
创建没有 javascript 代码的 DataGrid。


DataGrid 使用 'url' 属性，并赋值为 'get_users.php'，用来从服务器检索数据。

## 步骤 3：创建表单对话框
我们使用相同的对话框来创建或编辑用户。

## 步骤 4：实现创建和编辑用户
当创建用户时，打开一个对话框并清空表单数据。

## 步骤 5：保存用户数据
我们使用下面的代码保存用户数据：

*提交表单之前，'onSubmit' 函数将被调用，该函数用来验证表单字段值。当表单字段值提交成功，关闭对话框并重新加载 datagrid 数据。*

## 步骤 6：删除一个用户
我们使用下面的代码来移除一个用户：