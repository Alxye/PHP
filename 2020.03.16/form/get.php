<?php
 //取得一个网址参数
 echo $_GET["id"];
 
 //遍历$_GET数组
 foreach ($_GET as $key=>$value)
   echo $key."----".$value;
?>