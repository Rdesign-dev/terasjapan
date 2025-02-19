<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Email</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/changeemail.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    var baseUrl = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">CHANGE EMAIL ADDRESS</div>
    </div>

    <!-- Email Change Form -->
    <div class="email-container">
        <p class="email-description">Edit your email address using the form below. You'll be required to verify your
            email address.</p>

        <form id="changeEmailForm">
            <div class="form-group">
                <input type="email" id="new_email" name="new_email" placeholder="Enter your email address" required>
            </div>
            <button type="button" class="verify-btn" id="sendOtpBtn">VERIFY EMAIL</button>
        </form>

        <form id="verifyOtpForm" style="display: none;">
            <div class="form-group">
                <input type="text" id="otp" name="otp" placeholder="Enter OTP" required>
            </div>
            <button type="submit" class="save-btn">VERIFY OTP</button>
        </form>
    </div>

    <div id="rewardRedeemPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRewardRedeemPopup()">&times;</span>
            <p id="rewardRedeemMessage"></p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="closeRewardRedeemPopup()">
                    <p class="text">OK</p>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeConfirmPopup()">&times;</span>
            <p id="confirmMessage"></p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="closeConfirmPopup()">
                    <p class="text">OK</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#sendOtpBtn').click(function() {
            var newEmail = $('#new_email').val();
            if (newEmail) {
                $.ajax({
                    url: '<?php echo base_url("changeemail/request_change_email"); ?>',
                    type: 'POST',
                    data: {
                        new_email: newEmail
                    },
                    dataType: 'json',
                    success: function(response) {
                        showRewardRedeemPopup(response.message);
                        if (response.status === 'success') {
                            $('#changeEmailForm').hide();
                            $('#verifyOtpForm').show();
                        }
                    },
                    error: function() {
                        showRewardRedeemPopup('An error occurred. Please try again.');
                    }
                });
            } else {
                showRewardRedeemPopup('Please check your email correctly.');
            }
        });

        $('#verifyOtpForm').submit(function(e) {
            e.preventDefault();
            var otp = $('#otp').val();
            $.ajax({
                url: '<?php echo base_url("changeemail/verify_otp"); ?>',
                type: 'POST',
                data: {
                    otp: otp
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    showConfirmPopup(response.message);
                    console.log('Success');
                },
                error: function() {
                    showConfirmPopup('An error occurred. Please try again.');
                }
            });
        });
    });

    function showRewardRedeemPopup(message) {
        document.getElementById('rewardRedeemMessage').innerText = message;
        document.getElementById('rewardRedeemPopup').style.display = 'flex';
    }

    function showConfirmPopup(message) {
        document.getElementById('confirmMessage').innerText = message;
        document.getElementById('confirmPopup').style.display = 'flex';
    }

    function closeRewardRedeemPopup() {
        document.getElementById('rewardRedeemPopup').style.display = 'none';
    }

    function closeConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'none';
        window.location.href = '<?php echo base_url('profile'); ?>';
    }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>

</html>