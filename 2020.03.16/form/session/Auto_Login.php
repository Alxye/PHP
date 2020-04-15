<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>自动登录界面</title>
    <style type="text/css">
        .style1 {
            color: #FFFFFF;
            font-weight: bold;
        }
        .input{font-size:14px;width:150px;height:18px;border:solid 1px #cccccc;}
        td {color:#666666;font-size:14px;}
        .table{text-align:center;}
    </style>
    <script language="javascript">
        function check_form()
        {
            if(form1.username.value=="")
            {
                alert("请输入用户名！");
                return false;
            }
            if(form1.password.value=="")
            {
                alert("请输入密码！");
                return false;
            }
            if(form1.username.value!="root"||form1.password.value!="0000")
            {
                alert("用户名或密码错误！");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div align="center">
    <form action="Auto_Login.php" method="post" name="form1" onsubmit="return check_form();">
        <table width="80%" border="0" cellpadding="3" cellspacing="1" bgcolor="#757575">
            <tr>
                <td height="26" colspan="2" bgcolor="#475783"><div align="center" class="style1">会员登陆</div></td>
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
</body>
</html>

<?php
//表单登陆
function  login()
{
    $username=$_REQUEST["username"];
    $password=$_REQUEST["password"];
    //设置两个cookie
    session_start();
    $_SESSION["user"]=$username;
    $_SESSION["pass"]=$password;

    header("location:Auto_Index.php");
}
//处理登陆信息
if(isset($_REQUEST["username"])&&isset($_REQUEST["password"])) login();