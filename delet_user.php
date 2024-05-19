<?php
error_reporting(0);
include("./config/dbcon.php");

// Check if ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Select user information based on the provided ID
    $query = "SELECT * FROM users WHERE id = '$id'";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);
}


// Delete functionality
if(isset($_POST['delete'])) {
    $id = $_GET['id'];

    // Prepare and bind the DELETE statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted')</script>";
        // Redirect to the display page after successful deletion
        header("Location: http://localhost/flash/admin-table-users.php");
        exit(); // Terminate the script after redirection
    } else {
        echo "Failed to delete record.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete User Information</title>
<style>
    /* Resetting default margin and padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    /* Container styles */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Form styles */
    #deleteForm {
        background-color: #fff;
        border: 2px solid #ccc;
        border-radius: 10px;
        padding: 30px;
        width: 400px;
    }

    #deleteForm h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #f44336;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #d32f2f;
    }
</style>
</head>
<body>

<div class="container">
    <form id="deleteForm" method="post" action="#">
        <h2>Delete User Information</h2>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo isset($result['firstname']) ? $result['firstname'] : '' ?>" readonly>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo isset($result['lastname']) ? $result['lastname'] : '' ?>" readonly>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($result['email']) ? $result['email'] : '' ?>" readonly>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo isset($result['phone']) ? $result['phone'] : '' ?>" readonly>

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($result['password']) ? $result['password'] : '' ?>" readonly>

        <input type="submit" name="delete" value="Delete">
    </form>
</div>

</body>
</html>
