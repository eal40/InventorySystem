<?php
include __DIR__ . '/function.php';

// Disable any output before setting headers
ob_start();

// Prevent caching
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

header('Content-Type: application/json');

// Debugging: Log all POST data
error_log('POST Data: ' . print_r($_POST, true));

// Check if it's a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Debug: Check if 'register' field exists
    if (!isset($_POST['register'])) {
        error_log('Register field is missing from POST data');
        echo json_encode([
            'success' => false, 
            'message' => 'Register field is missing',
            'post_data' => $_POST
        ]);
        exit;
    }

    // Check if all required fields are present
    $required_fields = ['fname', 'lname', 'username', 'password', 'email', 'phone', 'role', 'branch'];
    
    $missing_fields = [];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (empty($missing_fields)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = preg_replace('/\D/', '', $_POST['phone']);
        $role = $_POST['role'];
        $branch = $_POST['branch'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $request = register($fname, $lname, $username, $password, $email, $phone, $role, $branch);

            if ($request) {
                echo json_encode(['success' => true, 'message' => 'Account created successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create account. Username or email might already exist.']);
            }
        } catch (Exception $e) {
            // Log the full error for server-side debugging
            error_log('Registration Error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'An unexpected error occurred during registration.']);
        }
    } else {
        // Log missing fields for debugging
        error_log('Missing fields: ' . implode(', ', $missing_fields));
        echo json_encode([
            'success' => false, 
            'message' => 'Missing required fields: ' . implode(', ', $missing_fields)
        ]);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}
?>