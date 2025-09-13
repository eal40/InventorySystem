<?php
include __DIR__ . '/function.php';
session_start();

$categoryID = $_GET['categoryID'];

if (isset($_POST['updatecategory']) && $_SESSION['Role'] == 'Admin') {

    $categoryName = $_POST['categoryName'];
    $categoryType = $_POST['categoryType'];
    $request = editCategory($categoryID, $categoryName, $categoryType);
    if ($request) {
        header("Location: ../dashboard.php?section=categories");
        exit;  
    } else {
        header("Location: ../edit_category.php?edit_category=failed");
        exit;
    }
}
?>