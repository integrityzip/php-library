<?php
// Form for adding new libraries with city selection dropdown
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();
if ($conn) {
    $result = $conn->query("SELECT name FROM city")->fetchAll();
} else {
    $result = [];
}
?>

<form method="post">
    <input type="hidden" id="addLibrary" name="addLibrary" value="addLibrary">
  <label for="libraryName">Library Name:</label>
  <input type="text" id="libraryName" name="libraryName" required />
  <br>

  <label for="libraryCity">City:</label>
  <select name="libraryCity" id="libraryCity" required>
    <option value="">Select a city</option>
    <?php foreach ($result as $city) {
        echo "<option value=\"{$city['name']}\">{$city['name']}</option>";
    } ?>
  </select>
  <br>

  <input type="submit" value="Add Library">
</form>
