<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/editprofil.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">&larr;</div>
        <div class="title">EDIT PROFILE</div>
    </div>

    <!-- Edit Profile Form -->
    <div class="edit-container">
        <p class="profile-description">Edit your personal information using the form below</p>
        
        <form action="<?php echo base_url('profile/setting/update-profile'); ?>" method="POST" enctype="multipart/form-data">
            <div class="profile-image-container">
                <img src="<?php echo base_url('../ImageTerasJapan/ProfPic/' . ($user->profile_pic ? $user->profile_pic : 'profile.jpg')); ?>"
                     alt="Profile Picture" 
                     class="profile-image">
                <input type="file" name="profile_picture" accept="image/jpeg,image/jpg,image/png" class="choose-file-btn">
                <?php if ($user->profile_pic && $user->profile_pic != 'profile.jpg'): ?>
                    <a href="<?php echo base_url('profile/setting/delete-profile-picture'); ?>" 
                       class="delete-photo-btn"
                       onclick="return confirm('Are you sure you want to remove your profile picture?');">
                        Remove Photo
                    </a>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo $user->name; ?>" placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label>Birth Date</label>
                <input type="date" name="birthdate" value="<?php echo $user->birthdate; ?>">
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender">
                    <option value="male" <?php echo ($user->gender == 'male' ? 'selected' : ''); ?>>Male</option>
                    <option value="female" <?php echo ($user->gender == 'female' ? 'selected' : ''); ?>>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label>Home Address</label>
                <input type="text" name="address" value="<?php echo $user->address; ?>" placeholder="Enter your address">
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $user->city; ?>" placeholder="Enter your city">
            </div>

            <button type="submit" class="save-btn">Save Changes</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include APPPATH . 'views/layout/Footer.php'; ?>

    <script>
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            title: 'Success!',
            text: '<?php echo $this->session->flashdata('success'); ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            title: 'Error!',
            text: '<?php echo $this->session->flashdata('error'); ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
    </script>
</body>
</html>