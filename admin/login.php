<?php
session_start();
include 'data.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $emailOrMobileOrUsername = mysqli_real_escape_string($conn, $_POST['emailOrMobileOrUsername']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM users WHERE email = ? OR mobileNumber = ? OR username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $emailOrMobileOrUsername, $emailOrMobileOrUsername, $emailOrMobileOrUsername);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];

      $response = array('success' => true);
    } else {
      $response = array('success' => false, 'message' => 'Invalid password.');
    }
  } else {
    $response = array('success' => false, 'message' => 'User not found. Please check your credentials.');
  }

  $stmt->close();
  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($response);
  exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="styles/login.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      function loginUser() {
        const emailOrMobileOrUsername = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        if (emailOrMobileOrUsername.trim() === '' || password.trim() === '') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter both email/mobile/username and password!',
          });
          return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'login.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
          if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                showConfirmButton: true,
                confirmButtonText: 'Let\'s Go',
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'dashboard.php';
                }
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.message,
              });
            }
          } else {
            console.error('Error: ' + xhr.status);
          }
        };
        const params = `emailOrMobileOrUsername=${emailOrMobileOrUsername}&password=${password}`;
        xhr.send(params);
      }

      document.getElementById('email').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          loginUser();
        }
      });

      document.getElementById('password').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          loginUser();
        }
      });
    });
  </script>
</head>
<body>

<div class="container">
  <div class="top"></div>
  <div class="bottom"></div>
  <div class="center">
    <h2>Please Sign In</h2>
    <input type="email" id="email" placeholder="Email">
    <input type="password" id="password" placeholder="Password">
    <div class="signup-link">
      <p>Don't have an account? <a href="signup.php"><b>Sign up here</b></a>.</p>
    </div>    
  </div>
  <img src="images/Logo.png" alt="Logo" class="logo">
</div>

</body>
</html>
