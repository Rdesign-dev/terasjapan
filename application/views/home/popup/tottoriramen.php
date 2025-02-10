<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOTTORI RAMEN</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/tottoriramen.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">TOTTORI RAMEN</div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="banner">
            <img src="<?php echo base_url('assets/image/banner/banner4.png') ?>" alt="Banner Image" style="width: 100%; height: 200px;">
        </div>
        <div class="details">
            <h1>TOTTORI RAMEN</h1>
            <p>Cita rasa Ramen baru, dengan hidangan andalan kami Tottori Signature Ramen dan Tottori Spicy Ramen. Didukung oleh Restoran Ramen di Tottori, Jepang dengan pengalaman lebih dari 100 tahun.</p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <div class="contact">
            <p style="font-weight: 600; margin-bottom: 15px;">GET IN TOUCH</p>
            <div style="text-align: center;">
                <a href="https://www.instagram.com/tottoriramen/"><i class="fab fa-instagram"></i> @tottoriramen</a>
                <a href="https://www.tiktok.com/@tottoriramen/"><i class="fab fa-tiktok"></i> @tottoriramen</a>
            </div>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
