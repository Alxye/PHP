<?php include("Auto_Check.php");
if(isset($_SESSION['user'])) $username=$_SESSION["user"];
if(isset($_POST['quit'])){
    echo "6666";
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["pass"]);
    header("location:Auto_Check.php");
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <style>
    #content1{width:90%;border:solid 1px #cccccc;}
</style>
</head>
<div id="content1">
    <ul>
        <li>欢迎访问首页</li>
    </ul>
    你好：<?php echo $username ?><br>
    今天：<?php echo date("Y年m月d日");?> <br/>
    <form method="post" action="Auto_Index.php"> <input type="submit" name="quit" value="退出登录"></input></form>
</div>
</body>
</html>