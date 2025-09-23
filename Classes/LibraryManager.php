<?php

class LibraryManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function GetAllLibraries() {
        $query = "SELECT l.id, l.name, c.name AS city_name
                  FROM library l
                  JOIN city c ON l.city_id = c.id";

        $result = $this->conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Library Id: {$row['id']} | ";
            echo "Library Name: {$row['name']} | ";
            echo "Library City: {$row['city_name']} | ";

            echo "<br><br><br>";
        }
    }
}

?>