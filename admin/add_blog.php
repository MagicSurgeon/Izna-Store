<?php
include 'data.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = ""; // Variable to store success or error messages

if (isset($_POST['button_temp'])) {
    // Form data retrieval
    $blog_name = $_POST['blog_name'];
    $blog_category = $_POST['blog_category'];
    $blog_description = $_POST['blog_description'];
    $blog_author = $_POST['blog_author'];
    $blog_date = $_POST['blog_date'];

    // File upload handling
    $blog_image = $_FILES['blog_image'];

    $uploadedFiles = [];
    $imageContents = [];
    foreach ($blog_image['name'] as $key => $fileName) {
        if ($blog_image['error'][$key] == 0) {
            $fileTmpName = $blog_image['tmp_name'][$key];
            $imageContent = file_get_contents($fileTmpName);
            $imageContents[] = mysqli_real_escape_string($conn, $imageContent);
            $uploadedFiles[] = $fileName;
        } else {
            $message = "File upload error: " . $blog_image['error'][$key] . " for file: " . $fileName;
        }
    }

    // Check if any uploaded files exist
    if (!empty($uploadedFiles)) {
        $sql = "INSERT INTO blog (blog_name, blog_category, blog_description, blog_author, blog_date, blog_image, is_active) VALUES (?, ?, ?, ?, ?, ?, 1)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            $uploadedFilesStr = implode(', ', $uploadedFiles);
            $imageContentsStr = implode(', ', $imageContents);
            mysqli_stmt_bind_param($stmt, "ssssss", $blog_name, $blog_category, $blog_description, $blog_author, $blog_date, $imageContentsStr);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Blog entry added successfully.";
            } else {
                $message = "Error executing statement: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        $message = "No files uploaded or error occurred during upload.";
    }
    
    // Redirect with message
    echo '<script>
        window.addEventListener("load", function() {
            alert("' . $message . '");
            window.location.href = "add_blog.php";
        });
    </script>';
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Add New Blog</h1>
    <div class="container">
        <form class="row g-3" method="POST" enctype="multipart/form-data" id="blog_form">
            <div class="col-md-3">
                <label for="blog_name" class="form-label">Blog Title</label>
                <input type="text" class="form-control" name="blog_name" placeholder="Earrings" id="blog_name" required>
            </div>
            <div class="col-md-3">
                <label for="blog_category" class="form-label">Category</label>
                <input type="text" class="form-control" name="blog_category" placeholder="jewellery" id="blog_category" required>
            </div>
            <div class="col-md-2">
                <label for="blog_author" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="blog_author" name="blog_author" placeholder="Kareem" required>
            </div>
            <div class="col-md-10">
                <label for="blog_description" class="form-label">Description</label>
                <textarea class="form-control" id="blog_description" name="blog_description" cols="95" rows="9" placeholder="Resin earrings are stylish accessories crafted from resin, a durable and versatile material that can be molded into various ..."></textarea>
            </div>
            <div class="col-md-4">
                <label for="blog_image" class="form-label">Images</label>
                <input type="file" class="form-control" id="blog_image" name="blog_image[]" accept="image/*" multiple>
                <div id="image-preview-container" class="mt-4" style="max-width: 300px; max-height: 300px; overflow: auto;"></div>
            </div>
            <div class="col-md-2">
                <label for="blog_date" class="form-label">Date</label>
                <input type="date" class="form-control" name="blog_date" placeholder="Category" id="blog_date" required>
            </div>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary" name="button_temp">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: '#blog_description',
            width: 1300,
            height: 600,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'help'
            ],
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
            menu: {
                favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
            },
            menubar: 'favs file edit view insert format tools table help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });

        document.getElementById('blog_form').addEventListener('submit', function(e) {
            tinymce.triggerSave();
        });
    </script>
</body>
</html>
