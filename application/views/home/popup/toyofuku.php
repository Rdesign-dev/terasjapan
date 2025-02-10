<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOYO FUKU</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/toyofuku.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">TOYO FUKU</div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="banner">
            <img src="<?php echo base_url('assets/image/banner/banner6.png') ?>" alt="Banner Image" style="width: 100%; height: 200px;">
        </div>
        <div class="details">
            <h1>TOYO FUKU</h1>
            <p><strong>🎌BEST "GYOZA" IN TOWN😋<br>
            街一番の餃子🥟<br>
            <p><strong>🎌RICH TASTE "RAMEN"😍<br>
            濃厚ラーメン🍜<br>
            </p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <div class="contact">
            <p style="font-weight: 600;">GET IN TOUCH</p>
            <div style="text-align: left; padding-left: 30px;">
                <a href="https://www.instagram.com/toyofuku.id/"><i class="fab fa-instagram"></i> @toyofuku.id</a>
            </div>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
