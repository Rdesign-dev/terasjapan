<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Voucher</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/myvoucher.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
</head>
<body>

    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">My Voucher</div>
    </div>
    <div class="voucher-container">
        <?php if (!empty($vouchers)): ?>
            <?php foreach ($vouchers as $voucher): ?>
                <?php $is_available = $voucher->status === 'Available'; ?>
                
                <div class="voucher-item <?php echo $is_available ? 'clickable' : 'disabled'; ?>">
                    <?php if ($is_available): ?>
                        <a href="<?php echo site_url('profile/redeem?voucher_id=' . $voucher->kode_voucher); ?>" class="voucher-link">
                    <?php endif; ?>

                        <img src="<?php echo base_url("assets/image/reward/{$voucher->image_name}"); ?>" 
                            alt="<?php echo $voucher->title; ?>" class="voucher-image">
                        
                        <div class="voucher-info">
                            <div class="voucher-details">
                                <h3><?php echo $voucher->title; ?></h3>
                                <p class="voucher-status <?php echo strtolower($voucher->status); ?>">
                                    <?php echo $voucher->status; ?>
                                </p>
                            </div>

                            <div class="voucher-expired">
                                <?php
                                if ($is_available) {
                                    $now = new DateTime();
                                    $expires_at = new DateTime($voucher->expires_at);
                                    $interval = $now->diff($expires_at);

                                    if ($interval->invert == 0) {
                                        if ($interval->days > 0) {
                                            echo '<p>Expires in: ' . $interval->days . ' days</p>';
                                        } elseif ($interval->h > 0) {
                                            echo '<p>Expires in: ' . $interval->h . ' hours</p>';
                                        } elseif ($interval->i > 0) {
                                            echo '<p>Expires in: ' . $interval->i . ' minutes</p>';
                                        } else {
                                            echo '<p>Expires soon</p>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    <?php if ($is_available): ?>
                        </a>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-voucher">
                <p>No vouchers available.</p>
            </div>
        <?php endif; ?>
    </div>



    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab');

            const containers = document.querySelectorAll('.benefit-container');
            containers.forEach(container => (container.style.display = 'none'));

            document.getElementById(tabId).style.display = 'flex';
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
<?php include 'application/views/layout/Footer.php'; ?>
</html>