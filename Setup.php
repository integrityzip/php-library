<?php
// Main setup file that initializes database connections for all managers

require_once 'vendor/autoload.php';

// Get database connection singleton
$conn = require_once 'Classes/DBManager.php';

// Distribute the connection to all manager classes
if ($conn) {
    AuthorManager::SetConnection($conn);
    PublisherManager::SetConnection($conn);
    CityManager::SetConnection($conn);
    BookManager::SetConnection($conn);
    LibraryManager::SetConnection($conn);
}

?>