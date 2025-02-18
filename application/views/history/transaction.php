<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="../assets/css/transaction.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="icon" type="image/x-icon" href="../assets/image/logo/logo-amigos.png">
</head>
<body>
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Transaction</div>
    </div>
    <div class="container">
        <div class="top-up-info">
            <h2>Balance Top-up</h2>
        <div class="datetime">
            <p>05 Jan 2025 &#8226; <span class="time">18 : 21 : 17</span></p>
        </div>
        </div>
        <div class="status">
            <img src="../assets/image/icon/cek.png" alt="Success" class="success-icon">
            <h3 class="success-message">Balance Top-up is successful</h3>
            <p class="description">The balance top-up process through the m-banking has been successfully completed for <strong>IDR 50,000</strong></p>
        </div>
        <button class="detail-btn">Detail Transaction</button>
    </div>

    <script>
        window.onload = function() {
            const profileLink = document.querySelector('.footer a[href="history.php"]');
            if (profileLink) {
                profileLink.classList.add('active');
            }
        }
    </script>
</body>
<?php include 'Footer.php'; ?>
</html>
