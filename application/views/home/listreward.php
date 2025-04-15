<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Brand Rewards</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/listreward.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="icon" type="image/x-icon" href="../assets/image/logo/logo-amigos.png">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header-wrapper">
            <div class="header-top-container">
                <img class="header-logo" src="https://terasjapan.com/ImageTerasJapan/logo/tjwhite.png" alt="Teras Japan" />
                <h1 class="header-title-text">Teras Heroes Club</h1>
            </div>
        </div>

        <h2 style="text-align: center; margin-top: 1rem;">All Brand Rewards</h2>

        <!-- Rewards by Brand -->
        <div class="reward-section">
            <?php if (!empty($all_brands)): ?>
            <?php foreach ($all_brands as $brand): ?>
            <div class="brand-reward-block">
                <h3 class="brand-reward-title"><?php echo $brand->name; ?></h3>
                <div class="reward-items">
                    <?php if (!empty($brand->rewards)): ?>
                    <?php foreach ($brand->rewards as $reward): ?>
                    <div class="reward-item" data-id="<?php echo $reward->id; ?>"
                        data-brand-id="<?php echo $brand->id; ?>" data-brand-name="<?php echo $brand->name; ?>">
                        <img src="https://terasjapan.com/ImageTerasJapan/reward/<?php echo $reward->image_name; ?>"
                            alt="<?php echo $reward->title; ?>" />
                        <div class="reward-info">
                            <h4><?php echo $reward->title; ?></h4>
                            <p class="points"><?php echo number_format($reward->points_required); ?> Points</p>
                            <?php if ($reward->qty <= 5): ?>
                            <div class="stock-warning"><?php echo $reward->qty; ?> voucher left!</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="no-rewards">No rewards available for this brand.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="no-brands">
                <p>No brands available.</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Modal Pop-Up -->
        <div id="rewardModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeRewardModal()">&times;</span>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Reward Image">
                    <div class="modal-info">
                        <h3 id="modalTitle" class="modal-title"></h3>
                        <p id="modalDescription" class="modal-description"></p>
                        <p id="modalValidity" class="modal-validity"></p>
                    </div>
                </div>
                <div id="modalBranches" class="modal-branches">
                    <!-- Branch badges will be added dynamically here -->
                </div>
                <div class="modal-footer">
                    <span id="modalPoints" class="point-text"></span>
                    <a href="#" id="redeemLink" class="exchange-btn">Redeem</a>
                </div>
            </div>
        </div>

        <!-- Confirm Redeem Popup -->
        <div id="confirmRedeemPopup" class="popup-referral">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <img src="https://terasjapan.com/ImageTerasJapan/icon/question.png" class="popup-image" alt="confirm-image">
                <p>Are you sure you want to redeem this reward?</p>
                <div class="button-container">
                    <div class="rectangle yes-btn">
                        <p class="text">Yes</p>
                    </div>
                    <div class="rectangle no-btn">
                        <p class="text">No</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup modals from index.php -->
        <?php include 'reward_popups.php'; ?>

        <!-- Popup Success Redeem -->
        <div id="rewardRedeemPopup" class="popup-referral" style="display: none;">
            <div class="popup-content">
                <span class="close-btn" onclick="closeRewardRedeemPopup()">&times;</span>
                <img src="https://terasjapan.com/ImageTerasJapan/icon/cek.png" class="popup-image" alt="popup-image">
                <p>Your reward has been successfully redeemed.</p>
                <div class="button-container">
                    <div class="rectangle ok-btn" onclick="closeRewardRedeemPopup()">
                        <p class="text">OK</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Popup -->
        <div id="loginPopup" class="popup-referral" style="display: none;">
            <div class="popup-content">
                <span class="close-btn" onclick="closeLoginPopup()">&times;</span>
                <p>Please log in to redeem rewards.</p>
                <div class="button-container">
                    <div class="rectangle ok-btn" onclick="redirectToLogin()">
                        <p class="text">OK</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Popup -->
        <div id="rewardErrorPopup" class="popup-referral" style="display: none;">
            <div class="popup-content">
                <span class="close-btn" onclick="closeRewardErrorPopup()">&times;</span>
                <img src="https://terasjapan.com/ImageTerasJapan/icon/x.png" class="popup-image" alt="error-image">
                <p id="errorMessage"></p>
                <div class="button-container">
                    <div class="rectangle ok-btn" onclick="closeRewardErrorPopup()">
                        <p class="text">OK</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'application/views/layout/Footer.php'; ?>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const rewardItems = document.querySelectorAll(".reward-item");
        const modal = document.getElementById("rewardModal");
        const modalImage = document.getElementById("modalImage");
        const modalTitle = document.getElementById("modalTitle");
        const modalPoints = document.getElementById("modalPoints");
        const modalDescription = document.getElementById("modalDescription");
        const modalValidity = document.getElementById("modalValidity");
        const modalBranches = document.getElementById("modalBranches");
        const redeemLink = document.getElementById("redeemLink");
        const closeButton = document.querySelector(".close");
        let currentRewardId = null;

        // Add these new variables
        const confirmPopup = document.getElementById('confirmRedeemPopup');
        const confirmYesBtn = confirmPopup.querySelector('.yes-btn');
        const confirmNoBtn = confirmPopup.querySelector('.no-btn');
        const confirmCloseBtn = confirmPopup.querySelector('.close-btn');

        rewardItems.forEach(item => {
            item.addEventListener("click", function() {
                const rewardId = this.getAttribute("data-id");
                const brandId = this.getAttribute("data-brand-id");
                const brandName = this.getAttribute("data-brand-name");
                currentRewardId = rewardId;
                fetchRewardData(rewardId, brandId, brandName);
            });
        });

        function fetchRewardData(rewardId, brandId, brandName) {
            fetch(`<?= base_url('reward/get_reward/'); ?>${rewardId}`)
                .then(response => response.json())
                .then(response => {
                    if (response.status === 'success') {
                        const data = response.data;
                        modalImage.src = `https://terasjapan.com/ImageTerasJapan/reward/${data.image_name}`;
                        modalTitle.textContent = data.title;
                        modalDescription.textContent = data.description || '';
                        modalPoints.textContent = `${data.points_required} Points`;
                        // Update validitas voucher
                        modalValidity.textContent =
                            `Voucher validity: ${data.total_days} days after redeem`;

                        // Add brand badge
                        modalBranches.innerHTML = `<span class="brand-badge">${brandName}</span>`;

                        redeemLink.onclick = () => showConfirmRedeemPopup(rewardId);
                        modal.style.display = "flex";
                    } else {
                        showRewardFetchErrorPopup();
                    }
                })
                .catch(error => {
                    console.error("Error fetching reward data:", error);
                    showRewardFetchErrorPopup();
                });
        }

        confirmYesBtn.addEventListener('click', confirmRedeemReward);

        confirmNoBtn.addEventListener('click', function() {
            closeConfirmRedeemPopup();
        });

        confirmCloseBtn.addEventListener('click', function() {
            closeConfirmRedeemPopup();
        });

        function showConfirmRedeemPopup(rewardId) {
            <?php if ($this->session->userdata('logged_in')): ?>
            confirmPopup.style.display = 'flex';
            currentRewardId = rewardId;
            <?php else: ?>
            showLoginPopup();
            <?php endif; ?>
        }

        function closeConfirmRedeemPopup() {
            confirmPopup.style.display = 'none';
        }

        function confirmRedeemReward() {
            fetch("<?= base_url('reward/redeem'); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        "reward_id": currentRewardId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Redeem response:", data);
                    if (data.status === 'success') {
                        showRewardRedeemPopup();
                        closeConfirmRedeemPopup();
                        modal.style.display = "none";
                    } else {
                        showRewardErrorPopup(data.message);
                        closeConfirmRedeemPopup();
                        modal.style.display = "none";
                    }
                })
                .catch(error => {
                    console.error("Error redeeming reward:", error);
                    showRewardErrorPopup("An error occurred while redeeming the reward");
                    closeConfirmRedeemPopup();
                });
        }

        function showRewardErrorPopup(message) {
            const popup = document.getElementById('rewardErrorPopup');
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = message || 'An error occurred while redeeming the reward';
            popup.style.display = 'flex';
        }

        function closeRewardErrorPopup() {
            const popup = document.getElementById('rewardErrorPopup');
            popup.style.display = 'none';
            modal.style.display = "none";
        }

        document.querySelector('#rewardErrorPopup .ok-btn').addEventListener('click', function() {
            closeRewardErrorPopup();
        });

        function showRewardRedeemPopup() {
            const popup = document.getElementById('rewardRedeemPopup');
            popup.style.display = 'flex';
        }

        function closeRewardRedeemPopup() {
            const popup = document.getElementById('rewardRedeemPopup');
            popup.style.display = 'none';
            window.location.href = '<?= base_url('profile/myvoucher'); ?>';
        }

        document.querySelector('#rewardRedeemPopup .ok-btn').addEventListener('click', function() {
            closeRewardRedeemPopup();
        });

        // Update fungsi untuk login popup
        function showLoginPopup() {
            document.getElementById('loginPopup').style.display = 'flex';
        }

        function closeLoginPopup() {
            document.getElementById('loginPopup').style.display = 'none';
        }

        function redirectToLogin() {
            window.location.href = '<?= base_url('login'); ?>';
        }

        // Add event listeners for login popup
        const loginPopup = document.getElementById('loginPopup');
        const loginCloseBtn = loginPopup.querySelector('.close-btn');
        const loginOkBtn = loginPopup.querySelector('.ok-btn');

        loginCloseBtn.addEventListener('click', closeLoginPopup);
        loginOkBtn.addEventListener('click', redirectToLogin);

        document.querySelectorAll('.close-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.popup-referral').style.display = 'none';
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('popup-referral')) {
                event.target.style.display = 'none';
            }
            if (event.target === modal) {
                closeRewardModal();
            }
        });

        function closeRewardModal() {
            modal.style.display = "none";
        }

        closeButton.addEventListener("click", closeRewardModal);
        window.closeRewardModal = closeRewardModal;
        window.showConfirmRedeemPopup = showConfirmRedeemPopup;
    });
    </script>
</body>

</html>