<?php
//ȡĳ���ؼ���ֵ
$uname=$_POST["username"];
$pword=$_POST["password"];

if($uname=="aaa"&&$pword=="bbb")
{
 echo "<font color=blue>��½�ɹ���</font><hr>";
 echo "���$uname";
}
else 
 echo "<font color=red>��½ʧ�ܣ�</font>";
?>