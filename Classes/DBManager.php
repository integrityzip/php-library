<?php
// Database connection manager using singleton pattern
class DBManager {
    private static $conn = null;

    // Get or create database connection
    public static function GetConnection() {
        if (self::$conn === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "php_library";

            try {
                self::$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return null;
            }
        }
        return self::$conn;
    }
}

return DBManager::GetConnection();
?>
