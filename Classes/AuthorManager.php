<?php

// Handles all author-related database operations
class AuthorManager
{
    private static $conn;

    // Initialize database connection
    public static function SetConnection($conn)
    {
        if (self::$conn === null) {
            self::$conn = $conn;
        }
    }

    public static function GetAllAuthors()
    {
        $query = "SELECT a.id, a.name, a.birthday FROM author a";

        $result = self::$conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Author Id: {$row['id']} | ";
            echo "Author Name: {$row['name']} | ";
            echo "Author Birthday: {$row['birthday']} | ";

            echo "<br><br><br>";
        }
    }

    public static function InsertAuthor()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("INSERT INTO author (name, birthday) VALUES (:name, :birthday)");
            $stmt1->execute(['name' => $_SESSION['authorName'], 'birthday' => $_SESSION['date']]);

            self::$conn->commit();
            echo "Author inserted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }

    public static function DeleteAuthor()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("DELETE FROM author WHERE id = :author_id");
            $stmt1->execute(['author_id' => $_SESSION['authorId']]);

            self::$conn->commit();
            echo "Author deleted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }
}

?>