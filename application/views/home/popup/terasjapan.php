<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teras Japan</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/terasjapan.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">Teras Japan</div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="banner">
            <img src="<?php echo base_url('assets/image/banner/banner3.png') ?>" alt="Banner Image" style="width: 100%; height: 200px;">
        </div>
        <div class="details">
            <h1>Teras Japan</h1>
            <p><strong>Teras Japan is a typical Japanese restaurant, providing a variety of Japanese specialties ranging from Tora Ramen, Toyo, and others. for those of you culinary lovers don't forget to stop by and taste it<br></p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <div class="contact">
            <p style="font-weight: 600;">GET IN TOUCH</p>
            <div style="padding: 10px;">
                <div class="social-row">
                    <a href="https://www.instagram.com/teras.japan/"><i class="fab fa-instagram"></i> @teras.japan</a>
                    <a href="https://www.tiktok.com/@terasjapan/"><i class="fab fa-tiktok"></i> @terasjapan</a>
                </div>
                <div class="website-row">
                    <a href="https://www.terasjapan.com/"><i class="fas fa-globe"></i> https://www.terasjapan.com/</a>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
