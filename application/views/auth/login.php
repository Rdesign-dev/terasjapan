<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <style>
        .error-field {
            color: red;
            font-size: 12px;
            margin-top: 2px;
            display: block;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .disabled {
            background-color: gray !important;
            cursor: not-allowed !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>" alt="Logo" class="logo">
        <h1>Hi, Fellas!</h1>
        <p>Welcome to membership! Let's get your own benefit</p>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="error-message" style="font-size: 12px; margin-bottom: 6px; color:red">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="success-message" style="font-size: 12px; margin-bottom: 6px; color:greenyellow">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form id="authForm" method="post" action="<?php echo isset($otp_sent) ? base_url('login/verify') : base_url('login'); ?>" enctype="multipart/form-data">
            <!-- Nomor HP field -->
            <div class="input-group">
                <input type="text" name="phone_number" placeholder="Nomor HP" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" required>
                <?php echo form_error('phone_number', '<small class="error">', '</small>'); ?>
            </div>
            <!-- OTP field (hidden until nomor is entered) -->
            <?php if (isset($otp_sent) && $otp_sent): ?>
                <div class="input-group">
                    <input type="text" name="otp" placeholder="Enter OTP" required>
                    <?php echo form_error('otp', '<small class="error">', '</small>'); ?>
                </div>
                <button type="submit" class="login-btn">Verify OTP</button>
                <button type="button" id="resendOtpBtn" class="login-btn disabled" disabled>Resend OTP</button>
            <?php else: ?>
                <button type="submit" class="login-btn">Request OTP</button>
            <?php endif; ?>
        </form>

        <!-- REGISTER FORM (Hidden by Default) -->
        <form id="registerForm" method="post" action="<?php echo base_url('register'); ?>" enctype="multipart/form-data" style="display: none;">
            <!-- Nama field -->
            <div class="input-group">
                <input type="text" name="name" placeholder="Name" required>
                <?php echo form_error('name', '<small class="error">', '</small>'); ?>
            </div>
            <!-- Nomor HP field -->
            <div class="input-group">
                <input type="text" name="phone_number" placeholder="Nomor HP" required>
                <?php echo form_error('phone_number', '<small class="error">', '</small>'); ?>
            </div>
            <!-- Kode Referral field (optional) -->
            <div class="input-group">
                <input type="text" name="referral_code" placeholder="Kode Referral (Optional)">
                <?php echo form_error('referral_code', '<small class="error">', '</small>'); ?>
            </div>
            <button type="submit" class="login-btn" id="registerButton">Register</button>
        </form>

        <div class="register-link" id="linkContainer">
            Don't have an account? <a href="#" id="toggleLink">Register Now</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loginForm = document.getElementById("authForm");
            const registerForm = document.getElementById("registerForm");
            const toggleLink = document.getElementById("toggleLink");
            const linkContainer = document.getElementById("linkContainer");

            toggleLink.addEventListener("click", function (event) {
                event.preventDefault();
                if (loginForm.style.display === "none") {
                    loginForm.style.display = "block";
                    registerForm.style.display = "none";
                    linkContainer.innerHTML = `Don't have an account? <a href="#" id="toggleLink">Register Now</a>`;
                } else {
                    loginForm.style.display = "none";
                    registerForm.style.display = "block";
                    linkContainer.innerHTML = `Already have an account? <a href="#" id="toggleLink">Login here</a>`;
                }
                document.getElementById("toggleLink").addEventListener("click", arguments.callee);
            });

            // Timer untuk tombol Resend OTP
            const resendOtpBtn = document.getElementById("resendOtpBtn");
            if (resendOtpBtn) {
                let timer = 60;
                const interval = setInterval(() => {
                    if (timer > 0) {
                        timer--;
                        resendOtpBtn.textContent = `Resend OTP (${timer}s)`;
                    } else {
                        clearInterval(interval);
                        resendOtpBtn.textContent = "Resend OTP";
                        resendOtpBtn.classList.remove("disabled");
                        resendOtpBtn.disabled = false;
                    }
                }, 1000);

                resendOtpBtn.addEventListener("click", function () {
                    // Kirim ulang OTP
                    loginForm.action = "<?php echo base_url('login'); ?>";
                    loginForm.submit();
                });
            }
        });
    </script>
</body>
</html>
