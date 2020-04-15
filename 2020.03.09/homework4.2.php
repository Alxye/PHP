<?php
echo "<p style='background-color: #ea9d25;color: #fff;text-align: center;'>面向对象练习（下）</p>";
final class Circle{
    const PI = 3.14159;
    private $Radius;
    static public function Circumference($Radius){return "周长为：".self::PI * $Radius * 2;}
    static public function Area($Radius){return "面积为：".self::PI * $Radius * $Radius;}
}
echo "半径为3的圆  ||  ".Circle::Area(3).'  ||  '.Circle::Circumference(3).'<br>';
Class Stu{
    //属性
    private $name;
    private $num;
    private $sex;
    private $class;
    //方法
    public function  __construct($name,$num,$sex,$class){
        $this->num=$num;
        $this->name=$name;
        $this->sex=$sex;
        $this->class=$class;
    }
    public function  __set($name, $value)    {$this->$name=$value;    }
    public function __get($name)    { return $this->$name;}
    public function  __isset($name)    {return isset($this->$name);}
    public function __unset($name)    {
        echo "成功调用__unset,该私有成员已被清空"."<br>";
        unset($this->$name);
    }
    public function getinfo(){
        echo "姓名：{$this->name}  ||  学号：{$this->num}  ||  性别：{$this->sex}  ||  班级：{$this->class}".'<br>';
    }
    public function __call($name, $arguments)    {
        echo "该类不包含该方法（函数）".'<br>';
    }
}
//__construct方法实现
$student1=new Stu('zxx','18220211','female','18222513');
//getinfo方法实现
$student1->getinfo();
//__call方法实现
$student1->null();
//__isset方法实现
if(isset($student1->name))    echo "该类成员，存在   ||   成员值为：{$student1->name}".'<br>';
else echo "该类成员，不存在".'<br>';
//__unset方法实现
unset($student1->name);
if(isset($student1->name))    echo "该类成员，存在   ||   成员值为：{$student1->name}".'<br>';
else echo "该类成员，不存在".'<br>';
//__get&__set方法实现
$student1->name='zxx_copy';
echo $student1->name;
echo "<p style='background-color: #ea324c;color: #fff;text-align: center;'>在线销售系统</p>";
//定义用户接口
interface user{
    public function get_name();
    public function get_password();
    public function get_discount();
}
//定义抽象用户类承接接口
abstract class abstract_user implements user{
    private $name;
    private $password;
    protected $grade;
    protected $discount;
    public function __construct($name,$password){
        $this->name=$name;
        $this->password=$password;
    }
    public function get_name()    {
        return $this->name;   // TODO: Implement get_name() method.
    }
    public function get_password()        {
        return $this->password;   // TODO: Implement get_password() method.
    }

