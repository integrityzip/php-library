<?php
// Delete interface for authors with search functionality
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();

if (isset($_POST['searchQuery'])) {
    $_SESSION['authorDeleteQuery'] = $_POST['searchQuery'];
}

if ($conn && (!isset($_SESSION['authorDeleteQuery']))) {
    $authors = $conn->query("SELECT id, name, birthday FROM author")->fetchAll(PDO::FETCH_ASSOC);
} elseif ($conn && isset($_SESSION['authorDeleteQuery'])) {

    $stmt = $conn->prepare("SELECT id, name, birthday FROM author WHERE name LIKE :authorName");
    $stmt->execute([':authorName' => '%' . $_SESSION['authorDeleteQuery'] . '%']);
    $authors = $stmt->fetchAll();
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
        <th>Birthday</th>
    </tr>
    <?php

    foreach ($authors as $author) {
        echo "<tr> 
                <td>
                    <form method=\"post\">
                        <input type=\"hidden\" name=\"deleteAuthor\" value=\"1\">
                        <input type=\"hidden\" name=\"authorId\" value=\"{$author['id']}\">
                        <input type=\"submit\" class=\"removeButton\" value=\"Remove\">
                    </form>
                </td> 
                <td>{$author['id']}</td> 
                <td>{$author['name']}</td>
                <td>{$author['birthday']}</td>
              </tr>";
    }

    ?>
</table>