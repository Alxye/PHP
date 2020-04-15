<form action="mutiformsave.php" method="POST" name="form1">
用户注册
<hr>
姓名：<input type="text" name="username"><br>
密码：<input type="password" name="password"><br>
性别：<input type="radio" name="sex" value="男">男  <input type="radio" name="sex" value="女">女<br> 
城市：<select name="city"> 
       <option value="">请选择</option>
        <option value="哈尔滨">哈尔滨</option>
         <option value="长春">长春</option>
    </select><br>
爱好：<input type="checkbox" name="hobby[]" value="文学">文学  
<input type="checkbox" name="hobby[]" value="体育">体育  
<input type="checkbox" name="hobby[]" value="音乐">音乐  
<input type="checkbox" name="hobby[]" value="美术">美术  <br>
说明：<textarea name="meno"></textarea>

<input type="submit" value="提交">
</form>
