<?php
$cname=$_FILES["fa"]["name"];
$namelist=explode(".",$cname);
$str=$namelist[count($namelist)-1];
$filename=date("ymdhis").".".$str;

//就这一句话，就可以实现上传，第一个参数是固定的，第二个你好保存的文件名称
move_uploaded_file($_FILES["fa"]["tmp_name"],$filename);

?>