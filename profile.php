<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
$user_id = $_SESSION['user_id'];

$query = "SELECT username, email FROM users WHERE id = $user_id LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "User not found.";
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #0b0b0b;
      font-family: 'Orbitron', sans-serif;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    .profile-container {
      max-width: 500px;
      margin: 100px auto;
      background-color: #1a1a1a;
      padding: 40px;
      border: 2px solid #ff3131;
      border-radius: 12px;
      box-shadow: 0 0 15px #ff3131aa;
      text-align: center;
    }

    .profile-container h1 {
      color: #ff3131;
      margin-bottom: 20px;
    }

    .profile-container p {
      font-size: 16px;
      color: #ccc;
      margin-bottom: 12px;
    }

    .logout-btn {
      display: inline-block;
      margin-top: 20px;
      background-color: #ff3131;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      font-size: 16px;
      border-radius: 6px;
      transition: 0.3s;
    }

    .logout-btn:hover {
      background-color: #e02525;
    }
  </style>
</head>
<body>

<div class="profile-container">
  <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
  <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
</html>
