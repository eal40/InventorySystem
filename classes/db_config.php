<?php
/**
 * Database Configuration Helper
 * 
 * This file provides a centralized way to handle database connections
 * using Railway's environment variables.
 */

/**
 * Get database connection parameters from Railway's environment variable
 * 
 * @return array Array containing host, dbname, username, and password
 */
function get_db_config() {
    // Parse Railway's DATABASE_URL environment variable
    $db_url = getenv('DATABASE_URL') ?: 'mysql://root:OaLTJmrPxXgjyJufzHKuLBQrcnkPIDBp@mysql-9ah0.railway.internal:3306/railway';
    
    // Parse the URL to extract components
    $url_parts = parse_url($db_url);
    
    return [
        'host' => $url_parts['host'],
        'dbname' => ltrim($url_parts['path'], '/'),
        'username' => $url_parts['user'],
        'password' => $url_parts['pass'],
        'port' => isset($url_parts['port']) ? $url_parts['port'] : 3306
    ];
}

/**
 * Create a PDO database connection
 * 
 * @return PDO PDO database connection object
 */
function create_db_connection() {
    $config = get_db_config();
    
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>