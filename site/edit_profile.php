<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'data.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "User ID not set.";
    exit();
}

// Fetch user data
$sql = "SELECT name, m_num, gmail, dob, gender, profile_photo, folder_path FROM new_user WHERE user_id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $m_num = $row["m_num"];
    $gmail = $row["gmail"];
    $dob = $row["dob"];
    $gender = $row["gender"];
    $profile_photo = $row["profile_photo"];
    $folder_path = $row["folder_path"];
} else {
    echo "No results found.";
    exit();
}

// Update user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $m_num = $_POST['m_num'];
    $gmail = $_POST['gmail'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    if (!empty($_FILES['profile_photo']['name'])) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $profile_photo = $upload_dir . basename($_FILES['profile_photo']['name']);
        
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $profile_photo)) {
            $folder_path = $upload_dir;
        } else {
            echo "Error uploading file.";
            exit();
        }
    }

    $sql = "UPDATE new_user SET name='$name', m_num='$m_num', gmail='$gmail', dob='$dob', gender='$gender', profile_photo='$profile_photo', folder_path='$folder_path' WHERE user_id='$user_id'";
    
    if ($conn->query($sql) === TRUE) {
        $update_success = true;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Mad_Cat">
    <link rel="shortcut icon" href="image/logo.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Edit Profile</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");
        :root {
            --primary-color: #3b5d50;
            --primary-color-dark: #2c4a3e;
            --secondary-color: #ca8a04;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --max-width: 800px;
            --background-color: #f9fafb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .parent-container {
            display: grid;
            place-items: center;
        }

        .container_e {
            max-width: var(--max-width);
            background-color: #ffffff;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 0rem auto; 
        }


        h2 {
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select,
        input[type="file"] {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 1rem;
            color: var(--text-dark);
        }

        .profile-photo {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .profile-photo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 1rem;
        }

        button {
            background-color: var(--primary-color);
            color: #fff;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--primary-color-dark);
        }

        .link {
            margin-top: 1rem;
            text-align: center;
        }

        .link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .link a:hover {
            text-decoration: underline;
        }

        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 160px; 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 599px;
        }

        #model_p{
            margin-top: 29px;
            margin-bottom: 4rem;
            font-size: 24px;
            margin-inline: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <!-- Start Header/Navigation -->
    <?php include 'header.php'; ?>
    <!-- End Header/Navigation -->

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <?php 
                        mysqli_data_seek($result, 0); 
                        while($row = $result->fetch_assoc()): 
                        ?>
                        <h1>Edit <?php echo $row['name']; ?>'s Profile</h1>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="col-lg-7">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

     <!-- Main Content Section -->
     <div class="kareem_co-section">          
        <div class="row">    
          <section class="section">
            <div class="section__container">
                <div class="container_e">
                    <h2>Edit Profile</h2>
                    <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                        <div class="profile-photo">
                            <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
                            <label for="profile_photo">Change Photo:</label>
                            <input type="file" id="profile_photo" name="profile_photo">
                        </div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

                        <label for="m_num">Mobile Number:</label>
                        <input type="text" id="m_num" name="m_num" value="<?php echo $m_num; ?>" required>

                        <label for="gmail">Email:</label>
                        <input type="email" id="gmail" name="gmail" value="<?php echo $gmail; ?>" readonly>

                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required>

                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" required>
                            <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Female</option>
                            <option value="other" <?php if ($gender == 'other') echo 'selected'; ?>>Other</option>
                        </select> <br><br>

                        <button type="submit">Update Profile</button>
                    </form>

                </div>
            </div>
        </section>
      </div>  
    </div>
    <!-- End Main Content Section -->

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="model_p">Profile updated successfully!</p>
            <button id="closeButton">Close</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($update_success) && $update_success): ?>
                var modal = document.getElementById("myModal");
                var span = document.getElementsByClassName("close")[0];
                var closeButton = document.getElementById("closeButton");

                modal.style.display = "block";

                span.onclick = function() {
                    window.location.href = 'my_profile.php';
                }

                closeButton.onclick = function() {
                    window.location.href = 'my_profile.php';
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        window.location.href = 'my_profile.php';
                    }
                }
            <?php endif; ?>
        });
    </script>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
