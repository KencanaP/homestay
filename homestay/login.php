<?php
include('db.php');

// Handle success and error messages
$success_message = "";
$error_message = "";

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 'registration_successful':
      $success_message = "Registration successful! Your ID is: " . (isset($_GET['id']) ? $_GET['id'] : 'N/A');
      break;
  }
}

if (isset($_GET['error'])) {
  switch ($_GET['error']) {
    case 'invalid_id':
      $error_message = "Invalid ID format. ID must start with G, O, or S.";
      break;
    case 'wrong_password':
      $error_message = "Wrong password. Please try again.";
      break;
    case 'user_not_found':
      $error_message = "User not found. Please check your ID.";
      break;
    case 'empty_fields':
      $error_message = "Please fill in all required fields.";
      break;
    case 'password_mismatch':
      $error_message = "Passwords do not match.";
      break;
    case 'email_exists':
      $error_message = "Email already exists. Please use a different email.";
      break;
    case 'phone_exists':
      $error_message = "Phone number already exists. Please use a different phone number.";
      break;
    case 'invalid_email':
      $error_message = "Please enter a valid email address.";
      break;
    case 'invalid_age':
      $error_message = "Please enter a valid age (1-99).";
      break;
    case 'invalid_phone':
      $error_message = "Please enter a valid phone number.";
      break;
    case 'password_too_short':
      $error_message = "Password must be at least 6 characters long.";
      break;
    case 'registration_failed':
      $error_message = "Registration failed. Please try again.";
      break;
    case 'database_error':
      $error_message = "Database error. Please try again later.";
      break;
    case 'invalid_request':
      $error_message = "Invalid request.";
      break;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>" />
  <link
    href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
    rel="stylesheet" />

</head>

<body>
  <!-- Option 1: Top-right corner (current active) -->
  <?php if (!empty($error_message) || !empty($success_message)): ?>
    <div class="message-container">
      <?php if (!empty($error_message)): ?>
        <div class="error-message">
          <?php echo htmlspecialchars($error_message); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success_message)): ?>
        <div class="success-message">
          <?php echo htmlspecialchars($success_message); ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="hero">
    <div class="form-box">
      <!-- Option 2: Above the form (uncomment to use) -->
      <!--
      <?php if (!empty($error_message) || !empty($success_message)): ?>
        <div class="message-above-form">
          <?php if (!empty($error_message)): ?>
            <div class="error-message">
              <?php echo htmlspecialchars($error_message); ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($success_message)): ?>
            <div class="success-message">
              <?php echo htmlspecialchars($success_message); ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      -->

      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="login()">
          LOGIN
        </button>
        <button type="button" class="toggle-btn" onclick="register()">
          REGISTER
        </button>
      </div>

      <!-- Login Form - points to php/login_logic.php -->
      <form action="php/login_logic.php" method="post" id="login" class="input-group">
        <input
          type="text"
          class="input-field"
          name="userID"
          placeholder="UserID (G12345, O12345, S12345)"
          required />
        <input
          type="password"
          class="input-field"
          name="password"
          placeholder="Password"
          required />
        <button type="submit" class="submit-btn">Log In</button>
      </form>

      <!-- Register Form - points to php/register_logic.php -->
      <form action="php/register_logic.php" method="post" id="register" class="input-group">
        <input
          type="text"
          name="reg-name"
          class="input-field"
          placeholder="Enter your name"
          required />
        <input
          type="text"
          name="reg-phone"
          class="input-field"
          placeholder="Enter your phone number"
          required />
        <input
          type="email"
          name="reg-email"
          class="input-field"
          placeholder="Enter your email"
          required />
        <input
          type="number"
          name="reg-age"
          class="input-field"
          placeholder="Enter your age"
          min="1"
          max="99"
          required />
        <input
          type="password"
          name="reg-password"
          class="input-field"
          placeholder="Enter your password (min 6 chars)"
          minlength="6"
          required />
        <input
          type="password"
          name="reg-confirm"
          class="input-field"
          placeholder="Confirm your password"
          required />
        <button type="submit" class="submit-btn">Register</button>
      </form>
    </div>
  </div>

  <!-- Option 3: Bottom center (uncomment to use) -->
  <!--
  <?php if (!empty($error_message) || !empty($success_message)): ?>
    <div class="message-bottom">
      <?php if (!empty($error_message)): ?>
        <div class="error-message">
          <?php echo htmlspecialchars($error_message); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success_message)): ?>
        <div class="success-message">
          <?php echo htmlspecialchars($success_message); ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  -->

  <script>
    var log = document.getElementById("login");
    var reg = document.getElementById("register");
    var button = document.getElementById("btn");

    function register() {
      log.style.left = "-400px";
      reg.style.left = "50px";
      button.style.left = "110px";
    }

    function login() {
      log.style.left = "50px";
      reg.style.left = "450px";
      button.style.left = "0";
    }

    // Client-side password confirmation validation
    document.getElementById('register').addEventListener('submit', function(e) {
      var password = document.querySelector('input[name="reg-password"]').value;
      var confirm = document.querySelector('input[name="reg-confirm"]').value;

      if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match!');
      }
    });

    // Auto-hide messages after 5 seconds
    setTimeout(function() {
      const messages = document.querySelectorAll('.error-message, .success-message');
      messages.forEach(function(message) {
        message.style.animation = 'slideOut 0.3s ease-in forwards';
      });
    }, 5000);
  </script>


</body>

</html>