<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teras Heroes Club</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/refferal.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="icon" type="image/x-icon" href="https://terasjapan.com/ImageTerasJapan/logo/logo-amigos.png">
</head>
<body>
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">Referral</div>
    </div>
    <div class="container">
        <div class="center">
            <img src="https://terasjapan.com/ImageTerasJapan/konten/refferal.jpg" alt="Two people holding phones">
        </div>
        <h1 class="title">Earn Poin By Inviting Friends</h1>
        <div class="input-group">
            <input type="text" value="<?php echo $referral_code; ?>" readonly>
            <button class="copy-btn" onclick="copyReferralCode()">Copy</button>
        </div>
    </div>
    <div class="container friends-list">
        <div class="flex justify-between items-center mb-4">
            <h2>Friends who use your referral</h2>
        </div>
        <?php if (!empty($referral_redeem_data)): ?>
            <?php foreach ($referral_redeem_data as $redeem): ?>
                <div class="friend-item">
                    <div class="friend-info">
                        <div class="avatar">
                            <?php 
                            $profilePic = !empty($redeem->referred_user_profile_pic) 
                                ? "https://terasjapan.com/ImageTerasJapan/ProfPic/" . $redeem->referred_user_profile_pic 
                                : "https://terasjapan.com/ImageTerasJapan/ProfPic/profile.jpg"; 
                            ?>
                            <img src="<?php echo $profilePic; ?>" alt="<?php echo $redeem->referred_user_name; ?>">
                        </div>
                        <div class="details">
                            <p class="name"><?php echo $redeem->referred_user_name; ?></p>
                            <p class="platform"><?php echo date('d M Y', strtotime($redeem->redeem_date)); ?></p>
                        </div>
                    </div>
                    <button class="point-btn">Point : <?php echo $redeem->referrer_points; ?></button> 
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-friends" style="text-align: center; margin-top: 20px;">
            <p style="color: #888; font-size: 16px;">No friends have used your referral code yet.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function copyReferralCode() {
            var copyText = document.querySelector('.input-group input');
            copyText.select();
            document.execCommand("copy");
            alert("Referral code copied: " + copyText.value);
        }

        function shareReferralCode() {
            var referralCode = document.querySelector('.input-group input').value;
            var shareText = `Hey! I just joined Japan Heroes at membership.terasjapan.com. There are tons of exclusive promos and reward points waiting for you! Don’t forget to use the referral code **${referralCode}** when signing up to enjoy extra benefits! Come join us now!`;

            if (navigator.share) {
                navigator.share({
                    title: 'Teras Heroes Club',
                    text: shareText,
                    url: window.location.href
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(console.error);
            } else {
                alert("Sharing not supported on this browser. Please copy the referral code manually.");
            }
        }

        window.onload = function() {
            const profileLink = document.querySelector('.footer a[href="Profile.php"]');
            if (profileLink) {
                profileLink.classList.add('active');
            }
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>