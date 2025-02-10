<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigos Beauty Indonesia</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/amibeauty.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">Amigos Beauty Indonesia</div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="banner">
            <img src="<?php echo base_url('assets/image/banner/banner2.png')?>" alt="Banner Image" style="width: 100%; height: 200px;">
        </div>
        <div class="details">
            <h1>Amigos Beauty Indonesia</h1>
            <p><strong>Curated Japan Skincare<br>
            LIVNUS Redefine Your Youth with LIVNUS HONO Scientific & Patented Facial Wash</p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <div class="contact">
            <p style="font-weight: 600;">GET IN TOUCH</p>
            <div style="padding: 10px;">
                <div class="social-row">
                    <a href="https://www.instagram.com/amibeautyid/"><i class="fab fa-instagram"></i> @amibeautyid</a>
                    <a href="https://www.tiktok.com/@amigosbeautyindonesia/"><i class="fab fa-tiktok"></i> @amigosbeautyindonesia</a>
                </div>
                <div class="website-row">
                    <a href="https://www.amibeauty.id/"><i class="fas fa-globe"></i> https://www.amibeauty.id/</a>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