    public function get_discount()      {
        return $this->discount;   // TODO: Implement get_discount() method.
    }
    public function get_grade(){
        return $this->grade;
    }
}
//不同用户 类的继承
class normal_user extends abstract_user{
    protected $discount=1.0;
    protected $grade="Normal User";
}
class vip_user extends abstract_user{
    protected $discount=0.8;
    protected $grade="Vip User";
}
class inner_user extends abstract_user{
    protected $discount=0.5;
    protected $grade="Inner User";
}
//定义产品接口
interface product{
    public function get_name();
    public function get_price();
    public function get_author();
}
//定义book类
class book implements product {
    private $product_name;
    private $product_price;
    private $product_author;
    public function __construct($product_name,$product_price,$product_author){
        $this->product_name=$product_name;
        $this->product_price=$product_price;
        $this->product_author=$product_author;
    }
    public function get_name()         {
        return $this->product_name;   // TODO: Implement get_name() method.
    }
    public function get_price()     {
        return $this->product_price;   // TODO: Implement get_price() method.
    }
    public function  get_author()         {
        return $this->product_author;   // TODO: Implement get_author() method.
    }
}
//定义静态方法用于计算
class price_cal{
    public static function final_price(user $user,product $product){
        return $user->get_discount()*$product->get_price();
    }
}
//具体实现
$user1=new normal_user('normal','111');
$user2=new vip_user('vip','222');
$user3=new inner_user('inner','333');
$history_book=new book("汉纪",35,'荀悦');
$science_book=new book("时间简史",25,'斯蒂芬·威廉·霍金');
$story_book=new book("皮囊",30,'蔡崇达');
function print_user($a,$b,$c,$d){
    echo '<tr align="center" >';
    echo '<th>'.$a.'</th>';
    echo '<th>'.$b.'</th>';
    echo '<th>'.$c.'</th>';
    echo '<th>'.$d*100 .'</th>';
    echo '</tr>';
}
function print_book($a,$b,$c){
    echo '<tr align="center" >';
    echo '<th>'.$a.'</th>';
    echo '<th>'.$b.'</th>';
    echo '<th>'.$c.'</th>';
    echo '</tr>';
}
function login_judgement(user $user,$username,$password){
    if($username==$user->get_name()&&$password==$user->get_password()) return true;
    else return false;
}
echo '<table width="100%" align="center" border="1px" style="">';
echo '<caption style="font-weight: 900;">'.' 后台用户信息</caption>';
echo '<tr align="center" >';
echo '<th>'.'用户名'.'</th>';
echo '<th>'.'密码'.'</th>';
echo '<th>'.'等级'.'</th>';
echo '<th>'.'折扣(%)'.'</th>';
echo '</tr>';
print_user($user1->get_name(),$user1->get_password(),$user1->get_grade(),$user1->get_discount());
print_user($user2->get_name(),$user2->get_password(),$user2->get_grade(),$user2->get_discount());
print_user($user3->get_name(),$user3->get_password(),$user3->get_grade(),$user3->get_discount());
echo '</table>';
echo '<table width="100%" align="center" border="1px" style="">';
echo '<caption style="font-weight: 900;">'.' 后台图书信息</caption>';
echo '<tr align="center" >';
echo '<th>'.'书名'.'</th>';
echo '<th>'.'作者'.'</th>';
echo '<th>'.'价格(元）'.'</th>';
echo '</tr>';
print_book($history_book->get_name(),$history_book->get_author(),$history_book->get_price());
print_book($science_book->get_name(),$science_book->get_author(),$science_book->get_price());
print_book($story_book->get_name(),$story_book->get_author(),$story_book->get_price());
echo '</table>';
echo "<div style='width: 400px;height: 140px;background-color: #bee8d8;margin:10px auto;text-align: center;'><form style='padding-top: 20px;' action='homework4.2.php' method='post'>
 <table align='center'>
        <tr align='center'><td>用户名：</td><td><input type='text' name='username' placeholder='请输入用户名' id='username' value=''></td></tr>
        <tr align='center'><td>密码：</td><td><input type='password' name='password' placeholder='请输入密码' id='password'></td></tr>
        <tr align='center'><td>请勾选：</td><td><input type='checkbox' name='book1'>汉纪 <input type='checkbox' name='book2'>时间简史 <input type='checkbox' name='book3'>皮囊</td> </tr>
        <tr align='center'><td colspan='2' align='center' ><input type='submit' value='登录并购买' name='btn_sub'style='width: 80px;height: 30px;background-color: #009465;color: #ffffff;border: none;'></td></tr>    </table></div>";
if(empty($_POST['btn_sub'])||empty($_POST['username'])||empty($_POST['password'])){
    echo "<p style='background-color: #d72d00;color: #FFFFFF;text-align: center;margin:10px auto;'><a>待输入...</a></p>";
}
else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    global $price_total;
    function price_total(user $user,book $book1,book $book2,book $book3){
        global $price_total;
        $price_total=0;
        $string=" ";
        if(!empty($_POST['book1'])) {$price_total+=price_cal::final_price($user,$book1);
            $string .="| 汉纪 |";        }
        if(!empty($_POST['book2'])) {$price_total+=price_cal::final_price($user,$book2);
            $string .="| 时间简史 |";        }
        if(!empty($_POST['book3'])) {$price_total+=price_cal::final_price($user,$book3);
            $string .="| 皮囊 |";        }
        if(empty($_POST['book1'])&&empty($_POST['book2'])&&empty($_POST['book3'])) $string .="| 无 |";
        return $string;
    }
    function print_info(user $user1,book $book1,book $book2,book $book3){
        echo "<div style='background-color: #009465;color: #FFFFFF;text-align: center;margin:10px auto;padding: 10px;'><a>验证成功...</a><br>尊敬的 {$user1->get_name()} ,您的级别是 {$user1->get_grade()} ,您的折扣是 ".($user1->get_discount())*100 ."% <br>您已购买 ".price_total($user1,$book1,$book2,$book3)." <br>共计购买 {$GLOBALS['price_total']} 元。</div>";
    }
    if(login_judgement($user1,$username,$password)) print_info($user1,$history_book,$science_book,$story_book);
    if(login_judgement($user2,$username,$password)) print_info($user2,$history_book,$science_book,$story_book);
    if(login_judgement($user3,$username,$password)) print_info($user3,$history_book,$science_book,$story_book);
    if(!login_judgement($user1,$username,$password)&&!login_judgement($user2,$username,$password)&&!login_judgement($user3,$username,$password)) echo "<p style='background-color: #d72d00;color: #FFFFFF;text-align: center;margin:10px auto;'><a>输入错误！（请注册/找回密码/重新输入）</a></p>";
}
