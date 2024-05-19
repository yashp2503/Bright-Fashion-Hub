<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
         .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* CSS styles for the sidebar */
        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #4CAF50;
            padding-top: 20px;
            overflow-x: hidden;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            display: block;
            color: #fff;
            font-size: 18px;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .sidebar .active {
            background-color: #333;
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* Rest of your existing CSS styles */
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin-left: 200px;
        }

        .custom-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .custom-table th, .custom-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .custom-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .custom-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .custom-table tr:hover {
            background-color: #f2f2f2;
        }

        .update-btn, .delete-btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s;
            color: white;
        }

        .update-btn {
            background-color: #4CAF50;
        }

        .update-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }

        .file-input {
            width: 100%;
            margin: 0 auto; /* Center horizontally */
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            font-size: 24px; /* Adjusted font size */
            font-weight: bold;
            margin-top: 0; /* Remove default margin */
        }

        /* Added hover effect for buttons */
        .update-btn:hover, .delete-btn:hover {
            opacity: 0.8;
        }
        p1 {
            font-size: 18px;
            font-weight: bold;
        }

        /* Modal styles */

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
            text-align: center;
        }
        .modal-content {
    display: block;
    margin: 10% auto; /* Center horizontally and vertically */
    padding: 20px;
    background-color: #fefefe;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px; /* Adjust as needed */
    border-radius: 8px;
    text-align: center;
}
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        .modal-img {
            max-width: 100%;
            height: auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-align: center;
        }
        .form-group input[type="file"] {
    width: 100%;
    margin: 0 auto; /* Center horizontally */
    margin-bottom: 10px;
    text-align: center; /* Center the file input */
}
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <a href="adminhome.php" class="active"><i class="fas fa-home"></i> Home</a>
  <a href="admin-add-product.php"><i class="fas fa-box"></i> Product</a>
  <a href="admin-add-gallery.php"><i class="fas fa-images"></i> Gallery</a>
  <a href="admin-table-users.php"><i class="fas fa-users"></i> Users</a>
  <a href="order.php"><i class="fas fa-shopping-cart  "></i> Orders</a>
  <a href="requests.php"><i class="fas fa-envelope"></i> Requests</a>
  <a href="index.php" target="_blank"><i class="fas fa-globe"></i> Website</a> <!-- Added target="_blank" to open in a new tab -->
  <a href="adminlogin.php"><i class="fas fa-sign-out-alt"></i> Logout</a> 
</div>

<!-- Gallery -->
<p>Gallery</p>

<!-- Container -->
<div class="container">
    
    <!-- Add Gallery button -->
    <div style="margin-bottom: 20px;">
        <a href="#" class="btn" onclick="openUploadModal()"><i class="fas fa-plus"></i> Add Gallery</a>
    </div>

    <!-- Content goes here -->
    <!-- For example, the table -->
    <?php
include("./config/dbcon.php");
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $image_tmp = $_FILES['image']['tmp_name'];

    // Move uploaded file to desired directory
    move_uploaded_file($image_tmp, "uploads/$image");

    // Insert file details into the database
    $sql = "INSERT INTO gallery (image) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $image);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }
}

$query = "SELECT * FROM gallery";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

// Start the table
echo '<table class="custom-table">';
echo '<tr>
<th>Image</th>
<th>Action</th>
</tr>';

if($total != 0) {
    while($result = mysqli_fetch_assoc($data)) {
        // Output table row
        echo "<tr>
            <td style='width: 150px; height: 150px;'><img src='".$result['image']."' alt='Image' style='width: 100%; height: 100%; object-fit: cover;' onclick='showModal(\"".$result['image']."\")'></td>
            <td>
                <form action='update_image.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='image_id[]' value='".$result['id']."'>
                    <p1>Current Image: ".$result['image']."</p1><br>
                    <input type='file' name='new_image[]' class='file-input'><br>
                    <input type='submit' value='Update' class='update-btn'>
                </form>
            </td>
        </tr>"; 
    }
} else { 
    echo "<tr><td colspan='2'>No records found</td></tr>";
}

// Close the table
echo '</table>';
?>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modalImg" class="modal-img">
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUploadModal()">&times;</span>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Select image to upload:</label>
                <input type="file" name="image" id="image" required class="file-input">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Upload Image">
            </div>
        </form>
    </div>
</div>

<script>
    // Function to display modal with clicked image
    function showModal(imageSrc) {
        const modal = document.getElementById("myModal");
        const modalImg = document.getElementById("modalImg");
        modalImg.src = imageSrc;
        modal.style.display = "block";
    }

    // Function to close modal
    function closeModal() {
        const modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    // Function to open upload modal
    function openUploadModal() {
        const uploadModal = document.getElementById("uploadModal");
        uploadModal.style.display = "block";
    }

    // Function to close upload modal
    function closeUploadModal() {
        const uploadModal = document.getElementById("uploadModal");
        uploadModal.style.display = "none";
    }
</script>

</body>
</html>
