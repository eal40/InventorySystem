<?php
// Database connection
$host = 'localhost';
$dbname = '3motorinv';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sale_date = $_POST['sale_date'] ?? null;
    $category = $_POST['category'] ?? null;
    $branch = $_POST['branch'] ?? null;
    $quantity_sold = $_POST['quantity_sold'] ?? null;

    // Predefined valid categories and branches
    $valid_categories = ['motorparts', 'accessories', 'consumables'];
    $valid_branches = ['main', 'branch1', 'branch2'];

    // Validate required fields
    if ($sale_date && $category && $branch && $quantity_sold) {
        if (in_array($category, $valid_categories) && in_array($branch, $valid_branches)) {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO sales_data (sale_date, category, branch, quantity_sold)
                    VALUES (:sale_date, :category, :branch, :quantity_sold)
                ");

                $stmt->bindParam(':sale_date', $sale_date);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':branch', $branch);
                $stmt->bindParam(':quantity_sold', $quantity_sold, PDO::PARAM_INT);

                $stmt->execute();

                echo json_encode(['success' => true, 'message' => 'Sales data saved successfully.']);
                exit;
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Error saving sales data: ' . $e->getMessage()]);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid category or branch selected.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled out.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}
?>
