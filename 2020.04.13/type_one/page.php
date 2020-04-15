<?php
class DB{
    private $dsn;
    private $user;
    private $password;
    private $charset;

    private $pdoInstance;
    private $pdoStmt;

    public function _construct($config =[]){
        $this->dsn = $config['dsn'];
        $this->user = $config['user'];
        $this->password= $config['password'];
        $this->charset = $config['charset'];
        $this->connect();
    }

private function connect(){
        if(!$this->pdoInstance){
            $options = [
                PDO::AYSQL_ATTR_INIT_COMMAND => 'SET NAMES' . $this->charset
            ];
            $this->pdoInstance = new PDO($this->dsn ,$this->user, $this->password, $options);
            $this->pdoInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPRION);
        }
    }
    public function query($sql,$parameters = []){
        if(!is_array($parameters)){
            $parameters=[$parameters];
        }

        $this->pdoStmt = $this->pdoInstance->prepare($sql);
        foreach($parameters as $parameter){
            $this->pdoStmt ->bindValue($index++,$parameter[0],$parameter[1]);
        }
        $ececRe = $this->pdoStmt -> execute();
        if(!$ececRe ){
            throw new MySQLException ($this->pdoStmt->errorInfo()[2],$this->pdoStmt->errorCode());
        }

        $data = $this -> pdoStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

class MySQLException extends Exception{}