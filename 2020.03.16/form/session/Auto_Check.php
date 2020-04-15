<?php
session_start();
if(!isset($_SESSION['user']))
{
    echo '<script>alert("您尚未登录！");location.href=("Auto_Login.php");</script>';
    return;
}
else{
    $user=$_SESSION['user'];
    $pass=$_SESSION['pass'];
}