<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Our Brands</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/explore.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="icon" type="image/x-icon" href="../assets/image/logo/logo-amigos.png">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header-wrapper">
            <div class="header-top-container">
                <img class="header-logo" src="https://terasjapan.com/ImageTerasJapan/logo/tjwhite.png"
                    alt="Teras Japan" />
                <h1 class="header-title-text">Teras Heroes Club</h1>
            </div>
        </div>

        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-container">
                <div class="brand-items">
                    <div class="brand-title">
                        <img class="brand-logo" src="https://terasjapan.com/ImageTerasJapan/logo/<?php echo $brand->image; ?>"
                            alt="<?php echo $brand->name; ?>">
                        <p class="brand-name"><?php echo $brand->name; ?></p>
                    </div>
                    <img class="brand-image" src="https://terasjapan.com/ImageTerasJapan/banner/<?php echo $brand->banner; ?>"
                        alt="<?php echo $brand->name; ?>" />
                    <div class="brand-detail">
                        <div class="brand-social">
                            <?php 
                            // Create array of available social media
                            $social_media = [];
                            
                            // Update the PHP section for Instagram
                            if($brand->instagram) {
                                $social_media[] = [
                                    'type' => 'instagram',
                                    'url' => "https://instagram.com/" . str_replace(['@', 'instagram.com/'], '', $brand->instagram),
                                    'icon' => 'https://terasjapan.com/ImageTerasJapan/icon/instagram.png'
                                ];
                            }
                            
                            if($brand->tiktok) {
                                $social_media[] = [
                                    'type' => 'tiktok',
                                    'url' => "https://tiktok.com/@" . str_replace('@', '', $brand->tiktok),
                                    'icon' => 'https://terasjapan.com/ImageTerasJapan/icon/tiktok.png'
                                ];
                            }
                            
                            if($brand->wa) {
                                $social_media[] = [
                                    'type' => 'whatsapp',
                                    'url' => "https://wa.me/" . $brand->wa,
                                    'icon' => 'https://terasjapan.com/ImageTerasJapan/icon/whatsapp.png'
                                ];
                            }
                            
                            if($brand->web) {
                                $webUrl = (strpos($brand->web, 'http') === 0) ? $brand->web : 'https://' . $brand->web;
                                $social_media[] = [
                                    'type' => 'website',
                                    'url' => $webUrl,
                                    'icon' => 'https://terasjapan.com/ImageTerasJapan/icon/globe.png'
                                ];
                            }

                            // Display only up to 3 social media links
                            $social_media = array_slice($social_media, 0, 3);
                            
                            foreach($social_media as $social): ?>
                                <a class="<?php echo $social['type']; ?>" href="<?php echo $social['url']; ?>" target="_blank">
                                    <img src="<?php echo ($social['icon']); ?>" 
                                        class="<?php echo $social['type']; ?>" 
                                        alt="<?php echo ucfirst($social['type']); ?>" />
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="brand-description">
                            <a
                                href="<?php echo base_url('brand/detail?brand_name=' . strtolower(str_replace(' ', '', $brand->name))); ?>">
                                Brand detail...
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Promo Section -->
        <div class="promo-section">
            <h2>Available Promo</h2>
            <div class="promo-items">
                <?php if (!empty($available_promos)): ?>
                <?php foreach ($available_promos as $promo): ?>
                    <div class="promo-item" data-description="<?php echo htmlspecialchars($promo->description ?? ''); ?>">
                        <img src="https://terasjapan.com/ImageTerasJapan/promo/<?php echo $promo->promo_image; ?>"
                            alt="<?php echo $promo->promo_name; ?>">
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

        <!-- Coming Soon Promo Section -->
        <div class="coming-section">
            <h2>Coming Soon Promo</h2>
            <div class="coming-items">
                <?php if (!empty($coming_promos)): ?>
                <?php foreach ($coming_promos as $promo): ?>
                <div class="coming-item">
                    <img src="https://terasjapan.com/ImageTerasJapan/promo/<?php echo $promo->promo_image; ?>"
                        alt="<?php echo $promo->promo_name; ?>">
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-promo">
                        <p>🔪 Unavailable Promo, <span>Comeback Soon!</span></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Available reward Section -->
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

        <!-- Sidebar -->
        <div class="sidebar hidden">
            <div class="sidebar-content">
                <?php foreach ($all_brands as $sidebar_brand): ?>
                <a href="#" data-brand="<?php echo $sidebar_brand->id; ?>" class="brand-link">
                    <img src="https://terasjapan.com/ImageTerasJapan/logo/<?php echo $sidebar_brand->image; ?>"
                        alt="<?php echo $sidebar_brand->name; ?>" />
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'application/views/layout/Footer.php'; ?>
    </div>

    <script>
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


    // Handle sidebar brand clicks
    document.querySelectorAll('.brand-link').forEach(link => {
        link.addEventListener('click', async function(e) {
            e.preventDefault();
            const brandId = this.dataset.brand;

            try {
                // Fetch brand data
                const response = await fetch(
                    `<?php echo base_url('explore/get_brand_data?brand='); ?>${brandId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const brandData = await response.json();

                // Update the page content
                updatePageContent(brandData);
                // Smooth scroll
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    // Function to update page content
    function updatePageContent(brandData) {
        // Update brand section
        document.querySelector('.brand-logo').src = `https://terasjapan.com/ImageTerasJapan/logo/${brandData.image}`;
        document.querySelector('.brand-name').textContent = brandData.name;
        document.querySelector('.brand-image').src = `https://terasjapan.com/ImageTerasJapan/banner/${brandData.banner}`;
        document.querySelector('.brand-image').alt = brandData.name;

        // Update social media links
        const socialContainer = document.querySelector('.brand-social');
        let socialMedia = [];
        
        if (brandData.instagram) {
            socialMedia.push({
                type: 'instagram',
                url: `https://instagram.com/${brandData.instagram.replace(/(@|instagram\.com\/)/g, '')}`,
                icon: 'https://terasjapan.com/ImageTerasJapan/icon/instagram.png'
            });
        }
        
        if (brandData.tiktok) {
            socialMedia.push({
                type: 'tiktok',
                url: `https://tiktok.com/@${brandData.tiktok.replace('@', '')}`,
                icon: 'https://terasjapan.com/ImageTerasJapan/icon/tiktok.png'
            });
        }
        
        if (brandData.wa) {
            socialMedia.push({
                type: 'whatsapp',
                url: `https://wa.me/${brandData.wa}`,
                icon: 'https://terasjapan.com/ImageTerasJapan/icon/whatsapp.png'
            });
        }
        
        if (brandData.web) {
            const webUrl = brandData.web.startsWith('http') ? brandData.web : `https://${brandData.web}`;
            socialMedia.push({
                type: 'website',
                url: webUrl,
                icon: 'https://terasjapan.com/ImageTerasJapan/icon/globe.png'
            });
        }

        // Take only first 3 social media
        socialMedia = socialMedia.slice(0, 3);
        
        const socialHTML = socialMedia.map(social => `
            <a class="${social.type}" href="${social.url}" target="_blank">
                <img src="${social.icon}" class="${social.type}" alt="${social.type}" />
            </a>
        `).join('');

        socialContainer.innerHTML = socialHTML;

        // Update link brand detail
        document.querySelector('.brand-description a').href =
            `<?php echo base_url('brand/detail?brand_name='); ?>${brandData.name.toLowerCase().replace(/\s/g, '')}`;

        // Update promo sections
        const availablePromoContainer = brandData.available_promos.map(promo => `
        <div class="promo-item">
            <img src="https://terasjapan.com/ImageTerasJapan/promo/${promo.promo_image}" 
                 alt="${promo.promo_name}">
        </div>
    `).join('');

        const comingPromoContainer = brandData.coming_promos.map(promo => `
        <div class="coming-item">
            <img src="https://terasjapan.com/ImageTerasJapan/promo/${promo.promo_image}" 
                 alt="${promo.promo_name}">
        </div>
    `).join('');

        // Add reward section update
        const availableRewardContainer = brandData.available_rewards.map(reward => `
        <div class="promo-item">
            <img src="https://terasjapan.com/ImageTerasJapan/reward/${reward.image_name}" 
                 alt="${reward.title}">
        </div>
    `).join('');

        // Update DOM
        document.querySelector('.promo-items').innerHTML = availablePromoContainer || 
            '<div class="no-promo"><p>🔪 Unavailable Promo, <span>Comeback Soon!</span></p></div>';
        document.querySelector('.coming-items').innerHTML = comingPromoContainer || 
            '<div class="no-promo"><p>🔪 Unavailable Promo, <span>Comeback Soon!</span></p></div>';
        // Update rewards section
        document.querySelectorAll('.promo-section')[1].querySelector('.promo-items').innerHTML = 
            availableRewardContainer || 
            '<div class="no-promo"><p>🔪 Unavailable Reward, <span>Comeback Soon!</span></p></div>';
    }

    // Visible sidebar on scroll
    window.addEventListener('scroll', () => {
        const sidebar = document.querySelector('.sidebar');

        if (window.scrollY > 20) {
            sidebar.classList.remove('hidden');
            sidebar.classList.add('show');
        } else {
            sidebar.classList.remove('show');
            sidebar.classList.add('hidden');
        }
    });
    </script>

    <!-- Add this script at the bottom of the file before </body> -->
    <script>
        // Add click event to promo items
        document.querySelectorAll('.promo-item').forEach(item => {
            item.addEventListener('click', function() {
                const promoImage = this.querySelector('img');
                const promoName = promoImage.alt;
                
                // Get promo data from data attributes
                const promoData = {
                    image: promoImage.src,
                    title: promoName,
                    description: this.dataset.description || 'No description available'
                };
                
                openPromoModal(promoData);
            });
        });

        // Function to open modal
        function openPromoModal(promoData) {
            const modal = document.getElementById('promoModal');
            const modalImage = document.getElementById('promoModalImage');
            const modalTitle = document.getElementById('promoModalTitle');
            const modalDescription = document.getElementById('promoModalDescription');

            // Set modal content
            modalImage.src = promoData.image;
            modalTitle.textContent = promoData.title;
            modalDescription.textContent = promoData.description;

            // Show modal
            modal.style.display = 'flex';
        }

        // Function to close modal
        function closePromoModal() {
            document.getElementById('promoModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            const modal = document.getElementById('promoModal');
            if (e.target === modal) {
                closePromoModal();
            }
        });
    </script>
</body>

</html>
