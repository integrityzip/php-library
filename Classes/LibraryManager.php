<?php

// Handles all library-related database operations
class LibraryManager
{
    private static $conn;

    // Initialize database connection
    public static function SetConnection($conn)
    {
        if (self::$conn === null) {
            self::$conn = $conn;
        }
    }

    public static function GetAllLibraries()
    {
        $query = "SELECT l.id, l.name, c.name AS city_name
                  FROM library l
                  LEFT JOIN city c ON l.city_id = c.id";

        $result = self::$conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Library Id: {$row['id']} | ";
            echo "Library Name: {$row['name']} | ";
            echo "Library city: " . ($row['city_name'] ? $row['city_name'] : 'N/A') . " | ";

            echo "<br><br><br>";
        }
    }

    public static function InsertLibrary()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("INSERT INTO library (name, city_id) VALUES (:name, (SELECT id FROM city WHERE name = :city_id))");
            $stmt1->execute(['name' => $_SESSION['libraryName'], 'city_id' => $_SESSION['libraryCity']]);

            self::$conn->commit();
            echo "Library inserted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }

    public static function DeleteLibrary()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("DELETE FROM library WHERE id = :library_id");
            $stmt1->execute(['library_id' => $_SESSION['libraryId']]);

            self::$conn->commit();
            echo "Library deleted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }
}

?>