<!-- Distribution -->

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

                    <!-- Branch Selector and Search Bar -->
                    <div class="col-12 mb-4">
                        <div class="d-flex justify-content-between align-items-center">

                            <!-- Branch Selector -->
                            <div class="d-flex align-items-center">
                                <label for="branchSelector" class="me-2">Select Branch:</label>
                                <select id="branchSelector" class="form-select" style="width: 200px;">
                                    <option value="Branch1">Branch 1</option>
                                    <option value="Main">Main Branch</option>
                                    <option value="Branch2">Branch 2</option>
                                </select>
                            </div>

                            <script>
                                const branchSelector = document.getElementById('branchSelector');
                                branchSelector.addEventListener('change', (e) => {
                                    const selectedValue = e.target.value;
                                    const url = `dashboard.php?section=distribution${selectedValue}`;
                                    window.location.href = url;
                                });
                            </script>

                            <script>
                                const branchSelector = document.getElementById('branchSelector');

                                branchSelector.addEventListener('change', (e) => {
                                    const selectedValue = e.target.value;
                                    const url = `?section=distribution${selectedValue}.php`;
                                    window.location.href = url;
                                });
                            </script>

                            <!-- Search Bar -->
                            <div style="width: 300px;">
                                <input type="text" id="inventorySearch" class="form-control" placeholder="Search inventory...">
                            </div>
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
                                    <th>Deliver Date</th>
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
                                    <td>
                                        <?php 
                                        $status = htmlspecialchars($distribute['Status']); 
                                        $badgeClass = '';

                                        // Determine the badge class based on the status
                                        switch ($status) {
                                            case 'Pending':
                                                $badgeClass = 'bg-warning text-dark';
                                                break;
                                            case 'Delivered':
                                                $badgeClass = 'bg-success';
                                                break;
                                            case 'Cancelled':
                                                $badgeClass = 'bg-danger';
                                                break;
                                            default:
                                                $badgeClass = 'bg-secondary'; // Default for unknown statuses
                                                break;
                                        }
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?>">
                                            <?php echo $status; ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($distribute['Deliver_Date']); ?></td>
                                    <td>
                                    <?php 
                                    $isAdminOrManager = (isset($_SESSION['Role']) && ($_SESSION['Role'] === 'Admin' || $_SESSION['Role'] === 'Manager'));
                                    ?>

                                    <button class="btn btn-sm btn-primary <?php echo $isAdminOrManager ? '' : 'disabled'; ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editDistributionModal<?= $distribute['Transfer_ID']; ?>"
                                            <?php echo $isAdminOrManager ? '' : 'disabled="disabled"'; ?>>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger <?php echo $isAdminOrManager ? '' : 'disabled'; ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteDistributionModal<?= $distribute['Transfer_ID']; ?>"
                                            <?php echo $isAdminOrManager ? '' : 'disabled="disabled"'; ?>>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    </td>                                    
                                </tr>


                    <!-- Edit Distribution Modal -->
                    <div class="modal fade" id="editDistributionModal<?= $distribute['Transfer_ID']; ?>" tabindex="-1" aria-labelledby="editDistributionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editDistributionModalLabel">Edit Distribution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="classes/edit_distribution.php?transfer_id=<?= $distribute['Transfer_ID']; ?>" method="POST" id="editDistributionForm">
                                        <div class="mb-3">
                                            <label for="addDistItemId<?= $distribute['Transfer_ID']; ?>" class="form-label">Item ID</label>
                                            <input type="number" class="form-control" name="item_id" id="editDistItemIdModal<?= $distribute['Transfer_ID']; ?>" value="<?= $distribute['Item_ID']; ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistName<?= $distribute['Transfer_ID']; ?>" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" name="item_name" id="editDistNameModal<?= $distribute['Transfer_ID']; ?>" autocomplete="off" placeholder="Enter Item Name" value="<?= $distribute['Item_Name']; ?>" required>
                                            <ul id="itemNameSuggestionsEditModal<?= $distribute['Transfer_ID']; ?>" class="list-group" style="position: absolute; width: 100%; display: none; max-height: 150px; overflow-y: auto;">
                                                <!-- Suggestions will be populated here dynamically -->
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistCategory<?= $distribute['Transfer_ID']; ?>" class="form-label">Category</label>
                                            <input type="text" class="form-control" name="category" id="editDistCategoryModal<?= $distribute['Transfer_ID']; ?>" value="<?= $distribute['Category_Name']; ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistFrom" class="form-label">From</label>
                                            <select class="form-select" name="transfer_from" id="editDistFrom"  required>
                                                <option value="<?= htmlspecialchars($distribute['Transfer_From']); ?>"><?= htmlspecialchars($distribute['Transfer_From']); ?></option>
                                                <option value="Main Branch">Main Branch</option>
                                                <option value="Branch 1">Branch 1</option>
                                                <option value="Branch 2">Branch 2</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistTo" class="form-label">To</label>
                                            <select class="form-select" name="transfer_to" id="editDistTo"  required>
                                                <option value="<?= htmlspecialchars($distribute['Transfer_To']); ?>"><?= htmlspecialchars($distribute['Transfer_To']); ?></option>
                                                <option value="Main Branch">Main Branch</option>
                                                <option value="Branch 1">Branch 1</option>
                                                <option value="Branch 2">Branch 2</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistDate" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="editDistDate" value=<?= htmlspecialchars($distribute['Deliver_Date']); ?> name="deliver_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistQuantity" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="editDistQuantity" value=<?= htmlspecialchars($distribute['Quantity']); ?> name="quantity" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editDistPrice" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="editDistStatus" required>
                                                <option value="<?= htmlspecialchars($distribute['Status']); ?>"><?= htmlspecialchars($distribute['Status']); ?></option>
                                                <option value="Pending">Pending</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </div>
                                            
                                        <button type="submit" name="editdistribution" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delete Distribution Modal -->
                    <div class="modal fade" id="deleteDistributionModal<?= $distribute['Transfer_ID']; ?>" tabindex="-1" aria-labelledby="deleteDistributionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteDistributionModalLabel">Delete Distribution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="classes/delete_distribution.php?transfer_id=<?= $distribute['Transfer_ID']; ?>" method="POST">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this distribution record?</p>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="deletedistribution" class="btn btn-danger">Delete</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'Admin'): ?>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn" style="background-color: #bf1c2c; color: white;" data-bs-toggle="modal" data-bs-target="#addDistributionModal<?= $distribute['Transfer_ID']; ?>">
                            <i class="fas fa-plus me-1"></i> Add New Distribution
                        </button>
                    </div>
                    <?php endif; ?>

                    <!-- Add New Distribution Modal -->
                    <div class="modal fade" id="addDistributionModal<?= $distribute['Transfer_ID']; ?>" tabindex="-1" aria-labelledby="addDistributionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addDistributionModalLabel">Add New Distribution</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="classes/add_distribution.php" method="POST" id="addDistributionForm">
                                        <div class="mb-3">
                                            <label for="addDistItemId<?= $distribute['Transfer_ID']; ?>" class="form-label">Item ID</label>
                                            <input type="number" class="form-control" name="item_id" id="addDistItemIdModal<?= $distribute['Transfer_ID']; ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistName<?= $distribute['Transfer_ID']; ?>" class="form-label">Item Name</label>
                                            <input type="text" class="form-control" name="item_name" id="addDistNameModal<?= $distribute['Transfer_ID']; ?>" autocomplete="off" placeholder="Enter Item Name" required>
                                            <ul id="itemNameSuggestionsModal<?= $distribute['Transfer_ID']; ?>" class="list-group" style="position: absolute; width: 100%; display: none; max-height: 150px; overflow-y: auto;">
                                                <!-- Suggestions will be populated here dynamically -->
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistCategory<?= $distribute['Transfer_ID']; ?>" class="form-label">Category</label>
                                            <input type="text" class="form-control" name="category" id="addDistCategoryModal<?= $distribute['Transfer_ID']; ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistQuantity" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" name="quantity" id="addDistQuantity" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistFrom" class="form-label">From</label>
                                            <select class="form-select" id="addDistFrom" name="transfer_from" required>
                                                <option value="Main Branch">Main Branch</option>
                                                <option value="Branch 1">Branch 1</option>
                                                <option value="Branch 2">Branch 2</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addDistTo" class="form-label">To</label>
                                            <select class="form-select" id="addDistTo" name="transfer_to" required>
                                                <option value="Main Branch">Main Branch</option>
                                                <option value="Branch 1">Branch 1</option>
                                                <option value="Branch 2">Branch 2</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="adddistribution" class="btn" style="background-color: #bf1c2c; color: white;">Add Distribution</button>
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
                </div>

                <script src="assets/js/DistributionHistory.js"></script>
