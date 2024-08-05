<?php
include 'header.php'; 
session_start();
include 'data.php';

$userId = $_SESSION['user_id']; 
$sql = "SELECT firstName, lastName, mobileNumber, username, dob, email, profile_image FROM users WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    
    $profileImage = $user['profile_image'];
    if (!empty($_FILES['profile_image']['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile);
        $profileImage = $targetFile;
    }

    $sql = "UPDATE users SET firstName = ?, lastName = ?, mobileNumber = ?, username = ?, dob = ?, email = ?, profile_image = ? WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $firstName, $lastName, $mobileNumber, $username, $dob, $email, $profileImage, $userId);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
        header("Location: profile_view.php");
        exit;
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: transparent;
            margin: 0;
            padding: 0;
            color: #3d405b;
        }

        .edit-profile-container {
            max-width: 86%;
            margin: 50px auto;
            padding: 30px;
            background: lightpink;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .edit-profile-container:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        .edit-profile-info {
            flex: 2;
            margin: 33px 0 10px 83px;
        }

        .edit-profile-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 192px 0 0;
        }

        .edit-profile-picture {
            width: 350px;
            height: 350px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #81b29a;
            transition: border-color 0.3s ease;
        }

        .edit-profile-picture:hover {
            border-color: #e07a5f; /* Accent color on hover */
        }

        .edit-profile-header h1 {
            margin: 0;
            font-size: 36px;
            color: #3d405b;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .save-button, .cancel-button {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            border: none;
            color: #ffffff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .save-button {
            background-color: #3d405b; /* Darker color for save button */
        }

        .save-button:hover {
            background-color: #2c3e50;
            transform: translateY(-2px);
        }

        .cancel-button {
            background-color: #e07a5f; /* Accent color for cancel button */
        }

        .cancel-button:hover {
            background-color: #c05644;
            transform: translateY(-2px);
        }

        .edit-profile-details {
            margin-top: 20px;
        }

        .edit-profile-details label {
            display: block;
            margin-bottom: 10px;
            color: #3d405b;
            font-size: 18px;
        }

        .edit-profile-details input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: lavenderblush;;
        }
        .edit-profile-details input::placeholder {
            background-color: lightpink; 
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <form action="edit_profile.php" style="display: inline-flex; gap: 259px;" method="POST" enctype="multipart/form-data">
            <div class="edit-profile-info">
                <div class="edit-profile-header">
                    <h1>Edit Profile</h1>
                </div>
                <div class="edit-profile-details">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($user['firstName']); ?>" required>
                    
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($user['lastName']); ?>" required>
                    
                    <label for="mobileNumber">Mobile Number</label>
                    <input type="text" id="mobileNumber" name="mobileNumber" value="<?php echo htmlspecialchars($user['mobileNumber']); ?>" readonly>
                    
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                    
                    <label for="profile_image">Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <button type="submit" class="save-button">Save Changes</button>
                <button type="button" class="cancel-button" onclick="location.href='profile_view.php'">Cancel</button>
            </div>
            <div class="edit-profile-image">
                <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Picture" class="edit-profile-picture">
            </div>
        </form>
    </div>
</body>
</html>
