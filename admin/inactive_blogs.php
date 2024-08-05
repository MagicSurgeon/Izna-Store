<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inactive Blogs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/button.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="head">
        <h1>Inactive Blogs</h1>
        <div class="buttons">
            <button><a href="add_blog.php">Add Blog</a></button>
            <button><a href="view_blog.php">View Active Blogs</a></button>
            <button><a href="dashboard.php">Home</a></button>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Blog Title</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                include 'data.php'; 

                $query = "SELECT * FROM blog WHERE is_active = 0";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['blog_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['blog_category']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['blog_author']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['blog_date']) . '</td>';
                        echo '<td>';
                        echo '<div class="btn-group">';
                        echo '<button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action</button>';
                        echo '<ul class="dropdown-menu">';
                        echo '<li><a class="dropdown-item" href="activate.php?id=' . $row['id'] . '">Activate</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No records found</td></tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
