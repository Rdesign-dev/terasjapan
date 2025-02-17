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
    <!-- Banner -->
    <div class="banner">
        <img src="<?php echo base_url('assets/image/Ads/ads1.png') ?>" alt="Advertisement 1">
        <img src="<?php echo base_url('assets/image/Ads/ads2.png') ?>" alt="Advertisement 2">
        <img src="<?php echo base_url('assets/image/Ads/ads3.png') ?>" alt="Advertisement 3">
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
                <img src="<?php echo base_url('assets/image/icon/coin.png') ?>" class="coin-icon">
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
    <div class="promo-section">
        <div class="promo-header">
            <h2>Promo This Week</h2>
        </div>
        <div class="promo-items">
            <?php if (!empty($promos)): ?>
            <?php foreach ($promos as $promo): ?>
            <div class="promo-item">
                <img src="<?php echo base_url('assets/image/promo/' . $promo->image_name); ?>"
                    alt="<?php echo $promo->title; ?>">
                <p><?php echo $promo->title; ?></p>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <?php if (empty($promo_this_week)) : ?>
            <div class="no-promo">
                <p>🔪 Unavailable Promo, <span>Comeback Soon!</span></p>
            </div>
            <?php else : ?>
            <ul>
                <?php foreach ($promo_this_week as $promo) : ?>
                <li><?= htmlspecialchars($promo) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Brand Section -->
    <div class="brand-section">
        <div class="promo-header">
            <h2 style="cursor: pointer;">Explore Our Brand</h2>
        </div>
        <div class="promo-items">
            <?php if (!empty($brands)): ?>
                <?php foreach($brands as $brand): ?>
                    <div class="promo-item">
                        <a href="<?php echo base_url('brand/detail?brand_name=' . strtolower(str_replace(' ', '', $brand->name))); ?>" 
                           class="promo-item-link" style="text-decoration: none;">
                            <img src="<?php echo base_url('assets/image/logo/' . $brand->image); ?>" 
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
                                <img src="<?php echo base_url('assets/image/logo/' . $brand->image); ?>" 
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
        <h2>Rewards</h2>
        <div class="reward-items">
            <?php if (!empty($rewards)): ?>
            <?php foreach ($rewards as $reward): ?>
            <div class="reward-item" data-id="<?php echo $reward->id; ?>">
                <img src="<?php echo base_url('assets/image/reward/' . $reward->image_name); ?>"
                    alt="<?php echo $reward->title; ?>">
                <div class="reward-info">
                    <div class="reward-title"><?php echo $reward->title; ?></div>
                    <div class="reward-points">
                        <span class="points-value"><?php echo $reward->points_required; ?></span>
                        <span class="points-text">Poin</span>
                    </div>
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

    <div class="news-section">
        <h2>News & Event</h2>
        <div class="news-grid">
            <?php if (!empty($news)): ?>
            <?php foreach ($news as $news_item): ?>
            <div class="news-item">
                <img src="<?= base_url("assets/image/news&event/{$news_item->image}") ?>"
                    alt="<?= $news_item->title ?>">
                <div class="news-content">
                    <h3><?= $news_item->title ?></h3>
                    <p><?= $news_item->description ?></p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <?php if (empty($promo_this_week)) : ?>
            <div class="no-promo">
                <p>🔪 Unavailable Promo, <span>Comeback Soon!</span></p>
            </div>
            <?php else : ?>
            <ul>
                <?php foreach ($promo_this_week as $promo) : ?>
                <li><?= htmlspecialchars($promo) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <a href="https://wa.me/6282283619320" class="whatsapp-section" style="text-decoration: none;">
        <img src="<?php echo base_url('assets/image/icon/whatsapp.png') ?>" alt="WhatsApp">
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
        const modalValidity = document.getElementById(
            "modalValidity"); // Tambahkan elemen untuk masa aktif voucher
        const modalBranches = document.getElementById("modalBranches");
        const redeemLink = document.getElementById("redeemLink");
        const closeButton = document.querySelector(".close");
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

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        function fetchRewardData(rewardId) {
            console.log("Fetching reward data for ID:", rewardId); // Debugging
            fetch("<?= base_url('reward/get_reward/'); ?>" + rewardId)
                .then(response => response.text())
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        modalImage.src = "<?= base_url('assets/image/reward/'); ?>" + data.image_name;
                        modalTitle.innerText = data.title;
                        modalPoints.innerText = "Poin: " + data.points_required;
                        modalDescription.innerText = data.description; // Tampilkan deskripsi dari database
                        modalValidity.innerText = "Voucher validity: " + data.total_days +
                            " days after redeem"; // Display voucher validity
                        modalBranches.innerHTML = data.branches.map(branch =>
                            `<span class="branch-badge">${branch.branch_name}</span>`).join('');
                        redeemLink.href = "javascript:redeemReward(" + rewardId + ");";
                        modal.style.display = "flex"; // Tampilkan modal
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                        console.error("Response text:", text);
                        alert("An error occurred while fetching reward data. Please try again later.");
                    }
                })
                .catch(error => console.error("Error fetching reward data:", error));
        }

        window.redeemReward = function(rewardId) {
            fetch("<?= base_url('reward/redeem'); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "reward_id": rewardId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Redeem reward response:", data); // Debugging
                    if (data.status === 'success') {
                        alert('Reward redeemed successfully');
                        modal.style.display = "none";
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error redeeming reward:", error));
        }
    });
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>

</html>