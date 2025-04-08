<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Brand Rewards</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/listreward.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="icon" type="image/x-icon" href="../assets/image/logo/logo-amigos.png">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header-wrapper">
            <div class="header-top-container">
                <img class="header-logo" src="http://localhost/ImageTerasJapan/logo/tjwhite.png" alt="Teras Japan" />
                <h1 class="header-title-text">Teras Heroes Club</h1>
            </div>
        </div>

        <h2 style="text-align: center; margin-top: 1rem;">All Brand Rewards</h2>

        <!-- Rewards by Brand -->
        <div class="reward-section">
            <?php if (!empty($all_brands)): ?>
                <?php foreach ($all_brands as $brand): ?>
                    <div class="brand-reward-block">
                        <h3 class="brand-reward-title"><?php echo $brand->name; ?></h3>
                        <div class="reward-items">
                            <?php if (!empty($brand->rewards)): ?>
                                <?php foreach ($brand->rewards as $reward): ?>
                                    <div class="reward-item">
                                        <img src="<?php echo base_url('../ImageTerasJapan/reward/' . $reward->image_name); ?>" 
                                             alt="<?php echo $reward->title; ?>" />
                                        <div class="reward-info">
                                            <h4><?php echo $reward->title; ?></h4>
                                            <p class="points"><?php echo number_format($reward->points_required); ?> Points</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="no-rewards">No rewards available for this brand.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-brands">
                    <p>No brands available.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <?php include 'application/views/layout/Footer.php'; ?>
    </div>
</body>

</html>