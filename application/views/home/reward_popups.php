<!-- Popup Reward Redeem Success -->
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

<!-- Popup Reward Fetch Error -->
<div id="rewardFetchErrorPopup" class="popup-referral" style="display: none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closeRewardFetchErrorPopup()">&times;</span>
        <h2>Error</h2>
        <p>An error occurred while fetching reward data. Please try again later.</p>
        <div class="button-container">
            <div class="rectangle ok-btn" onclick="closeRewardFetchErrorPopup()">
                <p class="text">OK</p>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Redeem Popup -->
<div id="confirmRedeemPopup" class="popup-referral" style="display: none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closeConfirmRedeemPopup()">&times;</span>
        <p>Are you sure you want to redeem this reward?</p>
        <div class="button-container">
            <div class="rectangle yes-btn" onclick="confirmRedeemReward()">
                <p class="text">Yes</p>
            </div>
            <div class="rectangle no-btn" onclick="closeConfirmRedeemPopup()">
                <p class="text">No</p>
            </div>
        </div>
    </div>
</div>

<!-- Login Popup -->
<div id="loginPopup" class="popup-referral" style="display: none;">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <p>Please log in to redeem rewards.</p>
        <div class="button-container">
            <div class="rectangle ok-btn">
                <p class="text">OK</p>
            </div>
        </div>
    </div>
</div>

<!-- Error Popup -->
<div id="rewardErrorPopup" class="popup-referral" style="display: none;">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <img src="https://terasjapan.com/ImageTerasJapan/icon/x.png" class="popup-image" alt="error-image">
        <p id="errorMessage"></p>
        <div class="button-container">
            <div class="rectangle ok-btn">
                <p class="text">OK</p>
            </div>
        </div>
    </div>
</div>