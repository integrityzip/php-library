<?php

// Handles all publisher-related database operations
class PublisherManager {
    private static $conn;

    // Initialize database connection
    public static function SetConnection($conn)
    {
        if (self::$conn === null) {
            self::$conn = $conn;
        }
    }

    public static function GetAllPublishers() {
        $query = "SELECT p.id, p.name FROM publisher p";

        $result = self::$conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Publisher Id: {$row['id']} | ";
            echo "Publisher Name: {$row['name']} | ";

            echo "<br><br><br>";
        }
    }

    public static function InsertPublisher()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("INSERT INTO publisher (name) VALUES (:name)");
            $stmt1->execute(['name' => $_SESSION['publisherName']]);

            self::$conn->commit();
            echo "Publisher inserted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }

    public static function DeletePublisher()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("DELETE FROM publisher WHERE id = :publisher_id");
            $stmt1->execute(['publisher_id' => $_SESSION['publisherId']]);

            self::$conn->commit();
            echo "Publisher deleted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }
}

?>