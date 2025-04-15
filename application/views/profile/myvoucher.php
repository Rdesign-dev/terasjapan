<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Voucher</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/myvoucher.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
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

                        <img src="https://terasjapan.com/ImageTerasJapan/reward/<?php echo $voucher->image_name; ?>" 
                            alt="<?php echo $voucher->reward_title; ?>" class="voucher-image">
                        
                        <div class="voucher-info">
                            <div class="voucher-details">
                                <h3><?php echo $voucher->reward_title; ?></h3>
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
                <div class="no-voucher-content" style="text-align: center; padding: 20px;">
                    <img src="https://terasjapan.com/ImageTerasJapan/konten/konten3.png" alt="No History" style="max-width: 200px; margin-bottom: 20px;">
                    <p><strong>You don't have any vouchers yet, huhu 😢. Keep making transactions to earn awesome vouchers! 🚀</strong></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>