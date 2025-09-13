
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
                    <option value="Main">Main Branch</option>
                    <option value="Branch1">Branch 1</option>
                    <option value="Branch2">Branch 2</option>
                </select>
            </div>

            <script>
                const branchSelector = document.getElementById('branchSelector');
                branchSelector.addEventListener('change', (e) => {
                    const selectedValue = e.target.value;
                    const url = `dashboard.php?section=inventory${selectedValue}`;
                    window.location.href = url;
                });
            </script>

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
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Supplier</th>
                        <th>Stocks</th>
                        <th>Unit Price</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $inventoryview1 = inventoryview0();

                        foreach ($inventoryview1 as $item) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['Item_ID']); ?></td>
                        <td><?php echo htmlspecialchars($item['Category_Name']); ?></td>
                        <td><?php echo htmlspecialchars($item['Item_Name']); ?></td>
                        <td><?php echo htmlspecialchars($item['Brand']); ?></td>
                        <td><?php echo htmlspecialchars($item['Description']); ?></td>
                        <td><?php echo htmlspecialchars($item['Supplier']); ?></td>
                        <td><?php echo htmlspecialchars($item['Quantity']); ?></td>
                        <td><?php echo '₱' . number_format($item['Unit_Price']); ?></td>
                        <td><?php echo htmlspecialchars($item['Updated_At']); ?></td>
                        <td>
                        <?php 
                        $isAdminOrManager = (isset($_SESSION['Role']) && ($_SESSION['Role'] === 'Admin' || $_SESSION['Role'] === 'Manager'));
                        ?>
                        <button class="btn btn-sm btn-primary <?php echo $isAdminOrManager ? '' : 'disabled'; ?>" 
                                data-bs-toggle="modal" 
                                data-bs-target="#edit_<?= $item['Item_ID']; ?>"
                                <?php echo $isAdminOrManager ? '' : 'disabled="disabled"'; ?>>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger <?php echo $isAdminOrManager ? '' : 'disabled'; ?>" 
                                data-bs-toggle="modal" 
                                data-bs-target="#delete_<?= $item['Item_ID']; ?>"
                                <?php echo $isAdminOrManager ? '' : 'disabled="disabled"'; ?>>
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
                            <input type="text" class="form-control" id="editItemName" value="<?= $item['Item_Name']?>" name="itemname" >
                        </div>

                        <div class="mb-3">
                            <label for="editItemBrand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="editItemBrand" value="<?= $item['Brand']?>" name="brand" >
                        </div>

                        <div class="mb-3">
                            <label for="editItemCategory" class="form-label">Category</label>
                            <select id="editItemCategory" class="form-select" name="category" >
                            <?php
                                $categories = fetchCategory();
                                foreach ($categories as $category) {
                                    echo '<option value="' . htmlspecialchars($category['Category_Name']) . '">' 
                                        . htmlspecialchars($category['Category_Name']) . '</option>';
                                }
                            ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editItemDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editItemDescription" name="description"><?= htmlspecialchars($item['Description']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editItemSupplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="editItemSupplier" value="<?= $item['Supplier']?>" name="supplier" >
                        </div>

                        <div class="mb-3">
                            <label for="editItemQuantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="editItemQuantity" value="<?= $item['Quantity']?>" name="quantity" >
                        </div>

                        <div class="mb-3">
                            <label for="editItemPrice" class="form-label">Unit Price</label>
                            <input type="number" step="0.01" class="form-control" id="editItemPrice" value="<?= $item['Unit_Price']?>" name="unitprice" >
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
                    </div>
                </form>
            
            </div>
        </div>


        <?php } ?> 
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
    </div>

    <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'Admin'): ?>    
         <div class="d-flex justify-content-end mt-3">
         <button class="btn" data-bs-toggle="modal" data-bs-target="#addModal" style="background-color: #bf1c2c; color: white;">
        <i class="fas fa-plus me-1"></i> Add New Inventory
        </button>
        </div>
    <?php endif; ?>

    <!-- Add New Inventory Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="classes/add_itemMain.php" method="POST" id="addInventoryForm">
                        <div class="mb-3">
                            <label for="addItemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="addItemName" name="itemname" required>
                        </div>

                        <div class="mb-3">
                            <label for="addItemBrand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="addItemBrand" name="brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="addItemCategory" class="form-label">Category</label>
                                <select id="addItemCategory" class="form-select" name="category" required>
                                    <?php
                                        $categories = fetchCategory();
                                        foreach ($categories as $category) {
                                            echo '<option value="' . htmlspecialchars($category['Category_Name']) . '">' 
                                                . htmlspecialchars($category['Category_Name']) . '</option>';
                                        }
                                    ?>
                                </select>
                        </div>
                        <div class="mb-3">
                            <label for="addItemDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="addItemDescription" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="addItemSupplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="addItemSupplier" name="supplier">
                        </div>           
                        <div class="mb-3">
                            <label for="addItemQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="addItemQuantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="addItemPrice" class="form-label">Unit Price</label>
                            <input type="number" step="0.01" class="form-control" id="addItemPrice" name="unitprice" required>
                        </div>
                        <button type="submit" class="btn" name="additem" style="background-color: #bf1c2c; color: white;">
    Add Item
</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>