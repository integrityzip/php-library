<?php
// Main application entry point and navigation interface

require_once 'SetSession.php';
require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Library</title>
</head>

<body>
    <div id="contentBox">
        <button onclick="setSession('viewbook')">ViewBook</button>
        <button onclick="setSession('viewauthor')">ViewAuthor</button>
        <button onclick="setSession('viewlibrary')">ViewLibrary</button>
        <button onclick="setSession('viewpublisher')">ViewPublisher</button>
        <button onclick="setSession('viewcity')">ViewCity</button>
        <span>==========</span>
        <button onclick="setSession('addbook')">AddBook</button>
        <button onclick="setSession('addauthor')">AddAuthor</button>
        <button onclick="setSession('addlibrary')">AddLibrary</button>
        <button onclick="setSession('addpublisher')">AddPublisher</button>
        <button onclick="setSession('addcity')">AddCity</button>
    </div>

    <div id="mainContent">
        <?php 
        if (!isset($_POST['screen'])) {
            include 'Logic.php';
        }
        ?>
    </div>

    <script src="JS/ArticleLoader.js"></script>
</body>

</html>
