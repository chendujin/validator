# Validator验证扩展包

## 安装

```composer require chendujin/validator ```

## 引用

```
require '../vendor/autoload.php';
use DataTrans\Validator;
```

## 判断是否为手机号码

```
$mobilephone = '123456';
$res = is_mobilephone($mobilephone);
var_dump($res);
```

## 判断email格式是否正确

```
$email = '123456@qq.com';
$res = is_email($email);
var_dump($res);
```

## 判断是否为QQ号码

```
$qq = '123456';
$res = is_qq($qq);
var_dump($res);
```

## 判断是否为合法的用户名

```
$username = 'Thomas';
$min_len = 3;
$max_len = 9;
$mode = 'mix';
$res = is_username($username, $min_len, $max_len, $mode);
var_dump($res);
```

## 判断是否为合法的密码

```
$password = '123456';
$min_len = 3;
$max_len = 9;
$mode = 'mix';
$res = is_password($password, $min_len, $max_len, $mode = 'mix');
var_dump($res);
```


## 验证身份证号码是否合法

```
$vStr = '1234562354253434';
$res = is_idcard($vStr);
var_dump($res);
```