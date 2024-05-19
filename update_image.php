<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['new_image']) && isset($_POST['image_id'])) {
    // Include the database connection file
    include("./config/dbcon.php");

    // Loop through each uploaded image
    $num_files = count($_FILES['new_image']['name']);
    $image_ids = $_POST['image_id'];

    for ($i = 0; $i < $num_files; $i++) {
        $image_id = $image_ids[$i];
        $new_image_name = $_FILES['new_image']['name'][$i];
        $new_image_tmp_name = $_FILES['new_image']['tmp_name'][$i];

        // Check if the image is uploaded successfully
        if (!empty($new_image_name) && !empty($new_image_tmp_name)) {
            // Move the uploaded image to the desired location
            $new_image_path = "" . $new_image_name;
            if (move_uploaded_file($new_image_tmp_name, $new_image_path)) {
                // Update the image path in the database
                $update_query = "UPDATE gallery SET image='$new_image_path' WHERE id='$image_id'";
                if (mysqli_query($conn, $update_query)) {

                    ?>
                    <meta http-equiv="refresh" content="0; url = http://localhost/flash/admin-add-gallery.php" />
                    <?php
                } else {
                    echo "Error updating image for ID $image_id: " . mysqli_error($conn) . "<br>";
                }
            } else {
                echo "Error moving uploaded image for ID $image_id.<br>";
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>