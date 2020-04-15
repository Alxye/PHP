<?php

 if(!empty($_GET["act"]))
 {
 	doPost();
 }
 
 function doPost()
 {
 	echo "姓名：",$_POST["username"],"<br>";
 	echo "密码：",$_POST["password"],"<br>";
 	echo "性别：",$_POST["sex"],"<br>";
 	echo "城市：",$_POST["city"],"<br>";
 	print_r($_REQUEST["hobby"]);
 	echo "备注：",$_POST["meno"];
 }

?>


<form action="?act=add" method="POST" name="form1">
注册信息：
<hr/>
姓名：<input name="username"><br>
密码：<input name="password"><br>
性别：<input type="radio" name="sex" value="男">男  <input type="radio" name="sex" value="女">女
<br>
省份：<select name="city">
    <option value="">请选择</option>
      <option value="哈尔滨">哈尔滨</option>
      </select>
 <br>
爱好：<input type="checkbox" name="hobby[]" value="文学">文学  <input type="checkbox" name="hobby[]" value="体育">体育
<input type="checkbox" name="hobby[]" value="书法">书法
<br>
备注：<textarea name="meno"></textarea>
<br>
<input type="submit" value="提交">
</form>