<?php
include 'data.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "SELECT * FROM contact_us WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1 style="color: #28a745; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding: 30px; margin-left: 50px; margin-top: 50px;">View Message</h1>
    <div class="container">
    <form>
        <div class="form-group row">
            <label for="fname" class="col-sm-1 col-form-label">First Name</label>
            <div class="col-sm-4">
                <input class="form-control" value="<?php echo $row['fname']; ?>" id="fname" readonly>
            </div>
            <div class="col-sm-1"></div> 
            <label for="lname" class="col-sm-1 col-form-label">Last Name</label>
            <div class="col-sm-4">
                <input class="form-control" value="<?php echo $row['lname']; ?>" id="lname" readonly>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="email" class="col-sm-1 col-form-label">Email</label>
            <div class="col-sm-4">
                <input class="form-control" value="<?php echo $row['email']; ?>" id="email" readonly>
            </div>
            <div class="col-sm-1"></div> 
            <label for="m_num" class="col-sm-1 col-form-label">Mobile Number</label>
            <div class="col-sm-2">
                <input class="form-control" value="<?php echo $row['m_num']; ?>" id="m_num" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="message" class="col-sm-1 col-form-label">Message</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="message" readonly><?php echo $row['message']; ?></textarea>
            </div>
        </div><br>
        <div class="form-group row">
            <div class="col-sm-10">
            <a href="deactivate.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Seen</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="contact_us.php" class="btn btn-danger">Back</a>
            </div>
        </div>
    </form>
    </div>
    <script>
        // Get the textarea element
        var textarea = document.getElementById('message');
        // Set its height to fit the content
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        // No message found with the provided ID
        echo "<p>Message not found.</p>";
    }
} else {
    // No ID provided in the URL
    echo "<p>No message ID provided.</p>";
}
?>
