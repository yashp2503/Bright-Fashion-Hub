<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        /* CSS styles for the container */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* CSS styles for the form elements */
        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 15px 30px; /* Increase padding to make the button bigger */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: block; /* Change to block element */
    margin: 0 auto; /* Center the button */
    font-size: 18px; /* Increase font size */
}

input[type="submit"]:hover {
    background-color: #45a049;
}

        /* CSS to center the heading */
        h2.center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="center">Update Product</h2>
    <?php
        include("./config/dbcon.php");

        // Check if ID parameter is set and not empty
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            
            // Retrieve product data from the database
            $query = "SELECT * FROM products WHERE id='$id'";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result) > 0) {
                $product = mysqli_fetch_assoc($result);

                // Handle form submission for updating product
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve form data
                    $name = $_POST['name'];
                    $small_description = $_POST['small_description'];
                    $description = $_POST['description'];
                    $original_price = $_POST['original_price'];
                    $selling_price = $_POST['selling_price'];
                    $meta_title = $_POST['meta_title'];

                    // Update the product in the database
                    $update_query = "UPDATE products SET name='$name', small_description='$small_description', description='$description', original_price='$original_price', selling_price='$selling_price', meta_title='$meta_title' WHERE id='$id'";
                    if(mysqli_query($conn, $update_query)) {
                        echo "Product updated successfully.";
                      ?>
                        <meta http-equiv="refresh" 
                        content="0; url = http://localhost/flash/admin-add-product.php" />
                        <?php
                    } else {
                        echo "Error updating product: " . mysqli_error($conn);
                    }
      


                    

                    // Handle image upload
                    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $image_name = $_FILES['image']['name'];
                        $temp_name = $_FILES['image']['tmp_name'];
                        $image_path = "" . $image_name;

                        // Move the uploaded image to the uploads folder
                        if(move_uploaded_file($temp_name, $image_path)) {
                            // Update the image path in the database
                            $update_image_query = "UPDATE products SET image='$image_path' WHERE id='$id'";
                            mysqli_query($conn, $update_image_query);
                            ?>
                            <meta http-equiv="refresh" 
                            content="0; url = http://localhost/flash/admin-add-product.php" />
                            <?php
                        } else {
                            echo "Error updating image: " . mysqli_error($conn);
                        }
                    }
                }
    ?>
    
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>"><br>
        <label for="small_description">Small Description:</label><br>
        <input type="text" id="small_description" name="small_description" value="<?php echo $product['small_description']; ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $product['description']; ?></textarea><br>
        <label for="original_price">Original Price:</label><br>
        <input type="text" id="original_price" name="original_price" value="<?php echo $product['original_price']; ?>"><br>
        <label for="selling_price">Selling Price:</label><br>
        <input type="text" id="selling_price" name="selling_price" value="<?php echo $product['selling_price']; ?>"><br>
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>
        <label for="meta_title">Meta Title:</label><br>
        <input type="text" id="meta_title" name="meta_title" value="<?php echo $product['meta_title']; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
    <br>
    <form action="delete_product.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
    </form>
    <?php
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Invalid request.";
        }
    ?>
</div>

</body>
</html>
