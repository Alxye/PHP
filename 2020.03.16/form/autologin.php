<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<style type="text/css">
<!--
.STYLE1 {
	color: #FFFFFF;
	font-weight: bold;
}
.input{font-size:14px;width:150px;height:18px;border:solid 1px #cccccc;}
td {color:#666666;font-size:14px;}
.table{text-align:center;}
-->
</style>
</head>

<body>
<div align="center">
<form action="autosave.php" method="POST" name="form1" onsubmit="return checkform();">
<table width="80%" border="0" cellpadding="3" cellspacing="1" bgcolor="#757575">
  <tr>
    <td height="26" colspan="2" bgcolor="#475783"><div align="center" class="STYLE1">会员登陆</div></td>
  </tr>
  <tr>
    <td width="33%" bgcolor="#FFFBF0"><div align="right">用户：</div></td>
    <td width="67%" bgcolor="#FFFBF0" align="left"><input type="text" name="username"  class="input"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFBF0"><div align="right">密码：</div></td>
    <td bgcolor="#FFFBF0" align="left"><input type="password" name="password"  class="input"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFBF0"><div align="right"></div></td>
    <td bgcolor="#FFFBF0" align="left">COOKIE
      <select name="select">
      <option value="0">不保存</option>
      <option value="7">一周</option>
      <option value="30">一个月</option>
    </select>
    </td>
  </tr>
  <tr>
    <td bgcolor="#FFFBF0">&nbsp;</td>
    <td bgcolor="#FFFBF0" align="left"><input type="submit" name="Submit" value="提交" />
      <input type="reset" name="Submit2" value="重置" /></td>
  </tr>
</table>
</form>
</div>
<script language="javascript">
 function checkform()
 {
 	if(form1.username.value=="")
 	{
 	 alert("用户不能为空");
 	 return false;
 	}
 	
 	if(form1.password.value=="")
 	{
 	 alert("密码不能为空");
 	 return false;
 	}
 	return true; 	
 }
</script>
</body>
</html>
