<?php
require (__DIR__.'/../patterns/Singleton.php');
class Conexion extends Singleton{
    protected $host = null;
    protected $username = null;
    protected $password = null;
    protected $database = null;
    protected $port = null;
    protected $conn;

    protected function setHost($value){
        $this->host = $value;
    }
    protected function setUsername($value){
        $this->username = $value;
    }
    protected function setPassword($value){
        $this->password = $value;
    }
    protected function setDatabase($value){
        $this->database = $value;
    }
    protected function setPort($value){
        $this->port = $value;
    }
    protected function getHost(){
        return $this->host;
    }
    protected function getUsername(){
        return $this->username;
    }
    protected function getPassword(){
        return $this->password;
    }
    protected function getPort(){
        return $this->port;
    }
    protected function getDatabase(){
        return $this->database;
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

}
