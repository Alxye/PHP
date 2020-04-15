<?php
if(empty($_COOKIE["jyh"]))
{
	//创建一个cookie
	setcookie("jyh","ccopen",time()+3600);
}
else 
{
	echo $_COOKIE["jyh"];
	
	print_r($_COOKIE);
}
?>