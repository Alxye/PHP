<?php

 if(!empty($_GET["act"]))
 {
 	doPost();
 }
 
 function doPost()
 {
 	echo "������",$_POST["username"],"<br>";
 	echo "���룺",$_POST["password"],"<br>";
 	echo "�Ա�",$_POST["sex"],"<br>";
 	echo "���У�",$_POST["city"],"<br>";
 	print_r($_REQUEST["hobby"]);
 	echo "��ע��",$_POST["meno"];
 }

?>


<form action="?act=add" method="POST" name="form1">
ע����Ϣ��
<hr/>
������<input name="username"><br>
���룺<input name="password"><br>
�Ա�<input type="radio" name="sex" value="��">��  <input type="radio" name="sex" value="Ů">Ů
<br>
ʡ�ݣ�<select name="city">
    <option value="">��ѡ��</option>
      <option value="������">������</option>
      </select>
 <br>
���ã�<input type="checkbox" name="hobby[]" value="��ѧ">��ѧ  <input type="checkbox" name="hobby[]" value="����">����
<input type="checkbox" name="hobby[]" value="�鷨">�鷨
<br>
��ע��<textarea name="meno"></textarea>
<br>
<input type="submit" value="�ύ">
</form>