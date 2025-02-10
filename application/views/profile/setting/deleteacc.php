<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/deleteacc.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">DELETE ACCOUNT</div>
    </div>

    <!-- Delete Account Container -->
    <div class="delete-container">
        <h2 class="delete-title">ARE YOU SURE YOU WANT TO DELETE ACCOUNT</h2>
        <p class="delete-description">Deleting your account will :</p>
        
        <ul class="delete-points">
            <li>All points you've achieved cannot be used anymore</li>
            <li>All benefits you have cannot be enjoyed anymore</li>
            <li>You can't get any rewards anymore</li>
            <li>This action can't be undone. You can't get your account back once deleted</li>
        </ul>

        <form action="<?php echo base_url('profile/setting/delete-account'); ?>" method="POST" id="deleteForm">
            <div class="checkbox-container">
                <input type="checkbox" id="agreement" onchange="toggleDeleteButton()">
                <label for="agreement">I've read, understood, and agreed all about account deletion written above</label>
            </div>
            <input type="hidden" name="confirm_delete" value="1">
            <button type="submit" class="delete-btn" id="deleteBtn" disabled>DELETE ACCOUNT</button>
        </form>
    </div>

    <script>
        function toggleDeleteButton() {
            const checkbox = document.getElementById('agreement');
            const deleteBtn = document.getElementById('deleteBtn');
            deleteBtn.disabled = !checkbox.checked;
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
