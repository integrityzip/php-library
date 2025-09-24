<?php 
require_once __DIR__ . '/Logic.php';
require_once __DIR__ . '/vendor/autoload.php'; 
?>

<?php
include("Classes/DBManager.php");

$bookManager = new BookManager($conn);
$cityManager = new CityManager($conn);
$publisherManager = new PublisherManager($conn);
$authorManager = new AuthorManager($conn);
$libraryManager = new LibraryManager($conn);

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
        <?php
            $authorManager->InsertAuthor();
        ?>
    </div>
</body>

</html>