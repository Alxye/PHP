<?php

echo "�ͻ���IP��ַ��".$_SERVER['REMOTE_ADDR'];
//ѭ��$_SERVER

foreach ($_SERVER as $key=>$value)
{
	echo $key,"........",$value,"<br>";
}

?>