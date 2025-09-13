<?php
include __DIR__ . '/function.php';
session_start();

if (isset($_POST['addcategory']) && $_SESSION['Role'] == 'Admin') {
    $categoryName = $_POST['categoryName'];
    $categoryType = $_POST['categoryType'];
    $request = addCategory($categoryName, $categoryType);
    if ($request) {
        header("Location: ../dashboard.php?section=categories");
        exit;  
    } else {
        header("Location: ../add_category.php?add_category=failed");
        exit;
    }
}


?>