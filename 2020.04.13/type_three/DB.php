<?php
//class DB
//{
//   private $dsn;       // 数据库名 mysql 连接
//   private $user;      // 数据库用户名
//   private $password;  // 数据库密码
//   private $charset;   // 数据库字符集
//
//    /**pdo对象
//     * @var PDO
//     */
//   private $pdoInstance;  // pdo对象
//    /**sql 对象
//     * @var PDOStatement
//     */
//   private $pdoStmt;      // sql 对象
//
//    public function __construct($config=[]) // 初始化构造 连接基本信息配置
//    {
//        $this->dsn=$config['dsn'];
//        $this->user=$config['user'];
//        $this->password=$config['password'];
//        $this->charset=$config['charset'];
//        $this->connect();
//    }
//
//    /**
//     * 连接数据库
//     */
//    public function connect(){
//        if(!$this->pdoInstance){
//            // 载入传入字符集
//            $options=[
//                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES'.$this->charset
//            ];
//            //获取pdo对象
//            $this->pdoInstance = new PDO($this->dsn, $this->user, $this->password);
//            //设置pdo对象错误处理方式
//            $this->pdoInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//        }
//    }
//    /**通过sql query 数据
//     * @param $sql
//     * @param array $parameters
//     * @return array
//     * @throws MySQLException
//     */
//    public function query($sql,$parameters=[]){
//        // 假设非数组
//        if(!is_array($parameters)){
//            $parameters=[$parameters]; // 转换为数组
//        }
////    var_dump($parameters);exit();
//        // 循环绑定
//        $this->pdoStmt=$this->pdoInstance->prepare($sql);
//        $index=1;
//        foreach ($parameters as $parameter){
//            $this->pdoStmt->bindValue($index++,isset($parameter[0])?$parameter[0]:$parameter,isset($parameter[1])?$parameter[1]:PDO::PARAM_STR); // 将传值转为int 更改默认的字符串模式
//            //$this->pdoStmt->bindValue($index++,$parameter,PDO::PARAM_INT);
//        }
//        $execRe=$this->pdoStmt->execute();
//
//        if(!$execRe){
//            throw new MySQLException($this->pdoStmt->errorInfo()[2],$this->pdoStmt->errorCode());
//        }
//        $data=$this->pdoStmt->fetchAll(PDO::FETCH_ASSOC);
//        return $data;
//    }
//
//}
//class MySQLException extends Exception{
//
//}
class Page {
    private $total; //数据表中总记录数
    private $listRows; //每页显示行数
    private $limit;
    private $uri;
    private $pageNum; //页数
    private $config=array('header'=>"个记录", "prev"=>"上一页", "next"=>"下一页", "first"=>"首 页", "last"=>"尾 页");
    private $listNum=8;
    /*
     * $total
     * $listRows
     */
    public function __construct($total, $listRows=10, $pa=""){
        $this->total=$total;
        $this->listRows=$listRows;
        $this->uri=$this->getUri($pa);
        $this->page=!empty($_GET["page"]) ? $_GET["page"] : 1;
        $this->pageNum=ceil($this->total/$this->listRows);
        $this->limit=$this->setLimit();
    }

    private function setLimit(){
        return "Limit ".($this->page-1)*$this->listRows.", {$this->listRows}";
    }

    private function getUri($pa){
        $url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"], '?')?'':"?").$pa;
        $parse=parse_url($url);



        if(isset($parse["query"])){
            parse_str($parse['query'],$params);
            unset($params["page"]);
            $url=$parse['path'].'?'.http_build_query($params);

        }

        return $url;
    }

    function __get($args){
        if($args=="limit")
            return $this->limit;
        else
            return null;
    }

    private function start(){
        if($this->total==0)
            return 0;
        else
            return ($this->page-1)*$this->listRows+1;
    }

    private function end(){
        return min($this->page*$this->listRows,$this->total);
    }

