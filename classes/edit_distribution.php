<?php
include __DIR__ . '/function.php';

session_start();
$transferId = $_GET['transfer_id'];

if (isset($_POST['editdistribution']) && $_SESSION['Role'] == 'Admin') {
    // Get form data
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $category = $_POST['category'];  // Category name (if passed via form, else query it based on Item_ID)
    $transferFrom = $_POST['transfer_from'];
    $transferTo = $_POST['transfer_to'];
    $status = $_POST['status']; // Update status after changes
    $deliverDate = $_POST['deliver_date'];
    $quantity = $_POST['quantity']; // Updated delivery date

    try {
        // Database connection
        $dbconnection = dbconnection();
        
        // Fetch the Category Name based on Item_ID (if needed)
        $sqlCategory = "SELECT c.Category_Name
                        FROM category c
                        JOIN item i ON i.Category_ID = c.Category_ID
                        WHERE i.Item_ID = :item_id LIMIT 1";
        $stmtCategory = $dbconnection->prepare($sqlCategory);
        $stmtCategory->execute([':item_id' => $itemId]);
        $categoryResult = $stmtCategory->fetch(PDO::FETCH_ASSOC);

        // If the category is found, assign it
        if ($categoryResult) {
            $categoryName = $categoryResult['Category_Name'];
        } else {
            // Handle error if category is not found
            throw new Exception("Category not found for the selected item.");
        }

        // Update the transfer record
        $sql = "UPDATE transfer SET 
                    Item_ID = :item_id,
                    Transfer_From = :transfer_from,
                    Transfer_To = :transfer_to,
                    Quantity = :quantity,
                    Status = :status,
                    Deliver_Date = :deliver_date
                WHERE Transfer_ID = :transfer_id";

        $stmt = $dbconnection->prepare($sql);
        $stmt->execute([
            ':item_id' => $itemId,
            ':transfer_from' => $transferFrom,
            ':transfer_to' => $transferTo,
            ':quantity' => $quantity,
            ':status' => $status,
            ':deliver_date' => $deliverDate,
            ':transfer_id' => $transferId
        ]);

        // Redirect after the update
        header("Location: ../dashboard.php?section=distribution");
        exit();

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
