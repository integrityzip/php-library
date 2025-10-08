<?php
// Simple form for adding new publishers
?>

<form method="post">
    <input type="hidden" id="addPublisher" name="addPublisher" value="addPublisher">
    <label for="publisherName">Publisher Name:</label>
    <input type="text" id="publisherName" name="publisherName" required>
    <br>
    <input type="submit" value="Add Publisher">
</form>
