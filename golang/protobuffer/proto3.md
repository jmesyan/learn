# 概述
这篇引导将介绍如何使用proto buffer 语言去组织你的proto buffer 数据， 包含 .proto文件语法和如何通过.proto文件产生数据入口类文件，这里讲述包含第三版protocol buffer 语言，获取更多老版proto2信息，请自行查阅, [proto2](https://developers.google.com/protocol-buffers/docs/proto)

# 定义一个消息类型
首先让我们查看一个简单例子。假如你想去定义一个搜索请求消息， 每一个搜索请求包含请求关键词query、查询页数page_number，还有每页结果条数result_per_page。下面的.proto文件可以用来定义这个消息类型:
````
syntax = "proto3";

message SearchRequest {
  string query = 1;
  int32 page_number = 2;
  int32 result_per_page = 3;
}
````
- 第一行定义说明你是用的是proto3的语法，如果没有，默认使用proto2语法，文件中第一行必须是一条非空和非注释的语句
- SearchRequest 消息定义了三种不同的字段(成对的name-value)，可以在每个需要该消息的文件中引入，每个字段都有一个名字和类型

## 定义字段类型
上面例子总包含两种字段类型, 都是标量类型-两个整形(page_number 和 result_per_page) 和一个字符串类型(query)。但是，你可能需要其他类型去组合你的字段，例如枚举类型和其他类型.
## 设置字段标签
正如你所看到的一样，每一个消息字段都会定义一个唯一的数字化标签，这些标签将会用来标识你的字段在消息中的二进制格式, 一旦你的消息类型在使用了就不应该再改变了。注意1-15的标签值占用1byte去编码，包括识别号码和字段的类型.16-2047标签值占用2bytes编码。所以你应该确保大量字段保存在1-15的标签纸，并且为未来可能大量使用的字段预留空间.
最小的标签值可以指定为1， 最大的为2^29-1 或者536，870，911.但是你不能使用19000-19999的标签值,因为它们作为了协议的缓存实现，当然也不能使用先前已经保存的标签,否则编译器会报错。
## 指定字段规则
消息字段可指定如下规则：
- 单数（singular）：一个格式良好的消息可以有零个或者一个这个字段-但是不超过一个
- 重复 (repeated) : 一个格式良好的消息可以重复该字段任意次（包括零次）, 重复次序将会保存。
在proto3里面, 重复字段是标量型数字将会默认使用打包编码.
## 添加更多的消息类型
多个消息类型可以定义在同一个.proto文件里，当你需要定义多个相关联的消息时这是非常有用的.例如你可以定义SearchResponse消息作为请求消息的回应，如下：
````
message SearchRequest {
  string query = 1;
  int32 page_number = 2;
  int32 result_per_page = 3;
}

message SearchResponse {
 ...
}
````
## 添加注释,
可以使用c/c++风格的注释, // 或者 /*...*/

````
/* SearchRequest represents a search query, with pagination options to
 * indicate which results to include in the response. */

message SearchRequest {
  string query = 1;
  int32 page_number = 2;  // Which page number do we want?
  int32 result_per_page = 3;  // Number of results to return per page.
}
````
## 预留字段
````
message Foo {
  reserved 2, 15, 9 to 11;
  reserved "foo", "bar";
}

````
如果未来有用户尝试使用如上预留的名称和标签数字，编译器编译时将会报错，注意同一个reserved中不能混合存放名称和标签数字
## 通过.proto编译会产生什么
当你使用proto buffer编译时将会产生你选择的开发语言所对应的代码，包括get和set字段值，序列化你的消息输出和解析你的消息输入.
-针对Go语言,将会为你每一个消息类型生成.pb.go文件


# 标量类型
一个标量消息字段可以有如下类型:
![](./images/proto1.png)
![](./images/proto2.png)

默认值：
- strings =>empty string
- bytes => empty bytes
- bools => false
- numeric => zero
- enums => 第一个定义的enum类型值，应该为0
要注意，如果将标量消息字段设置为它的默认值，则该值将不会被串行化

## 枚举类型
当你定义一个消息类型时，你可能想要定义一个包含预定义值的字段。例如为搜索请求消息添加一个字段corpus-词库， 词库可能包含如下关键词-UNIVERSAL, WEB, IMAGES, LOCAL, NEWS, PRODUCTS 或者 VIDEO， 你可以添加一个枚举类型将所有可能的词加入常量，示例如下:
````
message SearchRequest {
  string query = 1;
  int32 page_number = 2;
  int32 result_per_page = 3;
  enum Corpus {
    UNIVERSAL = 0;
    WEB = 1;
    IMAGES = 2;
    LOCAL = 3;
    NEWS = 4;
    PRODUCTS = 5;
    VIDEO = 6;
  }
  Corpus corpus = 4;
}
````
正如你所看到的，枚举类型的第一个常量词对应0， 每个枚举类型的第一个常量均应如此， 有两点原因：
- 1、必须有一个零值，我们可以使用数字0作为默认值
- 2、零值作为第一行，能够兼容proto2协议-第一行作为默认值

你可以通过添加 allow_alias = true 表述在不同枚举类型定义统一名称常量, 否则编译器发现同义词将会报错

````
enum EnumAllowingAlias {
  option allow_alias = true;
  UNKNOWN = 0;
  STARTED = 1;
  RUNNING = 1;
}
enum EnumNotAllowingAlias {
  UNKNOWN = 0;
  STARTED = 1;
  // RUNNING = 1;  // Uncommenting this line will cause a compile error inside Google and a warning message outside.
}
````
枚举常量必须是在32位整形常量范围内,自从枚举类型串行化时使用varint类型编码，编码负数效率比较低下，所以不太推荐。 如果枚举类型在消息类型外定义，可以起到重复利用的好处。另外你可以定义一个枚举消息类型，利用如下语法
````
MessageType.EnumType
````
如果你使用proto buffer编译器编译一个包含枚举类型的文件，不同语言会生成不同的格式
在反序列化的过程中，未确认的枚举值将会在消息中保存，这些值反序列后如何表达取决于不同的语言，如c++和Go，未知枚举值被简单地存储为其底层整数表示

## 使用其他消息类型
你可以使用其他的消息类型作为字段类型, 例如你可以在SearchRespone消息中包含一个结果消息类型, 示例如下：
````
message SearchResponse {
  repeated Result results = 1;
}

message Result {
  string url = 1;
  string title = 2;
  repeated string snippets = 3;
}
````
上述定义在同一个消息文件中， 如果定义在不同文件中可以通过import引入：
````
import "myproject/other_protos.proto";
````
默认情况下你只能使用已经引入已经定义好的.proto文件， 然而，有时你可能移动一个.proto文件到一个新的位置。在不改变所有引入proto文件的情况下，你可以使用一个废弃的旧文件里去引入新的文件位置使用 import public 关键字，示例如下：
````
// new.proto
// All definitions are moved here

// old.proto
// This is the proto that all clients are importing.
import public "new.proto";
import "other.proto";

// client.proto
import "old.proto";
// You use definitions from old.proto and new.proto, but not other.proto
````

编译器将会查找输入参数 -I / --proto_path下的文件，如果没有提供该参数，编译器将会查找编译调用的目录， 通过情况下你应该社会该参数为你的项目根目录， 并且将所有引入使用全路径

## 使用proto2消息类型
可以在proto3中使用proto2消息，但是proto2的枚举类型不能直接在proto3语法中使用,如果时引入的Proto2消息那是可以的。

# 嵌套定义
你可以在一个消息类型中定义和使用另一个消息类型,如下所示：
````
message SearchResponse {
  message Result {
    string url = 1;
    string title = 2;
    repeated string snippets = 3;
  }
  repeated Result results = 1;
}
````
如果想在这个消息外的消息中使用，可以使用Parent.type格式
````
message SomeOtherMessage {
  SearchResponse.Result result = 1;
}
````
你可以按照自己的想法多层嵌套
````
message Outer {                  // Level 0
  message MiddleAA {  // Level 1
    message Inner {   // Level 2
      int64 ival = 1;
      bool  booly = 2;
    }
  }
  message MiddleBB {  // Level 1
    message Inner {   // Level 2
      int32 ival = 1;
      bool  booly = 2;
    }
  }
}
````
# 更新一个消息类型
如果一个消息类型不再满足你的所有需求-例如, 你想消息中添加一个额外的字段，但是你仍然想使用老格式产生的代码，不用担心，在不破坏你原有代码的情况下可以很简单的更新你的消息。只要记住如下规则:
- 不要改变任何已经存在的数字标签
