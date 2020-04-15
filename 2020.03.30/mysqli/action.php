
<?php
try {
	$conn=new mysqli("localhost","root","","course_system");
}
catch (Exception $e) {
	die("数据库连接失败".$e->getMessage());
}
$conn->set_charset('utf8');
//操作
switch ($_GET['action']){
	case "add":
		  $id=$_POST['id'];
		  $name=$_POST['name'];
		  $age=$_POST['age'];
		  $address=$_POST['address'];
		  $sql="insert into student values(null,'{$id}','{$name}','{$age}','{$address}')";
		  $rw=$conn->query($sql);
		  if($rw>0){
		  	echo "<script>alert('增加成功');window.location='index.php'</script>";
		  }else{
		  	echo "<script>alert('增加失败');window.history.back()</script>";
		  }
		  break;
	case "del":
		$id=$_GET['id'];
		$sql="delete from student where student_id={$id}";
		$conn->query($sql);
		header("Location:index.php");
		break;
	case "del_course":
		$id=$_GET['id'];
		$course_id=$_GET['course_id'];
		$sql="delete from select_course where id={$id} AND course_id={$course_id}";
		$conn->query($sql);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; // return back and refresh
		break;
    case "add_course":
        $id=$_GET['id'];
        $course_id=$_GET['course_id'];
        //$sql="delete from select_course where id={$id} AND course_id={$course_id}";
        $sql="INSERT INTO select_course VALUES ('{$id}', '{$course_id}');";
        $conn->query($sql);
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; // return back and refresh
        break;
	case "edit":
        $id=$_POST['student_id'];
        $name=$_POST['student_name'];
        $age=$_POST['student_age'];
        $address=$_POST['address'];
        $original_id=$_POST['id'];
		$sql="update student set student_id='{$id}',student_name='{$name}',student_age='{$age}',address ='{$address}' where id={$original_id}";
		 $rw=$conn->query($sql);
		  if($rw>0){
		  	  echo "<script>alert('修改成功');window.location='index.php'</script>";
		  }else{
		  	echo "<script>alert('修改失败');window.history.back()</script>";
		  }
		  break;
		  
		  
}

