<?php
include __DIR__ . '/function.php';

session_start();


if (isset($_POST['adddistribution']) && $_SESSION['Role'] == 'Admin') {
    // Get form data
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $category = $_POST['category'];
    $transferFrom = $_POST['transfer_from'];
    $transferTo = $_POST['transfer_to'];
    $quantity = $_POST['quantity'];
    $status = 'Pending'; // Default status for new distribution
    $deliverDate = date('Y-m-d'); // Set today's date for delivery (could be changed based on your logic)

    $request = addDistribution($itemId, $itemName, $category, $transferFrom, $transferTo, $quantity, $status, $deliverDate);

    if ($request) {
        header("Location: ../dashboard.php?section=distribution");
        alert("Distribution added successfully!");
        exit;  
    } else {
        header("Location: ../add_distribution.php?add_distribution=failed");
        exit;
    }
}
?>

<?php
include __DIR__ . '/function.php';

session_start();

if (isset($_POST['adddistribution']) && $_SESSION['Role'] == 'Admin') {
    // Get form data
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $category = $_POST['category']; // The category is selected from the form
    $transferFrom = $_POST['transfer_from'];
    $transferTo = $_POST['transfer_to'];
    $quantity = $_POST['quantity'];
    $status = 'Pending'; // Default status for new distribution
    $deliverDate = date('Y-m-d'); // Set today's date for delivery (could be changed based on your logic)

    // Ensure the category is properly retrieved based on the selected item_id
    try {
        // Fetch category name from the item table based on the item_id
        $dbconnection = dbconnection();
        $sql = "SELECT c.Category_Name 
                FROM item i
                JOIN category c ON i.Category_ID = c.Category_ID
                WHERE i.Item_ID = :item_id LIMIT 1";
        $stmt = $dbconnection->prepare($sql);
        $stmt->execute([':item_id' => $itemId]);
        $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($categoryResult) {
            // If a category is found for the item, overwrite the posted category
            $category = $categoryResult['Category_Name'];
        } else {
            // If no category is found, handle as an error
            die("Error: Item does not have a valid category.");
        }

        // Now add the distribution
        $request = addDistribution($itemId, $itemName, $category, $transferFrom, $transferTo, $quantity, $status, $deliverDate);

        if ($request) {
            header("Location: ../dashboard.php?section=distribution");
            alert("Distribution added successfully!");
            exit;  
        } else {
            header("Location: ../add_distribution.php?add_distribution=failed");
            exit;
        }
    } catch (Exception $e) {
        // Log the error
        echo "Error: " . $e->getMessage();
    }
}
?>
