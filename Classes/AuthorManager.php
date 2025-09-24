<?php

class AuthorManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function GetAllAuthors()
    {
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

    public function InsertAuthor()
    {
        include_once(__DIR__ . '/../Views/InsertAuthorForm.html');

        if (isset($_SESSION['authorName']) && isset($_SESSION['date'])) {

            try {
                $this->conn->beginTransaction();

                $stmt1 = $this->conn->prepare("INSERT INTO author (name, birthday) VALUES (:name, :birthday)");
                $stmt1->execute(['name' => $_SESSION['authorName'], 'birthday' => $_SESSION['date']]);

                $this->conn->commit();
                echo "Author inserted successfully.";
            } catch (Exception $e) {
                $this->conn->rollBack();
                echo "Failed to complete transaction: " . $e->getMessage();
            }

            unset($_POST['authorName']);
            unset($_POST['date']);
        }
    }
}

?>