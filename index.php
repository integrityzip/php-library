<?php require_once __DIR__ . '/vendor/autoload.php'; ?>

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
    <title>Document</title>
</head>

<body>
    <div id="contentBox">
        <?php
        $bookManager->GetAllBooks();

        echo "<h3>hi this is placeholder text :]</h3>";

        $cityManager->GetAllCities();

        echo "<h3>hi this is placeholder text :]</h3>";

        $publisherManager->GetAllPublishers();

        echo "<h3>hi this is placeholder text :]</h3>";

        $authorManager->GetAllAuthors();

        echo "<h3>hi this is placeholder text :]</h3>";

        $libraryManager->GetAllLibraries();
        ?>
    </div>
</body>

</html>