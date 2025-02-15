<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/about.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">←</button>
        <div class="title">About Teras Japan</div>
    </div>

    <!-- FAQ Container -->
    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question"><strong>1. Who We Are ?</strong></div>
            <div class="faq-answer">Welcome to <strong>Teras Japan</strong>, your ultimate membership program designed to offer exclusive rewards, benefits, and personalized experiences. We aim to provide our members with the best deals, special perks, and seamless access to exciting offers</div>
        </div>
        <div class="faq-item">
            <div class="faq-question"><strong>2. Our Mission</strong></div>
            <div class="faq-answer">At <strong>Teras Japan</strong>, we believe that loyalty deserves to be rewarded. Our mission is to create a rewarding experience where every interaction counts, ensuring that our members get the most value from their purchases and engagement.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question"><strong>3. What We Offer ?</strong></div>
            <div class="faq-answer">
                <ul>
                    <li><strong>Exclusive Rewards</strong> = Earn points and redeem them for special deals and discounts.</li>
                    <li><strong>Personalized Offers</strong> = Get tailored promotions based on your preferences.</li>
                    <li><strong>Seamless Experience</strong> = Enjoy a user-friendly platform with easy navigation.</li>
                    <li><strong>Premium Membership Benefits</strong> = Unlock VIP perks with premium subscription options.</li>
                </ul>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question"><strong>4. Why Choose Us ?</strong></div>
            <div class="faq-answer">
                <ul>
                    <li><strong>Trusted by Thousands of Users</strong> = Our platform is designed to ensure transparency and security for all our members.</li>
                    <li><strong>Easy & Fast Redemption</strong> = Earn and use rewards effortlessly with just a few clicks.</li>
                    <li><strong>Regular Updates & Special Events</strong> = We keep our members engaged with ongoing promotions, events, and seasonal offers.</li>
                </ul>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question"><strong>5. Join Us Today !</strong></div>
            <div class="faq-answer">
            Become a member of <strong>Teras Japan</strong> and start enjoying exclusive benefits today. Sign up now and make every moment more rewarding!
                <ul>
                    <li>Email: <a href="mailto:cs@terasjapan.com" class="contact-item" style="text-decoration: none;">cs@terasjapan.com</a></li>
                    <li>Phone: <a href="https://wa.me/6281011348123" class="contact-item" style="text-decoration: none;">+62 810 1134 8123</a></li>
                    <li>Address: Jl. Pare No.34 Blok A1, RT.001/RW.008, Rw. Buntu, Kec. Serpong, Kota Tangerang Selatan, Banten 15318.</li>
                </ul>
            </div>
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
    <script>
        window.onload = function() {
            const profileLink = document.querySelector('.footer a[href="history.php"]');
            if (profileLink) {
                profileLink.classList.add('active');
            }
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
