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
  <title>Buy Account - <?php echo htmlspecialchars($account['title']); ?></title>
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
      color: #ff3131;
      margin-bottom: 20px;
      text-align: center;
    }
    .instructions {
      background-color: #1a1a1a;
      border: 2px solid #ff3131;
      border-radius: 15px;
      padding: 25px 30px;
      max-width: 600px;
      width: 100%;
      margin-bottom: 20px;
    }
    .instructions h3 {
      margin-bottom: 15px;
      font-size: 22px;
      color: #00ff99;
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
      border: 2px solid #00ff99;
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
      background-color: #ff3131;
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #e02626;
    }
    @media (max-width: 640px) {
      h1 {
        font-size: 22px;
      }
      .instructions,
      .notice,
      form {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<h1>Buy PUBG Account</h1>

<div class="instructions">
  <h3>Step 1: Manual Payment</h3>
  <p><strong>Amount:</strong> <?php echo number_format($account['price']); ?> PKR</p>
  <p><strong>JazzCash:</strong> 03144402959 (Muhmmad bachal)</p>
  <p>After sending payment, please fill the form below and upload your payment receipt.</p>
</div>

<div class="notice">
  📩 Also send your receipt on WhatsApp: <strong>+923144402959</strong>
</div>

<form action="submit_payment.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="account_id" value="<?php echo $account['id']; ?>">

  <label for="name">Your Name</label>
  <input type="text" id="name" name="name" required>

  <label for="contact">Phone or Email</label>
  <input type="text" id="contact" name="contact" required>

  <label for="receipt">Upload Payment Receipt</label>
  <input type="file" id="receipt" name="receipt" accept="image/*" required>

  <input type="hidden" name="order_type" value="account">
  <input type="hidden" name="account_id" value="<?php echo $account['id']; ?>">


  <button type="submit">Submit for Review</button>
</form>

</body>
</html>
