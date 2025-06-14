<?php
include "db.php";

$sql = "SELECT * FROM pubg_accounts ORDER BY id DESC LIMIT 3";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM pubg_popularity ORDER BY id DESC LIMIT 3";
$result2 = mysqli_query($conn, $sql2);
if (!$result2) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PUBG Store</title>
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
    background: linear-gradient(135deg, #000000, #0c0c0c);
    color: #ffffff;
    scroll-behavior: smooth;
  }

  header {
    background: #0a0a0a;
    padding: 20px 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: red 2px solid;
    position: sticky;
    top: 0;
    z-index: 999;
  }

  header h1 {
    color: #ff3131;
  }

  .menu-toggle {
    display: none;
    font-size: 26px;
    color: white;
    cursor: pointer;
  }

  nav a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
    transition: 0.3s;
    font-weight: bold;
    position: relative;
  }

  nav a::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    background: #ff3131;
    left: 0;
    bottom: -4px;
    transition: 0.4s;
  }

  nav a:hover::after {
    width: 100%;
  }

  .profile-icon {
    font-size: 28px;
    color: white;
    margin-left: 20px;
    text-decoration: none;
    transition: 0.3s;
  }

  .profile-icon:hover {
    color: #ff3131;
  }

  .hero {
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
  }

  .hero::after {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.6);
  }

  .hero-content {
    position: relative;
    z-index: 2;
  }

  .hero h2 {
    font-size: 50px;
    color: #ffffff;
    margin-bottom: 10px;
  }

  .hero p {
    font-size: 20px;
    color: #cccccc;
    margin-bottom: 20px;
  }

  .hero a {
    background-color: #ff3131;
    padding: 12px 25px;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.3s, transform 0.3s;
  }

  .hero a:hover {
    background-color: #e60000;
    transform: scale(1.05);
  }

  .section {
    padding: 60px 20px;
    text-align: center;
  }

  .section h3 {
    font-size: 36px;
    color: #ff3131;
    margin-bottom: 20px;
  }

  .filter-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin: 40px 0 20px;
    flex-wrap: wrap;
  }

  .filter-row select,
  .filter-row input {
    padding: 10px 15px;
    border-radius: 6px;
    background-color: #111;
    border: 1px solid #ff3131;
    color: white;
    outline: none;
  }

  .account-cards, .popularity-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 25px;
  }

  .popularity-cards ul{
    list-style: none;
   }

  .card, .pop-card {
    background-color: #101010;
    border: 2px solid #ff3131;
    border-radius: 15px;
    width: 280px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover, .pop-card:hover {
    transform: scale(1.05);
  }

  .card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }

  .card-content, .pop-card {
    padding: 15px;
    text-align: center;
  }

  .card-content .pop-card ul{
    list-style: none;
  }

  .card-content h4, .pop-card h4 {
    color: #ff3131;
    font-size: 22px;
    margin-bottom: 10px;
  }

  .card-content p, .pop-card p {
    font-size: 14px;
    color: #ccc;
    margin-bottom: 10px;
  }

  .card-content a, .pop-card a {
    background-color: #ff3131;
    color: white;
    padding: 8px 15px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
  }

  .card-content a:hover, .pop-card a:hover {
    background-color: #e60000;
  }

  .promo-banner {
    padding: 100px 20px;
    text-align: center;
    background: linear-gradient(145deg, #1c1c1c, #0a0a0a);
    border-top: 2px solid #ff3131;
    border-bottom: 2px solid #ff3131;
  }

  .promo-banner-content h3 {
    font-size: 40px;
    margin-bottom: 10px;
  }

  .promo-banner-content p {
    font-size: 18px;
    margin-bottom: 20px;
    color: #ccc;
  }

  form {
    background-color: #121212;
    max-width: 500px;
    margin: 20px auto;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #ff3131;
  }

  form input,
  form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background: #000;
    border: 1px solid #ff3131;
    color: white;
    border-radius: 6px;
    font-family: inherit;
  }

  form button {
    background-color: #ff3131;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
  }

  form button:hover {
    background-color: #e60000;
  }

  footer {
    background-color: #0a0a0a;
    color: #999;
    padding: 30px;
    text-align: center;
    font-size: 14px;
    border-top: 1px solid #ff3131;
  }

  @media (max-width: 768px) {
    nav {
      position: absolute;
      top: 100px;
      left: 0;
      width: 100%;
      background: #0c0c0c;
      flex-direction: column;
      display: none;
      z-index: 20;
    }

    nav.show {
      display: flex;
    }

    nav a {
      display: block;
      margin: 15px 0;
      text-align: center;
    }

    .menu-toggle {
      display: block;
    }

    header {
      flex-direction: row;
    }

    .hero h2 {
      font-size: 28px;
    }

    .section h3 {
      font-size: 28px;
    }
  }
