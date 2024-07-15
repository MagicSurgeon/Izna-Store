<?php
include 'data.php';

if (isset($_POST['add_category'])) {
    // Form data retrieval
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Database interaction
    $sql = "INSERT INTO categories (category_name, category_description, is_active) VALUES (?, ?, 1)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $category_name, $category_description);

        if (mysqli_stmt_execute($stmt)) {
            // Success message with redirection
            echo '<script>alert("Category added successfully."); window.location = "' . $_SERVER["REQUEST_URI"] . '";</script>';
            exit(); // Stop further execution
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Add New Category</h1>
    <div class="container">
        <form class="row g-3" method="POST" id="category_form">
            <div class="col-md-6">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="category_name" placeholder="Home Décor" id="category_name" required>
            </div>
            <div class="col-md-12">
                <label for="category_description" class="form-label">Description</label>
                <textarea class="form-control" id="category_description" name="category_description" cols="55" rows="3" placeholder="Enter category description..."required></textarea>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" name="add_category">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
