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
        <h1>MISSION</h1>
        <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center;">
            <img src="<?php echo base_url('assets/image/konten/konten4.png'); ?>" alt="No Mission">
            <p>Sorry no missions available at the moment</p>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
