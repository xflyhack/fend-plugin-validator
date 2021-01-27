## 1.2.22
* ValidatorFiler增加 mbstring ，使用mb\_strlen检测长度 -任成龙

## 1.2.21
* Validation: require && not found message can custom -徐炜杰 

## 1.2.20
* validatorFilter: 增加数组检测，减少warning提示 -袁也

## 1.2.19
* RumValidator：添加emptystr规则  -刘木荣
* RumValidator：修复filter\_var使用问题 -刘木荣

## 1.2.18
 * 修复validation json检测及错误的单元测试  -张小旭，长龙

## 1.2.17
 * 增加类laravel validation检测 -刘木荣、秘静雅、杨云超、李宗源、孟祥存、段超、韩天峰、安国雷、韩刚
 
## 1.2.15
 * 增加array类型验证，目前只是检测是否为数组 -邵王镇
 
## 1.2.13
 * validateFilter修复，设置key但未设置val导致warning提示、修复默认值弱类型检测错误导致0无效问题，设置enum传入类型in_array类型不严谨问题 -秘静雅
 
## 1.2.12
 * validateFilter增加数组批量添加规则功能 -秘静雅 长龙

## 1.2.11
 * 修复validateFilter 非必填没有default参数，有warning提示问题 -任成龙

## 1.2.10
 * 修复validateFilter 正则表达式不生效问题 -任成龙

## 1.2.9
 * 配合中台架构规范化，validateFilter开启自定义错误码功能addRuleEx -邵王镇

## 1.2.8
 * 增加自定义错误信息及错误码，用户可以定义错误提示文字内容及错误码,addRuleEx函数遗弃 -杜超群 徐长龙

## 1.2.7
 * 过滤后参数，不自动转换，防止数据精度丢失 -伟达
 * validator 验证功能失效修正 -秘静雅
 * validatorFilter 参数传入数组被转义问题 -尹伟达
