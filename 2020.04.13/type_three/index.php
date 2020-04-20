<?php
///**
// * 操作mysql数据库
// * 1.建立链接
// * 2.写sql
// * 3.执行
// * 4.处理结果
// * 5.关闭
// */
//require_once 'DB.php';
//class App{
//    private $db;
//    public function __construct()
//    {
//
//        $this->db=new DB([
//            'dsn'=>'mysql:dbname=ajax;host=localhost;port:3306;charset=utf8',
//            'user'=>'root',
//            'password'=>'',
//            'charset'=>'utf8',
//        ]);
//    }
//
//    /**
//     * 入口方法
//     */
//    public function run(){
//        try{
//            // $pageSize=$_GET['page_size'] ?? 10;   // only support on php 7
//            $pageSize=isset($_GET['page_size']) ? $_GET['page_size'] : 10;
//
//            $pageIndex=$_GET['page_index'];
//
//            $data=$this->pagination(intval($pageSize),intval($pageIndex));
//
//            $count=intval($this->getCount());
//            $totalPage=ceil($count/$pageSize);
//            $info=[
//                'count'=>$count,
//                'total_page'=>$totalPage,
//                'data'=>$data,
//            ];
//            return $this->returnSuccessData($info);
//
//        }catch (Exception $e){
//            return $this->returnData($e->getCode(),$e->getMessage());
//        }
//    }
//
//    /**
//     * 分页查询
//     * @param $pageSize
//     * @param $pageIndex
//     * @return array
//     * @throws MySQLException
//     */
//    public function pagination($pageSize,$pageIndex){
//
//        //$sql='select id,title,type,date from tb_user WHERE type=1 order by date limit ? offset ?';
//
//        $limit=$pageSize;
//        $offset=$pageSize*($pageIndex--);
//        echo $limit."<br>";
//        echo $offset."<br>";
//        echo $pageSize."<br>";
//        echo $pageIndex."<br>";
//        //$sql='select id,title,type,date from tb_user WHERE type=1 order by date limit '.$limit.' offset'. $offset;
//        $sql='select id,title,type,date from tb_user WHERE type=1 order by date limit ? offset ?';
//        $data=$this->db->query($sql,[
//            [$limit,PDO::PARAM_INT],
//            [$offset,PDO::PARAM_INT]
//        ]);
//        //$data=$this->db->query($sql,[$limit,$offset]);
//        echo $sql;
//        return $data;
//    }
//
//    /**
//     * 一共多少页
//     * @return mixed
//     * @throws MySQLException
//     */
//    public function getCount(){
//        $sql='select count(id) as count from tb_user';
//        $data=$this->db->query($sql);
//        return $data[0]['count'];
//    }
//    /**
//     * 返回正常数据
//     * @param $data
//     * @return string
//     */
//    public function returnSuccessData($data){
//        $content=[
//            'code'=>0,
//            'message'=>'Success',
//            'info'=>$data,
//        ];
//        return json_encode($content);
//    }
//
//    /**
//     * 返回数据
//     * @param $code
//     * @param $message
//     * @param array $data
//     * @return string
//     */
//    public function returnData($code,$message,$data=[]){
//        $content=[
//            'code'=>0,
//            'message'=>$message,
//            'info'=>$data,
//        ];
//        return json_encode($content);
//    }
//}
//$app=new App();
//$re=$app->run();
//echo $re;
//$re=$app->run();
//echo $re;


header("content-type:text/html;charset=utf-8");
//实现传统分页效果
//连接数据库、获得数据、分页显示
//$link = mysql_connect('localhost', 'root', '123456');
$link =new mysqli('localhost','root','');
$link->select_db('ajax');
$link->set_charset('utf8');
//mysql_select_db('shop0811', $link);
//mysql_query('set names utf8');

//数据分页实现
//① 引入分页工具类
include("DB.php");

//② 获得记录总条数/每页显示条数设置
$sql = "select * from tb_user";
$qry=$link->query($sql);
$cnt=$qry->num_rows;
//$qry = mysql_query($sql);
//$cnt = mysql_num_rows($qry); //数据总条数
$per = 7;//每页显示7条

//③ 实例化分页类对象
$page_obj = new Page($cnt, $per);

//④ 拼装sql语句，获得每页信息
$sql3 = "select id,title,type,date,backup from tb_user " . $page_obj->limit;
$qry3=$link->query($sql3);
//$qry3 = mysql_query($sql3);

//⑤ 获得页码列表
$pagelist = $page_obj->fpage(array(3, 4, 5, 6, 7, 8));

//通过table表格显示数据
echo <<<eof
<style type="text/css">
    table {width:700px; margin:auto;border:1px solid black; border-collapse:collapse;}
    td {border:1px solid black;}
</style>
<table>
<tr><td>序号</td><td>名称</td><td>type</td><td>data</td><td>backup</td></tr>
eof;

$p = isset($_GET['page']) ? $_GET['page'] : 1;
$i = ($p - 1) * $per + 1; //(页码-1)*每页条数+1
while ($rst3 = $qry3->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $i++ . "</td>";
    echo "<td>" . $rst3['title'] . "</td>";
    echo "<td>" . $rst3['type'] . "</td>";
    echo "<td>" . $rst3['date'] . "</td>";
    echo "<td>" . $rst3['backup'] . "</td>";
    echo "</tr>";
}
echo "<tr><td colspan='5'>$pagelist</td></tr>";
echo "</table>";