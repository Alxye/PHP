<?php
$cname=$_FILES["fa"]["name"];
$namelist=explode(".",$cname);
$str=$namelist[count($namelist)-1];
$filename=date("ymdhis").".".$str;

//����һ�仰���Ϳ���ʵ���ϴ�����һ�������ǹ̶��ģ��ڶ�����ñ�����ļ�����
move_uploaded_file($_FILES["fa"]["tmp_name"],$filename);

?>