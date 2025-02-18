<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/transaction.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
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
                <p><?php echo date('d M Y', strtotime($transaction->created_at)); ?> &#8226; <span class="time"><?php echo date('H : i : s', strtotime($transaction->created_at)); ?></span></p>
            </div>
        </div>
        <div class="status">
            <img src="<?php echo base_url('assets/image/icon/cek.png'); ?>" alt="Success" class="success-icon">
            <h3 class="success-message">Balance Top-up is successful</h3>
            <p class="description">The process of replenishing the balance via <strong><?php echo $transaction->payment_method; ?></strong> has been successfully carried out in the amount of <strong>IDR <?php echo number_format($transaction->amount, 0, ',', '.'); ?></strong></p>
        </div>
        <button class="detail-btn">Click here for transaction proof details.</button>
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
<?php include 'application/views/layout/Footer.php'; ?>
</html>
