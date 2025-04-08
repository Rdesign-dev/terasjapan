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
            <?php foreach ($all_brands as $brand): ?>
                <div class="brand-reward-block">
                    <h3 class="brand-reward-title"><?php echo $brand->name; ?></h3>
                    <div class="reward-items">
                        <?php foreach ($brand->rewards as $reward): ?>
                            <div class="reward-item">
                                <img src="http://localhost/ImageTerasJapan/reward/<?php echo $reward->image; ?>" alt="<?php echo $reward->name; ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Footer -->
        <?php include 'application/views/layout/Footer.php'; ?>
    </div>
</body>

</html>