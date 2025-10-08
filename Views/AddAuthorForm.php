<?php
// Simple form for adding new authors with name and birthday
?>

<form method="post">
    <input type="hidden" id="addAuthor" name="addAuthor" value="addAuthor">
    <label for="authorName">Author Name:</label>
    <input type="text" id="authorName" name="authorName" required>
    <br>
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>
    <br>
    <input type="submit" value="Add Author">
</form>