</style>

</head>
<body>

  <header>
    <h1>PUBG Store</h1>
    <div class="menu-toggle" id="menu-toggle">&#9776;</div>
    <nav id="navbar">
      <a href="index.php">Home</a>
      <a href="accounts.php">Accounts</a>
      <a href="popularity.php">Popularity</a>
      <a href="#contact">Contact</a>
    </nav>
      <a href="profile.php" class="profile-icon"><i class="fas fa-user-circle"></i></a>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h2>Get Premium PUBG Accounts Now</h2>
      <p>Verified, High-KD, Rare Skins & More</p>
      <a href="#accounts">Explore Now</a>
    </div>
  </section>

  <section class="section" id="accounts">
    <h3>Featured Accounts</h3>
    <div class="account-cards">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
  <div class="card">
    <img src="images/account.jpg" alt="Account">
    <div class="card-content">
      <h4><?php echo htmlspecialchars($row['title']); ?></h4>
      <p><?php echo htmlspecialchars($row['short_description']); ?></p>
      <h4><?php echo number_format($row['price']); ?> PKR</h4>
      <a href="account_detail.php?id=<?php echo $row['id']; ?>">Buy Now</a>
    </div>
  </div>
<?php } ?>
    </div> <!-- Close .account-cards -->
  </section> <!-- Close #accounts -->



<section class="promo-banner" id="popularity">
  <div class="promo-banner-content-with-bg">
    <div class="promo-banner-content">
      <h3>💥 Buy PUBG Popularity at Best Rates!</h3>
      <p>Send Popularity to Friends or Boost Your ID – 100% Safe</p>
    </div>
  </div>

  <div class="popularity-cards">
    <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
      <div class="pop-card">
        <h4><?php echo number_format($row2['amount']); ?></h4>
        <ul>
          <li>Instant Delivery</li>
          <li>Supports Global IDs</li>
          <li>100% Safe & Secure</li>
        </ul>
        <h4><?php echo number_format($row2['price'], 2); ?> PKR</h4>
        <a href="#">Buy now</a>
      </div>
    <?php } ?>
  </div>
</section>




<section class="section" id="contact">
  <h3>Contact Us</h3>
  <p>Have questions? DM us or fill the form below.</p>
  <form id="contactForm">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
    <p id="form-message" style="margin-top: 10px;"></p>
  </form>
</section>

  <footer>
    &copy; 2025 PUBG Store. All rights reserved.
  </footer>

  <script>
    document.getElementById("menu-toggle").addEventListener("click", function () {
      document.getElementById("navbar").classList.toggle("show");
    });

     document.getElementById("contactForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);
  const messageEl = document.getElementById("form-message");

  fetch("save_contact.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (data.trim() === "success") {
      messageEl.textContent = "✅ Your message has been saved!";
      messageEl.style.color = "#00ff99";
      form.reset();
    } else {
      messageEl.textContent = "❌ Something went wrong.";
      messageEl.style.color = "#ff3131";
    }
  });
});
  </script>
</body>
</html>
