<?php

define("SAE_MYSQL_HOST_M",     "ja-cdbr-azure-east-a.cloudapp.net");
define("SAE_MYSQL_USER",     "b5b35eecdcd068");
define("SAE_MYSQL_PASS",     "b5074189");
define("SAE_MYSQL_DB",     "rdbeacoAd7N1JMXE");
session_start();

//  表单提交后...
$posts = $_POST;
//  清除一些空白符号
foreach ($posts as $key => $value) {
    $posts[$key] = trim($value);
}
$password = $posts["password"];
$username = $posts["username"];

$conn = @mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
mysql_select_db(SAE_MYSQL_DB,$conn);
//查询用户是否存在
$result=mysql_query("SELECT * FROM user where userid='$username' and password='$password'",$conn);
if ($myrow = mysql_fetch_row($result)){
//以下为身份验证成功后的相关操作
    //alert();
    $_SESSION["admin"] = $username;
}else{
    $_SESSION["admin"] = null;
    die("用户名密码错误");
    header("location:login.html");
}
?>