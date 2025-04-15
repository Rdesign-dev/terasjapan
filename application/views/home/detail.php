<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $brand->name; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/detail.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title"><?php echo $brand->name; ?></div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="banner">
            <img src="https://terasjapan.com/ImageTerasJapan/banner/<?php echo $brand->banner; ?>" 
                 alt="<?php echo $brand->name; ?>" style="width: 100%; max-height: 200px; object-fit: cover;">
        </div>
        <div class="details">
            <h1><?php echo $brand->name; ?></h1>
            <p><?php echo $brand->desc; ?></p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <?php 
        if($brand->instagram || $brand->tiktok || $brand->wa || $brand->web): ?>
            <div class="contact">
                <p style="font-weight: 600; margin-bottom: 15px;">GET IN TOUCH</p>
                <div class="social-icons">
                    <?php if($brand->instagram): ?>
                        <a href="https://instagram.com/<?php echo str_replace('instagram.com/', '', $brand->instagram); ?>" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($brand->tiktok): ?>
                        <a href="https://www.tiktok.com/@<?php echo str_replace('@', '', $brand->tiktok); ?>" target="_blank">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($brand->wa): ?>
                        <a href="https://wa.me/<?php echo $brand->wa; ?>" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($brand->web): ?>
                        <a href="<?php echo $brand->web; ?>" target="_blank">
                            <i class="fas fa-globe"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
