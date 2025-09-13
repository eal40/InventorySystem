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
  <style>
    /* Floating button styles */
    .floating-info-btn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #0d6efd;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 24px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      z-index: 1000;
      transition: all 0.3s ease;
    }
    
    .floating-info-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }
    
    /* Info card styles */
    .info-card {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 300px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      padding: 20px;
      z-index: 999;
      display: none;
    }
    
    .info-card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .info-card-title {
      font-weight: bold;
      margin: 0;
    }
    
    .info-card-close {
      cursor: pointer;
      font-size: 20px;
    }
    
    .info-card-body {
      margin-bottom: 15px;
    }
    
    .info-card-footer {
      display: flex;
      align-items: center;
    }
    
    .dont-show-again {
      margin-left: 8px;
    }
  </style>
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
  
  <!-- Floating Info Button -->
  <div class="floating-info-btn" id="infoButton">i</div>
  
  <!-- Info Card -->
  <div class="info-card" id="infoCard">
    <div class="info-card-header">
      <h5 class="info-card-title">Test Credentials</h5>
      <span class="info-card-close" id="closeInfoCard">&times;</span>
    </div>
    <div class="info-card-body">
      <p><strong>Username:</strong> test</p>
      <p><strong>Password:</strong> test</p>
      <p class="text-muted">This is only a sample site for demonstration purposes.</p>
    </div>
    <div class="info-card-footer">
      <input type="checkbox" id="dontShowAgain" class="form-check-input">
      <label for="dontShowAgain" class="form-check-label dont-show-again">Don't show again</label>
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
  
  <!-- Info Card JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const infoButton = document.getElementById('infoButton');
      const infoCard = document.getElementById('infoCard');
      const closeInfoCard = document.getElementById('closeInfoCard');
      const dontShowAgain = document.getElementById('dontShowAgain');
      
      // Check if user has chosen not to show the popup again
      const shouldShowPopup = localStorage.getItem('dontShowInfoCard') !== 'true';
      
      // Function to toggle info card visibility
      function toggleInfoCard() {
        if (infoCard.style.display === 'block') {
          infoCard.style.display = 'none';
        } else {
          infoCard.style.display = 'block';
        }
      }
      
      // Function to close info card
      function closeCard() {
        infoCard.style.display = 'none';
        
        // If checkbox is checked, save preference to localStorage
        if (dontShowAgain.checked) {
          localStorage.setItem('dontShowInfoCard', 'true');
        }
      }
      
      // Show popup on page load if user hasn't chosen to hide it
      if (shouldShowPopup) {
        setTimeout(function() {
          infoCard.style.display = 'block';
        }, 1000); // Show after 1 second
      }
      
      // Event listeners
      infoButton.addEventListener('click', toggleInfoCard);
      closeInfoCard.addEventListener('click', closeCard);
    });
  </script>
</body>
</html>
