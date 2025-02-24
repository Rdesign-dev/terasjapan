<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/faq.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">←</button>
        <div class="title">FAQ</div>
    </div>

    <!-- FAQ Container -->
    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question">Bagaimana cara menjadi member Teras Japan?</div>
            <div class="faq-answer">
                Untuk menjadi member Teras Japan, Teras Heroes dapat mengikuti langkah berikut:
                <ul>
                    <li>Akses website dengan link <a href="https://membership.terasjapan.com" target="_blank">https://membership.terasjapan.com</a></li>
                    <li>Lalu klik "Daftar sekarang" yang berada di bawah tombol login</li>
                    <li>Masukan nomor whatsapp aktif dan nama lengkap di form yang tersedia</li>
                    <li>Masukkan kode OTP yang dikirimkan ke nomor whatsapp yang didaftarkan</li>
                    <li>Setelah berhasil maka pendaftaran telah selesai dan Teras Heroes bisa update data diri secara lengkap</li>
                </ul>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Apakah membership saya memiliki masa berlaku?</div>
            <div class="faq-answer">Tidak, membership Teras Japan tidak memiliki masa berlaku.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Apakah ada biaya membership yang harus saya bayarkan?</div>
            <div class="faq-answer">Tidak ada. Teras Heroes tidak akan dikenai biaya sepeser pun saat mendaftar membership dan menjadi member Teras Japan.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Apa saja benefit menjadi Membership Teras Japan?</div>
            <div class="faq-answer">Dengan menjadi Membership Teras Japan, Teras Heroes bisa memperoleh banyak benefit, yaitu Teras Poin yang dapat digunakan untuk diskon makanan di outlet Teras Japan, voucher merchant yang bekerjasama dengan Teras Japan, Free menu setiap minggunya, Free Drink setiap kedatangan, loyalty reward, promo khusus, personalize offer, event khusus membership Teras Japan, dan lain-lain.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Bagaimana cara mengubah nomor WhatsApp/e-mail?</div>
            <div class="faq-answer">Untuk mengubah nomor whatsapp/e-mail, Teras Heroes dapat mengirim e-mail ke cs@terasjapan.com.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Apakah saya bisa melakukan transfer Teras Poin?</div>
            <div class="faq-answer">Teras Poin yang Teras Heroes miliki tidak dapat dipindahkan ke akun lain, tetapi jika Teras Heroes melakukan penggantian nomor whatsapp di akun Membership Teras Japan Teras heroes, Teras Poin yang sudah Teras Heroes miliki akan tetap ada di akun yang sama.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Bagaimana jika saya tidak menerima OTP?</div>
            <div class="faq-answer">Jika tidak menerima OTP dan sudah melebihi batas request yang ditentukan, Teras Heroes dapat mencoba kembali di hari selanjutnya. Jika kendala masih terjadi di hari selanjutnya, Teras Heroes bisa menghubungi Customer Service melalui nomor whatsapp 0881-0113-48123 atau e-mail cs@terasjapan.com.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Bagaimana jika nomor saya ditolak?</div>
            <div class="faq-answer">Jika nomor yang ingin digunakan ditolak oleh sistem, Teras Heroes bisa menghubungi Customer Service melalui nomor whatsapp 0881-0113-48123 atau e-mail cs@terasjapan.com.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Apakah saya bisa login dengan lebih dari 1 nomor?</div>
            <div class="faq-answer">Tidak. Teras Heroes hanya bisa login menggunakan 1 nomor member dalam satu perangkat.</div>
        </div>
    </div>

    <script>
        // Toggle FAQ answers
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
