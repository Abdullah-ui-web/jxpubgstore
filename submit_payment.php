<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Status</title>
  <style>
    body {
      background-color: #0b0b0b;
      color: #fff;
      font-family: 'Orbitron', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
      min-height: 100vh;
    }
    .box {
      background-color: #1a1a1a;
      border: 2px solid #00ff99;
      padding: 40px 30px;
      border-radius: 15px;
      max-width: 600px;
      width: 100%;
      text-align: center;
      box-shadow: 0 0 20px #00ff99;
    }
    h2 {
      color: #00ff99;
      font-size: 26px;
      margin-bottom: 15px;
    }
    p {
      font-size: 16px;
      color: #ccc;
      line-height: 1.6;
    }
    .success {
      color: #00ff99;
    }
    .error {
      color: #ff3131;
    }
    a {
      display: inline-block;
      margin-top: 25px;
      padding: 12px 20px;
      background: #ff3131;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s ease;
    }
    a:hover {
      background: #e02626;
    }
  </style>
</head>
<body>
<div class="box">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $order_type = isset($_POST['order_type']) ? mysqli_real_escape_string($conn, $_POST['order_type']) : 'account';
    $related_id = intval($_POST['account_id']); // item_id (account or popularity)

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === 0) {

        $upload_dir = "admin/receipts/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_tmp = $_FILES['receipt']['tmp_name'];
        $file_name = basename($_FILES['receipt']['name']);
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array(strtolower($file_ext), $allowed)) {
            echo "<p class='error'>Only JPG, JPEG, PNG, and GIF files are allowed.</p>";
            exit;
        }

        // Sanitize original file name
        $safe_name = preg_replace("/[^A-Za-z0-9_\-\.]/", '_', $file_name);

        // Prevent overwriting
        $final_name = $safe_name;
        $counter = 1;
        while (file_exists($upload_dir . $final_name)) {
            $final_name = pathinfo($safe_name, PATHINFO_FILENAME) . "_$counter." . $file_ext;
            $counter++;
        }

        $destination = $upload_dir . $final_name;

        if (move_uploaded_file($file_tmp, $destination)) {
            // Insert into DB
            $sql = "INSERT INTO payment_receipts (item_id, order_type, name, contact, receipt_image)
                    VALUES ('$related_id', '$order_type', '$name', '$contact', '$final_name')";

            if (mysqli_query($conn, $sql)) {
                echo "<h2 class='success'>✅ Receipt Submitted</h2>";
                echo "<p>Thank you <strong>$name</strong>! Your <strong>$order_type</strong> receipt has been submitted.</p>";
                echo "<p>We will contact you after verifying your payment.</p>";
            } else {
                echo "<p class='error'>Database error: " . mysqli_error($conn) . "</p>";
            }

        } else {
            echo "<p class='error'>❌ Failed to upload the receipt image. Please try again.</p>";
        }

    } else {
        echo "<p class='error'>⚠️ Please upload a valid receipt image.</p>";
    }

} else {
    echo "<p class='error'>Invalid request.</p>";
}
?>
  <a href="index.php">Back to Home</a>
</div>
</body>
</html>
