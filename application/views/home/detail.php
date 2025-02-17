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
            <img src="<?php echo base_url('assets/image/banner/' . $brand->banner); ?>" 
                 alt="<?php echo $brand->name; ?>" style="width: 100%; max-height: 200px; object-fit: cover;">
        </div>
        <div class="details">
            <h1><?php echo $brand->name; ?></h1>
            <p><?php echo $brand->desc; ?></p>
            <a href="#" class="order-btn">ORDER NOW</a>
        </div>
        <div class="contact">
            <p style="font-weight: 600; margin-bottom: 15px;">GET IN TOUCH</p>
            <div style="text-align: center;">
                <?php if($brand->instagram): ?>
                    <a href="https://www.instagram.com/<?php echo $brand->instagram; ?>/">
                        <i class="fab fa-instagram"></i> @<?php echo $brand->instagram; ?>
                    </a>
                <?php endif; ?>
                
                <?php if($brand->tiktok): ?>
                    <a href="https://www.tiktok.com/@<?php echo $brand->tiktok; ?>/">
                        <i class="fab fa-tiktok"></i> @<?php echo $brand->tiktok; ?>
                    </a>
                <?php endif; ?>
                
                <?php if($brand->wa): ?>
                    <a href="https://wa.me/<?php echo $brand->wa; ?>">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                <?php endif; ?>
                
                <?php if($brand->web): ?>
                    <a href="<?php echo $brand->web; ?>">
                        <i class="fas fa-globe"></i> Website
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
