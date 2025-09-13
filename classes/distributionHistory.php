<?php
header('Content-Type: application/json');

// Include database configuration helper
require_once __DIR__ . '/db_config.php';

if (isset($_GET['category'])) {
    $category = htmlspecialchars($_GET['category']);

    try {
        $pdo = create_db_connection();
        
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
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Category not specified.'
    ]);
}
?>
