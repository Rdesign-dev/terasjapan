<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mission.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">Mission</div>
    </div>

    <!-- Mission Container -->
    <div class="mission-container">
        <?php if (isset($missions_available) && $missions_available): ?>
            <?php foreach ($missions as $mission): ?>
                <div class="Mission-item <?php echo strtolower($mission->status); ?>">
                    <h3><?php echo $mission->title; ?></h3>
                    <p><?php echo $mission->description; ?></p>
                    <div class="mission-reward">
                        <span class="mission-status <?php echo strtolower($mission->status); ?>">
                            <?php echo $mission->status; ?>
                        </span>
                        <span class="point-badge">
                            <i class="fas fa-star"></i> <?php echo number_format($mission->point_reward); ?> Points
                        </span>
                        <?php if($mission->completed_at): ?>
                            <span class="completion-date">
                                Completed on: <?php echo date('d M Y', strtotime($mission->completed_at)); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-mission">
                <p>No missions available at this time.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
