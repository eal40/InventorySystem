<!-- Categories -->
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

        <?php if (isset($_SESSION['Role']) && ($_SESSION['Role'] === 'Admin' || $_SESSION['Role'] === 'Manager')): ?>
            <div class="col-md-6 text-end">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal" style="background-color: #bf1c2c; color: white;">
    <i class="fas fa-plus me-1"></i> Add New Category
</button>
                     
            </div>
        <?php endif; ?>

    </div>

    <!-- Categories Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Category ID</th>
                    <th>Category Type</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch categories from the database
                    $categories = categoryView();

                    foreach ($categories as $category) {
                ?>
                <tr>
                    <td><?= htmlspecialchars($category['Category_ID']); ?></td>
                    <td><?= htmlspecialchars($category['Category_Type']); ?></td>
                    <td><?= htmlspecialchars($category['Category_Name']); ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateCategoryModal<?= $category['Category_ID']; ?>">
                        <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="<?= $category['Category_ID']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>


                    <!-- Edit Modal -->
    <div class="modal fade" id="updateCategoryModal<?= $category['Category_ID']; ?>" tabindex="-1" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryModalLabel">Update Category - <?= $category['Category_ID']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                            
                <form action="classes/edit_category.php?categoryID=<?= $category['Category_ID']; ?>" method="POST" id="updateCategoryForm">

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="updateCategoryType" class="form-label">Category Type</label>
                                <select class="form-select" id="updateCategoryType" name="categoryType" value="<?= $category['Category_Type']; ?>" >
                                    <option value="" disabled>Select a category type</option>
                                    <option value="Motor Parts">Motor Parts</option>
                                    <option value="Accessories">Accessories</option>
                                    <option value="Consumables">Consumables</option>
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="updateCategoryName" class="form-label">Category Name</label>
                            <select class="form-select" id="updateCategoryName" name="categoryName" value="<?= $category['Category_Name']; ?>">
                            <?php
                                $categories = fetchCategory();
                                foreach ($categories as $category) {
                                    echo '<option value="' . htmlspecialchars($category['Category_Name']) . '">' 
                                        . htmlspecialchars($category['Category_Name']) . '</option>';
                                }
                            ?>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updatecategory" class="btn btn-primary">Update Category</button>
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

                <form action="classes/delete_category.php" method="POST" id="deleteCategoryForm">
                    <div class="modal-body">
                        <input type="hidden" name="categoryID" id="categoryID">
                        <p>Are you sure you want to delete this category <?= $category['Category_Name']; ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="deletecategory" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


                <?php } ?>
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

                <form action="classes/add_category.php" method="POST" id="addCategoryForm">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="categoryType" class="form-label">Category Type</label>
                                <select class="form-select" id="categoryType" name="categoryType" required>
                                    <option value="" disabled selected>Select a category type</option>
                                    <option value="Motor Parts">Motor Parts</option>
                                    <option value="Accessories">Accessories</option>
                                    <option value="Consumables">Consumables</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="e.g., Accessories" name="categoryName" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                    <button type="submit" name="addcategory" class="btn" style="background-color: #bf1c2c; color: white;">
    Add Category
</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            
            </div>
        </div>
    </div>                
    
</div>