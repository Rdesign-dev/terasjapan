<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shogun App</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css')?>">
</head>

<body>
<!-- Advertisement Pop-up -->
    <div id="adPopup" class="ad-popup">
        <div class="ad-popup-content">
            <span class="ad-close">&times;</span>
            <?php if (!empty($popup)): ?>
                <img src="<?php echo image_url('contentpopup', $popup->Image); ?>" 
                    alt="<?php echo $popup->name; ?>"
                    <?php if (!empty($popup->link)): ?>
                    onclick="window.location.href='<?php echo $popup->link ?>'"
                    style="cursor: pointer;"
                    <?php endif; ?>>
            <?php endif; ?>
        </div>
    </div>
    <!-- Banner -->
    <div class="banner">
        <?php if (!empty($banners)): ?>
            <?php foreach($banners as $banner): ?>
                <img src="https://terasjapan.com/ImageTerasJapan/banner/<?php echo $banner->image; ?>" 
                     alt="<?php echo $banner->title; ?>"
                     <?php if (!empty($banner->link)): ?>
                     onclick="window.location.href='<?php echo $banner->link; ?>'"
                     style="cursor: pointer;"
                     <?php endif; ?>>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-banner">
                <p>No active banners available.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="header-wrapper">
        <div class="header-top-container">
            <div class="header-title">
                <?php 
            date_default_timezone_set('Asia/Jakarta');
            $name = $this->session->userdata('name');
            $hour = date('H');

            if ($hour < 12) {
                $greeting = 'Ohayou';
            } elseif ($hour < 18) {
                $greeting = 'Konnichiwa';
            } else {
                $greeting = 'Konbanwa';
            }

            if ($name) {
                echo $greeting . ', ' . $name;
            } else {
                echo $greeting . ', Guest';
            }
            ?>
            </div>
            <?php if ($name): ?>
            <div class="points-container">
                <span class="points-value"><?php echo $poin ?? '0'; ?></span>
                <span class="points-text">ryo</span>
                <img src="<?php echo icon_url('coin.png') ?>" class="coin-icon">
            </div>
            <?php endif; ?>
        </div>
        <a href="<?php echo base_url('home/alamat'); ?>" class="header-bottom-link" style="text-decoration: none;">
            <div class="header-bottom-container">
                <div class="location-inf
                <div class=" location-name">Pasar Modern BSD</div>
                <span class="dropdown-icon">▼</span>
                <div class="location-address">Jl. Letnan Sutopo No.38 Rw. Mekar Jaya, Kec. Serpong</div>
            </div>
    </div>
    </a>
    </div>
    <?php if ($this->session->userdata('logged_in')): ?>
        <div class="mission-section">
            <div class="mission-header">
                <h2>Mission</h2>
            </div>
            <?php if (!empty($user_missions)): ?>
                <?php foreach ($user_missions as $user_mission): ?>
                    <div class="mission-item">
                        <div class="mission-text">
                            <strong><?php echo $user_mission->title; ?></strong>
                            <span class="mission-points"><?php echo $user_mission->point_reward; ?> Points</span>
                        </div>
                        <!-- <p>Time Remaining</p> -->
                        <span class="status"><?php echo $user_mission->status; ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-mission">
                    <p>No missions available.</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="promo-section">
        <div class="promo-header">
            <h2>Promo This Week</h2>
        </div>
        <div class="promo-items">
            <?php 
            $activePromos = array_filter($promos ?? [], function($promo) {
                return $promo->status === 'Available';
            });
            
            if (!empty($activePromos)): 
            ?>
                <?php foreach ($activePromos as $promo): ?>
                    <div class="promo-item"
                         data-id="<?= $promo->id ?>"
                         data-title="<?= htmlspecialchars($promo->promo_name) ?>"
                         data-description="<?= htmlspecialchars($promo->promo_desc) ?>"
                         data-image="<?= image_url('promo', $promo->promo_image) ?>">
                        <img src="<?php echo image_url('promo', $promo->promo_image); ?>"
                             alt="<?php echo htmlspecialchars($promo->promo_name); ?>">
                        <p><?php echo htmlspecialchars($promo->promo_name); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-promo">
                    <p>🔪 Unavailable Promo, <span>Comeback Soon!</span></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Update the promo modal HTML -->
    <div id="promoModal" class="promo-modal" style="display: none;">
        <div class="promo-modal-content">
            <span class="promo-close" onclick="closePromoModal()">&times;</span>
            <div class="promo-modal-body">
                <img id="promoModalImage" src="" alt="Promo Image" class="promo-modal-image">
                <div class="promo-modal-info">
                    <h3 id="promoModalTitle" class="promo-modal-title"></h3>
                    <p id="promoModalDescription" class="promo-modal-description"></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Brand Section -->
    <div class="brand-section">
        <div class="promo-header">
            <h2 style="cursor: pointer;">Explore Our Brand</h2>
        </div>
        <div class="brand-items">
            <?php if (!empty($brands)): ?>
                <?php foreach($brands as $brand): ?>
                    <div class="brand-item">
                        <a href="<?php echo base_url('brand/detail?brand_name=' . strtolower(str_replace(' ', '', $brand->name))); ?>" 
                           class="brand-item-link" style="text-decoration: none;">
                            <img src="<?php echo image_url('logo', $brand->image); ?>"
                                 alt="<?php echo $brand->name; ?>"
                                 class="brand-logo">
                            <p><?php echo $brand->name; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-brand">
                    <p>No brands available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="popup-brands" id="popupBrands">
        <div class="popup-brands-content">
            <button class="popup-brands-close" id="popupBrandsClose">×</button>
            <div class="popup-brands-header">
                <h2>Explore Our Brand</h2>
            </div>
            <div class="brands-grid">
                <?php if (!empty($brands)): ?>
                    <?php foreach($brands as $brand): ?>
                        <div>
                            <a href="<?php echo base_url('brand/detail?brand_name=' . strtolower(str_replace(' ', '', $brand->name))); ?>">
                                <img src="https://terasjapan.com/ImageTerasJapan/logo/<?php echo $brand->image; ?>" 
                                    alt="<?php echo $brand->name; ?>">
                                <p><?php echo $brand->name; ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-brand">
                        <p>No brands available.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Reward Section -->
    <div class="reward-section">
        <div class="reward-header">
            <h2>Rewards</h2>
            <a href="<?php echo base_url('home/listreward'); ?>" class="see-all-btn">See All</a>
        </div>
        <div class="reward-items">
            <?php 
            $available_rewards = array_filter($rewards ?? [], function($reward) {
                return isset($reward->qty) && 
                       $reward->qty > 0 && 
                       strtotime($reward->valid_until) > time();
            });
            
            if (!empty($available_rewards)): 
            ?>
                <?php foreach ($available_rewards as $reward): ?>
                <div class="reward-item" data-id="<?php echo $reward->id; ?>">
                    <img src="https://terasjapan.com/ImageTerasJapan/reward/<?php echo $reward->image_name; ?>"
                        alt="<?php echo $reward->title; ?>">
                    <div class="reward-info">
                        <div class="reward-title"><?php echo $reward->title; ?></div>
                        <div class="reward-points">
                            <span class="points-value"><?php echo $reward->points_required; ?></span>
                            <span class="points-text">Poin</span>
                        </div>
                        <?php if ($reward->qty <= 5): ?>
                        <div class="stock-warning"><?php echo $reward->qty; ?> voucher left!</div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-promo">
                    <p>🔪 Unavailable Reward, <span>Comeback Soon!</span></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Pop-Up -->
    <div id="rewardModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Reward Image">
                <div class="modal-info">
                    <h3 id="modalTitle" class="modal-title"></h3>
                    <p id="modalDescription" class="modal-description"></p>
                    <p id="modalValidity" class="modal-validity"></p> <!-- Tambahkan elemen untuk masa aktif voucher -->
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

    <!-- Popup Reward Redeem Success -->
    <div id="rewardRedeemPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRewardRedeemPopup()">&times;</span>
            <img src="<?php echo icon_url('cek.png') ?>" class="popup-image" alt="popup-image">
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

    <!-- Add this new popup div after the existing popups -->
    <div id="rewardErrorPopup" class="popup-referral" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRewardErrorPopup()">&times;</span>
            <img src="https://terasjapan.com/ImageTerasJapan/icon/x.png" class="popup-image" alt="error-image">
            <p id="errorMessage">Insufficient points to redeem this reward.</p>
            <div class="button-container">
                <div class="rectangle ok-btn" onclick="closeRewardErrorPopup()">
                    <p class="text">OK</p>
                </div>
            </div>
        </div>
    </div>

    <div class="news-section">
        <h2>News & Event</h2>
        <div class="news-grid">
            <?php 
            $activeNews = array_filter($news ?? [], function($news_item) {
                return isset($news_item->status) && $news_item->status === 'Active';
            });
            
            if (!empty($activeNews)): 
            ?>
                <?php foreach ($activeNews as $news_item): ?>
                    <a href="<?php echo base_url('home/news/' . $news_item->id); ?>" class="news-item">
                        <img src="<?= image_url('news_event', $news_item->image) ?>"
                            alt="<?= htmlspecialchars($news_item->title) ?>">
                        <div class="news-content">
                            <h3><?= htmlspecialchars($news_item->title) ?></h3>
                            <p><?= substr(htmlspecialchars($news_item->description), 0, 100) ?>...</p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="news-no-promo">
                    <p>🔪 Unavailable News & Events, <span>Comeback Soon!</span></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <a href="https://wa.me/6282283619320" class="whatsapp-section" style="text-decoration: none;">
        <img src="http://terasjapan.com/ImageTerasJapan/icon/whatsapp.png" alt="WhatsApp">
        <span>Join our Community via WhatsApp</span>
    </a>

    <script>
    const popup = document.getElementById('popup');
    const popupClose = document.getElementById('popupClose');
    // const openPopupBtn = document.querySelector('.open-popup-btn');
    const brandLogos = document.querySelector('.brand-logos');

    // Add sliding class when page loads
    // window.addEventListener('load', () => {
    //     brandLogos.classList.add('sliding');
    // });
    window.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.classList.remove('active');
            // Resume animation when popup is closed
            brandLogos.classList.add('sliding');
        }
    });
    </script>

    <script>
    // Ambil elemen yang dibutuhkan
    const popupBrands = document.getElementById('popupBrands');
    const popupBrandsClose = document.getElementById('popupBrandsClose');
    const exploreOurBrandText = document.querySelector('.brand-section h2');


    // Buka popup saat teks "Explore Our Brand" diklik
    exploreOurBrandText.addEventListener('click', () => {
        popupBrands.classList.add('active');
    });

    // Tutup popup saat tombol close diklik
    popupBrandsClose.addEventListener('click', () => {
        popupBrands.classList.remove('active');
    });

    // Tutup popup saat klik di luar konten popup
    window.addEventListener('click', (e) => {
        if (e.target === popupBrands) {
            popupBrands.classList.remove('active');
        }
    });

    // Add click event listeners to footer links
    document.querySelectorAll('.footer a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove active class from all links
            document.querySelectorAll('.footer a').forEach(l => {
                l.classList.remove('active');
            });
            // Add active class to clicked link
            this.classList.add('active');
        });
    });
    </script>

    <script>
    let currentIndex = 0;
    const images = document.querySelectorAll('.banner img');
    const totalImages = images.length;

    function showNextImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % totalImages;
        images[currentIndex].classList.add('active');
    }

    // Initialize the first image as active
    images[currentIndex].classList.add('active');

    // Set the interval for sliding images
    setInterval(showNextImage, 3000); // Change image every 2 seconds
    </script>

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
        const rewardRedeemPopupCloseButton = document.querySelector("#rewardRedeemPopup .close-btn");
        const rewardFetchErrorPopupCloseButton = document.querySelector("#rewardFetchErrorPopup .close-btn");
        const rewardRedeemPopupOkButton = document.querySelector("#rewardRedeemPopup .ok-btn");
        const rewardFetchErrorPopupOkButton = document.querySelector("#rewardFetchErrorPopup .ok-btn");
        const confirmRedeemPopup = document.getElementById("confirmRedeemPopup");
        const confirmRedeemPopupCloseButton = document.querySelector("#confirmRedeemPopup .close-btn");
        const confirmRedeemPopupNoButton = document.querySelector("#confirmRedeemPopup .no-btn");
        const loginPopup = document.getElementById("loginPopup");
        const loginPopupCloseButton = document.querySelector("#loginPopup .close-btn");
        const loginPopupOkButton = document.querySelector("#loginPopup .ok-btn");
        const rewardErrorPopupCloseButton = document.querySelector("#rewardErrorPopup .close-btn");
        const rewardErrorPopupOkButton = document.querySelector("#rewardErrorPopup .ok-btn");
        let currentRewardId = null;

        rewardItems.forEach(item => {
            item.addEventListener("click", function() {
                const rewardId = item.getAttribute("data-id");
                currentRewardId = rewardId;
                fetchRewardData(rewardId);
            });
        });

        closeButton.addEventListener("click", function() {
            modal.style.display = "none";
        });

        rewardRedeemPopupCloseButton.addEventListener("click", closeRewardRedeemPopup);
        rewardFetchErrorPopupCloseButton.addEventListener("click", closeRewardFetchErrorPopup);
        rewardRedeemPopupOkButton.addEventListener("click", closeRewardRedeemPopup);
        rewardFetchErrorPopupOkButton.addEventListener("click", closeRewardFetchErrorPopup);
        confirmRedeemPopupCloseButton.addEventListener("click", closeConfirmRedeemPopup);
        confirmRedeemPopupNoButton.addEventListener("click", closeConfirmRedeemPopup);
        loginPopupCloseButton.addEventListener("click", closeLoginPopup);
        loginPopupOkButton.addEventListener("click", redirectToLogin);
        rewardErrorPopupCloseButton.addEventListener("click", closeRewardErrorPopup);
        rewardErrorPopupOkButton.addEventListener("click", closeRewardErrorPopup);

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        function fetchRewardData(rewardId) {
            console.log("Fetching reward data for ID:", rewardId);
            fetch("<?= base_url('Reward/get_reward/'); ?>" + rewardId)
                .then(response => response.json())
                .then(response => {
                    if (response.status === 'success') {
                        const data = response.data;
                        
                        // Direct URL reference
                        modalImage.src = "https://terasjapan.com/ImageTerasJapan/reward/" + data.image_name;
                        
                        modalTitle.innerText = data.title;
                        modalPoints.innerText = "Poin: " + data.points_required;
                        modalDescription.innerText = data.description;
                        modalValidity.innerText = "Voucher validity: " + data.total_days + " days after redeem";
                        
                        modalBranches.innerHTML = '';
                        redeemLink.href = "javascript:showConfirmRedeemPopup(" + rewardId + ");";
                        modal.style.display = "flex";
                    } else {
                        throw new Error(response.message || 'Failed to fetch reward data');
                    }
                })
                .catch(error => {
                    console.error("Error fetching reward data:", error);
                    showRewardFetchErrorPopup();
                });
        }

        window.showConfirmRedeemPopup = function(rewardId) {
            // Check if user is logged in
            <?php if ($this->session->userdata('logged_in')): ?>
                confirmRedeemPopup.style.display = 'flex';
                currentRewardId = rewardId;
            <?php else: ?>
                showLoginPopup();
            <?php endif; ?>
        }

        window.confirmRedeemReward = function() {
            fetch("<?= base_url('Reward/redeem'); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "reward_id": currentRewardId
                })
            })
            .then(response => {
                // Periksa status response terlebih dahulu
                if (!response.ok) {
                    // Cek apakah response adalah JSON atau bukan
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Terjadi kesalahan saat menebus reward');
                        });
                    } else {
                        // Jika bukan JSON, tangani sebagai error umum
                        throw new Error('Server error: ' + response.status);
                    }
                }
                return response.json();
            })
            .then(data => {
                console.log("Redeem reward response:", data);
                if (data.status === 'success') {
                    showRewardRedeemPopup();
                    confirmRedeemPopup.style.display = "none";
                    modal.style.display = "none";
                } else {
                    showRewardErrorPopup(data.message);
                    confirmRedeemPopup.style.display = "none";
                    modal.style.display = "none";
                }
            })
            .catch(error => {
                // Tampilkan popup error jika error.message ada
                if (error.message && error.message.includes('Insufficient')) {
                    showRewardErrorPopup(error.message);
                    confirmRedeemPopup.style.display = "none";
                    modal.style.display = "none";
                } else {
                    // Bisa juga tampilkan popup fetch error umum
                    showRewardErrorPopup('Failed to redeem reward. Please try again.');
                }
                console.error("Error redeeming reward:", error);
            });
        }

        function showRewardErrorPopup(message) {
            const popup = document.getElementById('rewardErrorPopup');
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = message || 'Insufficient points to redeem this reward.';
            popup.style.display = 'flex';
        }

        function closeRewardErrorPopup() {
            document.getElementById('rewardErrorPopup').style.display = 'none';
        }

        function showRewardRedeemPopup() {
            document.getElementById('rewardRedeemPopup').style.display = 'flex';
        }

        function closeRewardRedeemPopup() {
            document.getElementById('rewardRedeemPopup').style.display = 'none';
            window.location.href = '<?= base_url('profile/myvoucher'); ?>';
        }

        function showRewardFetchErrorPopup() {
            document.getElementById('rewardFetchErrorPopup').style.display = 'flex';
        }

        function closeRewardFetchErrorPopup() {
            document.getElementById('rewardFetchErrorPopup').style.display = 'none';
        }

        function closeConfirmRedeemPopup() {
            document.getElementById('confirmRedeemPopup').style.display = 'none';
        }

        function showLoginPopup() {
            loginPopup.style.display = 'flex';
        }

        function closeLoginPopup() {
            loginPopup.style.display = 'none';
        }

        function redirectToLogin() {
            window.location.href = '<?= base_url('login'); ?>';
        }
    });
    </script>

    <!-- Add this JavaScript code -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const promoModal = document.getElementById('promoModal');
        const promoModalImage = document.getElementById('promoModalImage');
        const promoModalTitle = document.getElementById('promoModalTitle');
        const promoModalDescription = document.getElementById('promoModalDescription');

        document.querySelector('.promo-items').querySelectorAll('.promo-item').forEach(item => {
            item.addEventListener('click', function() {
                const title = this.getAttribute('data-title');
                const description = this.getAttribute('data-description');
                const imageUrl = this.getAttribute('data-image');
                
                promoModalImage.src = imageUrl;
                promoModalTitle.textContent = title;
                promoModalDescription.textContent = description;
                promoModal.style.display = 'flex';
            });
        });
    });

    function closePromoModal() {
        document.getElementById('promoModal').style.display = 'none';
    }
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const adPopup = document.getElementById('adPopup');
        const adClose = document.querySelector('.ad-close');
        
        // Check if user has seen the ad today
        const lastShown = localStorage.getItem('adLastShown');
        const today = new Date().toDateString();
        
        if (!lastShown || lastShown !== today) {
            // Show popup after 1 second
            setTimeout(() => {
                adPopup.style.display = 'flex';
                localStorage.setItem('adLastShown', today);
            }, 1000);
        }
        
        // Close popup when clicking close button
        adClose.addEventListener('click', () => {
            adPopup.style.display = 'none';
        });
        
        // Close popup when clicking outside
        adPopup.addEventListener('click', (e) => {
            if (e.target === adPopup) {
                adPopup.style.display = 'none';
            }
        });
    });
    </script>
</body>

<?php $this->load->view('layout/Footer'); ?>

</html>