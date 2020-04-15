<?php
function auto_login()
{
    //自动登陆，其原理：读取客户端事先保存的cookie信息，如果正确，即登陆成功
    if(!empty($_COOKIE["user"])&&!empty($_COOKIE["pass"])) {
        if($_COOKIE["user"]=="root"&&$_COOKIE["pass"]=="0000")
            return true;
        else
            return false;
    }
    return false;
}
if(!auto_login())
{
    echo '<script>alert("你尚未登录！"); location.href=("Auto_Login.php");</script>';
    //return;
}
