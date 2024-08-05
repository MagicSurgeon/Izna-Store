<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Items Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/button.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="head">
        <h1>View Items</h1>
        <div class="buttons">
            <button><a href="add_items_shop.php">Add Product</a></button>
            <button><a href="inactive_items_shop.php">View Inactive Product</a></button>
            <button><a href="dashboard.php">Home</a></button>
        </div>
    </div>
    <div class="container">
            <table class="table table-success table-striped">
                <thead>
                  <tr>
                    <th scope="col">S.NO</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">MRP</th>
                    <!-- <th scope="col">Discount or Sale Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Images</th> -->
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    include 'data.php';

                    $query = "SELECT * FROM product WHERE is_active = 1";
                    $data = mysqli_query($conn, $query);
                    $result = mysqli_num_rows($data);
        
                    if ($result) {
                        while ($row = mysqli_fetch_array($data)) {
                           
                  ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['product_Category']; ?></td>
                                <td>₹ <?php echo $row['product_mrp']; ?></td>
                                <!-- Example
                                <td><?php echo $row['product_Discount']; ?></td>
                                <td><?php echo $row['product_sprice']; ?></td>
                                <td><?php echo $row['product_description']; ?></td>
                                <td>
                                    <img src="image/<?php echo $row['product_images']; ?>" class="img-fluid product-thumbnail" style="width: 200px; height: 250px;">
                                </td>
                                Example -->

                                <td><?php echo $row['product_date']; ?></td>
                                <td>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="edit_items_shop.php?id=<?php echo $row['id']; ?>">Edit</a></li>
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
