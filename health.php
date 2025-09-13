<?php
/**
 * Health Check Script
 * 
 * This script performs various health checks on the application:
 * - Database connectivity
 * - PHP version compatibility
 * - Required PHP extensions
 * - Directory permissions
 * 
 * It returns a JSON response with health status information.
 */

// Set content type to JSON
header('Content-Type: application/json');

// Initialize response array
$response = [
    'status' => 'healthy',
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => []
];

// Check PHP version
$requiredPhpVersion = '7.4.0';
$phpVersionCheck = [
    'name' => 'PHP Version',
    'status' => version_compare(PHP_VERSION, $requiredPhpVersion, '>=') ? 'pass' : 'fail',
    'message' => 'PHP ' . PHP_VERSION . ' installed',
    'required' => '>= ' . $requiredPhpVersion
];
$response['checks'][] = $phpVersionCheck;

if ($phpVersionCheck['status'] === 'fail') {
    $response['status'] = 'unhealthy';
}

// Check required PHP extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'json', 'session'];
$extensionsCheck = [
    'name' => 'PHP Extensions',
    'status' => 'pass',
    'details' => []
];

foreach ($requiredExtensions as $extension) {
    $loaded = extension_loaded($extension);
    $extensionsCheck['details'][$extension] = $loaded ? 'loaded' : 'missing';
    
    if (!$loaded) {
        $extensionsCheck['status'] = 'fail';
        $response['status'] = 'unhealthy';
    }
}

$response['checks'][] = $extensionsCheck;

// Check database connection
try {
    require_once __DIR__ . '/classes/db_config.php';
    
    // Check if we're in a local development environment
    $isLocalEnv = (strpos($_SERVER['HTTP_HOST'] ?? 'localhost', 'localhost') !== false) || 
                  (strpos($_SERVER['SERVER_NAME'] ?? 'localhost', 'localhost') !== false);
    
    // Get database config
    $config = get_db_config();
    
    // If we're in local environment and trying to connect to Railway, provide a warning
    if ($isLocalEnv && strpos($config['host'], 'railway.internal') !== false) {
        $dbCheck = [
            'name' => 'Database Connection',
            'status' => 'warning',
            'message' => 'Railway database not accessible in local environment. This is expected in development.'
        ];
    } else {
        // Try to connect to the database
        $dbConnection = create_db_connection();
        
        // Simple query to test connection
        $stmt = $dbConnection->query('SELECT 1');
        $stmt->fetchAll();
        
        $dbCheck = [
            'name' => 'Database Connection',
            'status' => 'pass',
            'message' => 'Successfully connected to database'
        ];
    }
} catch (Exception $e) {
    $dbCheck = [
        'name' => 'Database Connection',
        'status' => 'fail',
        'message' => 'Failed to connect to database: ' . $e->getMessage()
    ];
    
    // Only set unhealthy if we're not in a local environment trying to access Railway
    $isLocalEnv = (strpos($_SERVER['HTTP_HOST'] ?? 'localhost', 'localhost') !== false) || 
                  (strpos($_SERVER['SERVER_NAME'] ?? 'localhost', 'localhost') !== false);
    $isRailwayDb = strpos($e->getMessage(), 'railway.internal') !== false;
    
    if (!($isLocalEnv && $isRailwayDb)) {
        $response['status'] = 'unhealthy';
        // Set HTTP status code to 500 for error
        http_response_code(500);
    } else {
        // This is expected in local development
        $dbCheck['status'] = 'warning';
    }
}

$response['checks'][] = $dbCheck;

// Check write permissions for important directories
$directories = [
    'classes' => __DIR__ . '/classes',
    'modules' => __DIR__ . '/modules',
    'assets' => __DIR__ . '/assets'
];

$permissionsCheck = [
    'name' => 'Directory Permissions',
    'status' => 'pass',
    'details' => []
];

foreach ($directories as $name => $path) {
    $writable = is_writable($path);
    $permissionsCheck['details'][$name] = $writable ? 'writable' : 'not writable';
    
    if (!$writable) {
        $permissionsCheck['status'] = 'fail';
        $response['status'] = 'degraded'; // Set to degraded instead of unhealthy
    }
}

$response['checks'][] = $permissionsCheck;

// Output the response
echo json_encode($response, JSON_PRETTY_PRINT);