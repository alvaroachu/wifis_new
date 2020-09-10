<?php
class Conexion{
    private static $instances = [];
    private $host = null;
    private $username = null;
    private $password = null;
    private $database = null;
    private $port = null;
    private $conn;

    protected function __construct() {
    }
    public function setHost($value){
        $this->host = $value;
    }
    public function setUsername($value){
        $this->username = $value;
    }
    public function setPassword($value){
        $this->password = $value;
    }
    public function setDatabase($value){
        $this->database = $value;
    }
    public function setPort($value){
        $this->port = $value;
    }
    public function getHost(){
        return $this->host;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getPort(){
        return $this->port;
    }
    public function getDatabase(){
        return $this->database;
    }
    public function open(){
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database, $this->port) or 
        die(mysqli_connect_errno().'<br/>'. mysqli_connect_error());
    }
    public function close(){
        $this->conn->close();
    }
    public function setQuery1($query,$string,$value){
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param($string, $value);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }
    }
    public function setQuery2($query,$string,$name, $value){
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param($string, $value, $name);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        }
    }
    public static function getInstance(){
        $class = static::class;
        if(!isset(self::$instances[$class])){
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }
    public function getInit(){
        $conexion = static::getInstance();
        if(is_null($conexion->getHost()) && is_null($conexion->getUsername()) && 
            is_null($conexion->getPassword()) && is_null($conexion->getDatabase()) && 
            is_null($conexion->getPort())){
            return null;
        }
        return true;
    }
    public function see($eol = PHP_EOL){
        $conexion = static::getInstance();
        echo $conexion->getHost().$eol;
        echo $conexion->getUsername().$eol;
        echo $conexion->getPassword().$eol;
        echo $conexion->getDatabase().$eol;
        echo $conexion->getPort().$eol;
    }
    public function init($host,$username,$password,$database,$port=3306){
        $conexion = static::getInstance();
        $conexion->setHost($host);
        $conexion->setUsername($username);
        $conexion->setPassword($password);
        $conexion->setDatabase($database);
        $conexion->setPort($port);
    }
    public function registroStatus($value){
        $conexion = static::getInstance();
        $conexion->open();
        $result = $conexion->setQuery1("SELECT * FROM registro WHERE status = ?",'i',$value);
        $conexion->close();
        return $result;
    }
    public function updateConfiguration($name,$value){
        $conexion = static::getInstance();
        $conexion->open();
        $result = $conexion->setQuery2("UPDATE configuration SET value = ?, updated_time = now() WHERE name= ?",'ss',$name,$value);
        $conexion->close();
        return $result;
    }

}
