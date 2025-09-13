<?php
session_start();
include __DIR__ . '/function.php';

if (isset($_POST['updatepassword'])) {
    // Sanitize user inputs
    $userId = intval($_POST['user_id']);
    $currentPassword = $_POST['entered_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
        exit;
    }

    try {
        // Database connection
        $dbconnection = dbconnection();

        // Fetch the current hashed password from the database
        $stmt = $dbconnection->prepare("SELECT Password FROM users WHERE User_ID = :id");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($currentPassword, $user['Password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
            exit;
        }

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateStmt = $dbconnection->prepare("UPDATE users SET Password = :Password WHERE User_ID = :id");
        $updateStmt->execute([
            'Password' => $hashedPassword,
            'id' => $userId
        ]);

        header("location: ../dashboard.php?section=settings?success");
    } catch (PDOException $e) {
        header("location: ../dashboard.php?section=settings");
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateemail'])) {
    try {
        // Sanitize input
        $userId = $_SESSION['User_ID']; // Assume user ID is stored in session
        $currentEmail = filter_var($_POST['current_email'], FILTER_SANITIZE_EMAIL);
        $newEmail = filter_var($_POST['new_email'], FILTER_SANITIZE_EMAIL);

        // Database connection
        $dbconnection = dbconnection();
        // Check if the current email matches the one in the database
        $stmt = $dbconnection->prepare("SELECT Email FROM users WHERE User_ID = :id");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['Email'] !== $currentEmail) {
            $_SESSION['message'] = 'Current email is incorrect.';
            $_SESSION['message_type'] = 'error';
            header("Location: ../dashboard.php?section=settings");
            exit;
        }

        // Check if the new email is already in use
        $checkStmt = $dbconnection->prepare("SELECT User_ID FROM users WHERE Email = :Email");
        $checkStmt->execute(['Email' => $newEmail]);
        if ($checkStmt->fetch()) {
            $_SESSION['message'] = 'New email is already in use.';
            $_SESSION['message_type'] = 'error';
            header("Location: ../dashboard.php?section=settings");
            exit;
        }

        // Update the email in the database
        $updateStmt = $dbconnection->prepare("UPDATE users SET Email = :Email WHERE User_ID = :id");
        $updateStmt->execute([
            'Email' => $newEmail,
            'id' => $userId
        ]);

        $_SESSION['message'] = 'Email updated successfully.';
        $_SESSION['message_type'] = 'success';
        header("Location: ../dashboard.php?section=settings");
        exit;
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Database error: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
        header("Location: ../dashboard.php?section=settings");
        exit;
    }
} else {
    $_SESSION['message'] = 'Invalid request.';
    $_SESSION['message_type'] = 'error';
    header("Location: ../dashboard.php?section=settings");
    exit;
}
