<?php
include __DIR__ . '/function.php';
session_start();

$categoryID = $_POST['categoryID'];

if (isset($_POST['deletecategory']) && $_SESSION['Role'] == 'Admin') {

    $request = deleteCategory($categoryID);
    if ($request == true) {
        header("Location: ../dashboard.php?section=categories");
        exit;  
    } else {
        header("Location: ../dashboard.php?section=categories");
        exit;
    }
}
?>
