<?php
include 'data.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Blog's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">View Blog's</h1>
    <div class="container">
            <table class="table table-success table-striped">
                <thead>
                  <tr>
                    <th scope="col">S.NO</th>
                    <th scope="col">Blog Tittle</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM blog WHERE is_active = 1";
                    $data = mysqli_query($conn, $query);
                    $result = mysqli_num_rows($data);
        
                    if ($result) {
                        while ($row = mysqli_fetch_array($data)) {
                           
                  ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['blog_name']; ?></td>
                                <td><?php echo $row['blog_category']; ?></td>
                                <td><?php echo $row['blog_author']; ?></td>
                                <td><?php echo $row['blog_date']; ?></td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="edit_blog.php?id=<?php echo $row['id']; ?>">Edit</a></li>
                                        <li><a class="dropdown-item" href="deactivate.php?id=<?php echo $row['id']; ?>">Inactive</a></li>
                                    </ul>
                                    </div>
                                </td>
                            </tr>
                         
                    <?php
                    }
                  }
                    ?>
                </tbody>
              </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