<script>
// Debounce function to limit API calls
function debounce(func, delay) {
    let timer;
    return function (...args) {
        clearTimeout(timer);
        timer = setTimeout(() => func.apply(this, args), delay);
    };
}

// Function to handle item search and suggestions
function attachItemSearchListener(inputSelector, nameInputId, itemIdInputId, categoryInputId, suggestionsListId) {
    document.querySelectorAll(inputSelector).forEach(input => {
        input.addEventListener('input', debounce(function () {
            const modalId = this.id.replace(inputSelector.replace('[id^="', '').replace('"]', ''), '');
            const query = this.value.trim();
            const suggestionsList = document.getElementById(suggestionsListId + modalId);

            // Hide suggestions if the input is less than 3 characters
            if (query.length < 3) {
                suggestionsList.style.display = 'none';
                return;
            }

            // Fetch matching items
            fetch(`./classes/search_item.php?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsList.innerHTML = ''; // Clear previous suggestions
                    if (data.length > 0) {
                        suggestionsList.style.display = 'block';
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item', 'list-group-item-action');
                            li.textContent = `${item.Item_Name} (${item.Category_Name || 'No Category'})`; // Display both name and category
                            li.setAttribute('data-item-id', item.Item_ID);
                            li.setAttribute('data-category-name', item.Category_Name || 'No Category');
                            li.addEventListener('click', function () {
                                // Populate fields on selection
                                const nameInput = document.getElementById(nameInputId + modalId);
                                const itemIdInput = document.getElementById(itemIdInputId + modalId);
                                const categoryInput = document.getElementById(categoryInputId + modalId);
                                
                                if (nameInput) nameInput.value = item.Item_Name;
                                if (itemIdInput) itemIdInput.value = item.Item_ID;
                                if (categoryInput) categoryInput.value = item.Category_Name || 'No Category';
                                
                                suggestionsList.style.display = 'none';
                            });
                            suggestionsList.appendChild(li);
                        });
                    } else {
                        suggestionsList.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching items:', error));
        }, 300)); // Debounce delay of 300ms
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // Attach listener for Add Distribution Modal
    attachItemSearchListener(
        '[id^="addDistNameModal"]',     // Input selector
        'addDistNameModal',             // Name input ID prefix
        'addDistItemIdModal',           // Item ID input ID prefix
        'addDistCategoryModal',         // Category input ID prefix
        'itemNameSuggestionsModal'      // Suggestions list ID prefix
    );

    // Attach listener for Edit Distribution Modal
    attachItemSearchListener(
        '[id^="editDistNameModal"]',    // Input selector
        'editDistNameModal',            // Name input ID prefix
        'editDistItemIdModal',          // Item ID input ID prefix
        'editDistCategoryModal',        // Category input ID prefix
        'itemNameSuggestionsEditModal'  // Suggestions list ID prefix
    );
});
</script>
