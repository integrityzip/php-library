<?php
// Delete interface for books with search functionality
require_once 'Classes/DBManager.php';

$conn = DBManager::GetConnection();

if (isset($_POST['searchQuery'])) {
    $_SESSION['bookDeleteQuery'] = $_POST['searchQuery'];
}

if ($conn && (!isset($_SESSION['bookDeleteQuery']))) {
    $books = $conn->query(
        "SELECT b.id, b.title, b.pages, b.genre, a.name AS author_name, p.name AS publisher_name, l.name AS library_name
                FROM book b
                LEFT JOIN author a ON b.author_id = a.id
                LEFT JOIN publisher p ON b.publisher_id = p.id
                LEFT JOIN library l ON b.library_id = l.id"
    )->fetchAll(PDO::FETCH_ASSOC);
} elseif ($conn && isset($_SESSION['bookDeleteQuery'])) {

    $stmt = $conn->prepare(
        "SELECT b.id, b.title, b.pages, b.genre, a.name AS author_name, p.name AS publisher_name, l.name AS library_name
                FROM book b
                LEFT JOIN author a ON b.author_id = a.id
                LEFT JOIN publisher p ON b.publisher_id = p.id
                LEFT JOIN library l ON b.library_id = l.id
                WHERE b.title LIKE :bookTitle"
    );
    $stmt->execute([':bookTitle' => '%' . $_SESSION['bookDeleteQuery'] . '%']);
    $books = $stmt->fetchAll();
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
        <th>Title</th>
        <th>Pages</th>
        <th>Genre</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Library</th>
    </tr>
    <?php

    foreach ($books as $book) {
        $book['author_name'] = $book['author_name'] ? $book['author_name'] : 'N/A';
        $book['publisher_name'] = $book['publisher_name'] ? $book['publisher_name'] : 'N/A';
        $book['library_name'] = $book['library_name'] ? $book['library_name'] : 'N/A';

        echo "<tr> 
                <td>
                    <form method=\"post\">
                        <input type=\"hidden\" name=\"deleteBook\" value=\"1\">
                        <input type=\"hidden\" name=\"bookId\" value=\"{$book['id']}\">
                        <input type=\"submit\" class=\"removeButton\" value=\"Remove\">
                    </form>
                </td> 
                <td>{$book['id']}</td> 
                <td>{$book['title']}</td>
                <td>{$book['pages']}</td>
                <td>{$book['genre']}</td>
                <td>{$book['author_name']}</td>
                <td>{$book['publisher_name']}</td>
                <td>{$book['library_name']}</td>
              </tr>";
    }

    ?>
</table>