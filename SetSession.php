<?php
// Handle session management and screen navigation
session_name("PHPLibrary");
session_start();

// Process AJAX screen change requests
if (isset($_POST['screen'])) {
    $_SESSION['screen'] = $_POST['screen'];
    include 'Logic.php';
}
?>