<?php
// Include your database connection file here
include 'data.php';
// Check if the signup form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $m_num = $_POST['m_num'];
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];
    $seeword = $_POST['password']; //this is for check
    // You may want to perform further sanitization and validation here
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the new_user table
    $sql = "INSERT INTO new_user (name, m_num, gmail, password, seeword) VALUES ('$name', '$m_num', '$gmail', '$hashed_password', '$password')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to login page after successful signup
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
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
        font-size: 12px;
    }
    .login{
        margin-top: 100px;
    }
    .ring {
    position: relative;
    margin-top: -160px;
    margin-left: 450px;
    margin-bottom: 119px;
    width: 450px;
    height: 450px;
    display: flex;
    justify-content: center;
    align-items: center;
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
                        <i style="--clr:#00ff0a; width: 650px; height: 650px; left: -100px; top: -0px;" ></i>
                        <i style="--clr:#fffd44;  width: 650px; height: 650px; left: -100px; top: -0px;"></i>
                        <i style="--clr:#ff0057;  width: 650px; height: 650px; left: -100px; top: -0px;"></i>
                        <form class="login" id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                            <h2 style="margin-top: 120px;">Sign Up</h2>
                            <div class="inputBx">
                                <input type="text" id="name" name="name" placeholder="Your Name">
                            </div>
                            <div class="inputBx">
                                <input type="text" id="m_num" name="m_num" placeholder="Mobile Number">
                            </div>
                            <div class="inputBx">
                                <input type="text" id="gmail" name="gmail" placeholder="Gmail">
                            </div>
                            <div class="inputBx">
                                <input type="password" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="inputBx">
                                <input type="password" id="c_password" name="c_password" placeholder="Confirm your Password">
                            </div>
                            <div class="inputBx">
                                <input type="submit" value="Sign Up">
                            </div>
                            <div class="links">
                                <!-- <a href="forgot_password.php">Forget Password..?</a> -->
                                <a href="login.php">&nbsp;&nbsp;&nbsp;&nbsp; Have an account? Login..!</a>
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
            function validateForm() {
                var name = document.getElementById("name").value.trim();
                var m_num = document.getElementById("m_num").value.trim();
                var gmail = document.getElementById("gmail").value.trim();
                var password = document.getElementById("password").value.trim();
                var c_password = document.getElementById("c_password").value.trim();

                // Form validation
                if (name.length < 4) {
                    showPopup("Name should be at least 4 characters long.", "name");
                    return false;
                }
                if (m_num.length !== 10 || isNaN(m_num)) {
                    showPopup("Mobile number should be exactly 10 digits long and numeric.", "m_num");
                    return false;
                }
                if (!gmail.match(/^[a-zA-Z0-9._%+-]+@(?:email|gmail)\.com$/)) {
                    showPopup("Please enter a valid Gmail address.", "gmail");
                    return false;
                }
                if (!password.match(/^(?=.*[A-Z])(?=.*[a-z].*[a-z])(?=.*\d.*\d)(?=.*[!@#$%^&*]).{8,}$/)) {
                    showPopup("Please enter a valid password. It must contain at least 8 characters like Izna@03.", "password");
                    return false;
                }
                if (password !== c_password) {
                    showPopup("Passwords do not match.", "c_password");
                    return false;
                }

                // If all validations pass, return true to submit the form
                return true;
            }

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
