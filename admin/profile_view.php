<?php
include 'header.php';
include 'data.php';

session_start();
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

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile View</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: ;
            margin: 0;
            padding: 0;
            color: #3d405b;
        }

        .profile-container {
            max-width: 96%;
            margin: 50px auto;
            padding: 30px;
            background: honeydew;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-container:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        .profile-info {
            flex: 2;
        }

        .profile-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-picture {
            width: 310px;
            height: 310px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #81b29a;
            transition: border-color 0.3s ease;
        }

        .profile-picture:hover {
            border-color: #e07a5f; /* Accent color on hover */
        }

        .profile-header h1 {
            margin: 0;
            font-size: 36px;
            color: #3d405b;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .edit-button, .dashboard-button {
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

        .edit-button {
            background-color: #3d405b; /* Darker color for edit button */
        }

        .edit-button:hover {
            background-color: #2c3e50;
            transform: translateY(-2px);
        }

        .dashboard-button {
            background-color: #81b29a; /* Light green for dashboard button */
        }

        .dashboard-button:hover {
            background-color: #6a9c6e;
            transform: translateY(-2px);
        }

        .profile-details {
            margin-top: 20px;
        }

        .profile-details h2 {
            border-bottom: 2px solid #81b29a; /* Light green color for header underline */
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #3d405b;
            font-size: 24px;
        }

        .profile-details p {
            margin-bottom: 15px;
            font-size: 18px;
            color: #3d405b;
        }

        .profile-details strong {
            display: inline-block;
            width: 200px;
            color: #81b29a;
            text-shadow: 0.5px 0.5px 1px #3d405b;
        }

        .profile-header {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-info">
            <div class="profile-header">
                <h1><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></h1>
            </div>
            <div class="profile-details">
                <h2>Personal Information</h2>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($user['mobileNumber']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
            </div>
        </div>
        <div class="button" style="display:grid">
            <button class="edit-button" onclick="location.href='edit_profile.php'">Edit Profile</button>
            <button class="dashboard-button" onclick="location.href='dashboard.php'">Dashboard</button>
        </div>
        <div class="profile-image">
            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Picture" class="profile-picture">
        </div>
    </div>
</body>
</html>
