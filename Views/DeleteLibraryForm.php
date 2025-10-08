<?php
// Delete interface for libraries with search functionality
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();

if (isset($_POST['searchQuery'])) {
    $_SESSION['libraryDeleteQuery'] = $_POST['searchQuery'];
}

if ($conn && (!isset($_SESSION['libraryDeleteQuery']))) {
    $libraries = $conn->query(
        "SELECT l.id, l.name, c.name AS city_name
                FROM library l
                LEFT JOIN city c ON l.city_id = c.id"
    )->fetchAll(PDO::FETCH_ASSOC);
} elseif ($conn && isset($_SESSION['libraryDeleteQuery'])) {

    $stmt = $conn->prepare(
        "SELECT l.id, l.name, c.name AS city_name
                FROM library l
                LEFT JOIN city c ON l.city_id = c.id
                WHERE l.name LIKE :libraryName"
    );
    $stmt->execute([':libraryName' => '%' . $_SESSION['libraryDeleteQuery'] . '%']);
    $libraries = $stmt->fetchAll();
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
        <th>Location</th>
    </tr>
    <?php

    foreach ($libraries as $library) {
        $library['city_name'] = $library['city_name'] ? $library['city_name'] : 'N/A';

        echo "<tr> 
                <td>
                    <form method=\"post\">
                        <input type=\"hidden\" name=\"deleteLibrary\" value=\"1\">
                        <input type=\"hidden\" name=\"libraryId\" value=\"{$library['id']}\">
                        <input type=\"submit\" class=\"removeButton\" value=\"Remove\">
                    </form>
                </td> 
                <td>{$library['id']}</td> 
                <td>{$library['name']}</td>
                <td>{$library['city_name']}</td>
              </tr>";
    }

    ?>
</table>