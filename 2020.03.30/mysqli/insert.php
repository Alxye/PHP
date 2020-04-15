
<html>
<head>
<title>学生管理信息</title>
</head>

<body>
	<center>
         <h3>增加学生</h3>
		<form action="action.php?action=add" method="post">
			<table>
				<tr>
					<td>学号</td>
					<td><input type="text" name="id" /></td>
				</tr>
				<tr>
					<td>姓名</td>
					<td><input type="text" name="name" /></td>
				</tr>
				<tr>
					<td>年龄</td>
					<td><input type="text" name="age" /></td>
				</tr>
				<tr>
					<td>家庭住址</td>
					<td><input type="text" name="address" /></td>
				</tr>
				<tr>
					<td>
					    <input type="submit" value="增加" />
					    <input type="reset" value="重置" />
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>