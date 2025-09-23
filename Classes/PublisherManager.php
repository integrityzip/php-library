<?php

class PublisherManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function GetAllPublishers() {
        $query = "SELECT p.id, p.name FROM publisher p";

        $result = $this->conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "Publisher Id: {$row['id']} | ";
            echo "Publisher Name: {$row['name']} | ";

            echo "<br><br><br>";
        }
    }
}

?>