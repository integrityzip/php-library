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
                  JOIN author a ON b.author_id = a.id
                  JOIN publisher p ON b.publisher_id = p.id
                  JOIN library l ON b.library_id = l.id";

        $result = $this->conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Book Id: {$row['id']} | ";
            echo "Book Title: {$row['title']} | ";
            echo "Book Page Count: {$row['pages']} | ";
            echo "Book Genre: {$row['genre']} | ";
            echo "Book Author: {$row['author_name']} | ";
            echo "Book Publisher: {$row['publisher_name']} | ";
            echo "Book Library: {$row['library_name']} | ";

            echo "<br><br><br>";
        }
    }
}

?>