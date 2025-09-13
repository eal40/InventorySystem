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
                				<li>
                					<strong>Stock Alert:</strong> The stock of "Motor Oil" has fallen below the threshold. <small class="text-muted">10 minutes ago</small>
                				</li>
                				<li>
                					<strong>New Order:</strong> Order #12345 has been successfully processed. <small class="text-muted">30 minutes ago</small>
                				</li>
                				<li>
                					<strong>Low Stock Warning:</strong> "Air Filters" stock is running low. <small class="text-muted">1 hour ago</small>
                				</li>
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