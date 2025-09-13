<div class="row">

    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h2>Settings</h2>
                <small class="text-muted">Manage your account security, including password and email.</small>
            </div>
        </div>
    </div>

    <!-- Change Password Form -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>
                <form action="classes/settings.php" method="POST" id="change-password-form">
                    <!-- Hidden input for user_id -->
                    <input type="hidden" name="user_id" value="<?= $_SESSION['User_ID']; ?>">
                    
                    <div class="mb-3">
                        <label for="current-password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current-password" name="entered_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new-password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new-password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                    </div>
                    <button type="submit" name="updatepassword" class="btn w-100" style="background-color: #bf1c2c; color: white;">
    Update Password
</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Change Email Form -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Change Email</h5>
                <form action="classes/settings.php" method="POST" id="change-email-form">

                    <!-- Hidden input for user_id -->
                    <input type="hidden" name="user_id" value="<?= $_SESSION['User_ID']; ?>">

                    <div class="mb-3">
                        <label for="current-email" class="form-label">Current Email</label>
                        <input type="email" class="form-control" id="current-email" name="current_email"  required>
                    </div>
                    <div class="mb-3">
                        <label for="new-email" class="form-label">New Email</label>
                        <input type="email" class="form-control" id="new-email" name="new_email" required>
                    </div>
                    <button type="submit" name="updateemail" class="btn w-100" style="background-color: #bf1c2c; color: white;">
    Update Email
</button>

                </form>
            </div>
        </div>
    </div>
</div>
