<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Cabang</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/alamat.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">Alamat Cabang</div>
    </div>

    <!-- Logo Container -->
    <div class="logo-container">
        <?php foreach ($brands as $brand): ?>
        <img src="<?php echo base_url('../ImageTerasJapan/logo/' . $brand->image) ?>" alt="<?php echo $brand->name ?>"
            class="logo" onclick="showAddresses(<?php echo $brand->id ?>)">
        <?php endforeach; ?>
    </div>

    <!-- Branches Section -->
    <div class="branches-section">
        <!-- Alamat cabang akan ditampilkan di sini -->
    </div>

    <script>
    function showAddresses(brandId) {
        $.ajax({
            url: '<?php echo base_url('home/get_addresses_by_brand/') ?>' + brandId,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var branchesSection = $('.branches-section');
                branchesSection.empty();

                data.forEach(function(address) {
                    var logos = "";
                    if (address.brand_images) {
                        var logoArray = address.brand_images.split(',');
                        logoArray.forEach(function(image) {
                            logos +=
                                '<img src="<?php echo base_url('../ImageTerasJapan/logo/') ?>' +
                                image.trim() +
                                '" alt="Logo" class="logo" style="width:auto; height:18px;">';
                        });
                    }

                    branchesSection.append(`
                    <div class="branch-item">
                        <div class="branch-header">
                            <h2>${address.city}</h2>
                            <div class="logos">${logos}</div>
                        </div>
                        <p>${address.address}</p>
                    </div>
                `);
                });
            }
        });
    }

    function loadAllAddresses() {
        $.ajax({
            url: '<?php echo base_url('home/get_all_addresses') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var branchesSection = $('.branches-section');
                branchesSection.empty();
                data.forEach(function(address) {
                    var logos = "";
                    if (address.brand_images) {
                        var logoArray = address.brand_images.split(',');
                        logoArray.forEach(function(image) {
                            logos += '<img src="<?php echo base_url('../ImageTerasJapan/logo/') ?>' + image.trim() + '" alt="Logo" class="logo" style="width:auto; height:18px;">';
                        });
                    }
                    branchesSection.append(`
                        <div class="branch-item">
                            <div class="branch-header">
                                <h2>${address.city}</h2>
                                <div class="logos">${logos}</div>
                            </div>
                            <p>${address.address}</p>
                        </div>
                    `);
                });
            }
        });
    }

    $(document).ready(function() {
        loadAllAddresses();
    });
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>


</html>