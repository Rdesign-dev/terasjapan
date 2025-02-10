<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benefit</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/benefit.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Benefit</div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <?php foreach ($levels as $index => $level): ?>
            <div class="tab <?php echo $index === 0 ? 'active' : ''; ?>" onclick="showTab('<?php echo $level->id; ?>')">
                <?php echo $level->level_name; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Benefit Containers -->
    <?php foreach ($levels as $index => $level): ?>
        <div class="benefit-container" id="<?php echo $level->id; ?>" style="<?php echo $index === 0 ? '' : 'display: none;'; ?>">
            <?php foreach ($benefits[$level->id] as $benefit): ?>
                <div class="benefit-item">
                    <h3><?php echo $benefit->benefit_title; ?></h3>
                    <p><?php echo $benefit->benefit_description; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.benefit-container').forEach(container => {
                container.style.display = 'none';
            });
            document.getElementById(tabId).style.display = 'flex';

            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelector(`.tab[onclick="showTab('${tabId}')"]`).classList.add('active');
        }

        // Add script to keep profile active in footer
        window.onload = function() {
            const profileLink = document.querySelector('.footer a[href="Profile.php"]');
            if (profileLink) {
                profileLink.classList.add('active');
            }
        }
    </script>
</body>
<?php include APPPATH . 'views/layout/Footer.php'; ?>
</html>