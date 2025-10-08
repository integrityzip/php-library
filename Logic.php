<?php
// Main business logic handling form submissions and page routing

require_once 'Setup.php';

// Utility function for redirecting after form submissions
function ResetHeader()
{
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ! Adding New Items
    if (isset($_POST['addAuthor'])) {
        $_SESSION['authorName'] = $_POST['authorName'];
        $_SESSION['date'] = $_POST['date'];
        AuthorManager::InsertAuthor();
    }

    if (isset($_POST['addLibrary'])) {
        $_SESSION['libraryName'] = $_POST['libraryName'];
        $_SESSION['libraryCity'] = $_POST['libraryCity'];
        LibraryManager::InsertLibrary();
    }

    if (isset($_POST['addCity'])) {
        $_SESSION['cityName'] = $_POST['cityName'];
        CityManager::InsertCity();
    }

    if (isset($_POST['addPublisher'])) {
        $_SESSION['publisherName'] = $_POST['publisherName'];
        PublisherManager::InsertPublisher();
    }

    if (isset($_POST['addBook'])) {
        $_SESSION['bookTitle'] = $_POST['bookTitle'];
        $_SESSION['bookPages'] = $_POST['bookPages'];
        $_SESSION['bookGenre'] = $_POST['bookGenre'];
        $_SESSION['bookAuthor'] = $_POST['bookAuthor'];
        $_SESSION['bookPublisher'] = $_POST['bookPublisher'];
        $_SESSION['bookLibrary'] = $_POST['bookLibrary'];
        BookManager::InsertBook();
    }

    // ? Deleting Items

    if (isset($_POST['deleteBook'])) {
        $_SESSION['bookId'] = $_POST['bookId'];
        BookManager::DeleteBook();
    }

    if (isset($_POST['deleteAuthor'])) {
        $_SESSION['authorId'] = $_POST['authorId'];
        AuthorManager::DeleteAuthor();
    }

    if (isset($_POST['deleteLibrary'])) {
        $_SESSION['libraryId'] = $_POST['libraryId'];
        LibraryManager::DeleteLibrary();
    }

    if (isset($_POST['deletePublisher'])) {
        $_SESSION['publisherId'] = $_POST['publisherId'];
        PublisherManager::DeletePublisher();
    }

    if (isset($_POST['deleteCity'])) {
        $_SESSION['cityId'] = $_POST['cityId'];
        CityManager::DeleteCity();
    }
}

if (!isset($_SESSION['screen'])) {
    $_SESSION['screen'] = "start";
}

switch ($_SESSION['screen']) {
    case "addbook":
        include 'Views/AddBookForm.php';
        break;
    case "addauthor":
        include 'Views/AddAuthorForm.php';
        break;
    case "addlibrary":
        include 'Views/AddLibraryForm.php';
        break;
    case "addpublisher":
        include 'Views/AddPublisherForm.php';
        break;
    case "addcity":
        include 'Views/AddCityForm.php';
        break;
    case "viewbook":
        include 'Views/DeleteBookForm.php';
        break;
    case "viewauthor":
        include 'Views/DeleteAuthorForm.php';
        break;
    case "viewlibrary":
        include 'Views/DeleteLibraryForm.php';
        break;
    case "viewpublisher":
        include 'Views/DeletePublisherForm.php';
        break;
    case "viewcity":
        include 'Views/DeleteCityForm.php';
        break;
    default:
        echo "Welcome to the Library System!";
        break;
}
?>