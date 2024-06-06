<?php
include 'data.php';

// Fetch inactive items from the database
$query = "SELECT * FROM contact_us WHERE is_active = 0";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seen Message's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <!-- Display inactive items here -->
    <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Seen Message's</h1>
    <div class="container">
            <table class="table">
                <thead>
                  <tr>
                  <th scope="col">S.NO</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gmail</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM contact_us WHERE is_active = 0";
                    $data = mysqli_query($conn, $query);
                    $result = mysqli_num_rows($data);
        
                    if ($result) {
                        while ($row = mysqli_fetch_array($data)) {
                           
                  ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['m_num']; ?></td>
                                <td><?php echo substr($row['message'], 0, 13); ?></td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="activate.php?id=<?php echo $row['id']; ?>">Unseen</a></li>
                                    </ul>
                                    </div>
                                </td>
                            </tr>
                    <?php
                    }
                  }
                    if ($result == 0) {
                    echo '<p>No inactive items found.</p>';
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <!-- Load Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
