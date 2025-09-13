<?php
include __DIR__ . '/function.php';
session_start();

$accid = $_GET['accid'];

if (isset($_POST['deleteaccount']) && $_SESSION['Role'] == 'Admin') {
    $request = deleteAcc($accid);

    if ($request == true) {
        $_SESSION['delete_status'] = 'success'; // Store success status in session
    } else {
        $_SESSION['delete_status'] = 'failed'; // Store failure status in session
    }
    // Redirect back to the same page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
