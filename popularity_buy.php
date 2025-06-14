<?php
include "db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $popularity_id = intval($_GET['id']);
    $sql = "SELECT * FROM pubg_popularity WHERE id = $popularity_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $popularity = mysqli_fetch_assoc($result);
    } else {
        echo "Popularity option not found."; exit;
    }
} else {
    echo "Invalid popularity ID."; exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buy Popularity - <?php echo htmlspecialchars($popularity['title']); ?></title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      background-color: #0b0b0b;
      font-family: 'Orbitron', sans-serif;
      color: #fff;
      min-height: 100vh;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    h1 {
      color: #00ff99;
      margin-bottom: 20px;
      text-align: center;
    }
    .instructions {
      background-color: #1a1a1a;
      border: 2px solid #00ff99;
      border-radius: 15px;
      padding: 25px 30px;
      max-width: 600px;
      width: 100%;
      margin-bottom: 40px;
    }
    .instructions h3 {
      margin-bottom: 15px;
      font-size: 22px;
      color: #ff3131;
    }
    .instructions p {
      margin-bottom: 10px;
      line-height: 1.6;
    }
    .notice {
      background-color: #1a1a1a;
      border: 2px dashed #00ff99;
      padding: 20px;
      border-radius: 10px;
      max-width: 600px;
      width: 100%;
      text-align: center;
      margin-bottom: 30px;
      color: #00ff99;
      font-size: 16px;
    }
    form {
      background-color: #1a1a1a;
      border: 2px solid #ff3131;
      border-radius: 15px;
      padding: 30px;
      max-width: 600px;
      width: 100%;
    }
    label {
      font-size: 14px;
      margin-bottom: 5px;
      color: #ccc;
    }
    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 8px;
      border: none;
      font-size: 16px;
      background-color: #262626;
      color: #fff;
    }
    input[type="file"] {
      cursor: pointer;
    }
    button {
      width: 100%;
      padding: 14px;
      background-color: #00ff99;
      color: #000;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #00cc77;
    }
    @media (max-width: 640px) {
      h1 {
        font-size: 22px;
      }
      .instructions,
      form {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<h1>Buy PUBG Popularity</h1>

<div class="instructions">
  <h3>Step 1: Make Manual Payment</h3>
    <p><strong>Popularity Amount:</strong> <?php echo number_format($popularity['amount']); ?> PKR</p>
  <p><strong>Price:</strong> <?php echo number_format($popularity['price']); ?> PKR</p>
  <p><strong>Easypaisa:</strong> 03144402959 (Muhmmad bachal)</p>
  <p>After payment, send a screenshot of the receipt using the form below.</p>
</div>

<div class="notice">
  📩 Also send your receipt on WhatsApp: <strong>+923144402959</strong>
</div>

<form action="submit_payment.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="popularity_id" value="<?php echo $popularity['id']; ?>">

  <label for="name">Your Name</label>
  <input type="text" id="name" name="name" required>

  <label for="contact">Phone or Email</label>
  <input type="text" id="contact" name="contact" required>

  <label for="receipt">Upload Payment Receipt</label>
  <input type="file" id="receipt" name="receipt" accept="image/*" required>

  <input type="hidden" name="order_type" value="popularity">
  <input type="hidden" name="account_id" value="<?php echo $popularity['id']; ?>">


  <button type="submit">Submit for Review</button>
</form>

</body>
</html>
