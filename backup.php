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
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/table.css" rel="stylesheet">
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
                <a href="#" class="nav-link" data-target="analyticsSection">
                    <i class="fas fa-chart-line fa-lg"></i>
                    <span class="menu-text">Analytics</span>
                </a>
                <a href="#" class="nav-link" data-target="inventorySection">
                    <i class="fas fa-box fa-lg"></i>
                    <span class="menu-text">Inventory</span>
                </a>
                <a href="#" class="nav-link" data-target="distributionSection">
                    <i class="fas fa-dolly fa-lg"></i>
                    <span class="menu-text">Distribution</span>
                </a>
                <a href="#" class="nav-link" data-target="notificationsSection">
                    <i class="fa fa-bell fa-lg"></i>
                    <span class="menu-text">Notification</span>
                </a>
                <a href="#" class="nav-link" data-target="categoriesSection">
                    <i class="fas fa-tags fa-lg"></i>
                    <span class="menu-text">Categories</span>
                </a>
                <a href="#" class="nav-link" data-target="accountManagementSection">
                    <i class="fas fa-user-cog fa-lg"></i>
                    <span class="menu-text">Account Management</span>
                </a>
                <a href="#" class="nav-link" data-target="settingsSection">
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

        <!-- Main Content -->
        <div class="container-fluid p-4" style="margin-left: 60px;"> 

            <!-- Analytics -->
            <div id="analyticsSection" class="content-section d-none">
                <div class="row">

                    <!-- Welcome Message -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Welcome back,<?php echo ' ' . $_SESSION['FName']; ?>!</h2>
                                <small class="text-muted">Explore the latest data insights and gain a comprehensive overview of key metrics to stay informed and make data-driven decisions. </small>
                            </div>
                        </div>
                    </div>
            
                    <!-- Chart Tabs -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="analyticsTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="by-type-tab" data-bs-toggle="tab" href="#byType" role="tab" aria-controls="byType" aria-selected="true">By Type</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="by-branch-tab" data-bs-toggle="tab" href="#byBranch" role="tab" aria-controls="byBranch" aria-selected="false">By Branch</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="analyticsTabsContent">
                                    <!-- By Type Tab -->
                                    <div class="tab-pane fade show active" id="byType" role="tabpanel" aria-labelledby="by-type-tab">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <!-- Dropdown Group -->
                                            <div class="d-flex align-items-center">
                                                <!-- Select Type Dropdown -->
                                                <div class="me-3">
                                                    <label for="selectTypeDropdown" class="form-label me-2">Select Type:</label>
                                                    <select id="selectTypeDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                                        <option value="motorparts">Motorparts</option>
                                                        <option value="accessories">Accessories</option>
                                                        <option value="consumables">Consumables</option>
                                                    </select>
                                                </div>
                                                <!-- Time Interval Dropdown -->
                                                <div>
                                                    <label for="timeIntervalDropdown" class="form-label me-2">Time Interval:</label>
                                                    <select id="timeIntervalDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                                        <option value="daily">Daily</option>
                                                        <option value="weekly">Weekly</option>
                                                        <option value="monthly">Monthly</option>
                                                        <option value="yearly">Yearly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Branch Checkboxes -->
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">Branch:</span>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input branch-checkbox" type="checkbox" id="mainBranch" value="Main">
                                                    <label class="form-check-label" for="mainBranch">Main</label>
                                                </div>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input branch-checkbox" type="checkbox" id="branch1" value="Branch 1">
                                                    <label class="form-check-label" for="branch1">Branch 1</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input branch-checkbox" type="checkbox" id="branch2" value="Branch 2">
                                                    <label class="form-check-label" for="branch2">Branch 2</label>
                                                </div>
                                            </div>
                                        </div>
                                        <canvas id="salesTrendsChart" height="150"></canvas>
                                    </div>

                                    <!-- By Branch Tab -->
                                    <div class="tab-pane fade" id="byBranch" role="tabpanel" aria-labelledby="by-branch-tab">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <!-- Dropdown Group -->
                                            <div class="d-flex align-items-center">
                                                <!-- Select Branch Dropdown -->
                                                <div class="me-3">
                                                    <label for="selectBranchDropdown" class="form-label me-2">Select Branch:</label>
                                                    <select id="selectBranchDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                                        <option value="main">Main</option>
                                                        <option value="branch1">Branch 1</option>
                                                        <option value="branch2">Branch 2</option>
                                                    </select>
                                                </div>
                                                <!-- Time Interval Dropdown -->
                                                <div>
                                                    <label for="branchTimeIntervalDropdown" class="form-label me-2">Time Interval:</label>
                                                    <select id="branchTimeIntervalDropdown" class="form-select form-select-sm d-inline-block w-auto">
                                                        <option value="daily">Daily</option>
                                                        <option value="weekly">Weekly</option>
                                                        <option value="monthly">Monthly</option>
                                                        <option value="yearly">Yearly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Type Checkboxes -->
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">Type:</span>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="checkbox" id="motorparts" value="motorparts">
                                                    <label class="form-check-label" for="motorparts">Motorparts</label>
                                                </div>
                                                <div class="form-check me-2">
                                                    <input class="form-check-input" type="checkbox" id="accessories" value="accessories">
                                                    <label class="form-check-label" for="accessories">Accessories</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="consumables" value="consumables">
                                                    <label class="form-check-label" for="consumables">Consumables</label>
                                                </div>
                                            </div>
                                        </div>
                                        <canvas id="salesByTypeChart" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Summary Cards -->
                    <div class="col-md-3 col-sm-6 mb-2 mt-2">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Total Inventory</h5>
                                <p class="h2" id="totalSales">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2 mt-2">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Motor Parts</h5>
                                <p class="h2" id="motorPartsSales">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2 mt-2">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Accessories</h5>
                                <p class="h2" id="accessoriesSales">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2 mt-2">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Consumables</h5>
                                <p class="h2" id="consumablesSales">0</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>

            <!-- Inventory -->
             <div id="inventorySection" class="content-section d-none">
                <div class="row">
                    <!-- Header -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Inventory Overview</h2>
                                <small class="text-muted">Keep track of your stock and ensure optimal inventory levels.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Branch Selector and Search Bar -->
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Branch Selector -->
                            <div class="d-flex align-items-center">
                                <label for="branchSelector" class="me-2">Select Branch:</label>
                                <select id="branchSelector" class="form-select" style="width: 200px;">
                                    <option value="main">Main Branch</option>
                                    <option value="branch1">Branch 1</option>
                                    <option value="branch2">Branch 2</option>
                                </select>
                            </div>

                            <!-- Search Bar -->
                            <div style="width: 300px;">
                                <input type="text" id="inventorySearch" class="form-control" placeholder="Search inventory...">
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Tables -->
                        <div class="col-12">
                            <!-- Main Branch Table -->
                            <div id="mainBranchTable">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Item ID</th>
                                            <th>Category</th>
                                            <th>Item Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $inventoryview1 = inventoryview();

                                            foreach ($inventoryview1 as $item) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($item['Item_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($item['Category_Name']); ?></td>
                                            <td><?php echo htmlspecialchars($item['Item_Name']); ?></td>
                                            <td><?php echo htmlspecialchars($item['Description']); ?></td>
                                            <td><?php echo htmlspecialchars($item['Quantity']); ?></td>
                                            <td><?php echo '₱' . number_format($item['Unit_Price']); ?></td>
                                            <td><?php echo htmlspecialchars($item['Updated_At']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit_<?= $item['Item_ID']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_<?= $item['Item_ID']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

<!-- Edit Inventory Modal -->
<div class="modal fade" id="edit_<?= $item['Item_ID']?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Inventory Item <?= $item['Item_ID']?> </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="classes/edit_item.php?itemid=<?= $item['Item_ID']?>" method="POST" id="editInventoryForm">
                                        <div class="mb-3">
                                            <label for="editItemName" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="editItemName" placeholder="<?= $item['Item_Name']?>" name="itemname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editItemCategory" class="form-label">Category</label>
                                            <select id="editItemCategory" class="form-select" name="category" required>
                                                <option value="Engine Parts">Engine Parts</option>
                                                <option value="Transmission">Transmission Parts</option>
                                                <option value="Brake Components">Brake Components</option>
                                                <option value="Electrical Systems">Electrical Systems</option>
                                                <option value="Suspension">Suspension</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editItemDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="editItemDescription" placeholder="<?= $item['Description']?>" name="description" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editItemQuantity" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="editItemQuantity" placeholder="<?= $item['Quantity']?>" name="quantity" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editItemPrice" class="form-label">Unit Price</label>
                                            <input type="number" step="0.01" class="form-control" id="editItemPrice" placeholder="<?= $item['Unit_Price']?>" name="unitprice" required>
                                        </div>
                                        <button type="submit" name="edititem" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_<?= $item['Item_ID']?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Inventory Item <?= $item['Item_ID']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="classes/delete_item.php?itemid=<?= $item['Item_ID']?>" method="POST">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this item?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="deleteitem" class="btn btn-danger">Delete</button>
                               </form>
                            </div>
                        </div>
                    </div>

                                         <?php } ?> 
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fas fa-plus me-1"></i> Add New Inventory</button>
                    </div>

                    <!-- Add New Inventory Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Add New Inventory</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="classes/add_item.php" method="POST" id="addInventoryForm">
                                        <div class="mb-3">
                                            <label for="addItemName" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="addItemName" name="itemname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addItemCategory" class="form-label">Category</label>
                                            <select id="addItemCategory" class="form-select" name="category" required>
                                                <option value="Engine Parts">Engine Parts</option>
                                                <option value="Transmission">Transmission Parts</option>
                                                <option value="Brake Components">Brake Components</option>
                                                <option value="Electrical Systems">Electrical Systems</option>
                                                <option value="Suspension">Suspension</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addItemDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="addItemDescription" name="description" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addItemQuantity" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="addItemQuantity" name="quantity" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addItemPrice" class="form-label">Unit Price</label>
                                            <input type="number" step="0.01" class="form-control" id="addItemPrice" name="unitprice" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="additem">Add Item</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                    
            <!-- Distribution -->
            <div id="distributionSection" class="content-section d-none">
                <div class="row">

                    <!-- Header -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Distribution Overview</h2>
                                <small class="text-muted">Monitor your product distribution across branches. </small>
                            </div>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-12 mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search distribution records">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Distribution Table -->
                    <div class="col-12">
                        <table class="table table-bordered table-distribution">
                            <thead class="table-dark">
                                <tr>
                                    <th>Distribution ID</th>
                                    <th>Item ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $distributionview = distributionview();

                                    foreach ($distributionview as $distribute) {
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($distribute['Transfer_ID']); ?></td>
                                    <td><?php echo htmlspecialchars($distribute['Item_ID']); ?></td>
                                    <td><?php echo htmlspecialchars($distribute['Item_Name']); ?></td>
                                    <td>
                                    <a href="#" class="category-link" data-category="<?php echo htmlspecialchars($distribute['Category_Name']); ?>">
                                        <?php echo htmlspecialchars($distribute['Category_Name']); ?>
                                    </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($distribute['Quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($distribute['Transfer_From']); ?></td>
                                    <td><?php echo htmlspecialchars($distribute['Transfer_To']); ?></td>
                                    <td><span class="badge bg-success"><?php echo htmlspecialchars($distribute['Status']); ?></span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDistributionModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDistributionModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDistributionModal">
                            <i class="fas fa-plus me-1"></i> Add New Distribution
                        </button>
                    </div>
                    
                    <!-- Add New Distribution Modal -->
                    <div class="modal fade" id="addDistributionModal" tabindex="-1" aria-labelledby="addDistributionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addDistributionModalLabel">Add New Distribution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addDistributionForm">
                                        <div class="mb-3">
                                            <label for="addDistItemId" class="form-label">Item ID</label>
                                            <input type="text" class="form-control" id="addDistItemId" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistName" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="addDistName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistCategory" class="form-label">Category</label>
                                            <select id="addDistCategory" class="form-select" required>
                                                <option value="engine">Engine Parts</option>
                                                <option value="transmission">Transmission Parts</option>
                                                <option value="brakes">Brake Components</option>
                                                <option value="electrical">Electrical Systems</option>
                                                <option value="suspension">Suspension</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistFrom" class="form-label">From</label>
                                            <input type="text" class="form-control" id="addDistFrom" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistTo" class="form-label">To</label>
                                            <input type="text" class="form-control" id="addDistTo" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Distribution</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Distribution History Modal -->
                    <div class="modal fade" id="categoryHistoryModal" tabindex="-1" aria-labelledby="categoryHistoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="categoryHistoryModalLabel">Distribution History</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="categoryHistoryContent">
                                        <!-- Table will be populated dynamically -->
                                        <div class="text-center">
                                            <p class="text-muted">Loading distribution history...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit Distribution Modal -->
                    <div class="modal fade" id="editDistributionModal" tabindex="-1" aria-labelledby="editDistributionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editDistributionModalLabel">Edit Distribution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editDistributionForm">
                                        <div class="mb-3">
                                            <label for="editDistItemId" class="form-label">Item ID</label>
                                            <input type="text" class="form-control" id="editDistItemId" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistName" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" id="editDistName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistCategory" class="form-label">Category</label>
                                            <select id="editDistCategory" class="form-select" required>
                                                <option value="engine">Engine Parts</option>
                                                <option value="transmission">Transmission Parts</option>
                                                <option value="brakes">Brake Components</option>
                                                <option value="electrical">Electrical Systems</option>
                                                <option value="suspension">Suspension</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistFrom" class="form-label">From</label>
                                            <input type="text" class="form-control" id="editDistFrom" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistTo" class="form-label">To</label>
                                            <input type="text" class="form-control" id="editDistTo" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Distribution Modal -->
                    <div class="modal fade" id="deleteDistributionModal" tabindex="-1" aria-labelledby="deleteDistributionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteDistributionModalLabel">Delete Distribution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this distribution record?</p>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Notification -->
            <div id="notificationsSection" class="content-section d-none">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Notifications</h2>
                                <small class="text-muted">Stay updated with important alerts and announcements.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Card -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Recent Activity</h5>
                            <ul class="list-unstyled">
                                <li><strong>Stock Alert:</strong> The stock of "Motor Oil" has fallen below the threshold. <small class="text-muted">10 minutes ago</small></li>
                                <li><strong>New Order:</strong> Order #12345 has been successfully processed. <small class="text-muted">30 minutes ago</small></li>
                                <li><strong>Low Stock Warning:</strong> "Air Filters" stock is running low. <small class="text-muted">1 hour ago</small></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings Card -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Notification Settings Form -->
                            <form id="notification-settings-form">
                                <div class="mb-3">
                                    <label for="stock-threshold" class="form-label">Stock Threshold</label>
                                    <input type="number" class="form-control" id="stock-threshold" name="stock-threshold" min="1" value="10" required>
                                    <small class="form-text text-muted">Set the minimum stock level for receiving a notification.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select the roles that will receive outgoing notifications (Email)</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="role-admin" name="roles[]" value="admin">
                                        <label class="form-check-label" for="role-admin">Admin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="role-manager" name="roles[]" value="manager">
                                        <label class="form-check-label" for="role-manager">Manager</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="role-staff" name="roles[]" value="staff">
                                        <label class="form-check-label" for="role-staff">Staff</label>
                                    </div>
                                    <small class="form-text text-muted">Select all roles that should receive email notifications.</small>
                                </div>
                                

                                <div class="mb-3">
                                    <label for="notification-frequency" class="form-label">Notification Frequency</label>
                                    <select class="form-select" id="notification-frequency" name="notification-frequency" required>
                                        <option value="immediate">Immediately</option>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                    </select>
                                    <small class="form-text text-muted">Choose how often you would like to receive notifications.</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div id="categoriesSection" class="content-section d-none">
                <div class="row">

                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Categories</h2>
                                <small class="text-muted">Define and manage your product categories here.</small>
                            </div>
                        </div>
                    </div>

                    
                <!-- Search and Add Category -->
                <div class="row mb-4">

                    <div class="col-md-6">
                        <!-- Search Bar -->
                        <input type="text" class="form-control" id="categorySearch" placeholder="Search categories...">
                    </div>

                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            <i class="fas fa-plus me-1"></i> Add New Category
                        </button>                        
                    </div>

                </div>

                <!-- Categories Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="categoryTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Category ID</th>
                                <th>Category Type</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>A</td>
                                <td>Motor Parts</td>
                                <td>Parts and components for vehicle engines, transmissions, and other motor-related components.</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>B</td>
                                <td>Accessories</td>
                                <td>Various vehicle accessories, including seat covers, floor mats, and more.</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>C</td>
                                <td>Consumables</td>
                                <td>Consumable goods such as oil, filters, and other vehicle-maintenance products.</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Add New Category Modal-->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="addCategoryForm">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="categoryType" class="form-label">Category Type</label>
                                        <select class="form-select" id="categoryType" required>
                                            <option value="" disabled selected>Select a category type</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="categoryName" placeholder="e.g., Accessories" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="categoryDescription" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                

                <!-- Edit Modal -->
                <div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="updateCategoryForm">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="updateCategoryType" class="form-label">Category Type</label>
                                        <select class="form-select" id="updateCategoryType" required>
                                            <option value="" disabled>Select a category type</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="updateCategoryName" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="updateCategoryName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="updateCategoryDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="updateCategoryDescription" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this category?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Account Management -->
            <div id="accountManagementSection" class="content-section d-none">

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Account Management</h2>
                                <small class="text-muted">Manage user accounts and roles here.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Account Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Role</th>
                                    <th>Branch</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $userview = userview();

                                    foreach ($userview as $user) {
                                    
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['User_ID']); ?></td>
                                    <td><?php echo htmlspecialchars($user['FName']); ?></td>
                                    <td><?php echo htmlspecialchars($user['LName']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Phone']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Role']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Branch']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Updated_At']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-edit-account me-1" data-bs-toggle="modal" data-bs-target="#editAccountModal<?= $user['User_ID']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-delete-account" data-bs-toggle="modal" data-bs-target="#deleteAccountModal<?= $user['User_ID']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal<?= $user['User_ID']; ?>" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountModalLabel">Edit Account - <?= htmlspecialchars($user['FName']); ?>  <?= htmlspecialchars($user['LName']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAccountForm" action="classes/edit_acc.php?accid=<?= $user['User_ID']; ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="editAccountId">
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" placeholder="<?php echo htmlspecialchars($user['FName']); ?>" name="editFName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" placeholder="<?php echo htmlspecialchars($user['LName']); ?>" name="editLName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" placeholder="<?php echo htmlspecialchars($user['Username']);  ?>" name="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" placeholder="<?php echo htmlspecialchars($user['Email']);  ?>" name="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="editPhoneNumber" placeholder="<?php echo htmlspecialchars($user['Phone']);  ?>" name="editPhone" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" name="editRole" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editBrach" class="form-label">Branch</label>
                        <select class="form-select" id="editRole" name="editBranch" required>
                            <option value="Digos City, Bus Terminal">Digos City, Bus Terminal</option>
                            <option value="Digos City, Davao Cotabato Road">Digos City, Davao Cotabato Road</option>
                            <option value="Bansalan Davao Del Sur">Bansalan Davao Del Sur</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editaccount" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal<?= $user['User_ID']; ?>" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account - <?= $user['FName'] . ' ' . $user['LName'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteAccountForm" action="classes/delete_acc.php?accid=<?= $user['User_ID']; ?>" method="POST">
                <div class="modal-body">
                    <p>Are you sure you want to delete this account?</p>
                    <input type="hidden" id="deleteAccountId">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="deleteaccount" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createAccountModal">
                            <i class="fas fa-plus me-1"></i> Create New Account
                        </button>
                    </div>

                    <!-- Create Modal -->
                    <div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createAccountModalLabel">Create New Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="createAccountForm" action="classes/register.php" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="newFirstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="newFirstName" name="fname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newLastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="newLastName" name="lname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newUsername" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="newUsername" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="newPassword" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="newEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPhoneNumber" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="newPhoneNumber" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newRole" name="role" class="form-label">Role</label>
                                            <select class="form-select" id="newRole" name="role" required>
                                                <option value="Admin">Admin</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Branch" name="branch" class="form-label">Branch</label>
                                            <select class="form-select" id="newBranch" name="branch" required>
                                                <option value="Digos City, Bus Terminal">Digos City, Bus Terminal</option>
                                                <option value="Digos City, Davao Cotabato Road">Digos City, Davao Cotabato Road</option>
                                                <option value="Bansalan Davao Del Sur">Bansalan Davao Del Sur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="register">Create Account</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div id="settingsSection" class="content-section d-none">
                <div class="row">

                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Settings</h2>
                                <small class="text-muted">Manage your account security, including password and email.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <form id="change-password-form">
                                    <div class="mb-3">
                                        <label for="current-password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="current-password" name="current-password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new-password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new-password" name="new-password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-password" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Change Email Card -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Email</h5>
                                <form id="change-email-form">
                                    <div class="mb-3">
                                        <label for="current-email" class="form-label">Current Email</label>
                                        <input type="email" class="form-control" id="current-email" name="current-email" placeholder="<?php echo $_SESSION['Email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new-email" class="form-label">New Email</label>
                                        <input type="email" class="form-control" id="new-email" name="new-email" required>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Save Changes Button -->
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/contentswitch.js"></script>
    <script src="assets/js/firsttab.js"></script>
    <script src="assets/js/secondtab.js"></script>
    <script src="assets/js/DistributionHistory.js"></script>

</body>
</html>
