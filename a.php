<?php
$con =mysqli_connect ('localhost','root','');
if(!$con)
{
    die('连接错误：'.mysqli_connect_error());
}
else
    echo "连接成功";