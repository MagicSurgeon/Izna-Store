<?php
session_start();
include 'data.php';

// Check if the login form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered email and password from the form
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    // Query to fetch user credentials from the database based on the entered email
    $sql = "SELECT * FROM new_user WHERE gmail = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $gmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        // Check if a row is returned
        if (mysqli_num_rows($result) == 1) {
            // Fetch the row
            $row = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Password is correct, redirect to index.php
                $_SESSION['user_id'] = $row['user_id']; // Store user ID in session
                header("Location: index.php");
                exit;
            } else {
                // Password is incorrect
                $_SESSION['error'] = "Incorrect gmail or password. Please try again.";
            }
        } else {
            // Email not found in the database
            $_SESSION['error'] = "Incorrect gmail or password. Please try again.";
        }
    } else {
        // Query failed
        $_SESSION['error'] = "An error occurred. Please try again later.";
    }

    // Redirect back to the login page
    header("Location: login.php");
    exit;
}
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Mad_Cat">
  <link rel="shortcut icon" href="image/logo.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel='stylesheet' href='css/login.css'>
  <title>Thank for shoping</title>
  <style>
    /* Your CSS styles here */
    .warning-popup {
        position: absolute;
        background-color: #ffcccc;
        padding: 0.5px;
        border: 1.5px solid yellow;
        border-radius: 9px;
        font-size: 9px;
    }   
</style>
</head>

	<body>
		<!-- Start Header/Navigation -->
		<?php include 'header.php'; ?>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container" style="height: 1px;">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

        <div class="co-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-5">
                    <div class="ring">
                        <i style="--clr:#00ff0a;"></i>
                        <i style="--clr:#ff0057;"></i>
                        <i style="--clr:#fffd44;"></i>
                        <form class="login" id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <h2>Login</h2>
                            <?php
                                // Display error message if set
                                if (isset($_SESSION['error'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                                    unset($_SESSION['error']); // Clear the error message
                                }
                            ?>
                            <div class="inputBx">
                                <input type="text" id="gmail" name="gmail" placeholder="Enter your Gmail">
                            </div>
                            <div class="inputBx">
                                <input type="password" id="password" name="password" placeholder="Enter your Password">
                            </div>
                            <div class="inputBx">
                                <input type="submit" value="Log in">
                            </div>
                            <div class="links">
                                <a href="forgot_password.php">Forget Password..?</a>
                                <a href="signup.php">Signup..!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	

        <script>
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    // Reset previous warning popups
    var warningPopups = document.querySelectorAll(".warning-popup");
    warningPopups.forEach(function(element) {
        element.remove();
    });

    // Get values of email and password fields
    var email = document.getElementById("gmail").value.trim();
    var password = document.getElementById("password").value.trim();

    // Email validation
    if (!email.match(/^[a-zA-Z0-9._%+-]+@(?:email|gmail)\.com$/)) {
        showPopup("Please enter a valid email address ending with @gmail.com", "gmail");
        return;
    }

    // Password validation
    if (!password.match(/^(?=.*[A-Z])(?=.*[a-z].*[a-z])(?=.*\d.*\d)(?=.*[!@#$%^&*]).{8,}$/)) {
        showPopup("Please enter a valid password. It must contain at least 8 characters like Izna@03.", "password");
        return;
    }

    // If validations pass, submit the form
    this.submit();
});

function showPopup(message, fieldId) {
    var field = document.getElementById(fieldId);
    var rect = field.getBoundingClientRect();
    var left = rect.left + window.pageXOffset;
    var top = rect.bottom + window.pageYOffset;
    
    var popup = document.createElement("div");
    popup.className = "warning-popup";
    popup.innerText = message;
    popup.style.left = left + "px";
    popup.style.top = top + "px";
    
    document.body.appendChild(popup);

    // Add event listener to remove the popup when the user moves the cursor
    document.body.addEventListener("mousemove", function() {
        popup.remove();
    }, { once: true }); // Remove the event listener after it's triggered once
}

</script>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</body>

</html>
