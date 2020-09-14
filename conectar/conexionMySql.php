<?php
require (__DIR__.'/conexion.php');

class ConexionMySql extends Conexion{
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
    public function setQuery3($query,$string,$codigo,$nombre,$fecha,$asunto,$comentarios){
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param($string, $codigo, $nombre, $fecha, $asunto, $comentarios);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        }
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
    public function getIdIncidencia($database){
        $conexion = static::getInstance();
        $conexion->open();
        if ($stmt = $this->conn->prepare('SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = \''.$database.'\' AND   TABLE_NAME   = \'incidencias\';')) {
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        }
        $conexion->close();
        return $result;
    }
    public function insertIncidencia($codigo,$nombre,$fecha,$asunto,$comentarios){
        $conexion = static::getInstance();
        $conexion->open();
        $result = $conexion->setQuery3('INSERT INTO incidencias (codigo,nombre,fechaHora,asunto,comentarios) values (?,?,?,?,?)','sssss',$codigo,$nombre,$fecha,$asunto,$comentarios);
        $conexion->close();
        return $result;
    }
    public function getConfiguration($value){
        $conexion = static::getInstance();
        $conexion->open();
        if ($stmt = $this->conn->prepare('SELECT `value` FROM  `configuration` WHERE `name` = ?')) {
            $stmt->bind_param('s', $value);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        }
        $conexion->close();
        return $result;
    }
    public function deleteConfiguration($name){
        $conexion = static::getInstance();
        $conexion->open();
        $result = $conexion->setQuery2("UPDATE configuration SET value = ?, updated_time = now() WHERE name= ?",'ss',$name,'');
        $conexion->close();
        return $result;
    }
}