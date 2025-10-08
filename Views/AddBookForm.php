<?php
// Form for adding new books with dropdowns for related entities
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();
if ($conn) {
    $authors = $conn->query("SELECT id, name FROM author")->fetchAll(PDO::FETCH_ASSOC);
    $publishers = $conn->query("SELECT id, name FROM publisher")->fetchAll(PDO::FETCH_ASSOC);
    $libraries = $conn->query("SELECT id, name FROM library")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $authors = [];
    $publishers = [];
    $libraries = [];
}
?>

<form method="post">
    <input type="hidden" id="addBook" name="addBook" value="addBook">
    <label for="bookTitle">Book Title:</label>
    <input type="text" id="bookTitle" name="bookTitle" required />
    <br>
    <label for="bookPages">Book Page Count:</label>
    <input type="text" id="bookPages" name="bookPages" required />
    <br>
    <label for="bookGenre">Book Genre:</label>
    <input type="text" id="bookGenre" name="bookGenre" required />
    <br>

    <label for="bookAuthor">Book's Author:</label>
    <select name="bookAuthor" id="bookAuthor" required>
        <option value="">Select an Author</option>
        <?php foreach ($authors as $author) {
            echo "<option value=\"{$author['name']}\">{$author['name']}</option>";
        } ?>
    </select>
    <br>

    <label for="bookPublisher">Book's Publisher:</label>
    <select name="bookPublisher" id="bookPublisher" required>
        <option value="">Select a Publisher</option>
        <?php foreach ($publishers as $publisher) {
            echo "<option value=\"{$publisher['name']}\">{$publisher['name']}</option>";
        } ?>
    </select>
    <br>

    <label for="bookLibrary">Book's Library:</label>
    <select name="bookLibrary" id="bookLibrary" required>
        <option value="">Select a Library</option>
        <?php foreach ($libraries as $library) {
            echo "<option value=\"{$library['name']}\">{$library['name']}</option>";
        } ?>
    </select>
    <br>
    
    <input type="submit" value="Add Book">
</form>