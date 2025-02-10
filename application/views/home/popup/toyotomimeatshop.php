<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niku Shoo Toyotomi</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/toyotomi.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">Niku Shoo Toyotomi</div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="banner">
            <img src="<?php echo base_url('assets/image/banner/banner1.png'); ?>" alt="Banner Image" style="width: 100%; height: 200px;">
        </div>
        <div class="details">
            <h1>Niku Shoo Toyotomi</h1>
            <p><strong>Japan-spirit Premium Meat shop in BSD, South Tangerang</strong><br>
            Halal Wagyu💯, Meat Consultation🍖<br>
            Custom Cut🔪, Expertise in Japanese Cuisine🍱</p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <div class="contact">
            <p style="font-weight: 600; margin-bottom: 15px;">GET IN TOUCH</p>
            <div style="text-align: left; padding-left: 30px;">
                <a href="https://instagram.com/toyotomimeatshop"><i class="fab fa-instagram"></i> toyotomimeatshop</a>
                <a href="https://wa.me/6282283619320"><i class="fab fa-whatsapp"></i> +6282283619320</a>
            </div>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
