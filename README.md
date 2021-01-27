# Fend Validator组件
## 简介
Validator组件是Fend框架验证参数类合集，目前主要有两款：
  * ValidateFilter 新封装的参数统一校验类，能够统一登记参数验证规则（必填、数据类型、取值范围、默认值、自定义闭包规则），支持类似swagger API文档导出（建设中）
  * Validator 老款仿造Thinkphp实现的validator，对输入参数多规则验证，目前没有在维护，后续会投入精力进行整理

## 安装
 ```bash
 composer require php/fend-plugin-validator
 ```
 
## ValidatorFilter 使用样例
```php
<?php
//演示输入参数
$param = [
    "must"     => true,
    "string"   => "wahahah",
    "int"      => "3244",
    "float"    => "43.6",
    "double"   => "123.1",
    "email"    => "test@qq.com",
    "enum"     => "yes",
    "callback" => "ahaha",
];
//创建验证类，提供当前接口网址及功能介绍，及获取参数方式method（GET\POST等）
//当请求本接口附带tal_sec=show_param_json时，会输出下面录入的所有参数信息json格式，用于生成wiki
$validate = new \Fend\ValidateFilter("http://www.test.php/user/info", "根据学生id查找学生信息", "get");

//用于生成接口文档返回结果，demo请求参数，可以提供多组，每组体现不同情况
$validate->addDemoParameter([["uid" => 12312], ["uid" => 123]]);

//接口参数规则
//bool检测
$validate->addRule("must", "bool", "bool类型，必填字段", true);
//int检测，只是检测内容是否都为数字，类型不检测，不转换预防超长int被转换溢出
$validate->addRule("default", "int", "int类型，非必填，默认1", false, 1);
//字符串检测
$validate->addRule("string", "string", "用户uid", false, "", [1, 10]);
$validate->addRule("int", "int", "用户uid的int写法", false, "", [1, 20000]);
//浮点检测，返回结果不转类型成float防止丢失精度
$validate->addRule("float", "float", "float类型", false, "", [1, 20000]);
$validate->addRule("double", "double", "double", false, "", [1, 20000]);
$validate->addRule("email", "email", "email检测", false);
//用户输入项，必须是可选范围内选项
$validate->addRule("enum", "enum", "enum检测:yes代表xx，no代表xx", false, "", ["yes", "no"]);

//闭包自定义参数校验规则
$callback = function ($key, $val) {
    if ($val != "ahaha") {
        throw new \Exception("嗯错误了");
    }
    return $val;
};

$validate->addRule("callback", "callback", "用户回调规则", false, "", $callback);

//自定义错误提示信息及错误码
$message = [
            "must.require" => ["must必填,自定义哈",223],
            "string.int" => "user_id 必须是数值",
            "float.float" => ["只要float", 3636], //数组类型，第二个参数为自定义exception错误码
            "regx.regx" => "regx 必须由数字英文字符串组成",
            "user_name.string" => "user_name 必须是字符串类型数据",
 ];
$validate->addMessage($message);

try{
    //$param为演示数据，建议实际使用传递\Fend\Di::Factory()->get("Request")->get(); || \Fend\Di::Factory()->get("Request")->post();
    $result = $validate->checkParam($param);
}catch(\Exception $e) {
    return Di::factory()->getResponse()->json(["state"=> 0, "msg" => $e->getMessage(), "code" => $e->getCode()]);
}

//返回所有符合条件的变量，包括没有传递但是有默认值参数
var_dump($result);

//批量添加rule演示
$rules = [
            "must" => ["bool", "bool类型，必填字段", true],
            "default" => ["int", "int类型，非必填，默认1", false, 1],
            "string" => ["string", "用户uid", false, "", [1, 10]],
            "int" => ["int", "用户uid的int写法", false, "", [1, 20000]],
            "float" => ["float", "float类型", false, "", [1, 20000]],
            "double" => ["double", "double", false, "", [1, 20000]],
            "email" => ["email", "email检测", false],
            "enum" => ["enum", "enum检测:yes代表xx，no代表xx", false, "", ["yes", "no"]],
            "heiheihei" => ["string", "非必填，没填写", false],
            "testreg" => ["regx:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", "邮件正则检测", true],
            "t" => ["callback", "邮件正则检测", true, "", [validatefilterTest::class, "t1"]],
            "callback" => ["callback", "用户回调规则", false, "", $callback],
        ];

        $validate->addMultiRule($rules);
?>

```

## Validator 使用样例
类Thinkphp方式的validator，目前还在整理阶段
```php
<?php
 $rules = array(
    'name' => 'alpha|required', 
    'age'=> 'num--只能是数字|required--必须的', 
    'color' => 'optional--非必填|min:5--最小长度为5'
 );
 list($valdi_data,$errors) = validate($_POST, $rules);
```
