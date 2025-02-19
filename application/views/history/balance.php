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
            <h2>Teras Japan Payment</h2>
            <div class="datetime">
                <p><?php echo date('d M Y', strtotime($transaction->created_at)); ?> &#8226; <span class="time"><?php echo date('H : i : s', strtotime($transaction->created_at)); ?></span></p>
            </div>
        </div>
        <div class="status">
            <img src="<?php echo base_url('assets/image/icon/cek.png'); ?>" alt="Success" class="success-icon">
            <h3 class="success-message">Teras Japan Payment</h3>
            <p class="description">Transaction successful! Your balance has been deducted by <strong>IDR <?php echo number_format($transaction->amount, 0, ',', '.'); ?></strong> at Teras Japan Branch <strong><?php echo $branch->branch_name; ?></strong>.</p>
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
