<?php
include __DIR__ . '/function.php';

// Logout script
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location: ../index.php");
}

?>