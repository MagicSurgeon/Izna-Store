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
  <title>Thank for shoping</title>
  <style>
    /* Your CSS styles here */
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: cursive;
    }

    body {
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        min-width: 100vh;
        width: 100%;
    }

    /* Ring Animation */
    .ring {
        position: relative;
        margin-top: -124px;
        margin-left: 450px;
        margin-bottom: 162px;
        width: 450px;
        height: 450px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .ring i {
        position: absolute;
        inset: 0;
        border: 2px solid white;
        transition: 0.5s;
    }

    .ring i:nth-child(1) {
        border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
        animation: animate 6s linear infinite;
    }

    .ring i:nth-child(2) {
        border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
        animation: animate 4s linear infinite;
    }

    .ring i:nth-child(3) {
        border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
        animation: animate2 10s linear infinite;
    }

    .ring:hover i {
        border: 6px solid var(--clr);
        filter: drop-shadow(0 0 20px var(--clr));
    }

    @keyframes animate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes animate2 {
        0% {
            transform: rotate(360deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }

    /* Login Form */
    .login {
        position: absolute;
        width: 250px;
        height: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
        margin-top: 100px;
    }

    .login h2 {
        font-size: 2em;
        color: #3b5d50;
        text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;
    }

    .login .inputBx {
        position: relative;
        width: 100%;
    }

    .login .inputBx input,
    .login .inputBx select {
        position: relative;
        width: 100%;
        padding: 12px 20px;
        background: transparent;
        border: 2px solid #3b5d50;
        border-radius: 40px;
        font-size: 1.2em;
        box-shadow: none;
        outline: none;
    }

    .login .inputBx input::placeholder,
    .login .inputBx select option {
        color: #3b5d50;
    }

    .login .inputBx select {
        color: #3b5d50;
    }

    .login .inputBx input[type="submit"] {
        width: 100%;
        background: linear-gradient(45deg, #ff357a, #fff172);
        border: none;
        cursor: pointer;
        color: #fff;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .login .inputBx input[type="submit"]:hover {
        color: #fff;
        transform: scale(1.1);
    }

    .login .links {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
    }

    .login .links a {
        color: #3b5d50;
        text-decoration: none;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .login .links a:hover {
        color: #3b5d50;
        transform: scale(1.1);
    }

    /* Warning Popup */
    .warning-popup {
        position: absolute;
        background-color: #ffcccc;
        padding: 0.5px;
        border: 1.5px solid yellow;
        border-radius: 9px;
        font-size: 12px;
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
                                <select id="gender" name="gender">
                                    <option value="" disabled selected>Gender</option>
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                    <option value="other">Other</option>
                                    <option value="prefer_not_to_say">Prefer not to say</option>
                                </select>
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
