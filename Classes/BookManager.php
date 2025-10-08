<?php

// Handles all book-related database operations
class BookManager
{
    private static $conn;

    // Initialize database connection
    public static function SetConnection($conn)
    {
        if (self::$conn === null) {
            self::$conn = $conn;
        }
    }

    public static function GetAllBooks()
    {
        $query = "SELECT b.id, b.title, b.pages, b.genre, a.name AS author_name, p.name AS publisher_name, l.name as library_name
                  FROM book b
                  LEFT JOIN author a ON b.author_id = a.id
                  LEFT JOIN publisher p ON b.publisher_id = p.id
                  LEFT JOIN library l ON b.library_id = l.id";

        $result = self::$conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Book Id: {$row['id']} | ";
            echo "Book Title: {$row['title']} | ";
            echo "Book Page Count: {$row['pages']} | ";
            echo "Book Genre: {$row['genre']} | ";
            echo "Book Author: " . ($row['author_name'] ? $row['author_name'] : 'N/A') . " | ";
            echo "Book Publisher: " . ($row['publisher_name'] ? $row['publisher_name'] : 'N/A') . " | ";
            echo "Book Library: " . ($row['library_name'] ? $row['library_name'] : 'N/A') . " | ";

            echo "<br><br><br>";
        }
    }

    public static function InsertBook()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("INSERT INTO book (title, pages, genre, author_id, publisher_id, library_id) 
                                         VALUES (:title, :pages, :genre, 
                                         (SELECT id FROM author WHERE name = :author_name), 
                                         (SELECT id FROM publisher WHERE name = :publisher_name), 
                                         (SELECT id FROM library WHERE name = :library_name))");
            $stmt1->execute([
                'title' => $_SESSION['bookTitle'],
                'pages' => $_SESSION['bookPages'],
                'genre' => $_SESSION['bookGenre'],
                'author_name' => $_SESSION['bookAuthor'],
                'publisher_name' => $_SESSION['bookPublisher'],
                'library_name' => $_SESSION['bookLibrary']
            ]);

            self::$conn->commit();
            echo "Book inserted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }

    public static function DeleteBook()
    {
        try {
            self::$conn->beginTransaction();

            $stmt1 = self::$conn->prepare("DELETE FROM book WHERE id = :book_id");
            $stmt1->execute(['book_id' => $_SESSION['bookId']]);

            self::$conn->commit();
            echo "Book deleted successfully.";
        } catch (Exception $e) {
            self::$conn->rollBack();
            echo "Failed to complete transaction: " . $e->getMessage();
        }

        ResetHeader();
    }
}

?>