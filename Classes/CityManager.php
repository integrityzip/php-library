<?php

// Handles all city-related database operations
class CityManager
{
    private static $conn;

    // Initialize database connection
    public static function SetConnection($conn)
    {
        if (self::$conn === null) {
            self::$conn = $conn;
        }
    }

    public static function GetAllCities()
    {
        $query = "SELECT c.id, c.name FROM city c";

        $result = self::$conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "City Id: {$row['id']} | ";
            echo "City Name: {$row['name']} | ";

            echo "<br><br><br>";
        }
    }

    public static function InsertCity()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("INSERT INTO city (name) VALUES (:name)");
            $stmt1->execute(['name' => $_SESSION['cityName']]);

            self::$conn->commit();
            echo "City inserted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }

    public static function DeleteCity()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("DELETE FROM city WHERE id = :city_id");
            $stmt1->execute(['city_id' => $_SESSION['cityId']]);

            self::$conn->commit();
            echo "City deleted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }
}

?>