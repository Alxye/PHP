<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户列表</title>
</head>
<body>
<form>
    <input type="text" value="hello?">
    <input type="submit">
</form>
<hr>
<hr>
<?php 
  $con = mysqli_connect("localhost","root","","aa");
   
   
  $pageSize = 8;   //每页显示的数量
  $rowCount = 0;   //要从数据库中获取
  $pageNow = 1;    //当前显示第几页
   
  //如果有pageNow就使用，没有就默认第一页。
  if (!empty($_GET['pageNow'])){
    $pageNow = $_GET['pageNow'];
  }
   
  $pageCount = 0;  //表示共有多少页
   
  $sql1 = "select count(sno) from stu";
  $res1 = $con->query($sql1);
   
  if($row1=mysqli_fetch_row($res1)){
    $rowCount = $row1[0];
  }
   
  //计算共有多少页，ceil取进1
  $pageCount = ceil(($rowCount/$pageSize));
   
  //使用sql语句时，注意有些变量应取出赋值。
  $pre = ($pageNow-1)*$pageSize;
   
  $sql2 = "select * from stu limit $pre,$pageSize";
  $res2 = $con->query($sql2);
  
  while($row = $res2->fetch_array() ){
    echo $row['sno']."--";
    echo $row['sname']."--";
    echo $row['sage']."--";
    echo $row['sdept']."--";
    echo $row['saddress']."--";
	echo "<br>";
  }
  for ($i=1;$i<=$pageCount;$i++){
    echo "<a href='paging.php?pageNow=$i'>$i</a> ";
  }
?>
</body>
</html>