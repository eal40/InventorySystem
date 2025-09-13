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
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Password</th>
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
                        <td><?php echo htmlspecialchars($user['Password']); ?></td>
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
                                
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#createAccountModal" style="background-color: #bf1c2c; color: white;">
    <i class="fas fa-plus me-1"></i> Create New Account
</button>

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

                    <!-- Status Modal -->
                    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="statusModalLabel">Account Deletion Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id="statusMessage"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
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
                                        <div class="row">
                                            <!-- First Column -->
                                            <div class="col-md-6">
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
                                            </div>

                                            <!-- Second Column -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="newEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="newEmail" name="email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="newPhoneNumber" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" id="newPhoneNumber" name="phone" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="newRole" class="form-label">Role</label>
                                                    <select class="form-select" id="newRole" name="role" required>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Staff">Staff</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Branch" class="form-label">Branch</label>
                                                    <select class="form-select" id="newBranch" name="branch" required>
                                                        <option value="Digos City, Bus Terminal">Digos City, Bus Terminal</option>
                                                        <option value="Digos City, Davao Cotabato Road">Digos City, Davao Cotabato Road</option>
                                                        <option value="Bansalan Davao Del Sur">Bansalan Davao Del Sur</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn" name="register" style="background-color: #bf1c2c; color: white;">
    Create Account
</button>

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Toast Container -->
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="accountCreationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Account Creation</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body" id="toastMessage"></div>
                        </div>
                    </div>

</div>

<script src="assets/js/registration.js"></script>
<script src="assets/js/delete_acc.js"></script>
