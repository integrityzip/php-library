<?php

class CityManager
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function GetAllCities()
    {
        $query = "SELECT c.id, c.name FROM city c";

        $result = $this->conn->query($query)->fetchAll();

        echo "<br><br>";

        foreach ($result as $row) {
            echo "City Id: {$row['id']} | ";
            echo "City Name: {$row['name']} | ";

            echo "<br><br><br>";
        }
    }
}

?>