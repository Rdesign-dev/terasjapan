<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Cabang</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/alamat.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="history.back()">←</button>
        <div class="title">Alamat Cabang</div>
    </div>

    <!-- Banner -->
    <div class="banner">
        <img src="<?php echo base_url('assets/image/banner/banner2.png') ?>" alt="Banner Image">
    </div>

    <!-- Logo Container -->
    <div class="logo-container">
        <img src="<?php echo base_url('assets/image/logo/logo-terasjapan-black.png') ?>" alt="Logo Teras Japan" class="logo" onclick="showTerasJapanAddresses()">
        <img src="<?php echo base_url('assets/image/logo/logo-tottori.png') ?>" alt="Logo 2" class="logo" onclick="showtottoriAddresses()">
        <img src="<?php echo base_url('assets/image/logo/logo-amigosbeauty.png') ?>" alt="Logo 3" class="logo" onclick="showamigosbeautyAddresses()">
        <img src="<?php echo base_url('assets/image/logo/logo-toyofuku.png') ?>" alt="Logo 4" class="logo" onclick="showtoyofukuAddresses()">
        <img src="<?php echo base_url('assets/image/logo/logo-wataame.png') ?>" alt="Logo 5" class="logo" onclick="showwataameAddresses()">
    </div>

    <!-- Branches Section -->
    <div class="branches-section">
        <div class="branch-item">
            <div class="branch-header">
                <h2>Pasar Modern BSD</h2>
                <div class="logos">
                    <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                </div>
            </div>
            <p>Jl. Letnan Sutopo No.30, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</p>
        </div>
        <div class="branch-item">
            <div class="branch-header">
                <h2>Chillax Sudirman</h2>
                <div class="logos">
                    <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                </div>
            </div>
            <p>Jl. Jenderal Sudirman No.KAV 23, Kuningan, Karet, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12920</p>
        </div>
        <div class="branch-item">
            <div class="branch-header">
                <h2>ICE Business Park BSD</h2>
                <div class="logos">
                    <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                </div>
            </div>
            <p>Jl. BSD Grand Boulevard No.12, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339</p>
        </div>
        <div class="branch-item">
            <div class="branch-header">
                <h2>Cikole Sukabumi</h2>
                <div class="logos">
                    <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                </div>
            </div>
            <p>Jl. Surya Kencana No.64, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
        </div>
        <div class="branch-item">
            <div class="branch-header">
                <h2>Teras Japan Banjarmasin</h2>
                <div class="logos">
                    <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                </div>
            </div>
            <p>Jl. A. Yani No.KM 6 6, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70654</p>
        </div>
        <div class="branch-item">
            <div class="branch-header">
                <h2>Purwokerto - Hangout Caffe</h2>
                <div class="logos">
                    <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                    <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                </div>
            </div>
            <p>Jl. Profesor DR. HR Boenyamin, Glempang, Purwokerto Lor, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53121</p>
        </div>
        <!-- Duplicate the above div for more branches -->
    </div>

    <script>
        function showTerasJapanAddresses() {
            document.querySelector('.branches-section').innerHTML = `
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Pasar Modern BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Letnan Sutopo No.30, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Teras Japan Banjarmasin</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. A. Yani No.KM 6 6, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70654</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Cikole Sukabumi</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Surya Kencana No.64, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Purwokerto - Hangout Caffe</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Profesor DR. HR Boenyamin, Glempang, Purwokerto Lor, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53121</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Chillax Sudirman</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Jenderal Sudirman No.KAV 23, Kuningan, Karet, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12920</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>ICE Business Park BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. BSD Grand Boulevard No.12, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339</p>
                </div>
            `;
        }

        function showtottoriAddresses() {
            document.querySelector('.branches-section').innerHTML = `
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Pasar Modern BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Letnan Sutopo No.30, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Teras Japan Banjarmasin</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. A. Yani No.KM 6 6, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70654</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Cikole Sukabumi</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Surya Kencana No.64, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Purwokerto - Hangout Caffe</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Profesor DR. HR Boenyamin, Glempang, Purwokerto Lor, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53121</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Chillax Sudirman</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Jenderal Sudirman No.KAV 23, Kuningan, Karet, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12920</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>ICE Business Park BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. BSD Grand Boulevard No.12, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339</p>
                </div>
                <!-- Tambahkan alamat lainnya untuk logo lain -->
            `;
        }

        function showamigosbeautyAddresses() {
            document.querySelector('.branches-section').innerHTML = `
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Pasar Modern BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Letnan Sutopo No.30, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Teras Japan Banjarmasin</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. A. Yani No.KM 6 6, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70654</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Cikole Sukabumi</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Surya Kencana No.64, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Purwokerto - Hangout Caffe</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Profesor DR. HR Boenyamin, Glempang, Purwokerto Lor, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53121</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Chillax Sudirman</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Jenderal Sudirman No.KAV 23, Kuningan, Karet, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12920</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>ICE Business Park BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. BSD Grand Boulevard No.12, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339</p>
                </div>
                <!-- Tambahkan alamat lainnya untuk logo lain -->
            `;
        }

        function showtoyofukuAddresses() {
            document.querySelector('.branches-section').innerHTML = `
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Pasar Modern BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Letnan Sutopo No.30, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Teras Japan Banjarmasin</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. A. Yani No.KM 6 6, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70654</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Cikole Sukabumi</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Surya Kencana No.64, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Purwokerto - Hangout Caffe</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Profesor DR. HR Boenyamin, Glempang, Purwokerto Lor, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53121</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Chillax Sudirman</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Jenderal Sudirman No.KAV 23, Kuningan, Karet, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12920</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>ICE Business Park BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. BSD Grand Boulevard No.12, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339</p>
                </div>
                <!-- Tambahkan alamat lainnya untuk logo lain -->
            `;
        }

        function showwataameAddresses() {
            document.querySelector('.branches-section').innerHTML = `
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Pasar Modern BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Letnan Sutopo No.30, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Teras Japan Banjarmasin</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. A. Yani No.KM 6 6, Pemurus Dalam, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70654</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Cikole Sukabumi</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Surya Kencana No.64, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Purwokerto - Hangout Caffe</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Profesor DR. HR Boenyamin, Glempang, Purwokerto Lor, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53121</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>Chillax Sudirman</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. Jenderal Sudirman No.KAV 23, Kuningan, Karet, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12920</p>
                </div>
                <div class="branch-item">
                    <div class="branch-header">
                        <h2>ICE Business Park BSD</h2>
                        <div class="logos">
                            <img src="<?php echo base_url('assets/image/logo/logo1.png') ?>" alt="Logo 1" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo2.png') ?>" alt="Logo 2" class="logo">
                            <img src="<?php echo base_url('assets/image/logo/logo3.png') ?>" alt="Logo 3" class="logo">
                        </div>
                    </div>
                    <p>Jl. BSD Grand Boulevard No.12, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339</p>
                </div>
                <!-- Tambahkan alamat lainnya untuk logo lain -->
            `;
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>