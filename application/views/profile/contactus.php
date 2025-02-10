<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/contactus.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">Contact Us</div>
    </div>

    <!-- Contact Container -->
    <div class="contact-container">
        <h1>Contact Us</h1>
        <img src="<?php echo base_url('assets/image/konten/konten1.png'); ?>" alt="Contact Us" class="contact-image">
        <p style="font-weight: 600;">Questions, Comments, or Any Concerns? Please contact us at the below :</p>

        <a href="mailto:cs@terasjapan.com" class="contact-item" style="text-decoration: none;">
            <img src="<?php echo base_url('assets/image/icon/email.png'); ?>" alt="Email">
            <span>cs@terasjapan.com</span>
        </a>
        <a href="https://wa.me/6281011348123" class="contact-item" style="text-decoration: none;">
            <img src="<?php echo base_url('assets/image/icon/whatsapp.png'); ?>" alt="WhatsApp">
            <span>+62 810 1134 8123</span>
        </a>
        <a href="https://www.instagram.com/teras.japan/" class="contact-item" style="text-decoration: none;">
            <img src="<?php echo base_url('assets/image/icon/instagram.png'); ?>" alt="Instagram">
            <span>@teras.japan</span>
        </a>
        <a href="https://www.tiktok.com/@terasjapan/" class="contact-item" style="text-decoration: none;">
            <img src="<?php echo base_url('assets/image/icon/tiktok.png'); ?>" alt="TikTok">
            <span>@terasjapan</span>
        </a>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
