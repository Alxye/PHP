<?php include("Auto_Check.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <style>
    #content1{width:90%;border:solid 1px #cccccc;}
</style>
</head>
<body>
<div id="content1">
    欢迎您！
    <hr>
    你好：<?php echo $_COOKIE["user"] ?><br>
    今天：<?php echo date("Y年m月d日");?>
</div>
</body>
</html>