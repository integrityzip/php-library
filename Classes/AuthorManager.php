<?php

class AuthorManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function GetAllAuthors() {
        $query = "SELECT a.id, a.name, a.birthday FROM author a";

        $result = $this->conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Author Id: {$row['id']} | ";
            echo "Author Name: {$row['name']} | ";
            echo "Author Birthday: {$row['birthday']} | ";

            echo "<br><br><br>";
        }
    }
}

?>