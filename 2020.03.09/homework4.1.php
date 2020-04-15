<?php
echo "<p style='background-color: #1883ba;color: #fff;text-align: center;'>面向对象练习（上）</p>";
//类
class Car_General{
    //属性
    private $model;//汽车型号
    private $color;//汽车颜色
    //构造方法
    public function  __construct($model,$color){
        $this->model=$model;
        $this->color=$color;
    }
    //方法
    public function __toString(){
        return "汽车模型为：".$this->model."||汽车颜色为：".$this->color;
    }
    public function  __set($name, $value)
    {
        $this->$name=$value;
    }
    public function __get($name)
    {
        return $this->$name;
    }
}
//继承
class Bus extends Car_General{
    //Bus 自己的属性 方法
    private $Passenger_Num;//共载人数
    //构造方法 重写
    function __construct($model,$color,$Passenger_Num){
        //调用父元素的构造方法
        parent::__construct($model,$color);
        $this->Passenger_Num=$Passenger_Num;
    }
    //方法
    public function __toString(){
        return "汽车模型为：".$this->model."||汽车颜色为：".$this->color."||共载人数：".$this->Passenger_Num;
    }
}
$bus1=new Bus('x1021','blue',59);
echo $bus1;

