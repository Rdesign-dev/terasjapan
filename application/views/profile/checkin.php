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
            // Static data for UI testing
            $days_data = [
                ['day' => 1, 'points' => 10, 'status' => 'checked'],
                ['day' => 2, 'points' => 15, 'status' => 'checked'],
                ['day' => 3, 'points' => 20, 'status' => 'active'],
                ['day' => 4, 'points' => 25, 'status' => ''],
                ['day' => 5, 'points' => 30, 'status' => ''],
                ['day' => 6, 'points' => 35, 'status' => ''],
                ['day' => 7, 'points' => 50, 'status' => '']
            ];

            foreach($days_data as $day): 
            ?>
                <div class="checkin-day <?php echo $day['status']; ?>">
                    <span class="day-number">Day <?php echo $day['day']; ?></span>
                    <span class="points"><?php echo $day['points']; ?> pts</span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="streak-info">
            Current streak: 2 days
        </div>

        <button class="checkin-button">
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
            <p>You've earned <span class="earned-points">20</span> Ryo Points</p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="closeSuccessPopup()">
                    <p class="text">OK</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Static demo functionality
        document.querySelector('.checkin-button').addEventListener('click', function() {
            document.getElementById('successPopup').style.display = 'flex';
        });

        function closeSuccessPopup() {
            document.getElementById('successPopup').style.display = 'none';
            // Just reload page for demo
            location.reload();
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>