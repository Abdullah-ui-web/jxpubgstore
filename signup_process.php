<?php
include "db.php";

$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "Please fill in all fields.";
        $message_type = "error";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
        $message_type = "error";
    } else {
        // Check email exists
        $check_query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $message = "Email is already registered. Try logging in.";
            $message_type = "error";
        } else {
            // Save user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            if (mysqli_query($conn, $insert_query)) {
                $message = "Signup successful! <a href='login.php'>Click here to login</a>";
                $message_type = "success";
            } else {
                $message = "Error: " . mysqli_error($conn);
                $message_type = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Signup Result</title>
  <style>
    body {
      background-color: #0b0b0b;
      font-family: 'Arial', sans-serif;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .message-box {
      background-color: #1a1a1a;
      border: 2px solid #ff3131;
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 0 10px #ff3131aa;
    }

    .message-box h2 {
      margin-bottom: 20px;
      color: #ff3131;
    }

    .success {
      color: #00ff99;
    }

    .error {
      color: #ff6161;
    }

    .message-box a {
      color: #00ccff;
      text-decoration: underline;
    }

    .message-box a:hover {
      color: #ff3131;
    }
  </style>
</head>
<body>

<div class="message-box">
  <h2>Signup Status</h2>
  <p class="<?php echo $message_type; ?>"><?php echo $message; ?></p>
</div>

</body>
</html>
