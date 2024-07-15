<?php
include 'data.php'; 

$registrationSuccessful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $mobileNumber = mysqli_real_escape_string($conn, $_POST['mobileNumber']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL insert statement
    $sql = "INSERT INTO users (firstName, lastName, mobileNumber, username, dob, email, password, seeword)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $firstName, $lastName, $mobileNumber, $username, $dob, $email, $hashedPassword, $password);


    if ($stmt->execute()) {
        $registrationSuccessful = true;
        header("Location: success.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
  <link rel="stylesheet" href="styles/signup.css">
  <style>
    .input-container {
      position: relative;
    }
    .error-message {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      display: none;
      color: red;
    }
    .error-icon {
      margin-right: 5px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="top"></div>
  <div class="bottom"></div>
  <div class="center active">
    <h2>New User Registration</h2>
    <form id="registrationForm" method="POST" action="signup.php">
      <div class="input-container">
        <input type="text" name="firstName" id="firstName" placeholder="First Name">
        <div class="error-message" id="firstNameError"><span class="error-icon">⚠</span>Must be at least 3 letters</div>
      </div>
      <div class="input-container">
        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
        <div class="error-message" id="lastNameError"><span class="error-icon">⚠</span>Must be at least 3 letters</div>
      </div>
      <div class="input-container">
        <input type="text" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number">
        <div class="error-message" id="mobileNumberError"><span class="error-icon">⚠</span>Must be 10 digits</div>
      </div>
      <div class="input-container">
        <input type="text" name="username" id="username" placeholder="Username">
        <div class="error-message" id="usernameError"><span class="error-icon">⚠</span>Must be at least 4 letters</div>
      </div>
      <div class="input-container">
        <input type="date" name="dob" id="dob" placeholder="Date of Birth">
        <div class="error-message" id="dobError"><span class="error-icon">⚠</span>Must be at least 13 years old</div>
      </div>
      <div class="input-container">
        <input type="email" name="email" id="email" placeholder="Email">
        <div class="error-message" id="emailError"><span class="error-icon">⚠</span>Must be a valid @gmail.com address</div>
      </div>
      <div class="input-container">
        <input type="password" name="password" id="password" placeholder="Password">
        <div class="error-message" id="passwordError"><span class="error-icon">⚠</span>Must have 1 capital letter, 4 letters, 1 special character, and 1 number</div>
      </div>
      <div class="input-container">
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Re-enter Password">
        <div class="error-message" id="confirmPasswordError"><span class="error-icon">⚠</span>Passwords do not match</div>
      </div>
      <button type="submit">Register</button>
      <p class="terms">By clicking Register, you agree to our <a href="#">Terms & Conditions</a>.</p>
      <div class="login-link">
        <p>Already have an account? <a href="login.php"><b>Login here</b></a>.</p>
      </div>
    </form>
  </div>
  <img src="images/Logo.png" alt="Logo" class="logo">
</div>

<!-- Modal -->
<div id="successModal" class="modal">
  <div class="modal-content">
    <span class="close-button" id="closeModal">&times;</span>
    <h2>Welcome to our community!</h2>
    <p>Thanks for joining us. Let's start a smooth journey by clicking the login button below.</p>
    <button id="loginButton">Login</button>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("successModal");
    const closeModal = document.getElementById("closeModal");
    const loginButton = document.getElementById("loginButton");
    const registrationSuccessful = '<?php echo $registrationSuccessful ? 'true' : 'false'; ?>';

    if (registrationSuccessful === 'true') {
      modal.style.display = "block";
    }

    closeModal.onclick = function() {
      modal.style.display = "none";
    }

    loginButton.onclick = function() {
      window.location.href = "login.php";
    }

    window.onclick = function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    }

    // Form validation
    const form = document.getElementById("registrationForm");
    form.addEventListener("submit", function(event) {
      let valid = true;

      // Validate first name
      const firstName = document.getElementById("firstName").value;
      if (firstName.length < 3) {
        document.getElementById("firstNameError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("firstNameError").style.display = "none";
      }

      // Validate last name
      const lastName = document.getElementById("lastName").value;
      if (lastName.length < 3) {
        document.getElementById("lastNameError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("lastNameError").style.display = "none";
      }

      // Validate mobile number
      const mobileNumber = document.getElementById("mobileNumber").value;
      if (!/^\d{10}$/.test(mobileNumber)) {
        document.getElementById("mobileNumberError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("mobileNumberError").style.display = "none";
      }

      // Validate username
      const username = document.getElementById("username").value;
      if (username.length < 4) {
        document.getElementById("usernameError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("usernameError").style.display = "none";
      }

      // Validate date of birth
      const dob = new Date(document.getElementById("dob").value);
      const today = new Date();
      const age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
      }
      if (age < 13) {
        document.getElementById("dobError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("dobError").style.display = "none";
      }

      // Validate email
      const email = document.getElementById("email").value;
      if (!/^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(email)) {
        document.getElementById("emailError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("emailError").style.display = "none";
      }

      // Validate password
      const password = document.getElementById("password").value;
      const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{7,}$/;
      if (!passwordRegex.test(password)) {
        document.getElementById("passwordError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("passwordError").style.display = "none";
      }

      // Validate confirm password
      const confirmPassword = document.getElementById("confirmPassword").value;
      if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").style.display = "block";
        valid = false;
      } else {
        document.getElementById("confirmPasswordError").style.display = "none";
      }

      if (!valid) {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    });
  });
</script>
</body>
</html>
