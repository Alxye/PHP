<?php

//打印用户户
echo $_POST["username"],"<br>";
echo $_POST["password"],"<br>";
echo $_POST["sex"],"<br>";
echo $_POST["city"],"<br>";
//对于checkbox，取出的结果是数组，需要在客户端加数组标识[]
print_r($_POST["hobby"]);
echo $_POST["meno"],"<br>";


?>