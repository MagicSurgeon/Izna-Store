<?php
include 'data.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM blog WHERE id = ?";
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
    $blog_name = $_POST['blog_name'];
    $blog_category = $_POST['blog_category'];
    $blog_author = $_POST['blog_author'];
    $blog_description = $_POST['blog_description'];
    $blog_date = $_POST['blog_date'];

    // Check if a new image is uploaded
    if(isset($_FILES['new_blog_image']) && $_FILES['new_blog_image']['error'] == 0) {
        // Process and move the uploaded image file
        $target_dir = __DIR__ . '/uploads/';
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $new_image_name = 'new_image_' . time() . '_' . str_replace(' ', '_', $_FILES['new_blog_image']['name']);
        $target_file = $target_dir . $new_image_name;

        if (move_uploaded_file($_FILES['new_blog_image']['tmp_name'], $target_file)) {
            $row['blog_image'] = $new_image_name; // Update the image name
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update other fields in the database
    $update_query = "UPDATE blog SET
        blog_name = ?,
        blog_category = ?,
        blog_author = ?,
        blog_description = ?,
        blog_date = ?,
        blog_image = ?
        WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_stmt, "ssssssi", $blog_name, $blog_category, $blog_author, $blog_description, $blog_date, $row['blog_image'], $id);
    mysqli_stmt_execute($update_stmt);

    if (mysqli_affected_rows($conn) > 0) {
        // Show success message with JavaScript alert and redirect
        echo '<script>alert("Blog details updated successfully."); window.location = "view_blog.php";</script>';
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
    <title>Edit Blog - <?php echo $row['product_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
    <?php
    if (isset($row)) {
    ?>
        <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Edit Blog - <?php echo $row['blog_name']; ?></h1>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <!-- Add input fields with the current data for editing -->
            <div class="col-md-3">
                <label for="blog_name" class="form-label">Blog Title</label>
                <input type="text" class="form-control" name="blog_name" value="<?php echo $row['blog_name']; ?>" id="blog_name" required>
            </div>
            <div class="col-md-3">
                <label for="blog_category" class="form-label">Category</label>
                <input type="text" class="form-control" name="blog_category" value="<?php echo $row['blog_category']; ?>" id="blog_category" required>
            </div>

            <div class="col-md-2">
                <label for="blog_author" class="form-label">Author</label>
                <input type="text" class="form-control" id="blog_author" name="blog_author" value="<?php echo $row['blog_author']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="blog_description" class="form-label">Description</label>
                <textarea class="form-control" id="blog_description" name="blog_description" cols="15" rows="6" required><?php echo $row['blog_description']; ?></textarea>
            </div>
            <div class="col-md-2">
                <label for="blog_date" class="form-label">Date</label>
                <input type="date" class="form-control" name="blog_date" id="blog_date" value="<?php echo $row['blog_date']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="blog_image" class="form-label">Current Image</label>
                <img src="uploads/<?php echo $row['blog_image']; ?>" class="img-fluid product-thumbnail" style="width: 200px; height: 150px;" alt="blog Image"><br>
                
                <label for="new_blog_image" class="form-label mt-2">Upload New Image</label>
                <input type="file" class="form-control" id="new_blog_image" name="new_blog_image" accept="uploads/*">
            </div>
            

            <!-- Hidden field to store the product ID for updating -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php
    } else {
        echo "No data available for editing.";
    }
    ?>
</div>
     <!-- wysiwyg html editor  -->
     <script>
            ClassicEditor
                    .create( document.querySelector( '#blog_description' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
