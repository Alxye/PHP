<?php

echo "客户的IP地址：".$_SERVER['REMOTE_ADDR'];
//循环$_SERVER

foreach ($_SERVER as $key=>$value)
{
	echo $key,"........",$value,"<br>";
}

?>