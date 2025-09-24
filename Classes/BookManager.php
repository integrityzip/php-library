<?php

class BookManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function GetAllBooks()
    {
        $query = "SELECT b.id, b.title, b.pages, b.genre, a.name AS author_name, p.name AS publisher_name, l.name as library_name
                  FROM book b
                  LEFT JOIN author a ON b.author_id = a.id
                  LEFT JOIN publisher p ON b.publisher_id = p.id
                  LEFT JOIN library l ON b.library_id = l.id";

        $result = $this->conn->query($query)->fetchAll();

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
}

?>