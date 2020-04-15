
<html>
<head>
<title>学生管理信息</title>
</head>

<body>
	<center>
         <?php 
         try {
         	$conn=new mysqli("localhost","root","","course_system");
         } catch (Exception $e) {
         	die("数据库连接失败".$e->getMessage());
         }
         $conn->set_charset('utf8');
         
           $sql="select * from student where id=".$_GET['id'];
           $stmt=$conn->query($sql);
           if($stmt->num_rows >0){
           	    $stu=$stmt->fetch_assoc();
           }else{
           	die("没有修改");
           }
         ?>
         <h3>学生信息表</h3>
		<form action="action.php?action=edit" method="post">
			<table>
                <tr>
                    <td>学号</td>
                    <td><input type="text" name="student_id" value="<?php echo $stu['student_id']?>"/></td>
                </tr>
                <tr>
                    <td>姓名</td>
                    <td><input type="text" name="student_name" value="<?php echo $stu['student_name']?>"/></td>
                    </td>
                </tr>
                <tr>
                    <td>年龄</td>
                    <td><input type="text" name="student_age" value="<?php echo $stu['student_age']?>"/></td>
                </tr>
                <tr>
                    <td>家庭住址</td>
                    <td><input type="text" name="address" value="<?php echo $stu['address']?>"/></td>
                </tr>
                <input type="hidden" name="id" value="<?php echo $stu['id']?>"/>
                <tr>
                    <td>
                        <input type="submit" value="修改" />
                        <input type="reset" value="重置" />
                    </td>
                </tr>
			</table>
		</form>
        <table width="600" border="1" align="center">
            <caption align="center">已选课程</caption>
            <tr>
                <td>课程编号</td>
                <td>课程名称</td>
                <td>任课教师</td>
                <td>上课时间</td>
                <td>上课地点</td>
                <td>操作</td>
            </tr>
            <?php
            //连接数据库
            try { 	$conn=new mysqli("localhost","root","","course_system");}
            catch (Exception $e) {  die("数据库连接失败".$e->getMessage()); }
            $conn->set_charset('utf8');
            //执行SQL语句
            //$sql="select * from student where id=".$_GET['id'];
            $sql="SELECT * FROM `course` WHERE course_id IN ( SELECT course_id FROM select_course WHERE id =".$_GET['id'].")";
            foreach ($conn->query($sql) as $row) {
                echo "<tr>";
                echo "<td>{$row['course_id']}</td>";
                echo "<td>{$row['course_name']}</td>";
                echo "<td>{$row['course_teacher']}</td>";
                echo "<td>{$row['course_time']}</td>";
                echo "<td>{$row['course_venue']}</td>";
                echo "<td><a href='javascript:doDel_course({$_GET['id']},{$row['course_id']})'>退课</a> </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <table width="600" border="1" align="center">
            <caption align="center">可选课程</caption>
            <tr>
                <td>课程编号</td>
                <td>课程名称</td>
                <td>任课教师</td>
                <td>上课时间</td>
                <td>上课地点</td>
                <td>操作</td>
            </tr>
            <?php
            //连接数据库
            try { 	$conn=new mysqli("localhost","root","","course_system");}
            catch (Exception $e) {  die("数据库连接失败".$e->getMessage()); }
            $conn->set_charset('utf8');
            //执行SQL语句
            $sql="SELECT * FROM `course` WHERE course_id Not IN ( SELECT course_id FROM select_course WHERE id =".$_GET['id'].")";
            foreach ($conn->query($sql) as $row) {
                echo "<tr>";
                echo "<td>{$row['course_id']}</td>";
                echo "<td>{$row['course_name']}</td>";
                echo "<td>{$row['course_teacher']}</td>";
                echo "<td>{$row['course_time']}</td>";
                echo "<td>{$row['course_venue']}</td>";
                echo "<td><a href='javascript:doAdd_course({$_GET['id']},{$row['course_id']})'>选课</a> </td>";
                echo "</tr>";
            }
            ?>
        </table>
	</center>
</body>
<script type="text/javascript">
    function doDel_course(student_id,course_id){
        if(confirm('是否确定退选？')){
            window.location='action.php?action=del_course&id='+student_id+'&course_id='+course_id;
        }
    }
    function doAdd_course(student_id,course_id){
        if(confirm('是否确定选课？')){
            window.location='action.php?action=add_course&id='+student_id+'&course_id='+course_id;
        }
    }
</script>
</html>