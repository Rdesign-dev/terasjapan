<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Check-In</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/checkin.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Daily Check-In</div>
    </div>

    <div class="checkin-container">
        <div class="checkin-header">
            <div class="checkin-title">Daily Check-In Rewards</div>
            <div class="checkin-subtitle">Check in daily to earn Ryo Points!</div>
        </div>

        <div class="checkin-grid">
            <?php 
            $points = [10, 15, 20, 25, 30, 35, 50]; // Points for each day
            for($i = 1; $i <= 7; $i++): 
            ?>
                <div class="checkin-day <?php echo ($i < 3) ? 'checked' : ($i == 3 ? 'active' : ''); ?>">
                    <span class="day-number">Day <?php echo $i; ?></span>
                    <span class="points"><?php echo $points[$i-1]; ?> pts</span>
                </div>
            <?php endfor; ?>
        </div>

        <div class="streak-info">
            Current streak: 2 days
        </div>

        <button class="checkin-button" <?php echo ($i == 3) ? '' : 'disabled'; ?>>
            Check In Now
        </button>

        <div class="rewards-preview">
            Complete 7 days to get bonus 100 Ryo Points!
        </div>
    </div>

    <!-- Success Popup -->
    <div id="successPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeSuccessPopup()">&times;</span>
            <img src="<?php echo base_url('assets/image/icon/cek.png'); ?>" alt="Success" class="logout-image">
            <h2>Check-In Success!</h2>
            <p>You've earned <span class="earned-points">25</span> Ryo Points</p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="closeSuccessPopup()">
                    <p class="text">OK</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.checkin-button').addEventListener('click', function() {
            // Show success popup
            document.getElementById('successPopup').style.display = 'flex';
        });

        function closeSuccessPopup() {
            document.getElementById('successPopup').style.display = 'none';
            // Refresh page or update UI
            location.reload();
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>