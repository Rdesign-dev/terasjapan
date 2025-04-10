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
        <div class="title">Daily Check In</div>
    </div>


    <div class="checkin-container">
        <div class="checkin-header">
            <div class="checkin-title">Daily Check-In Rewards</div>
            <div class="checkin-subtitle">Check in daily to earn Ryo Points!</div>
        </div>

        <div class="checkin-grid">
            <?php foreach($days_data as $day): ?>
                <div class="checkin-day <?php echo $day['status']; ?>">
                    <span class="day-number">Day <?php echo $day['day']; ?></span>
                    <span class="points"><?php echo $day['points']; ?> pts</span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="streak-info">
            Current streak: <?php echo $streak_info['current_streak']; ?> days
        </div>

        <button class="checkin-button" <?php echo $streak_info['is_claimed_today'] ? 'disabled' : ''; ?>>
            <?php echo $streak_info['is_claimed_today'] ? 'Already Claimed' : 'Check In Now'; ?>
        </button>

        <div class="rewards-preview">
            Complete 7 days to get bonus <?php echo $total_bonus; ?> Ryo Points!
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
        document.querySelector('.checkin-button').addEventListener('click', function() {
            if(this.disabled) return;
            
            fetch('<?php echo base_url('checkin/claim'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    document.querySelector('.earned-points').textContent = data.points;
                    document.getElementById('successPopup').style.display = 'flex';
                } else {
                    alert(data.message);
                }
            });
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