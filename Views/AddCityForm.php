<?php
// Simple form for adding new cities
?>

<form method="post">
    <input type="hidden" id="addCity" name="addCity" value="addCity">
    <label for="cityName">City Name:</label>
    <input type="text" id="cityName" name="cityName" required>
    <br>
    <input type="submit" value="Add City">
</form>
