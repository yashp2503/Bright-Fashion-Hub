<?php
// Start the session to persist user login status
session_start();

include 'config/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM adminusers WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Set session variables to indicate user is logged in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Redirect user to admin home page
            header('Location: adminhome.php');
            exit;
        } else {
            // If login fails, set error message
            $error_message = "Invalid username or password";
        }
    } else {
        $error_message = "Please enter both username and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    /* Basic CSS for styling the admin home page */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 400px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .content {
        padding: 20px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .form-input {
        margin-bottom: 15px;
    }

    .form-input label {
        display: block;
        margin-bottom: 5px;
    }

    .form-input input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-input button {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-input button:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome Admin!</h1>
        </div>
        <div class="content">
            <!-- Login Form -->
            <form class="login-form" id="loginForm" action="" method="post">
                <div class="form-input">
                    <label for="username"> Admin:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-input">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-input">
                    <button type="submit">Login</button>
                </div>
                <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-S0Me5vpE4qVI4BAzGZY7fDHMxd2W5B3wh7EMpXEltR3M2pYXmC2R8g7sgUId8O3p" crossorigin="anonymous">
    </script>
</body>

</html>