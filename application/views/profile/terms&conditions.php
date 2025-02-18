<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/terms&conditions.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
</head>
<body>
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">←</button>
        <div class="title">Terms & Conditions</div>
    </div>
    
    <div class="container">
        <h1>Welcome to <strong>Teras Japan</strong>! By registering and using our services, you agree to comply with the following terms and conditions. Please read them carefully.</h1>
            <h2>Definitions</h2>
            <ul>
                <li><strong>App</strong> : The digital platform <strong>Teras Japan</strong> that provides membership services.</li>
                <li><strong>User</strong> : Any individual who registers and uses this application.</li>
                <li><strong>Membership</strong> : A user’s access to exclusive features based on the selected membership level.</li>
                <li><strong>Points & Rewards</strong> : A reward system that allows users to earn and redeem points for various benefits.</li>
            </ul>

            <h2>Registration and Account</h2>
            <ul>
                <li>You must be at least 18 years old or have parental/guardian consent to use this application.</li>
                <li>Users must provide accurate information and update their details if any changes occur.</li>
                <li>Users are responsible for maintaining account security. We are not liable for any misuse of accounts due to user negligence.</li>
            </ul>

            <h2>Membership and Benefits</h2>
            <ul>
                <li>Different membership types offer various exclusive benefits.</li>
                <li>Membership benefits are non-transferable and intended for personal use only.</li>
                <li>Users may cancel their membership at any time through account settings.</li>
            </ul>

            <h2>Points & Rewards</h2>
            <ul>
                <li>Points can be earned through transactions and specific activities within the app.</li>
                <li>Points have an expiration date and may be forfeited if not redeemed within the given timeframe.</li>
                <li>Rewards are subject to availability, non-transferable, and cannot be exchanged for cash.</li>
            </ul>

            <h2>Payments and Subscriptions</h2>
            <ul>
                <li>Some premium features require payment through available methods in the app.</li>
                <li>Membership fees are non-refundable except under specific conditions determined by <strong>Teras Japan</strong>.</li>
                <li>Auto-renewal may apply to paid memberships unless canceled before the next billing cycle.</li>
            </ul>

            <h2>Prohibited Actions and Restrictions</h2>
                <p>Users are strictly prohibited from:</p>
            <ul>
                <li>Using the app for illegal or unethical purposes.</li>
                <li>Exploiting the points and rewards system through fraudulent means.</li>
                <li>Sharing account information with unauthorized parties.</li>
            </ul>
                <p>We reserve the right to suspend or terminate accounts found in violation of these terms.</p>
            
            <h2>Changes to Terms & Conditions</h2>
                <p>We may update these terms and conditions at any time. Changes will be communicated via the app or email. By continuing to use the services, you agree to the revised terms.</p>
            
            <h2>Limitation of Liability</h2>
            <ul>
                <li>We are not responsible for any losses or damages resulting from the use of this application.</li>
                <li>We reserve the right to modify or discontinue services without prior notice.</li>
            </ul>

            <h2>Contact Us</h2>
                <p>If you have any questions or complaints regarding our services, please contact us:</p>
            <ul>
                <li><strong>Email</strong> : <a href="mailto:cs@terasjapan.com" style="text-decoration: none;">cs@terasjapan.com</li></a>
                <li><strong>Phone</strong> : <a href="https://wa.me/6281011348123" style="text-decoration: none;">+62 810 1134 8123</li></a>
                <li><strong>Address</strong> : Jl. Pare No.34 Blok A1, RT.001/RW.008, Rw. Buntu, Kec. Serpong, Kota Tangerang Selatan, Banten 15318.</li>
            </ul>
                <p>By using this app, you agree to all the terms and conditions stated above.</p>
        </section>
        <div class="last-update">Last Update: 20-10-2025</div>
    </div>

    <script>
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
