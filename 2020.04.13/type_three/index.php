<?php
/**
 * 操作mysql数据库
 * 1.建立链接
 * 2.写sql
 * 3.执行
 * 4.处理结果
 * 5.关闭
 */
require_once './DB.php';
class App{
    private $db;
    public function __construct()
    {

        $this->db=new DB([
            'dsn'=>'mysql:dbname=ajax;host=localhost;port:3306;charset=utf8',
            'user'=>'root',
            'password'=>'',
            'charset'=>'utf8',
        ]);
    }

    /**
     * 入口方法
     */
    public function run(){
        try{
            // $pageSize=$_GET['page_size'] ?? 10;   // only support on php 7
            $pageSize=isset($_GET['page_size']) ? $_GET['page_size'] : 10;

            $pageIndex=$_GET['page_index'];
            echo "test =>".$pageIndex."<br>";
            $data=$this->pagination(intval($pageSize),intval($pageIndex));

            //var_dump($data);
            
            $count=intval($this->getCount());
            $totalPage=ceil($count/$pageSize);
            $info=[
                'count'=>$count,
                'total_page'=>$totalPage,
                'data'=>$data,
            ];
            return $this->returnSuccessData($info);

        }catch (Exception $e){
            //var_dump($e->getMessage());
            return $this->returnData($e->getCode(),$e->getMessage());
        }
    }

    /**
     * 分页查询
     * @param $pageSize
     * @param $pageIndex
     * @return array
     * @throws MySQLException
     */
    public function pagination($pageSize,$pageIndex){

        //$sql='select id,title,type,date from tb_user WHERE type=1 order by date limit ? offset ?';

        $limit=$pageSize;
        $offset=$pageSize*($pageIndex--);
        echo $limit."<br>";
        echo $offset."<br>";
        echo $pageSize."<br>";
        echo $pageIndex."<br>";
        $sql='select id,title,type,date from tb_user WHERE type=1 order by date limit ? offset ? ';
        $data=$this->db->query($sql,[
            [$limit,PDO::PARAM_INT],
            [$offset,PDO::PARAM_INT]
        ]);
        //$data=$this->db->query($sql,[$limit,$offset]);
        echo $sql;
        return $data;
    }

    /**
     * 一共多少页
     * @return mixed
     * @throws MySQLException
     */
    public function getCount(){
        $sql='select count(id) as count from tb_user';
        $data=$this->db->query($sql);
        return $data[0]['count'];
    }
    /**
     * 返回正常数据
     * @param $data
     * @return string
     */
    public function returnSuccessData($data){
        $content=[
            'code'=>0,
            'message'=>'Success',
            'info'=>$data,
        ];
        return json_encode($content);
    }

    /**
     * 返回数据
     * @param $code
     * @param $message
     * @param array $data
     * @return string
     */
    public function returnData($code,$message,$data=[]){
        $content=[
            'code'=>0,
            'message'=>$message,
            'info'=>$data,
        ];
        return json_encode($content);
    }
}
$app=new App();
$re=$app->run();
echo $re;