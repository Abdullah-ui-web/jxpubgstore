<?php
include "db.php";

$sql = "SELECT * FROM pubg_accounts ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All PUBG Accounts</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Orbitron', sans-serif;
      background-color: #0b0b0b;
      color: #fff;
    }

    header {
      background: #1a1a1a;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #ff3131;
      position: relative;
      flex-wrap: wrap;
      z-index: 100;
    }

    header h1 {
      color: #ff3131;
      font-size: 24px;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      position: relative;
      transition: color 0.3s;
    }

    nav a:hover {
      color: #ff3131;
    }

    nav a::after {
      content: "";
      position: absolute;
      bottom: -4px;
      left: 0;
      height: 2px;
      width: 0;
      background-color: #ff3131;
      transition: width 0.3s ease;
    }

    nav a:hover::after {
      width: 100%;
    }

    nav a.active {
      color: #ff3131;
    }

    .menu-toggle {
      display: none;
      font-size: 26px;
      color: #fff;
      cursor: pointer;
      z-index: 999;
    }

    .menu-toggle.open i::before {
      content: "\f00d";
    }

    .profile-icon {
      font-size: 24px;
      color: #fff;
      margin-left: 20px;
      transition: 0.3s;
    }

    .profile-icon:hover {
      color: #ff3131;
    }

    .container {
      padding: 60px 20px;
      text-align: center;
    }

    .container h2 {
      font-size: 32px;
      color: #ff3131;
      margin-bottom: 30px;
    }

    .account-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 25px;
    }

    .card {
      background-color: #101010;
      border: 2px solid #ff3131;
      border-radius: 15px;
      width: 280px;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-content {
      padding: 15px;
      text-align: center;
    }

    .card-content h4 {
      color: #ff3131;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .card-content p {
      font-size: 14px;
      color: #ccc;
      margin-bottom: 10px;
    }

    .card-content a {
      background-color: #ff3131;
      color: white;
      padding: 8px 15px;
      border-radius: 6px;
      text-decoration: none;
      display: inline-block;
    }

    footer {
      background-color: #0a0a0a;
      color: #999;
      padding: 30px;
      text-align: center;
      font-size: 14px;
      margin-top: 60px;
      border-top: 1px solid #ff3131;
    }

    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      nav {
        position: absolute;
        top: 65px;
        left: 0;
        width: 100%;
        flex-direction: column;
        background-color: #1a1a1a;
        display: none;
        padding: 15px 0;
      }

      nav.show {
        display: flex;
      }

      nav a {
        text-align: center;
        padding: 10px 0;
        width: 100%;
      }

      .container h2 {
        font-size: 26px;
      }

      .card {
        width: 90%;
      }

      .container {
        padding: 40px 10px;
      }

      footer {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>PUBG Store</h1>
  <div class="menu-toggle" id="menu-toggle">
    <i class="fas fa-bars"></i>
  </div>
  <nav id="navbar">
    <a href="index.php">Home</a>
    <a href="accounts.php" class="active">Accounts</a>
    <a href="popularity.php">Popularity</a>
    <a href="contact.php">Contact</a>
  </nav>
  <a href="profile.php" class="profile-icon"><i class="fas fa-user-circle"></i></a>
</header>

<div class="container">
  <h2>All PUBG Accounts</h2>
  <div class="account-cards">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="card">
        <img src="images/account.jpg" alt="Account Image">
        <div class="card-content">
          <h4><?php echo htmlspecialchars($row['title']); ?></h4>
          <p><?php echo htmlspecialchars($row['short_description']); ?></p>
          <h4><?php echo number_format($row['price']); ?> PKR</h4>
          <a href="account_detail.php?id=<?php echo $row['id']; ?>">Buy Now</a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<footer>
  &copy; 2025 PUBG Store. All rights reserved.
</footer>

<script>
  const toggleBtn = document.getElementById("menu-toggle");
  const navbar = document.getElementById("navbar");

  toggleBtn.addEventListener("click", () => {
    navbar.classList.toggle("show");
    toggleBtn.classList.toggle("open");
  });
</script>

</body>
</html>
