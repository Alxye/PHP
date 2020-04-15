<?php
$question="问题1：一百个铜钱买了一百只鸡，其中公鸡一只5钱、母鸡一只3钱，小鸡一钱3只，问一百只鸡中公鸡、母鸡、小鸡各多少?";
echo $question."<br>"."答案：";
for($g=0;$g<=100/5;$g++)
{
    for($m=0;$m<33;$m++)
    {
        $x = 100 - $g - $m;
        if (5 * $g + 3 * $m + $x / 3 == 100 && $x % 3 == 0) {
            echo " 公鸡" . $g . "只" . "  母鸡" . $m . "只" . "  小鸡" . $x . "只" . "|——————|";
        }
    }
}
$question="问题2：输入一个数判断它是不是回文数";
echo "<br>".$question."<br>";
echo "<form action='homework.php' method='post'>
    <input type='number' value='' name='num'>
    <input type='submit' value='提交' name='sub'>
</form>";
if(empty($_POST['sub'])||empty($_POST['num']))
{
    echo "待输入回文数";
}
else
{
    $sum = $_POST['num'];
    $half = floor(strlen($sum)/2);
    $flag = true;
    for($i = 0;$i < $half;$i++)
    {
        $x = substr($sum,$i,1);
        $y = substr($sum,strlen($sum) - $i - 1,1);
        if($x != $y)
        {
            $flag = false;
            break;
        }
    }
    if($flag)
    {
        echo $sum,'是回文数';
    }else{
        echo $sum,'不是回文数';
    }
}
$question="问题3：24点计算程序，给定4个数，1，6，3，6 采用加减乘除算出24. ";
echo "<br>".$question."<br>"."答案：";
class calculate24 {
    public $aim = 24;
    public $precision = '1e-6';//精确值
    function func() {}
    /**
     * 输入值，进行计算
     * @param array $operants
     */
    public function calculate($operants = array()) {
        try {
            $this->search($operants, 4);
        }
        catch (Exception $e) {
            echo $e->getMessage();
            return;
        }
        echo "无此结果！";
        return;
    }

    /**
     * @param $currentnumber
     * @param $level
     * @return bool
     * @throws Exception
     */
    private function search($currentnumber, $level) {
        if ($level == 1) {
            $result = 'return ' . $currentnumber[0] . ';';
            if ( abs(eval($result) - $this->aim) <= $this->precision) {
                throw new Exception($currentnumber[0]);
            }
        }
        for ($i=0;$i<$level;$i++) {
            for ($j=$i+1;$j<$level;$j++) {
                $expLeft = $currentnumber[$i];
                $expRight = $currentnumber[$j];
                $currentnumber[$j] = $currentnumber[$level - 1];
                $currentnumber[$i] = '(' . $expLeft . ' + ' . $expRight . ')';
                $this->search($currentnumber, $level - 1);
                $currentnumber[$i] = '(' . $expLeft . ' * ' . $expRight . ')';
                $this->search($currentnumber, $level - 1);
                $currentnumber[$i] = '(' . $expLeft . ' - ' . $expRight . ')';
                $this->search($currentnumber, $level - 1);
                $currentnumber[$i] = '(' . $expRight . ' - ' . $expLeft . ')';
                $this->search($currentnumber, $level - 1);
                if ($expLeft != 0) {
                    $currentnumber[$i] = '(' . $expRight . ' / ' . $expLeft . ')';
                    $this->search($currentnumber, $level - 1);
                }
                if ($expRight != 0) {
                    $currentnumber[$i] = '(' . $expLeft . ' / ' . $expRight . ')';
                    $this->search($currentnumber, $level - 1);
                }
                $currentnumber[$i] = $expLeft;
                $currentnumber[$j] = $expRight;
            }
        }
        return false;
    }
}
$test = new calculate24();
$test->calculate( array(1,3,6,6) );
$question="问题4：数字的全排列（比如：2，3，5  全排列：235,253,325,352,523,532) ";
echo "<br>".$question."<br>"."请输入数字";
echo "<form action='homework.php' method='post'>
    <input type='number' value='' name='num1'>
    <input type='number' value='' name='num2'>
    <input type='number' value='' name='num3'>
    <input type='submit' value='提交' name='sub_next'>
</form>";
if(empty($_POST['sub_next'])||empty($_POST['num1'])||empty($_POST['num2'])||empty($_POST['num3']))
{
    echo "待输入排列组合数";
}
else
{
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];
    function arrangement($a, $m) {
        $r = array();
        $n = count($a);//计算数组a的元素数/长度
        if ($m <= 0 || $m > $n) {
            return $r;
        }
        for ($i=0; $i<$n; $i++) {
            $b = $a;
            $t = array_splice($b, $i, 1);
            if ($m == 1) {
                $r[] = $t;
            }
            else {
                $c = arrangement($b, $m-1);
                foreach ($c as $v) {
                    $r[] = array_merge($t, $v);
                }
            }
        }
        return $r;
    }
    $a = array($num1,$num2,$num3);
    $r = arrangement($a, 3);
    $conunt=0;
    for($i = 0; $i < count($r); $i++) {
        echo "|";
        for($j = 0; $j < count($r[$i]); $j++) {
            echo $r[$i][$j];
        }
        echo "|";
        $conunt++;
    }
    echo "<br>"."以".$num1." "."$num2"." "."$num3"."为内容的组合数有"."$conunt"."种";
}