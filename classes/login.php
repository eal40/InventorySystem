<?php
include __DIR__ . '/function.php';
session_start();  // Start the session at the very beginning

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Get the username and password from the POST request
    $username = $_POST['username'];  
    $password = $_POST['password'];

    // Call the login function
    $userData = login($username, $password);

    if ($userData) {
        // If login is successful, store user details in session
        $_SESSION['User_ID'] = $userData['User_ID'];
        $_SESSION['FName'] = $userData['FName'];
        $_SESSION['LName'] = $userData['LName'];
        $_SESSION['Role'] = $userData['Role'];
        $_SESSION['Branch'] = $userData['Branch'];
        $_SESSION['Email'] = $userData['Email'];
        $_SESSION['username'] = $username;  // You can still store the username if you like
        
        // Redirect to the dashboard
        header("Location: ../dashboard.php");
        exit();  // Always use exit() after header redirect
    } else {
        // If login failed, redirect back to the login page with an error message
        header("Location: index.php?login=failed");
        exit();  // Always use exit() to stop further execution
    }
}
?>
