<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem Voucher</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/redeem.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
</head>
<body>
<div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Redeem Voucher</div>
    </div>
<div class="container">
        <div class="content-top">
            <img src="https://terasjapan.com/ImageTerasJapan/reward/<?php echo $voucher->image_name; ?>" 
                 alt="<?php echo $voucher->title; ?> image">
            <div>
                <h1><?php echo $voucher->title; ?></h1>
                <span class="badge <?php echo strtolower($voucher->status); ?>"><?php echo $voucher->status; ?></span>
            </div>
        </div>
        <p class="description">
            <!-- Deskripsi bisa ditambahkan di sini jika ada -->
        </p>
        <div class="info">
            <div class="row">
                <span>Brand</span>
                <span class="value">
                    <?php 
                    log_message('debug', 'Full voucher object in view: ' . print_r($voucher, true));
                    log_message('debug', 'Brand name in view: ' . ($voucher->brand_name ?? 'null'));
                    echo $voucher->brand_name ?? '-'; 
                    ?>
                </span>
            </div>
            <div class="row">
                <span>Started on</span>
                <span class="value"><?php echo date('d-m-Y', strtotime($voucher->redeem_date)); ?></span>
            </div>
            <div class="row">
                <span>Voucher Code</span>
                <span class="value"><?php echo $voucher->kode_voucher; ?></span>
            </div>
            <div class="row">
                <span>Expired </span>
                <span class="value"><?php echo date('d-m-Y', strtotime($voucher->expires_at)); ?></span>
            </div>
        </div>
        <div class="content-bottom">
            <p>Scan code in the outlet</p>
            <img src="https://terasjapan.com/ImageTerasJapan/qrcode/<?php echo $voucher->qr_code_url; ?>" 
                 alt="QR code for voucher">
            <p class="note">Note: Don't give this voucher code to anyone</p>
        </div>
    </div>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
