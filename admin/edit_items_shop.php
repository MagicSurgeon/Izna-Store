<?php
include 'data.php';

// Assuming 'id' is passed as a query parameter in the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch data from the database based on the product ID
$query = "SELECT * FROM product WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process form submission
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_Category = mysqli_real_escape_string($conn, $_POST['product_Category']);
        $product_mrp = mysqli_real_escape_string($conn, $_POST['product_mrp']);
        $product_Discount = mysqli_real_escape_string($conn, $_POST['product_Discount']);
        $product_sprice = mysqli_real_escape_string($conn, $_POST['product_sprice']);
        $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
        $product_date = $_POST['product_date']; // Assuming product_date is already in the correct format

        // Process and move the uploaded image file
        if(isset($_FILES['new_product_images']) && $_FILES['new_product_images']['error'] == 0) {
            $target_dir = __DIR__ . '/uploads/'; // Adjusted path separator to forward slash
            $new_image_name = 'new_image_' . time() . '_' . str_replace(' ', '_', $_FILES['new_product_images']['name']);
            $target_file = $target_dir . $new_image_name;

            if (move_uploaded_file($_FILES['new_product_images']['tmp_name'], $target_file)) {
                // File uploaded successfully, update the product_images field in the database
                $update_query = "UPDATE product SET product_images = ? WHERE id = ?";
                $update_stmt = mysqli_prepare($conn, $update_query);
                mysqli_stmt_bind_param($update_stmt, 'si', $new_image_name, $id);
                mysqli_stmt_execute($update_stmt);

                $image_updated = true;
            } else {
                echo "Sorry, there was an error uploading your file.";
                $image_updated = false;
            }
        } else {
            $image_updated = false;
        }

        // Update other fields in the database
        $update_query = "UPDATE product SET
        product_name = ?,
        product_Category = ?,
        product_mrp = ?,
        product_sprice = ?,
        product_Discount = ?,
        product_description = ?,
        product_date = ?
        WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, "sssssssi", $product_name, $product_Category, $product_mrp, $product_sprice, $product_Discount, $product_description, $product_date, $id);
        mysqli_stmt_execute($update_stmt);

        if (mysqli_affected_rows($conn) > 0) {
            // Show success message if any update was successful
            $success_message = "Product details updated successfully.";
        } else {
            $success_message = "No changes made.";
        }

        if ($image_updated) {
            // Append image update message if image was also updated
            $success_message .= " Image updated successfully.";
        }

        // Show combined success message with an okay button
        echo '<script>alert("' . $success_message . '"); window.location = "view_items_shop.php?id=' . $id . '";</script>';
    }
} else {
    // Handle the case where no data is found for the given ID
    $row = null;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Item - <?php echo $row['product_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
    <?php
    if (isset($row)) {
    ?>
        <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">Edit Item - <?php echo $row['product_name']; ?></h1>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <!-- Add input fields with the current data for editing -->
            <div class="col-md-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>" id="product_name" required>
            </div>
            <div class="col-md-3">
                <label for="product_Category" class="form-label">Category</label>
                <input type="text" class="form-control" name="product_Category" value="<?php echo $row['product_Category']; ?>" id="product_Category" required>
            </div>

            <div class="col-md-2">
                <label for="product_mrp" class="form-label">MRP</label>
                <input type="text" class="form-control" id="product_mrp" name="product_mrp" value="<?php echo $row['product_mrp']; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="product_sprice" class="form-label">Sale Price</label>
                <input type="text" class="form-control" id="product_sprice" name="product_sprice" value="<?php echo $row['product_sprice']; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="product_Discount" class="form-label">Discount or Sale Price</label>
                <input type="text" class="form-control" id="product_Discount" name="product_Discount" value="<?php echo $row['product_Discount']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="product_description" class="form-label">Description</label>
                <textarea class="form-control" id="product_description" name="product_description" cols="15" rows="13" required><?php echo $row['product_description']; ?></textarea>
            </div>
            <div class="col-md-2">
                <label for="product_date" class="form-label">Date</label>
                <input type="date" class="form-control" name="product_date" id="product_date" value="<?php echo $row['product_date']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="product_images" class="form-label">Current Image</label>
                <img src="uploads/<?php echo $row['product_images']; ?>" class="img-fluid product-thumbnail" style="width: 200px; height: 150px;" alt="Product Image"><br>
                
                <label for="new_product_images" class="form-label mt-2">Upload New Image</label>
                <input type="file" class="form-control" id="new_product_images" name="new_product_images" accept="uploads/*">
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

        // Add event listeners to trigger discount calculation
        document.getElementById("product_mrp").addEventListener("input", calculateDiscount);
        document.getElementById("product_sprice").addEventListener("input", calculateDiscount);
</script>

</body>
</html>
