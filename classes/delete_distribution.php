<?php
include __DIR__ . '/function.php';
session_start();
$transferId = $_GET['transfer_id'];
if (isset($_POST['deletedistribution']) && $_SESSION['Role'] == 'Admin') {

    try {
        $dbconnection = dbconnection();
        // Delete distribution record
        $sql = "DELETE FROM transfer WHERE Transfer_ID = :transfer_id";
        $stmt = $dbconnection->prepare($sql);
        $stmt->execute([':transfer_id' => $transferId]);

        // Redirect back after deletion
        header("Location: ../dashboard.php?section=distribution");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>