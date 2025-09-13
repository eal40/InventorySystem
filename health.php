<?php
// Health check endpoint for Railway

// Check if the application can connect to the database
require_once __DIR__ . '/classes/db_config.php';

$status = ['status' => 'ok', 'timestamp' => time()];

try {
    // Attempt to connect to the database
    $pdo = create_db_connection();
    
    // Simple query to verify database connection
    $stmt = $pdo->query("SELECT 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $status['database'] = 'connected';
} catch (PDOException $e) {
    $status['status'] = 'error';
    $status['database'] = 'disconnected';
    $status['error'] = 'Database connection failed';
    
    // Set HTTP status code to 500 for error
    http_response_code(500);
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($status);