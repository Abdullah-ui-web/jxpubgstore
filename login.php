<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - PUBG Store</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }

    body {
      font-family: 'Orbitron', sans-serif;
      background-color: #0b0b0b;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: #1a1a1a;
      border: 2px solid #ff3131;
      padding: 40px;
      border-radius: 12px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 15px #ff3131aa;
    }

    h2 {
      color: #ff3131;
      text-align: center;
      margin-bottom: 25px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 6px;
      background: #2c2c2c;
      color: #fff;
      font-size: 15px;
    }

    .btn {
      background: #ff3131;
      color: #fff;
      border: none;
      padding: 12px;
      width: 100%;
      font-size: 16px;
      border-radius: 6px;
      margin-top: 15px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #e02525;
    }

    .link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #ccc;
      font-size: 14px;
    }

    .link a {
      color: #ff3131;
      text-decoration: none;
    }

    .link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <form action="login_process.php" method="POST" class="form-container">
    <h2>Login to PUBG Store</h2>
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" class="btn">Login</button>
    <div class="link">Don't have an account? <a href="signup.php">Signup</a></div>
  </form>
</body>
</html>
