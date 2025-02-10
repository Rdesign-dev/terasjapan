<!DOCTYPE html>

<!-- Oke aman  -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/setting.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">ACCOUNT</div>
    </div>

    <!-- Menu Section -->
    <div class="menu-section">
        <a href="<?php echo base_url('profile/setting/editprofile') ?>" class="menu-item">
            <span>Edit Profil</span>
            <span class="arrow">></span>
        </a>
        <a href="<?php echo base_url('profile/setting/change-email') ?>" class="menu-item">
            <span>Change Email</span>
            <span class="arrow">></span>
        </a>
        <a href="<?php echo base_url('profile/setting/delete-account') ?>" class="menu-item">
            <span>Delete Account</span>
            <span class="arrow">></span>
        </a>
    </div>

    <!-- Tambahkan script untuk mengontrol popup -->
    <script>
        function showReferralPopup() {
            document.getElementById('referralPopup').style.display = 'flex';
        }

        function closeReferralPopup() {
            document.getElementById('referralPopup').style.display = 'none';
        }

        // Menutup popup ketika mengklik di luar popup
        window.onclick = function(event) {
            var popup = document.getElementById('referralPopup');
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
