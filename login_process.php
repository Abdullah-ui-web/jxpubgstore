<?php
session_start();
include "db.php";

$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
        $message_type = "error";
    } else {
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: index.php");
                exit;
            } else {
                $message = "Incorrect password.";
                $message_type = "error";
            }
        } else {
            $message = "No account found with that email.";
            $message_type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Status</title>
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
  <h2>Login Status</h2>
  <?php if (!empty($message)): ?>
    <p class="<?php echo $message_type; ?>"><?php echo $message; ?></p>
    <p><a href="login.php">Go back to Login</a></p>
  <?php endif; ?>
</div>

</body>
</html>
