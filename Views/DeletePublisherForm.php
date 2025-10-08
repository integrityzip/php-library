<?php
// Delete interface for publishers with search functionality
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();

if (isset($_POST['searchQuery'])) {
    $_SESSION['publisherDeleteQuery'] = $_POST['searchQuery'];
}

if ($conn && (!isset($_SESSION['publisherDeleteQuery']))) {
    $publishers = $conn->query("SELECT id, name FROM publisher")->fetchAll(PDO::FETCH_ASSOC);
} elseif ($conn && isset($_SESSION['publisherDeleteQuery'])) {

    $stmt = $conn->prepare("SELECT id, name FROM publisher WHERE name LIKE :publisherName");
    $stmt->execute([':publisherName' => '%' . $_SESSION['publisherDeleteQuery'] . '%']);
    $publishers = $stmt->fetchAll();
}
?>

<form method="post">
    <label for="searchQuery">Look for Name:</label>
    <input type="text" id="searchQuery" name="searchQuery">
    <input type="submit" value="Search">
</form>

<table>
    <tr>
        <th>Remove</th>
        <th>ID</th>
        <th>Name</th>
    </tr>
    <?php

    foreach ($publishers as $publisher) {
        echo "<tr> 
                <td>
                    <form method=\"post\">
                        <input type=\"hidden\" name=\"deletePublisher\" value=\"1\">
                        <input type=\"hidden\" name=\"publisherId\" value=\"{$publisher['id']}\">
                        <input type=\"submit\" class=\"removeButton\" value=\"Remove\">
                    </form>
                </td> 
                <td>{$publisher['id']}</td> 
                <td>{$publisher['name']}</td>
              </tr>";
    }

    ?>
</table>