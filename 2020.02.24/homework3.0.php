<?php
/**
 * 字符串练习
 */
echo "<p style='background-color: #1883ba;color: #fff;text-align: center;'>字符串练习</p>";
function getExtension($filename){
    $text = substr($filename, strrpos($filename, '.'));
    return str_replace('.','',$text);
}
$filename = 'doc.exe.txt';
echo " 问题1：文件后缀名为：".getExtension($filename);
echo "<br>"."问题2：将数字表示成科学计数法。"."<form action='homework3.0.php' method='post'>
    <input type='text' value='' name='text_number'> 
    <input type='submit' value='转换' name='sub1'>
    </form>";
function fun1_transform($num){
    $num_reverse=strrev($num);
    $array_number_transform=str_split($num_reverse,3);
    $num_recombine=implode(",",$array_number_transform);
    $num=strrev($num_recombine);
    return $num;
}
if(!empty($_POST['sub1'])) {
    $num1=$_POST['text_number'];
    if(is_numeric($num1)){
        echo "原数：".$num1;
        echo "<br>转换后：".fun1_transform($num1);
    }
    else{
        echo "请重新输入...";
    }
}
else{
    echo "待输入...";
}
echo "<br>"."问题3： 字符串转换功能（例如：“hello_world” 转换成 “HelloWorld”、”rem_by_id” 转换成 ”RemById”。）
"."<form action='homework3.0.php' method='post'>
    <input type='text' value='' name='string_transform'> 
    <input type='submit' value='转换' name='sub2'>
    </form>";
if(empty($_POST['sub2'])||empty($_POST['string_transform'])) {
    echo "待输入...";
}
else{
    $string2=$_POST['string_transform'];
    echo str_replace("_","",ucwords(ucfirst($string2),"_"));
}
/**
 * 正则表达式练习
 */
echo "<p style='background-color: #e87818;color: #fff;text-align: center;'>正则表达式</p>";
echo "<div style='width: 600px;height: 300px;background-color: #bee8d8;margin:0 auto;text-align: center;'><form style='padding-top: 20px;' action='homework3.0.php' method='post'>
 <table align='center'>
        <tr><td>用户名：</td><td><input type='text' name='username' placeholder='请输入用户名'
        id='username' value=''></td>
        </tr>
        <tr>
        <td></td><td>6~18位字符，可使用字母、数字、下划线，需以字母开头</td>
        </tr>
        <tr>
            <td>密码：</td><td><input type='password' name='password' placeholder='请输入密码'
        id='password'></td>
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
            <td colspan='2' align='center' ><input type='submit' value='注册' name='btn_sub'style='width: 50px;height: 30px;background-color: #009465;color: #ffffff;border: none;'></td></tr>    </table></div>";
if(empty($_POST['btn_sub'])||empty($_POST['username'])||empty($_POST['password'])||empty($_POST['email'])||empty($_POST['telphone']))
//if(empty($_POST['btn_sub']))
{
    echo "<p style='width: 100px;background-color: #d72d00;color: #FFFFFF;text-align: center;margin:-35px auto;'><a>待输入...</a></p>";
}
else {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $telphone = $_POST['telphone'];
    if (preg_match("/^[a-zA-Z]\w{5,17}$/i", $username)) {
        if (preg_match("/^[a-zA-Z]\S{5,17}$/", $password)) {
            if (preg_match("/^[\w-]+@[\w-]+(\.(com)|(org)|(net))$/", $email)) {
                if ((preg_match("/^1(3|4|5|6|7|8|9)\d{9}$/", $telphone)) || preg_match("/^(\+(86))[1](3|4|5|6|7|8|9)\d{9}$/", $telphone) || preg_match("/^[0]\d{2,3}-[0-9]{8}$/", $telphone)) echo "<p style='width: 200px;background-color: #026f00;color: #FFFFFF;text-align: center;margin:-35px auto;'><a>注册成功</a></p>";
                else echo "<p style='width: 200px;background-color: #d72d00;color: #FFFFFF;text-align: center;margin:-35px auto;'><a>手机格式错误！</a></p>";
            } else echo "<p style='width: 200px;background-color: #d72d00;color: #FFFFFF;text-align: center;margin:-35px auto;'><a>邮箱格式错误！</a></p>";
        } else echo "<p style='width: 200px;background-color: #d72d00;color: #FFFFFF;text-align: center;margin:-35px auto;'><a>密码格式错误！</a></p>";
    }
    else echo "<p style='width: 200px;background-color: #d72d00;color: #FFFFFF;text-align: center;margin:-35px auto;'><a>用户名格式错误！</a></p>";
}
echo "<br>"."<br>"."<br>"."匹配16进制颜色值"."<form action='homework3.0.php' method='post'>
    <input type='text' value='' name='0x16'> 
    <input type='submit' value='匹配' name='sub_adj'>
    </form>";
if(empty($_POST['sub_adj'])||empty($_POST['0x16'])) {
    echo "待输入...";
}
else{
    $color=$_POST['0x16'];
    if(preg_match("/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/",$color))   echo "匹配成功！";
    else echo "匹配失败！";
}
echo "<br>"."数字每隔四位就用空格分割"."<form action='homework3.0.php' method='post'>
    <input type='text' value='' name='num_adj'> 
    <input type='submit' value='匹配' name='sub_num_adj'>
    </form>";
if(empty($_POST['num_adj'])||empty($_POST['sub_num_adj'])) {
    echo "待输入...";
}
else {
    $num_adj = $_POST['num_adj'];
    $string_array=preg_split("/\s/",$num_adj) ;
    $count=0;
    if((int)(strlen($num_adj)/5)+1==count($string_array)){
        for($i=0;$i<count($string_array)-1;$i++){
            if(is_numeric($string_array[$i])&&(strlen($string_array[$i])==4)) $count++;
        }
        if(is_numeric(end($string_array))) $count++;
        if($count==count($string_array)) echo "匹配成功！";
        else echo "匹配失败";
    }
    else echo "匹配失败！";
}