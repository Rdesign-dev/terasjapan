<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/history.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>"> 
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Transaction</div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <div class="tab active" onclick="showTab('exclusive')">Voucher</div>
        <div class="tab" onclick="showTab('newbie')">Balance</div>
    </div>

    <!-- Benefit Container -->
    <div class="benefit-container" id="exclusive">
        <?php if (!empty($vouchers)): ?>
            <?php foreach ($vouchers as $voucher): ?>
                <div class="benefit-item" onclick="window.location.href='<?php echo site_url('profile/redeem?voucher_id=' . $voucher->kode_voucher); ?>'">
                    <h3><?php echo htmlspecialchars($voucher->reward_title); ?></h3>
                    <p>Point redemption is done at <strong><?php echo date('d-m-Y', strtotime($voucher->redeem_date)); ?></strong> 
                       and uses <strong><?php echo number_format($voucher->points_used); ?></strong> points.</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php if ($this->session->userdata('user_id')): ?>
                <div class="center-container">
                    <img src="<?php echo base_url('assets/image/konten/konten3.png'); ?>" alt="No History">
                    <p><strong>You don't have transaction history</strong></p>
                </div>
            <?php else: ?>
                <div class="center-container">
                    <img src="<?php echo base_url('assets/image/konten/konten3.png'); ?>" alt="No History">
                    <p><strong>log in first to access your transaction history.</strong></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="benefit-container" id="newbie" style="display: none;">
        <?php if ($this->session->userdata('user_id')): ?>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <div class="benefit-item" 
                        <?php if ($transaction->transaction_type == 'Balance Top-up'): ?>
                            onclick="window.location.href='<?php echo site_url('history/transaction/' . $transaction->transaction_id); ?>'"
                        <?php elseif ($transaction->transaction_type == 'Teras Japan Payment'): ?>
                            onclick="window.location.href='<?php echo site_url('history/balance/' . $transaction->transaction_id); ?>'"
                        <?php endif; ?>>
                        <h3><?php echo $transaction->transaction_type; ?></h3>
                        <p><?php echo $transaction->transaction_type; ?> transaction of <strong>IDR <?php echo number_format($transaction->amount, 0, ',', '.'); ?></strong> has been successfully completed.</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="center-container">
                    <img src="<?php echo base_url('assets/image/konten/konten3.png'); ?>" alt="No History">
                    <p><strong>You don't have any balance transactions yet</strong></p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="center-container">
                <img src="<?php echo base_url('assets/image/konten/konten3.png'); ?>" alt="No History">
                <p><strong>log in first to access your transaction history.</strong></p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));

            const containers = document.querySelectorAll('.benefit-container');
            containers.forEach(container => (container.style.display = 'none'));

            document.getElementById(tabId).style.display = 'flex';
            document.querySelector(`.tab[onclick="showTab('${tabId}')"]`).classList.add('active');
        }

        // Add script to keep profile active in footer
        window.onload = function() {
            const profileLink = document.querySelector('.footer a[href="history"]');
            if (profileLink) {
                profileLink.classList.add('active');
            }
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
