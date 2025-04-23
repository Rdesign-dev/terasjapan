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
        // Handler untuk pengiriman OTP
        $('#sendOtpBtn').click(function() {
            var newEmail = $('#new_email').val();
            if (newEmail) {
                // Disable button saat proses
                $(this).prop('disabled', true).text('Sending...');
                
                $.ajax({
                    url: '<?php echo base_url("changeemail/request_change_email"); ?>',
                    type: 'POST',
                    data: {
                        new_email: newEmail
                    },
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(response) {
                        console.log('Success Response:', response);
                        // Cek status response
                        if (response.status === 'success') {
                            showRewardRedeemPopup('OTP has been sent to your email');
                            $('#changeEmailForm').hide();
                            $('#verifyOtpForm').show();
                        } else {
                            showRewardRedeemPopup(response.message || 'Failed to send OTP');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Coba parse response text jika ada
                        try {
                            var errorResponse = JSON.parse(xhr.responseText);
                            showRewardRedeemPopup(errorResponse.message);
                        } catch(e) {
                            showRewardRedeemPopup('Failed to send OTP. Please try again.');
                        }
                        console.log('Error details:', {
                            responseText: xhr.responseText,
                            status: status,
                            error: error
                        });
                    },
                    complete: function() {
                        // Re-enable button
                        $('#sendOtpBtn').prop('disabled', false).text('VERIFY EMAIL');
                    }
                });
            } else {
                showRewardRedeemPopup('Please enter your email address.');
            }
        });

        // Handler untuk verifikasi OTP
        $('#verifyOtpForm').submit(function(e) {
            e.preventDefault();
            var otp = $('#otp').val();
            
            if (!otp) {
                showConfirmPopup('Please enter the OTP code.');
                return;
            }

            $(this).find('button').prop('disabled', true).text('Verifying...');
            
            $.ajax({
                url: '<?php echo base_url("changeemail/verify_otp"); ?>',
                type: 'POST',
                data: { otp: otp },
                dataType: 'json',
                success: function(response) {
                    console.log('Verify Response:', response); // Debug response
                    
                    if (response.status === 'success') {
                        showConfirmPopup('Email changed successfully!');
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url('profile'); ?>';
                        }, 2000);
                    } else {
                        showConfirmPopup(response.message || 'Invalid OTP code.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Verify Error:', {xhr, status, error}); // Debug error
                    
                    let errorMessage = 'An error occurred. Please try again.';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMessage = response.message || errorMessage;
                    } catch(e) {}
                    
                    showConfirmPopup(errorMessage);
                },
                complete: function() {
                    $('#verifyOtpForm button').prop('disabled', false).text('VERIFY OTP');
                }
            });
        });
    });

    function showRewardRedeemPopup(message) {
        $('#rewardRedeemMessage').text(message);
        $('#rewardRedeemPopup').show();
        
        // Auto hide after 3 seconds if success message
        if(message.includes('has been sent')) {
            setTimeout(function() {
                $('#rewardRedeemPopup').hide();
            }, 3000);
        }
    }

    function showConfirmPopup(message) {
        document.getElementById('confirmMessage').innerText = message;
        document.getElementById('confirmPopup').style.display = 'flex';
    }

    function closeRewardRedeemPopup() {
        $('#rewardRedeemPopup').hide();
    }

    function closeConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'none';
        window.location.href = '<?php echo base_url('profile'); ?>';
    }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>

</html>