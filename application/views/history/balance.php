<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/transaction.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
</head>
<body>
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Transaction</div>
    </div>
    <div class="content">
        <div class="logo-container">
            <img src="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>" alt="Amigos logo">
            <h1>Amigos Mulia Indonesia</h1>
        </div>
        <div class="details">
            <div class="details-row">
                <span>Date</span>
                <span><?php echo date('d-m-Y', strtotime($transaction->created_at)); ?></span>
            </div>

            <div class="details-row">
                <span>Outlet</span>
                <span><?php echo $transaction->branch_name ?? 'Online Transaction'; ?></span>
            </div>

            <div class="details-row">
                <span>Voucher code</span>
                <?php if ($transaction->kode_voucher): ?>
                    <div class="voucher-info">
                        <span class="voucher-code"><?php echo $transaction->kode_voucher; ?></span>
                        </span>
                    </div>
                <?php else: ?>
                    <span>No voucher used</span>
                <?php endif; ?>
            </div>

            <div class="details-row">
                <span>Payment Method</span>
                <div class="payment-methods">
                    <?php if (!empty($transaction->payments)): ?>
                        <?php foreach ($transaction->payments as $payment): ?>
                            <div class="payment-item">
                                <?php echo ucfirst($payment->payment_method); ?>: 
                                Rp <?php echo number_format($payment->amount, 0, ',', '.'); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span>No payment information available</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="details-row">
                <span>Total Amount</span>
                <span>Rp <?php echo number_format($transaction->amount, 0, ',', '.'); ?></span>
            </div>
        </div>
        <div class="transaction-summary">
            <span id="toggleDetail">Payment Receipt</span>
            <div class="receipt-container" id="receiptContainer">
                <img src="<?php echo base_url('../ImageTerasJapan/transaction_proof/Payment/' . $transaction->transaction_evidence); ?>" alt="Struk Pembayaran">
            </div>
        </div>
    </div>

    

    <script>
        window.onload = function() {
            const profileLink = document.querySelector('.footer a[href="history.php"]');
            if (profileLink) {
                profileLink.classList.add('active');
            }
        }

        document.getElementById("toggleDetail").addEventListener("click", function () {
            let receipt = document.getElementById("receiptContainer");

            // Toggle tampilan struk
            if (receipt.style.display === "none" || receipt.style.display === "") {
                receipt.style.display = "block"; // Tampilkan jika sebelumnya tersembunyi
            } else {
                receipt.style.display = "none"; // Sembunyikan jika sudah tampil
            }
        });
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
