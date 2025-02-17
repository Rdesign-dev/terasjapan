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
    <script src="<?php echo base_url('assets/js/changeemail.js'); ?>"></script>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">CHANGE EMAIL ADDRESS</div>
    </div>

    <!-- Email Change Form -->
    <div class="email-container">
        <p class="email-description">Edit your email address using the form below. You'll be required to verify your email address.</p>
        
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

    <script>
        $(document).ready(function() {
            $('#sendOtpBtn').click(function() {
                var newEmail = $('#new_email').val();
                if (newEmail) {
                    $.ajax({
                        url: '<?php echo base_url("changeemail/request_change_email"); ?>',
                        type: 'POST',
                        data: { new_email: newEmail },
                        dataType: 'json',
                        success: function(response) {
                            alert(response.message);
                            if (response.status === 'success') {
                                $('#changeEmailForm').hide();
                                $('#verifyOtpForm').show();
                            }
                        }
                    });
                }
            });

            $('#verifyOtpForm').submit(function(e) {
                e.preventDefault();
                var otp = $('#otp').val();
                $.ajax({
                    url: '<?php echo base_url("changeemail/verify_otp"); ?>',
                    type: 'POST',
                    data: { otp: otp },
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        if (response.status === 'success') {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
