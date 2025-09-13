<?php
include __DIR__ . '/function.php';
session_start();

$itemid = $_GET['itemid'];

if (isset($_POST['deleteitem']) && $_SESSION['Role'] == 'Admin') {

    $request = deleteItem($itemid);

    if($request == true) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;  
    } else {
        header("Location: ../delete_item.php?delete_item=failed");
        exit;
    }

}
?>