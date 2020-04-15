<?php
$final_number=0;
function judge(&$x1,&$x2,&$x3,&$x4){
    $string="";
    if(!$x1&&!$x2&&!$x3&&!$x4){
        $string="注册成功！<br>您的用户名为：".$_POST['username']." <br>密码为：".$_POST['password']." <br>邮箱为：".$_POST['email']." <br>电话号码为：".$_POST['telphone'];;
        return $string;
    }
    if($x1) $string.=" 用户名格式 ";
    if($x2) $string.=" 密码格式 ";
    if($x3) $string.=" 邮箱格式 ";
    if($x4) $string.=" 电话格式 ";
    $string.="错误！";
    return $string;
}
if(empty($_POST['num1'])||empty($_POST['num2'])){
    if(!empty($_POST['sub1'])) echo "<script>alert('请输入完整！');</script>";}
else{
    if (empty($_POST['sub2'])){
        $num1=$_POST['num1'];
        $num2=$_POST['num2'];
        if (empty($_POST['s1'])) {
            if(empty($_POST['s2'])){
                if(empty($_POST['s3'])) {
                    if(empty($_POST['s4']))
                        echo "<script>alert('请指定运算符！');</script>";
                    else $final_number=$num1/$num2;
                }
                else $final_number=$num1*$num2;}
            else $final_number=$num1-$num2;}
        else $final_number=$num2+$num1;
    }
}
if(empty($_POST['btn_sub'])||empty($_POST['username'])||empty($_POST['password'])||empty($_POST['email'])||empty($_POST['telphone']))
{
    $_no_set=true;
}
else {
    $_no_set=false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $telphone = $_POST['telphone'];
    $_wrong_username=false;
    $_wrong_password=false;
    $_wrong_email=false;
    $_wrong_telephone=false;
    if (preg_match("/^[a-zA-Z]\w{5,17}$/i", $username)) {
        if (preg_match("/^[a-zA-Z]\S{5,17}$/", $password)) {
            if (preg_match("/^[\w-]+@[\w-]+(\.(com)|(org)|(net))$/", $email)) {
                if ((preg_match("/^1(3|4|5|6|7|8|9)\d{9}$/", $telphone)) || preg_match("/^(\+(86))[1](3|4|5|6|7|8|9)\d{9}$/", $telphone) || preg_match("/^[0]\d{2,3}-[0-9]{8}$/", $telphone)) {}
                else $_wrong_telephone=true;
            } else $_wrong_email=true;;
        } else $_wrong_password=true;;
    }
    else $_wrong_username=true;
}
?>
<div align="center">
<form action='homework5.1.php' method='post'>
    <table style="background-color: #ff9b15;color: #FFFFFF;padding: 20px;">
        <caption align="center"><p>PHP——简易计算器</p></caption>
        <tr><td>请输入第一个要计算的数字:</td><td><input name="num1" type='number'></td></tr>
        <tr><td>请输入第二个要计算的数字:</td><td><input name="num2" type='number'></td></tr>
        <tr><td>请选择要选择的方式:</td><td><input type="checkbox" name="s1">+<input type="checkbox" name="s2">-<input type="checkbox" name="s3">X<input type="checkbox" name="s4">/</td></tr>
        <tr align="center"><td><input name="sub1" type="submit"></td><td><input name="sub2" type="reset" value="重置"></td></tr>
        <tr><td colspan='2' align="center"><?php if(!$final_number==0) echo "计算结果为：".$final_number; $final_number=0;?> </td></tr>
    </table>
</form>
</div>
<div style='width: 600px;background-color: #bee8d8;margin:0 auto;text-align: center;'>
    <form style='padding-top: 20px;' action='homework5.1.php' method='post'>
        <table align='center'>
            <tr><td>用户名：</td><td><input type='text' name='username' placeholder='请输入用户名' id='username' value=''></td>
            </tr>
            <tr>
                <td></td><td>6~18位字符，可使用字母、数字、下划线，需以字母开头</td>
            </tr>
            <tr>
                <td>密码：</td><td><input type='password' name='password' placeholder='请输入密码' id='password'></td>
            </tr>
            <tr><td></td><td>6~16个字符，区分大小写，以字母开头，不得包含空格</td></tr>
            <tr>
                <td>Email：</td><td><input type='email' name='email' placeholder='请输入Email' id='Email'>
                </td>
            </tr>
            <tr><td></td><td>必须以.com//.org//.net为后缀</td></tr>
            <tr>
                <td>手机号：</td>
                <td><input type='text' name='telphone' placeholder='请输入您的手机号'
                           id='Telphone'></td>
            </tr>
            <tr><td></td><td>长度为11位的数字（+86及固定电话，例：0571-58538465）</td></tr>
            <tr>
                <td colspan='2' align='center' ><input type='submit' value='注册' name='btn_sub'style='width: 50px;height: 30px;background-color: #009465;color: #ffffff;border: none;'></td></tr>
            <tr> <td colspan='2' align='center' ><?php if($_no_set) echo "<p style='background-color: #d72d00;color: #FFFFFF;text-align: center;'>"."待输入..."; else echo "<p style='background-color: #009465;color: #FFFFFF;text-align: center;'>" .judge($_wrong_username,$_wrong_password,$_wrong_email,$_wrong_telephone); ?></p></td></tr>
        </table>
</div>



