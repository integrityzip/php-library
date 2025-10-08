<?php
// Delete interface for cities with search functionality
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();

if (isset($_POST['searchQuery'])) {
    $_SESSION['cityDeleteQuery'] = $_POST['searchQuery'];
}

if ($conn && (!isset($_SESSION['cityDeleteQuery']))) {
    $cities = $conn->query("SELECT id, name FROM city")->fetchAll(PDO::FETCH_ASSOC);
} elseif ($conn && isset($_SESSION['cityDeleteQuery'])) {

    $stmt = $conn->prepare("SELECT id, name FROM city WHERE name LIKE :cityName");
    $stmt->execute([':cityName' => '%' . $_SESSION['cityDeleteQuery'] . '%']);
    $cities = $stmt->fetchAll();
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

    foreach ($cities as $city) {
        echo "<tr> 
                <td>
                    <form method=\"post\">
                        <input type=\"hidden\" name=\"deleteCity\" value=\"1\">
                        <input type=\"hidden\" name=\"cityId\" value=\"{$city['id']}\">
                        <input type=\"submit\" class=\"removeButton\" value=\"Remove\">
                    </form>
                </td> 
                <td>{$city['id']}</td> 
                <td>{$city['name']}</td>
              </tr>";
    }

    ?>
</table>