<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session at the very beginning
session_start();

// Check if user is logged in and if session variables are set
if (!isset($_SESSION['FName'])) {
    // If session variables aren't set, redirect the user to the login page
    header("Location: index.php");  // Redirect to login page
    exit(); // Ensure no further code is executed after the redirect
}

include 'classes/function.php';

// Determine the section to include based on a query parameter
$section = isset($_GET['section']) ? $_GET['section'] : 'analytics';

// Sanitize the section parameter to prevent directory traversal
$allowed_sections = ['summary', 'analytics', 'distributionMain', 'distributionBranch1', 'distributionBranch2', 'inventoryMain', 'inventoryBranch1', 'inventoryBranch2', 'distribution', 'notification', 'categories', 'account-management', 'settings'];
if (!in_array($section, $allowed_sections)) {
    $section = 'analytics'; // Default to analytics if an invalid section is specified
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/table.css" rel="stylesheet">
    <link href="assets/css/sum.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar bg-dark">
            <div class="sidebar-header text-white">
                <i class="fas fa-bars fa-lg"></i>
                <span class="menu-text">Dashboard</span>
            </div>
            
            <!-- Menu Section -->
            <div class="menu-section">
                <a href="?section=summary" class="nav-link">
                    <i class="fas fa-file-alt fa-lg"></i>
                    <span class="menu-text">Summary</span>
                </a>
                <a href="?section=analytics" class="nav-link">
                    <i class="fas fa-chart-line fa-lg"></i>
                    <span class="menu-text">Analytics</span>
                </a>
                <a href="?section=inventoryMain" class="nav-link">
                    <i class="fas fa-box fa-lg"></i>
                    <span class="menu-text">Inventory</span>
                </a>
                <a href="?section=distributionMain" class="nav-link">
                    <i class="fas fa-dolly fa-lg"></i>
                    <span class="menu-text">Distribution</span>
                </a>
                <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] !== 'Staff'): ?>
                <a href="?section=notification" class="nav-link">
                    <i class="fa fa-bell fa-lg"></i>
                    <span class="menu-text">Notification</span>
                </a>
                <?php endif; ?>
                <a href="?section=categories" class="nav-link">
                    <i class="fas fa-tags fa-lg"></i>
                    <span class="menu-text">Categories</span>
                </a>
                <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'Admin'): ?>
                <a href="?section=account-management" class="nav-link">
                    <i class="fas fa-user-cog fa-lg"></i>
                    <span class="menu-text">Account Management</span>
                </a>
                <?php endif; ?>
                <a href="?section=settings" class="nav-link">
                    <i class="fas fa-cog fa-lg"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
                        
            <!-- User Profile -->
            <div class="user-profile">
                <a href="#" class="nav-link profile-container">
                    <i class="bi bi-person-circle"></i>
                    <span class="name"><?php echo $_SESSION['Role'] . ' ' . $_SESSION['FName']; ?></span>
                </a>
                <form action="classes/logout.php" method="POST">
                    <button type="submit" name="logout" class="custom-logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="menu-text">Logout</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Dynamic Content Area -->
        <div id="dynamic-content" class="container-fluid p-4" style="margin-left: 60px;">
            <?php
            // Include the appropriate content based on the section parameter
            $file_path = "modules/" . $section . ".php";
            if (file_exists($file_path)) {
                include $file_path;
            } else {
                echo '<div class="alert alert-danger">Section not found.</div>';
            }
            ?>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/contentswitch.js"></script>
</body>
</html>
