<?php
error_reporting(0);
include("./config/dbcon.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = '$id'";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);
}

if(isset($_POST['update'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $id = $_GET['id'];

    // Prepare and bind the UPDATE statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, phone=?, password=? WHERE id=?");
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $phone, $password, $id);

    if ($stmt->execute()) {
        echo "<script>alert('record updated')</script>";
        ?>

          <meta http-equiv="refresh" 
          content="0; url = http://localhost/flash/admin-table-users.php" />

        <?php
    } 
    else {
        echo "Failed to update data.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update User Information</title>
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
    #updateForm {
        background-color: #fff;
        border: 2px solid #ccc;
        border-radius: 10px;
        padding: 30px;
        width: 400px;
    }

    #updateForm h2 {
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
        background-color: #4caf50;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="container">
    <form id="updateForm" method="post" action="#">
        <h2>Update User Information</h2>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo isset($result['firstname']) ? $result['firstname'] : '' ?>" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo isset($result['lastname']) ? $result['lastname'] : '' ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($result['email']) ? $result['email'] : '' ?>" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo isset($result['phone']) ? $result['phone'] : '' ?>" required>

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($result['password']) ? $result['password'] : '' ?>" required>

        <input type="submit" name="update" value="Update">
    </form>
</div>

</body>
</html>
