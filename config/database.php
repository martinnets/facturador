// ==================== config/database.php ====================
<?php
class Database {
    private $conn;
    private $host = "database-facturador.clkqwysgg32b.us-east-1.rds.amazonaws.com";
    private $db_name  = "dbiaca_web";
    private $username = "adminiaca";
    private $password = "CIn34$#ca9";
    private $charset = 'utf8mb4';
 
    
    public static function connect() {
        self::$conn = null;
        try {
            self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo 'Error de conexión: ' . $exception->getMessage();
        }
        return self::$conn;
    }
}