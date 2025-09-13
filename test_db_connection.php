<?php
// Test script to check database connection

// Include the database configuration
require_once __DIR__ . '/classes/db_config.php';

// Display PHP version and loaded extensions
echo "<h2>PHP Information</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";

echo "<h3>Loaded Extensions:</h3>";
echo "<pre>";
print_r(get_loaded_extensions());
echo "</pre>";

echo "<h3>PDO Drivers:</h3>";
echo "<pre>";
print_r(PDO::getAvailableDrivers());
echo "</pre>";

// Get database configuration
$config = get_db_config();

echo "<h2>Database Configuration</h2>";
echo "<pre>";
// Don't show the actual password in output
$config_safe = $config;
$config_safe['password'] = '********';
print_r($config_safe);
echo "</pre>";

// Try connecting with explicit driver specification
try {
    echo "<h2>Connection Test</h2>";
    
    // Explicitly specify the driver
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
    echo "<p>DSN: $dsn</p>";
    
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color:green;font-weight:bold;'>Connection successful!</p>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT 1 as test");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>Query test result: " . $result['test'] . "</p>";
    
} catch (PDOException $e) {
    echo "<p style='color:red;font-weight:bold;'>Connection failed: " . $e->getMessage() . "</p>";
    
    // Additional debugging information
    echo "<h3>Error Details:</h3>";
    echo "<pre>";
    print_r($e);
    echo "</pre>";
}
?>