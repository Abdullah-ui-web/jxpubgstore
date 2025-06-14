<?php
include "db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $account_id = intval($_GET['id']);
    $sql = "SELECT * FROM pubg_accounts WHERE id = $account_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $account = mysqli_fetch_assoc($result);
    } else {
        echo "Account not found."; exit;
    }
} else {
    echo "Invalid account ID."; exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($account['title']); ?> - PUBG Account Detail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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

    .menu-toggle {
      display: none;
      font-size: 26px;
      color: #fff;
      cursor: pointer;
      z-index: 999;
    }

    .menu-toggle.open i::before {
      content: "\f00d"; /* 'X' icon */
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

    .detail-container {
      max-width: 1100px;
      margin: 40px auto;
      display: flex;
      flex-wrap: wrap;
      background: #1a1a1a;
      border-radius: 12px;
      border: 2px solid #ff3131;
      overflow: hidden;
    }

    .media-box, .info-box {
      flex: 1 1 50%;
      padding: 30px;
    }

    .media-box img, .media-box video {
      width: 100%;
      margin-bottom: 20px;
      border-radius: 10px;
      border: 1px solid #ff3131;
    }

    .info-box h1 {
      font-size: 26px;
      color: #ff3131;
      margin-bottom: 15px;
    }

    .info-box p {
      font-size: 15px;
      margin-bottom: 12px;
      color: #ccc;
    }

    .price {
      font-size: 20px;
      color: #00ff99;
      font-weight: bold;
      margin: 20px 0;
    }

    .buy-btn {
      background-color: #ff3131;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      font-size: 16px;
      border-radius: 6px;
      transition: background-color 0.3s;
      display: inline-block;
    }

    .buy-btn:hover {
      background-color: #e02525;
    }

    @media (max-width: 768px) {
      header {
        flex-wrap: wrap;
      }

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

      .detail-container {
        flex-direction: column;
      }

      .media-box, .info-box {
        flex: 1 1 100%;
        padding: 20px;
      }
    }
      footer {
    background-color: #0a0a0a;
    color: #999;
    padding: 30px;
    text-align: center;
    font-size: 14px;
    border-top: 1px solid #ff3131;
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
    <a href="index.php#accounts">Accounts</a>
    <a href="index.php#popularity">Popularity</a>
    <a href="index.php#contact">Contact</a>
  </nav>
  <a href="profile.php" class="profile-icon"><i class="fas fa-user-circle"></i></a>
</header>

<div class="detail-container">
  <div class="media-box">
    <?php if (!empty($account['image1'])): ?>
      <img src="admin/uploads/<?php echo htmlspecialchars($account['image1']); ?>" alt="PUBG Account Image">
    <?php endif; ?>

    <?php if (!empty($account['video'])): ?>
      <video controls>
        <source src="admin/uploads/<?php echo htmlspecialchars($account['video']); ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    <?php endif; ?>
  </div>

  <div class="info-box">
    <h1><?php echo htmlspecialchars($account['title']); ?></h1>
    <p><strong>Account ID:</strong> <?php echo htmlspecialchars($account['account_id']); ?></p>
    <p><strong>Short Description:</strong> <?php echo htmlspecialchars($account['short_description']); ?></p>
    <p><strong>Full Description:</strong><br><?php echo nl2br(htmlspecialchars($account['description'])); ?></p>
    <p class="price">Price: <?php echo number_format($account['price'], 2); ?> PKR</p>
    <a href="account_buy.php?id=<?php echo $account['id']; ?>" class="buy-btn">Buy This Account</a>
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
