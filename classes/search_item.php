<?php
include __DIR__ . '/function.php';

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];

    // Function to fetch item names and category based on the search term
    $items = searchItems($searchTerm);
    
    // Return the items as JSON
    echo json_encode($items);
} else {
    echo json_encode([]);
}

function searchItems($searchTerm) {
    $dbconnection = dbconnection();
    $sql = "SELECT 
                item.Item_ID, 
                item.Item_Name, 
                category.Category_Name
            FROM 
                item
            LEFT JOIN 
                category 
            ON 
                item.Category_ID = category.Category_ID
            WHERE 
                item.Item_Name LIKE :searchTerm
            LIMIT 10;";

    $stmt = $dbconnection->prepare($sql);
    $stmt->execute([':searchTerm' => '%' . $searchTerm . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
