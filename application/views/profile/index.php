<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/profil.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="title">
            <img src="<?php echo base_url('assets/image/logo/logo-terasjapan-black.png') ?>" alt="Teras Japan">
            Teras Heroes Club
        </div>
    </div>

    <!-- Profile Section -->
    <div class="w-full max-w-[400px] bg-white rounded-lg shadow-lg mb-4">
        <div class="flex justify-between items-center p-4">
            <?php if ($user): ?>
                <div class="flex gap-4 items-center">
                    <img src="<?php echo base_url('assets/image/Profpic/' . ($user->profile_pic ? $user->profile_pic : 'profile.jpg')); ?>" 
                         alt="Profile Picture" 
                         class="w-[60px] h-[60px] rounded-full object-cover">
                    <div class="flex flex-col gap-1">
                        <h2><?php echo $user->name; ?></h2>
                        <p>Level: <?php echo $user->lv_member; ?></p>
                        <p class="text-yellow-500"><?php echo $user->poin; ?> Ryo Coin</p>
                        <p class="text-yellow-500">Saldo: Rp <?php echo number_format($user->balance, 0, ',', '.'); ?></p>
                    </div>
                </div>
                <img src="<?php echo base_url('assets/image/icon/setting.png'); ?>" alt="Settings" class="settings-icon" onclick="window.location.href='<?php echo base_url('setting') ?>'">
            <?php else: ?>
                <div class="flex gap-4 items-center">
                    <img src="<?php echo base_url('assets/image/Profpic/profile.jpg'); ?>" 
                         alt="Guest Profile" 
                         class="w-[60px] h-[60px] rounded-full object-cover">
                    <div class="flex flex-col gap-1">
                        <h2>Join the exclusive community!</h2>
                        <a href="<?php echo site_url('auth/login'); ?>" 
                           class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                           Login
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="p-3 sm:p-4 mb-3 sm:mb-4 text-sm text-custom-outline bg-red-100 rounded-lg" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="menu-section">
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/Benefit') ?>'">
            <span>Benefit</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/mission') ?>'">
            <span>Mission</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="showReferralPopup()">
            <span>Referral</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="checkLoginStatus()">
            <span>My Voucher</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/contactus') ?>'">
            <span>Contact Us</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/terms_conditions') ?>'">
            <span>Terms & Conditions</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/privacypolicy') ?>'">
            <span>Privacy Policy</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/faq'); ?>'">
            <span>FAQ</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/feedback'); ?>'">
            <span>Send Feedback</span>
            <span class="arrow">></span>
        </div>
        <div class="menu-item" onclick="window.location.href='<?php echo base_url('profile/about'); ?>'">
            <span>About</span>
            <span class="arrow">></span> 
        </div>
    </div>

    <?php if($this->session->userdata('user_id')): ?>
        <div class="logout-section">
            <div class="rectangle" onclick="showLogoutPopup()">
                <p class="text">Log Out</p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Popup Logout -->
    <div id="logoutPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeLogoutPopup()">&times;</span>
            <h2>Confirm Logout</h2>
            <img src="<?php echo base_url('assets/image/icon/exit.png'); ?>" alt="Logout Confirmation" class="logout-image">
            <p>Are you sure you want to logout?</p>
            <div class="button-container">
                <a href="<?php echo base_url('profile/logout') ?>">
                    <div class="rectangle confirm-btn">
                        <p class="text">Log Out</p>
                    </div>
                </a>
                <div class="rectangle cancel-btn" onclick="closeLogoutPopup()">
                    <p class="text">Cancel</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Edit Success -->
    <div id="edit-popup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeEditPopup()">&times;</span>
            <h2>Edit profile successfully</h2>
            <img src="<?php echo base_url('assets/image/icon/centang.png'); ?>" alt="Success change" class="logout-image">
            <p>Your profile has been updated.</p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="closeEditPopup()">
                    <p class="text">Oke</p>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('successEdit')): ?>
        <script>
            const editPopup = document.getElementById('edit-popup');
            editPopup.style.display = 'flex';
        </script>
    <?php endif; ?>

    <!-- Popup Referral -->
    <div id="referralPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeReferralPopup()">&times;</span>
            <h2>KODE REFERRAL</h2>
            <div class="referral-code">
                <?php if(isset($user)): ?>
                    <?php echo $referral_code ?? 'No referral code available'; ?>
                <?php else: ?>
                    <p>Please login to view your referral code</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Popup Voucher -->
    <div id="VoucherPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeVoucherPopup()">&times;</span>
            <h2>VOUCHER CODE</h2>
            <div class="referral-code">
                <?php if(isset($user)): ?>
                    <?php echo $voucher_code ?? 'No voucher code available'; ?>
                <?php else: ?>
                    <p>Heroes, please login first to see your voucher.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Popup Login -->
    <div id="loginPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeLoginPopup()">&times;</span>
            <p>Please log in to access this feature.</p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="redirectToLogin()">
                    <p class="text">OK</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script untuk mengontrol popup -->
    <script>
        function checkLoginStatus() {
            <?php if ($user): ?>
                // Jika user sudah login, arahkan ke halaman profile/myvoucher
                window.location.href = "<?php echo base_url('profile/myvoucher'); ?>";
            <?php else: ?>
                // Jika user belum login, tampilkan popup untuk login
                showVoucherPopup();
            <?php endif; ?>
        }

        function showVoucherPopup() {
            document.getElementById('VoucherPopup').style.display = 'flex';
        }

        function closeVoucherPopup() {
            document.getElementById('VoucherPopup').style.display = 'none';
        }

        window.onclick = function(event) {
            var popup = document.getElementById('VoucherPopup');
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        }

        function showLogoutPopup() {
            document.getElementById('logoutPopup').style.display = 'flex';
        }

        function closeLogoutPopup() {
            document.getElementById('logoutPopup').style.display = 'none';
        }

        function closeEditPopup() {
            document.getElementById('edit-popup').style.display = 'none';
        }

        function closeReferralPopup() {
            document.getElementById('referralPopup').style.display = 'none';
        }

        function showReferralPopup() {
            <?php if ($this->session->userdata('user_id')): ?>
                // Jika user sudah login, arahkan ke halaman referral
                window.location.href = "<?php echo base_url('profile/referral'); ?>";
            <?php else: ?>
                // Jika user belum login, tampilkan popup untuk login
                document.getElementById('referralPopup').style.display = 'flex';
            <?php endif; ?>
        }
    </script>


</body>
<?php include 'application/views/layout/FooterTailwind.php'; ?>
</html>
