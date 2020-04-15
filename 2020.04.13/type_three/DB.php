<?php
class DB
{
   private $dsn;       // 数据库名 mysql 连接
   private $user;      // 数据库用户名
   private $password;  // 数据库密码
   private $charset;   // 数据库字符集

    /**pdo对象
     * @var PDO
     */
   private $pdoInstance;  // pdo对象
    /**sql 对象
     * @var PDOStatement
     */
   private $pdoStmt;      // sql 对象

    public function __construct($config=[]) // 初始化构造 连接基本信息配置
    {
        $this->dsn=$config['dsn'];
        $this->user=$config['user'];
        $this->password=$config['password'];
        $this->charset=$config['charset'];
        $this->connect();
    }

    /**
     * 连接数据库
     */
    public function connect(){
        if(!$this->pdoInstance){
            // 载入传入字符集
            $options=[
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES'.$this->charset
            ];
            //获取pdo对象
            $this->pdoInstance = new PDO($this->dsn, $this->user, $this->password);
            //设置pdo对象错误处理方式
            $this->pdoInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
    }
    /**通过sql query 数据
     * @param $sql
     * @param array $parameters
     * @return array
     * @throws MySQLException
     */
    public function query($sql,$parameters=[]){
        // 假设非数组
        if(!is_array($parameters)){
            $parameters=[$parameters]; // 转换为数组
        }
//    var_dump($parameters);exit();
        // 循环绑定
        $this->pdoStmt=$this->pdoInstance->prepare($sql);
        $index=1;
        foreach ($parameters as $parameter){
            $this->pdoStmt->bindValue($index++,isset($parameter[0])?$parameter[0]:$parameter,isset($parameter[1])?$parameter[1]:PDO::PARAM_STR); // 将传值转为int 更改默认的字符串模式
            //$this->pdoStmt->bindValue($index++,$parameter,PDO::PARAM_INT);
        }
        $execRe=$this->pdoStmt->execute();

        if(!$execRe){
            throw new MySQLException($this->pdoStmt->errorInfo()[2],$this->pdoStmt->errorCode());
        }
        $data=$this->pdoStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
}
class MySQLException extends Exception{

}