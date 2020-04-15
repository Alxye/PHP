<?php
/**
 * 函数练习
 */
echo "<p style='background-color: #1883ba;color: #fff;text-align: center;'>函数练习</p>";
echo "问题一：自定义一个递归函数反序输出一个整数。"."<br>"."<form action='homework2.0.php' method='post'>
    <input type='number' value='' name='num1'>
    <input type='submit' value='提交' name='sub1'>
</form>";
$b=0;
/**
 * @param $a
 * @return mixed
 */
function fun1($a){
    if($a==0)
        return 0;
    else{
        global $b;
        $b *= 10;
        $b += ($a % 10);
        return fun1((int)($a/10));
    }
}
if(empty($_POST['sub1'])||empty($_POST['num1'])) {
    echo "待输入整数"."<br>";
}
else {
    $sum1 = $_POST['num1'];
    echo "原数：".$sum1."<br>";
    fun1($sum1);
    echo "反序后：".$b."<br>";
}
echo "问题二：求100-999内水仙花数。"."<br>";
function fun2($a){
    if ($a==pow((int)($a/100),3)+pow((int)(($a/10)%10),3)+pow((int)($a%10),3))
        return 1;
    else
        return 0;
}
for($i=100;$i<=999;$i++){
    if(fun2($i))
        echo "|".$i."|";
}
echo "<br>"."问题三：求某个数是不是素数。"."<br>"."<form action='homework2.0.php' method='post'>
    <input type='number' value='' name='num2'>
    <input type='submit' value='提交' name='sub2'>
</form>";
function fun3($a){
    $sqrtm = sqrt($a*1.0);
    for ($i = 2; $i <= $sqrtm; $i++)
        if ($a %$i == 0)    return 0;
    return 1;
}
if(empty($_POST['sub2'])||empty($_POST['num2'])) {
    echo "待输入整数"."<br>";
}
else {
    $sum2 = $_POST['num2'];
    if(fun3($sum2))    echo $sum2."  是素数";
    else    echo $sum2."  不是素数";
}
echo "<br>"."问题四：求两个数最大公约数、最小公倍数。"."<br>"."<form action='homework2.0.php' method='post'>
    <input type='number' value='' name='num3'>
    <input type='number' value='' name='num4'>
    <input type='submit' value='提交' name='sub3'>
</form>";
function fun4($a,$b){
    $c = 0;
	max($a,$b);
	$c = $b;
	do{
        $b = $c;
        $a>$b ? $c = $a - $b : $c = $b - $a;
        $a = $b;
    } while ($c != 0);
	return $b;
}
if(empty($_POST['sub3'])||empty($_POST['num3'])||empty($_POST['num4']))
{
    echo "待输入";
}
else {
    $num3 = $_POST['num3'];
    $num4 = $_POST['num4'];
    echo $num3 . "与" . $num4 . "的最大公约数为 " . fun4($num3, $num4)."<br>";
    echo $num3 . "与" . $num4 . "的最小公倍数为 " . ($num3*$num4)/fun4($num3, $num4);
}
/**
 * 数组练习
 */
echo "<p style='background-color:#ea9d25;color: #fff;text-align: center;'>数组练习</p>";
echo "问题一：写函数创建长度为10的数组，数组中的元素为递增的奇数，首项为1。"."<form action='homework2.0.php' method='post'>
    <input type='submit' value='创建数组' name='creat_array'>
</form>";
function fun2_1(){
    $creatarry=array(10);
    for ($i=0;$i<10;$i++){
        $creatarry[$i]=2*$i+1;
    }
    return $creatarry;
}
if(!empty($_POST['creat_array'])) {
    echo "创建成功..."."<br>";
    print_r(fun2_1());
}
echo "<br>"."问题二：求数组中最大数的下标。"."<form action='homework2.0.php' method='post'>
    <input type='submit' value='创建随机数组' name='creat_array2'>
</form>";
function find_max_number_in_array($array){
    $max=0;
    $max_key=0;
    for ($i=1; $i<count($array); $i++)
    {
        if ($array[$i] > $max)
        {
            $max = $array[$i];
            $max_key=$i;
        }
    }
    echo "数组最大数为 ".$max."  其下标为 ".$max_key;
}
if(!empty($_POST['creat_array2'])) {
    $arry1=range(rand()%10,rand()%1000);
    shuffle($arry1);
    echo "创建随机数组成功..."."<br>";
    find_max_number_in_array($arry1);
}
echo "<br>"."问题三：求数组中最大数和最小数的差。"."<form action='homework2.0.php' method='post'>
    <input type='submit' value='创建随机数组' name='creat_array3'>
    </form>";
if(!empty($_POST['creat_array3'])) {
    $arry3=range(rand()%100,rand()%1000);
    shuffle($arry3);
    echo "创建随机数组成功..."."<br>";
    sort($arry3);
    $D_value=$arry3[count($arry3)-1]-$arry3[0];
    echo "最小值为 ".$arry3[0]." || 最大值为 ".$arry3[count($arry3)-1]." || 差值为 ".$D_value;
}
echo "<br>"."问题四：数组逆序存放。"."<form action='homework2.0.php' method='post'>
    <input type='submit' value='创建随机数组' name='creat_array4'>
    </form>";
function array_reverse_define($array){
    for ($i = 0; $i < count($array)/2; $i++){
    $tmp = $array[$i];
    $array[$i] = $array[count($array) - 1 - $i];
    $array[count($array) - 1-$i] = $tmp;
    }
    return $array;
}
if(!empty($_POST['creat_array4'])) {
    $arry4=range(rand()%10,rand()%10);
    shuffle($arry4);
    echo "创建随机数组成功..."."<br>";
    echo "原数组：<br>";
    print_r($arry4);
    echo "<br>逆序后数组：<br>";
    print_r(array_reverse_define($arry4));
}
echo "<br>"."问题五：定义一个三维数组\$categories，用于存放Car,Van和Truck的产品信息，并使用foreach循环完成数组的遍历，并显示结果。";
$categories=array(
    "Car Parts"=>array(
        "Code"=>array(
            "CAR_TIR",
            "CAR_OIL",
            "CAR_SPK" ),
        "Description"=>array(
            "Tires",
            "Oil",
            "Spark Plugs"),
        "Price"=>array(
            "100",
            "10",
            "4")
    ),
    "Van Parts"=>array(
        "Code"=>array(
            "VAN_TIR",
            "VAN_OIL",
            "VAN_SPK" ),
        "Description"=>array(
            "Tires",
            "Oil",
            "Spark Plugs"),
        "Price"=>array(
            "120",
            "12",
            "4")
    ),
    "Truck Parts"=>array(
        "Code"=>array(
            "TRK_TIR",
            "TRK_OIL",
            "TRK_SPK" ),
        "Description"=>array(
            "Tires",
            "Oil",
            "Spark Plugs"),
        "Price"=>array(
            "150",
            "15",
            "5")
    )
);
foreach ($categories as $key=>$value) {
    echo '<table width="100%" align="center" border="1px" style="">';
    echo '<caption ><h2>'.$key.' 产品信息</h2></caption>';
    echo '<tr align="center" >';
    foreach ($value as $k=>$head){
        echo '<th>'.$k.'</th>';
    }
    echo '</tr>';
    foreach ($value as $v)     {
        echo '<td align="center" >';
        foreach ($v as $info) {
            echo '<li align="center" style="list-style: none;border:solid #4a4a4a 1px;padding:3px;" >' .$info.'</li>';
        }
        echo '</td>';
    }
        echo '</table>';
}

