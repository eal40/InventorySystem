<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Three M Motors</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- External CSS -->
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

  <div class="login-container">
    <!-- Left: Form Section -->
    <div class="form-section">
        
      <h2>Log In</h2>
      <form action="classes/login.php" method="POST">
      <input type="text" placeholder="Username" class="userInput form-control" name="username" />
      <input type="password" placeholder="Password" class="passInput form-control" name="password" />
        <button type="submit" class="btn btn-primary signIn" name="login">Log In</button>
      </form>
      <div class="text-center mt-3">
        <!-- Forgot Password Link -->
        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password</a>
      </div>
    </div>
    <!-- Right: Logo Section -->
    <div class="logo-section">
      <img src="assets/images/logoAlt.jpg" alt="Three M Motor Logo">
      <h4>Centralized Inventory System</h4>
    </div>
  </div>

  <!-- Forgot Password Modal -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Please enter your email address to reset your password:</p>
          <form>
            <input type="email" class="form-control mb-3" placeholder="Email Address" required>
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
