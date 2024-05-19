<?php
// Start a session at the beginning of the script
session_start();

include("./config/dbcon.php");
error_reporting(0);

$query = "SELECT * FROM products";
$data = mysqli_query($conn, $query);

$totalproduct = mysqli_num_rows($data);

// Store total user count in a session variable
$_SESSION['totalproduct'] = $totalproduct;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>User Data</title>
    <style>
        /* CSS styles for the container */
        .container {
            max-width: 1200px; /* Adjust the width as needed */
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            overflow: hidden;
            border: 1px solid #ddd; /* Add border */
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
            background-color: #333; /* Highlight active link */
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* Rest of your existing CSS styles */
        body {
            background-color: #f0f0f0; /* Change to the desired background color */
            font-family: Arial, sans-serif; /* Use a common font */
            margin-left: 200px; /* Adjust content margin to accommodate sidebar */
        }

        .custom-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .custom-table th, .custom-table td {
            padding: 8px;
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
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Make it inline-block to respect padding */
            text-align: center; /* Center the text */
            transition: background-color 0.3s; /* Smooth transition */
            color: white;
        }

        .update-btn {
            background-color: #4CAF50;
        }

        .update-btn:hover {
            background-color: #45a049;
        }

        /* Style for the delete button */
        .delete-btn {
            background-color: #f44336; /* Red color */
        }

        .delete-btn:hover {
            background-color: #d32f2f; /* Darker shade of red on hover */
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

<!-- Container -->
<div class="container">
    <!-- Content goes here -->
    <!-- For example, the table -->
    <?php
    include("./config/dbcon.php");
    error_reporting(0);

    $query = "SELECT * FROM products";
    $data = mysqli_query($conn, $query);

    $totalproduct = mysqli_num_rows($data);

    // Start the table
    echo '<table class="custom-table">';
    echo '<tr>
    <th>Name</th>
    <th>Small Description</th>
    <th>Description</th>
    <th>Original Price</th>
    <th>Selling Price</th>
    
    <th>Meta Title</th>
    <th>Update</th>
    <th>Delete</th>

    <!-- Added the Image column -->
    </tr>';

    if($totalproduct != 0) {
        while($result = mysqli_fetch_assoc($data)) {
            // Output table row
            echo "<tr>
                <td>".$result['name']."</td>
                <td>".$result['small_description']."</td>
                <td>".$result['description']."</td>
                <td>".$result['original_price']."</td>
                <td>".$result['selling_price']."</td>
                
                <td>".$result['meta_title']."</td>
                <td><a href='update_product.php?id=$result[id]' class='update-btn'>Update</a></td>
                <td><a href='delete_product.php?id=$result[id]' class='delete-btn'>Delete</a></td>
                
            </tr>"; 
        }
    } else { 
        echo "<tr><td colspan='9'>No records found</td></tr>";
    }

    // Close the table
    echo '</table>';
    ?>
</div>

</body>
</html>
