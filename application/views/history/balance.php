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
            <div class="detail-item">
                <p>Date</p>
                <span class="value"><?php echo date('d-m-Y', strtotime($transaction->created_at)); ?></span>
            </div>
            <div class="detail-item">
                <p>Outlet</p>
                <span class="value"><?php echo $branch->branch_name; ?></span>
            </div>
            <div class="detail-item">
                <p>Cashier Name</p>
                <span class="value"><?php echo ucwords($cashier->name); ?></span> <!-- Tampilkan nama kasir dengan huruf kapital di setiap kata -->
            </div>
            <div class="detail-item">
                <p>Payment Method</p>
                <span class="value"><?php echo $transaction->payment_method; ?></span>
            </div>
            <div class="total-payment">
                <span>Total Payments</span>
                <span class="amount">Rp<?php echo number_format($transaction->amount, 0, ',', '.'); ?></span>
            </div>
        </div>
        <div class="transaction-summary">
            <span id="toggleDetail">Payment Receipt</span>
            <div class="receipt-container" id="receiptContainer">
                <img src="<?php echo base_url('assets/image/transaction_proof/' . $transaction->transaction_evidence); ?>" alt="Struk Pembayaran">
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
