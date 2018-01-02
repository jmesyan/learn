# Node.js DES加密的简单实现
## 常见的加密算法基本分为这几类，1 :线性散列算法、2：对称性加密算法、3、非对称性加密算法 （记记记）
- 线性散列算法（签名算法）：MD5,SHA1,HMAC
比如MD5:即Message-Digest Algorithm 5（信息-摘要算法5），用于确保信息传输完整一致。
特点：
- 1、压缩性：任意长度的数据，算出的MD5值长度都是固定的。
- 2、容易计算：从原数据计算出MD5值很容易。
- 3、抗修改性：对原数据进行任何改动，哪怕只修改1个字节，所得到的MD5值都有很大区别。
- 4、强抗碰撞：已知原数据和其MD5值，想找到一个具有相同MD5值的数据（即伪造数据）是非常困难的。
MD5的作用是让大容量信息在用数字签名软件签署私人密钥前被"压缩"成一种保密的格式（就是把一个任意长度的字节串变换成一定长的十六进制数字串）
- 对称性加密算法：AES,DES,3DES
比如AES:(Advanced Encryption Standard)在密码学中又称Rijndael加密法，是美国联邦政府采用的一种区块加密标准。这个标准用来替代原先的DES，已经被多方分析且广为全世界所使用。
- 非对称性加密算法：RSA,DSA,ECC
比如RSA:RSA公开密钥密码体制。所谓的公开密钥密码体制就是使用不同的加密密钥与解密密钥，是一种“由已知加密密钥推导出解密密钥在计算上是不可行的”密码体制。
在公开密钥密码体制中，加密密钥（即公开密钥）PK是公开信息，而解密密钥（即秘密密钥）SK是需要保密的。加密算法E和解密算法D也都是公开的。虽然解密密钥SK是由公开密钥PK决定的，但却不能根据PK计算出SK。

## NodeJS中的Crypto模块
node利用 OpenSSL库来实现它的加密技术，这是因为OpenSSL已经是一个广泛被采用的加密算法。它包括了类似MD5 or SHA-1 算法，这些算法你可以利用在你的应用中。
下面的代码使用Crypto模块DES算法的实现方法
````
var crypto = require('crypto');
var key = '12345670';
exports.des = {

  algorithm:{ ecb:'des-ecb',cbc:'des-cbc' },
  encrypt:function(plaintext,iv){
    var key = new Buffer(key);
    var iv = new Buffer(iv ? iv : 0);
    var cipher = crypto.createCipheriv(this.algorithm.ecb, key, iv);
    cipher.setAutoPadding(true) //default true
    var ciph = cipher.update(plaintext, 'utf8', 'base64');
    ciph += cipher.final('base64');
    return ciph;
  },
  decrypt:function(encrypt_text,iv){
    var key = new Buffer(key);
    var iv = new Buffer(iv ? iv : 0);
    var decipher = crypto.createDecipheriv(this.algorithm.ecb, key, iv);
    decipher.setAutoPadding(true);
    var txt = decipher.update(encrypt_text, 'base64', 'utf8');
    txt += decipher.final('utf8');
    return txt;
  }

};
````
使用DES加密解密方法
````
//加密
var cryptUtil = require("./utils/crypt");
var str = "/upload/image/201602120012.jpg";
var encrypt_text = cryptUtil.des.encrypt(str,0);
var decrypt_text = cryptUtil.des.decrypt(encrypt_text,0);
console.log(encrypt_text);
console.log(decrypt_text);
````
输出结果：
I+qwOsXQvBq18KVmX3ainoMHbs3nT+v64s