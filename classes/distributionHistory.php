<?php
header('Content-Type: application/json');

if (isset($_GET['category'])) {
    $category = htmlspecialchars($_GET['category']);

    $pdo = new PDO('mysql:host=localhost;dbname=3motorinv', 'username', 'password');

    $stmt = $pdo->prepare("SELECT Transfer_ID, Item_ID, Item_Name, Quantity, Transfer_From, Transfer_To, Status 
                           FROM distributions 
                           WHERE Category_Name = :category");
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'records' => $records
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Category not specified.'
    ]);
}
?>
