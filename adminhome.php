<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
<style>
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.sidebar {
  height: 100%;
  width: 200px;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #4CAF50;
  padding-top: 20px;
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

.content {
  margin-left: 200px;
  padding: 20px;
}

/* Adjust content width to accommodate sidebar */
@media (max-width: 768px) {
  .sidebar, .content {
    margin-left: 0;
    width: 100%;
  }
}

.total-users-box {
  width: 160px;
  height: 60px;
  padding: 10px;
  border: 2px solid #ddd;
  border-radius: 10px;
  background-color: #fff;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.total-users-icon {
  font-size: 24px;
  margin-right: 10px;
}

/* Calendar styling */
#calendar {
  margin-top: 20px;
}
</style>
</head>
<body>

<div class="sidebar">
  <a href="#" class="active"><i class="fas fa-home"></i> Home</a>
  <a href="admin-add-product.php"><i class="fas fa-box"></i> Product</a>
  <a href="admin-add-gallery.php"><i class="fas fa-images"></i> Gallery</a>
  <a href="admin-table-users.php"><i class="fas fa-users"></i> Users</a>
  <a href="order.php"><i class="fas fa-shopping-cart"></i> Orders</a>
  <a href="requests.php"><i class="fas fa-envelope"></i> Requests</a> 
  <a href="index.php" target="_blank"><i class="fas fa-globe"></i> Website</a> 
  <a href="adminlogin.php"><i class="fas fa-sign-out-alt"></i> Logout</a> 
</div>

<div class="content">
  <h2>Admin Panel</h2>
  <p>Welcome to the admin panel of Bright Fashion Hub.</p>
  <div class="total-users-box">
    <div class="total-users-icon">
      <i class="fas fa-users"></i>
    </div>
    Total Users: <?php echo isset($_SESSION['totalUsers']) ? $_SESSION['totalUsers'] : '0'; ?>
  </div>
  <div class="total-users-box">
    <div class="total-users-icon">
      <i class="fas fa-box"></i>
    </div>
    Total Product: <?php echo isset($_SESSION['totalproduct']) ? $_SESSION['totalproduct'] : '0'; ?>
  </div>
  <div class="total-users-box">
    <div class="total-users-icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    Total Product: <?php echo isset($_SESSION['totalorders']) ? $_SESSION['totalorders'] : '0'; ?>
  </div>
  
  <!-- Calendar -->
  <div id="calendar"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth', // Set initial view to month
      events: [
        // Sample events data, you can replace it with your own
        {
          title: 'Event 1',
          start: '2024-03-01'
        },
        {
          title: 'Event 2',
          start: '2024-03-05',
          end: '2024-03-07'
        }
        // Add more events as needed
      ]
    });

    calendar.render();
  });
</script>

</body>
</html>
