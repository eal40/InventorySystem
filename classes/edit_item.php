<?php
include __DIR__ . '/function.php';
session_start();

$itemid = $_GET['itemid'];


if (isset($_POST['edititem']) && $_SESSION['Role'] == 'Admin') {
    // Collect POST data
    $itemname = $_POST['itemname'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $supplier = $_POST['supplier'];    
    $quantity = $_POST['quantity'];
    $unitprice = $_POST['unitprice'];

    // Call addItem function
    $request = editItem($itemid, $itemname, $brand, $category, $description, $supplier, $quantity, $unitprice);
    // Redirect based on result
    if ($request) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;  
    } else {
        header("Location: ../edit_item.php?$itemid=failed");
        exit;
    }
}


?>