<?php
namespace Core;

class Database {
    private    $conn  ;
    private    $host = "database-facturador.clkqwysgg32b.us-east-1.rds.amazonaws.com";
    private    $db_name  = "dbiaca_web";
    private    $username = "adminiaca";
    private    $password = "CIn34$#ca9";
    private    $charset = 'utf8mb4';
 
    
    public   function connect() {
        
        $this->conn = null;

        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(\PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
        // self::$conn = null;
        // try {
        //     self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
        //     self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // } catch (PDOException $exception) {
        //     echo 'Error de conexión: ' . $exception->getMessage();
        // }
        // return self::$conn;
    }
}