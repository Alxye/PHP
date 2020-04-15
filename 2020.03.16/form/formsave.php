<?php
//取某个控件的值
$uname=$_POST["username"];
$pword=$_POST["password"];

if($uname=="aaa"&&$pword=="bbb")
{
 echo "<font color=blue>登陆成功！</font><hr>";
 echo "你好$uname";
}
else 
 echo "<font color=red>登陆失败！</font>";
?>