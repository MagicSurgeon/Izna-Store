<?php
session_start();
include 'data.php';

// Check if the user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

// Fetch categories from the database
$categoryQuery = "SELECT category_name FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

if (isset($_POST['button_temp'])) {
    $product_name = $_POST['product_name'];
    $product_Category = $_POST['product_Category'];
    $product_mrp = $_POST['product_mrp'];
    $product_Discount = $_POST['product_Discount'];
    $product_sprice = $_POST['product_sprice'];
    $product_description = $_POST['product_description'];
    $product_date = $_POST['product_date'];

    // Use $_FILES for file uploads
    $product_images = $_FILES['product_images'];

    // Specify the base upload directory
    $uploadBaseDirectory = __DIR__ . '/site/admin_images/';
    $folderName = uniqid('product_', true); // Generate a unique folder name
    $uploadDirectory = $uploadBaseDirectory . $folderName . '/';

    // Create the directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Process each uploaded file
    $uploadedFiles = [];
    foreach ($product_images['tmp_name'] as $key => $tmpName) {
        $fileName = basename($product_images['name'][$key]);
        $targetFile = $uploadDirectory . $fileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($tmpName, $targetFile)) {
            // File upload successful
            $uploadedFiles[] = $fileName;
        } else {
            echo "Error moving file to destination directory for file: " . $fileName;
        }
    }

    // Check if there were any errors during file upload
    if (!empty($uploadedFiles)) {
        $uploadedFilesStr = implode(', ', $uploadedFiles);

        // Include admin_id from session
        $admin_id = $_SESSION['user_id'];

        // Insert product details into the database
        $sql = "INSERT INTO product (product_name, product_Category, product_mrp, product_sprice, product_Discount, product_description, folder_path, product_date, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssss", $product_name, $product_Category, $product_mrp, $product_sprice, $product_Discount, $product_description, $folderName, $product_date, $admin_id);

            if (mysqli_stmt_execute($stmt)) {
                // Success message with redirection
                echo '<script>alert("Product added successfully."); window.location = "' . $_SERVER["REQUEST_URI"] . '";</script>';
                exit(); // Stop further execution
            } else {
                echo "Error executing statement: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo "No files uploaded or error occurred during upload.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Items Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Add New Item</h1>
    <div class="container">
        <form class="row g-3" method="POST" enctype="multipart/form-data" id="product_form">
            <div class="col-md-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Key chain" id="product_name" required>
            </div>
            <div class="col-md-3">
                <label for="product_Category" class="form-label">Category</label>
                <select class="form-control" name="product_Category" id="product_Category" required>
                    <option value="">Select Category</option>
                    <?php
                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        echo '<option value="' . $categoryRow['category_name'] . '">' . $categoryRow['category_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="product_mrp" class="form-label">MRP</label>
                <input type="text" class="form-control" id="product_mrp" name="product_mrp" placeholder="00.00" required>
            </div>
            <div class="col-md-2">
                <label for="product_sprice" class="form-label">Sale Price</label>
                <input type="text" class="form-control" id="product_sprice" name="product_sprice" placeholder="00.00" required>
            </div>
            <div class="col-md-2">
                <label for="product_Discount" class="form-label">Discount (%)</label>
                <input type="text" class="form-control" id="product_Discount" name="product_Discount" placeholder="%" readonly>
            </div>
            <div class="col-md-10">
                <label for="product_description" class="form-label">Description</label>
                <textarea class="form-control" id="product_description" name="product_description" cols="15" rows="9" placeholder="Resin earrings are stylish accessories crafted from resin, a durable and versatile material that can be molded into various ..."></textarea>
            </div>
            <div class="col-md-4">
                <label for="product_images" class="form-label">Images</label>
                <input type="file" class="form-control" id="product_images" name="product_images[]" accept="image/*" multiple required>
                <div id="image-preview-container" class="mt-4" style="max-width: 500px; max-height: 500px; overflow: auto;"></div>
            </div>
            <div class="col-md-2">
                <label for="product_date" class="form-label">Date</label>
                <input type="date" class="form-control" name="product_date" placeholder="Category" id="product_date" required>
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary" name="button_temp">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
        
        <!-- Display uploaded images dynamically -->
        <div id="image-preview-container" class="mt-4"></div>
    </div>
    

    <script>
        // Function to calculate discount percentage
        function calculateDiscount() {
            var mrp = parseFloat(document.getElementById("product_mrp").value);
            var salePrice = parseFloat(document.getElementById("product_sprice").value);

            if (!isNaN(mrp) && !isNaN(salePrice)) {
                var discount = ((mrp - salePrice) / mrp) * 100;
                document.getElementById("product_Discount").value = discount.toFixed(2) + "%";
            } else {
                document.getElementById("product_Discount").value = "";
            }
        }

        // Add event listeners to input fields
        document.getElementById("product_mrp").addEventListener("input", calculateDiscount);
        document.getElementById("product_sprice").addEventListener("input", calculateDiscount);

        // Handle image previews
        document.getElementById('product_images').addEventListener('change', function(event) {
            var files = event.target.files;
            var previewContainer = document.getElementById('image-preview-container');
            previewContainer.innerHTML = '';

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.marginRight = '10px';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9QhFAG5Yy2w5tA91jW9nF2EoK3Q6I2XH5Jf1eD6M+4b5+FhCLO/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-SDDK0x7Kzh0AnbmbmgcLsMKy7pF+d5yLlZXMuVtD1FPrzN0VfapgMkGSA0Pe4fz5/" crossorigin="anonymous"></script>
</body>
</html>
