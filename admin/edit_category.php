<?php
include 'data.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM categories WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $row = null;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    // Update other fields in the database
    $update_query = "UPDATE categories SET
        category_name = ?,
        category_description = ?,
        is_active = ?
        WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_stmt, "ssii", $category_name, $category_description, $is_active, $id);
    mysqli_stmt_execute($update_stmt);

    if (mysqli_affected_rows($conn) > 0) {
        // Show success message with JavaScript alert and redirect
        echo '<script>alert("Category details updated successfully."); window.location = "view_category.php";</script>';
        exit();
    } else {
        echo "No changes made.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category - <?php echo $row['category_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <?php
        if (isset($row)) {
        ?>
        <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Edit Category - <?php echo $row['category_name']; ?></h1>
        <form class="row g-3" method="POST">
            <!-- Add input fields with the current data for editing -->
            <div class="col-md-6">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="category_name" value="<?php echo $row['category_name']; ?>" id="category_name" required>
            </div>
            <div class="col-md-8">
                <label for="category_description" class="form-label">Category Description</label>
                <textarea class="form-control" id="category_description" name="category_description" cols="15" rows="6" required><?php echo $row['category_description']; ?></textarea>
            </div>
            <div class="col-md-2">
                <!-- <label class="form-check-label" for="is_active">Active</label> -->
                <input class="form-check-input" type="hidden" id="is_active" name="is_active" <?php echo $row['is_active'] ? 'checked' : ''; ?>>
            </div>

            <!-- Hidden field to store the category ID for updating -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
        } else {
            echo "No data available for editing.";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
