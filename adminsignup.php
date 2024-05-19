<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head><?php

$succes = 0;
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config/dbcon.php';
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM adminusers WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $num = mysqli_num_rows($result);

            if ($num > 0) {
                $user = 1;
            } else {
                $sql = "INSERT INTO adminusers (username, password) VALUES ('$username', '$password')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $succes = 1;
                } else {
                    die(mysqli_error($con));
                }
            }
        } else {
            die(mysqli_error($con));
        }
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
    .menu {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }
    .menu a {
      text-decoration: none;
      color: #333;
      padding: 10px 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin: 5px 0;
      transition: all 0.3s ease;
    }
    .menu a:hover {
      background-color: #333;
      color: #fff;
    }
    .login-button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .login-button:hover {
      background-color: #45a049;
    }
    .content {
      padding: 20px;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
    }
    .login-form {
      padding: 20px;
      display: none; /* Initially hide the login form */
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
    <div class="menu">
      <button class="login-button" id="loginButton"><i class="fas fa-lock"></i> Login</button>
    </div>
    <div class="content">
      <!-- Login Form -->
      <form class="login-form" id="loginForm" action="adminsignup.php" method="post" onsubmit="return validateForm()">
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
      </form>
    </div>
  </div>

  <script>
    // Get the login button and login form elements
    const loginButton = document.getElementById('loginButton');
    const loginForm = document.getElementById('loginForm');

    // Add event listener to login button to show/hide the login form
    loginButton.addEventListener('click', function() {
      // Toggle the display of the login form
      loginForm.style.display = loginForm.style.display === 'none' || loginForm.style.display === '' ? 'block' : 'none';
      
      // Hide the login button
      loginButton.style.display = 'none';
    });
  </script>
</body>
</html>

