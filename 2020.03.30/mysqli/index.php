<html>
<head>
<title>学生选课管理信息</title>
</head>

<body>
<h3 align="center">选课系统 </h3>
<table width="600" border="1" align="center">
    <caption align="center">可选课程</caption>
    <tr>
        <td>课程ID</td>
        <td>课程名称</td>
        <td>任课教师</td>
        <td>上课时间</td>
        <td>上课地点</td>
    </tr>
    <?php
    //连接数据库
    try { 	$conn=new mysqli("localhost","root","","course_system");  }
    catch (Exception $e) {  die("数据库连接失败".$e->getMessage()); }
    $conn->set_charset('utf8');
    //执行SQL语句
    $sql="select * from course";
    foreach ($conn->query($sql) as $row) {
        echo "<tr>";
        echo "<td>{$row['course_id']}</td>";
        echo "<td>{$row['course_name']}</td>";
        echo "<td>{$row['course_teacher']}</td>";
        echo "<td>{$row['course_time']}</td>";
        echo "<td>{$row['course_venue']}</td>";
        echo "</tr>";
    }
    ?>
</table>
<h3 align="center">课程统计:<?php
    try { 	$conn=new mysqli("localhost","root","","course_system");  }
    catch (Exception $e) {  die("数据库连接失败".$e->getMessage()); }
    $conn->set_charset('utf8');
    //执行SQL语句
    $sql="select Distinct id from select_course";//查找字段中，非重复项目数
    //$sql="select * from select_course";//查找字段中，非重复项目数
    $count=0;
    foreach ($conn->query($sql) as $row) {
        $count++;
    }
    echo '已选课人数为 '.$count;
    $sql='select count(id) as times,id from select_course group by id order by times desc';
    $result= $conn->query($sql);
    //echo $result['id'];
    foreach ($conn->query($sql) as $row){
        echo "，选课数最多的学生为 ";
        $sql_inner='select student_name from student where id in(select id from select_course group by id order by COUNT(id) desc)';//查找字段中，重复项目降序排列
    foreach ($conn->query($sql_inner) as $row_inner){
        echo "<td>{$row_inner['student_name']}</td>";
        break;
    }
        echo" 选了 "."<td>{$row['times']}</td>"." 节";
        break;
    }

    ?></h3>
<table width="600" border="1" align="center">
    <caption align="center">学生信息 <a href='insert.php'>新增学生</a></caption>
    <tr>
        <td>学生学号</td>
        <td>学生姓名</td>
        <td>学生年龄</td>
        <td>家庭地址</td>
        <td>操作</td>
    </tr>
    <?php
    //连接数据库
    try { 	$conn=new mysqli("localhost","root","","course_system");  }
    catch (Exception $e) {  die("数据库连接失败".$e->getMessage()); }
    $conn->set_charset('utf8');
    //执行SQL语句
    $sql="select * from student";
    foreach ($conn->query($sql) as $row) {
        echo "<tr>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td>{$row['student_name']}</td>";
        echo "<td>{$row['student_age']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td><a href='javascript:doDel({$row['student_id']})'>删除</a> | <a href='update.php?id={$row['id']}'>学生修改&选课</a></a></td>";
        echo "</tr>";
    }
    ?>
</table>
<h3 align="center">功能模块 </h3>
<div align="center">
   <form action="index.php" method="post" target="postTo">
       按&nbsp<select name="selection">
           <option value="student_id" selected>学生学号</option>
           <option value="student_name">学生姓名</option>
           <option value="student_age">学生年龄</option>
       </select>&nbsp搜索&nbsp&nbsp&nbsp&nbsp
       <input type="text" name="text_value">
       <input type="submit" name="submit_1">
   </form>
    <?php
    //连接数据库
    if(!empty($_POST['submit_1'])) {
    try { $conn=new mysqli("localhost","root","","course_system");  }
    catch (Exception $e) {  die("数据库连接失败".$e->getMessage()); }
    $conn->set_charset('utf8');
    //执行SQL语句
        $string_select=$_POST['selection'];
    if(!empty($_POST['text_value'])) {
        $temp=$_POST['text_value'];
        $string1="'".$_POST["text_value"]."'";
        if(!empty($_POST['student_name']))  $sql="select * from student where $string_select =  $string1";
        else  $sql="select * from student where $string_select = $string1";
        echo"<table width=\"600\" border=\"1\" align=\"center\">
    <caption align=\"center\">查询结果</caption>
    <tr>
        <td>学生学号</td>
        <td>学生姓名</td>
        <td>学生年龄</td>
        <td>家庭地址</td>
    </tr>";
        foreach ($conn->query($sql) as $row) {
            echo "<tr>";
            echo "<td>{$row['student_id']}</td>";
            echo "<td>{$row['student_name']}</td>";
            echo "<td>{$row['student_age']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "</tr>";
        }
    }
    else echo "请完善查询条件";
    }
    //echo "<iframe name=\"postTo\" style=\"display: none\"></iframe>";
    ?>
</div>


</body>

<script type="text/javascript">
   function doDel(id){
	   if(confirm('是否确定删除？')){
               window.location='action.php?action=del&id='+id;
		   }
	   }
</script>
</html>