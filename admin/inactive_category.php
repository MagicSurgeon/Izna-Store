
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inactive Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/button.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <!-- Display inactive categories here -->
    <div class="head">
        <h1>View Categories</h1>
        <div class="buttons">
            <button><a href="add_Category.php">Add Category</a></button>
            <button><a href="view_Category.php">View Active Categories</a></button>
            <button><a href="dashboard.php">Home</a></button>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.NO</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'data.php';
                $query = "SELECT * FROM categories WHERE is_active = 0";
                $data = mysqli_query($conn, $query);
                $result = mysqli_num_rows($data);

                if ($result) {
                    $count = 1;
                    while ($row = mysqli_fetch_array($data)) {
                ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['category_description']; ?></td>
                            <td><?php echo $row['is_active'] ? 'Active' : 'Inactive'; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="activate.php?id=<?php echo $row['id']; ?>">Activate</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="6">No inactive categories found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Load Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>
</html>
