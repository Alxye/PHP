<?php
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
$a = array("A", "B", "C");
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
echo "以".$num1." "."$num2"." "."$num3"."为内容的组合数有"."$conunt"."种";