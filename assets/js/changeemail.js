$(document).ready(function() {
    $('#sendOtpBtn').click(function() {
        var newEmail = $('#new_email').val();
        if (newEmail) {
            $.ajax({
                url: baseUrl + "changeemail/request_change_email",
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
            url: baseUrl + "changeemail/verify_otp",
            type: 'POST',
            data: { otp: otp },
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    window.location.href = baseUrl + 'profile';
                }
            }
        });
    });
});