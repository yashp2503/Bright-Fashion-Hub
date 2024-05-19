<?php
// Start the session to persist user login status
session_start();

include 'config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $image_tmp = $_FILES['image']['tmp_name'];

    // Check if file was uploaded successfully
    if (!empty($image) && is_uploaded_file($image_tmp)) {
        // Move uploaded file to desired directory
        $upload_directory = "uploads/";
        $destination = $upload_directory . $image;
        if (move_uploaded_file($image_tmp, $destination)) {
            // Insert file details into the database
            $sql = "INSERT INTO gallery (image) VALUES ('$image')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error inserting image details into the database: " . mysqli_error($conn);
            }
        } else {
            echo "Error moving uploaded file to destination directory.";
        }
    } else {
        echo "Error: No file uploaded or file upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="image">Select image to upload:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <div>
            <button type="submit" name="submit">Upload Image</button>
        </div>
    </form>
</body>
</html>