    private function first(){
        $html = "";
        if($this->page==1)
            $html.='';
        else
            $html.="&nbsp;&nbsp;<a href='javascript:showpage(\"{$this->uri}&page=1\")'>{$this->config["first"]}</a>&nbsp;&nbsp;";

        return $html;
    }

    private function prev(){
        $html = "";
        if($this->page==1)
            $html.='';
        else
            $html.="&nbsp;&nbsp;<a href='javascript:showpage(\"{$this->uri}&page=".($this->page-1)."\")'>{$this->config["prev"]}</a>&nbsp;&nbsp;";

        return $html;
    }

    private function pageList(){
        $linkPage="";

        $inum=floor($this->listNum/2);

        for($i=$inum; $i>=1; $i--){
            $page=$this->page-$i;

            if($page<1)
                continue;

            //$linkPage.="&nbsp;<a href='{$this->uri}&page={$page}'>{$page}</a>&nbsp;";
            $linkPage.="&nbsp;<a href='javascript:showpage(\"{$this->uri}&page={$page}\")'>{$page}</a>&nbsp;";

        }

        $linkPage.="&nbsp;{$this->page}&nbsp;";


        for($i=1; $i<=$inum; $i++){
            $page=$this->page+$i;
            if($page<=$this->pageNum){
                //$linkPage.="&nbsp;<a href='{$this->uri}&page={$page}'>{$page}</a>&nbsp;";
                $linkPage.="&nbsp;<a href='javascript:showpage(\"{$this->uri}&page={$page}\")'>{$page}</a>&nbsp;";
            }else{
                break;
            }
        }

        return $linkPage;
    }

    private function next(){
        $html = "";
        if($this->page==$this->pageNum)
            $html.='';
        else
            $html.="&nbsp;&nbsp;<a href='javascript:showpage(\"{$this->uri}&page=".($this->page+1)."\")'>{$this->config["next"]}</a>&nbsp;&nbsp;";

        return $html;
    }

    private function last(){
        $html = "";
        if($this->page==$this->pageNum)
            $html.='';
        else
            $html.="&nbsp;&nbsp;<a href='javascript:showpage(\"{$this->uri}&page=".($this->pageNum)."\")'>{$this->config["last"]}</a>&nbsp;&nbsp;";

        return $html;
    }

    private function goPage(){
        return '&nbsp;&nbsp;<input type="text" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value;showpage(\''.$this->uri.'&page=\'+page+\'\')}" value="'.$this->page.'" style="width:25px"><input type="button" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->pageNum.')?'.$this->pageNum.':this.previousSibling.value;showpage(\''.$this->uri.'&page=\'+page+\'\')">&nbsp;&nbsp;';
        //return '&nbsp;&nbsp;<input type="text" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value;location=\''.$this->uri.'&page=\'+page+\'\'}" value="'.$this->page.'" style="width:25px"><input type="button" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->pageNum.')?'.$this->pageNum.':this.previousSibling.value;location=\''.$this->uri.'&page=\'+page+\'\'">&nbsp;&nbsp;';
    }
    function fpage($display=array(0,1,2,3,4,5,6,7,8)){
        $html[0]="&nbsp;&nbsp;共有<b>{$this->total}</b>{$this->config["header"]}&nbsp;&nbsp;";
        $html[1]="&nbsp;&nbsp;每页显示<b>".($this->end()-$this->start()+1)."</b>条，本页<b>{$this->start()}-{$this->end()}</b>条&nbsp;&nbsp;";
        $html[2]="&nbsp;&nbsp;<b>{$this->page}/{$this->pageNum}</b>页&nbsp;&nbsp;";

        $html[3]=$this->first();
        $html[4]=$this->prev();
        $html[5]=$this->pageList();
        $html[6]=$this->next();
        $html[7]=$this->last();
        $html[8]=$this->goPage();
        $fpage='';
        foreach($display as $index){
            $fpage.=$html[$index];
        }

        return $fpage;

    }


}
