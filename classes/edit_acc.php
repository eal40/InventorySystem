<?php
include __DIR__ . '/function.php';

try{
    session_start();

    $accid = $_GET['accid'];


    if (isset($_POST['editaccount']) && $_SESSION['Role'] == 'Admin') {
        // Collect POST data
        $fname = $_POST['editFName'];
        $lname = $_POST['editLName'];
        $username = $_POST['editUsername'];
        $email = $_POST['editEmail'];
        $phone = $_POST['editPhone'];
        $role = $_POST['editRole'];
        $branch = $_POST['editBranch'];

        // Call addItem function
        $request = editAcc($accid, $fname, $lname, $username, $email, $phone, $role, $branch);
        // Redirect based on result
        if ($request) {
            header("Location: ../dashboard.php?edit_acc=success&modal=edit_");
            exit;  
        } else {
            header("Location: ../edit_acc.php?$accid=failedddd");
            exit;
        }
    }
}catch(Exception $e){
    echo $e->getMessage();
}

?>