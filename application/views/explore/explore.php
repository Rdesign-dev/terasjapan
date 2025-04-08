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
                <img class="header-logo" src="http://localhost/ImageTerasJapan/logo/tjwhite.png"
                    alt="Teras Japan" />
                <h1 class="header-title-text">Teras Heroes Club</h1>
            </div>
        </div>

        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-container">
                <div class="brand-items">
                    <div class="brand-title">
                        <img class="brand-logo" src= 'http://localhost/ImageTerasJapan/logo/<?php echo $brand->image; ?>'
                            alt="<?php echo $brand->name; ?>">
                        <p class="brand-name"><?php echo $brand->name; ?></p>
                    </div>
                    <img class="brand-image" src= 'http://localhost/ImageTerasJapan/banner/<?php echo $brand->banner; ?>'
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
                                    'icon' => 'http://localhost/ImageTerasJapan/icon/instagram.png'
                                ];
                            }
                            
                            if($brand->tiktok) {
                                $social_media[] = [
                                    'type' => 'tiktok',
                                    'url' => "https://tiktok.com/@" . str_replace('@', '', $brand->tiktok),
                                    'icon' => 'http://localhost/ImageTerasJapan/icon/tiktok.png'
                                ];
                            }
                            
                            if($brand->wa) {
                                $social_media[] = [
                                    'type' => 'whatsapp',
                                    'url' => "https://wa.me/" . $brand->wa,
                                    'icon' => 'http://localhost/ImageTerasJapan/icon/whatsapp.png'
                                ];
                            }
                            
                            if($brand->web) {
                                $webUrl = (strpos($brand->web, 'http') === 0) ? $brand->web : 'https://' . $brand->web;
                                $social_media[] = [
                                    'type' => 'website',
                                    'url' => $webUrl,
                                    'icon' => 'http://localhost/ImageTerasJapan/icon/globe.png'
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
                <div class="promo-item">
                    <img src="http://localhost/ImageTerasJapan/promo/<?php echo $promo->promo_image; ?>"
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

        <!-- Coming Soon Promo Section -->
        <div class="coming-section">
            <h2>Coming Soon Promo</h2>
            <div class="coming-items">
                <?php if (!empty($coming_promos)): ?>
                <?php foreach ($coming_promos as $promo): ?>
                <div class="coming-item">
                    <img src="http://localhost/ImageTerasJapan/promo/<?php echo $promo->promo_image; ?>"
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
        <div class="promo-section">
            <h2>Available Reward</h2>
            <div class="promo-items">
                <?php if (!empty($available_promos)): ?>
                <?php foreach ($available_promos as $promo): ?>
                <div class="promo-item">
                    <img src="http://localhost/ImageTerasJapan/promo/<?php echo $promo->promo_image; ?>"
                        alt="<?php echo $promo->promo_name; ?>">
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-promo">
                        <p>🔪 Unavailable Reward, <span>Comeback Soon!</span></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Coming Soon Promo Section -->
        <div class="coming-section">
            <h2>Coming Soon Reward</h2>
            <div class="coming-items">
                <?php if (!empty($coming_promos)): ?>
                <?php foreach ($coming_promos as $promo): ?>
                <div class="coming-item">
                    <img src="http://localhost/ImageTerasJapan/promo/<?php echo $promo->promo_image; ?>"
                        alt="<?php echo $promo->promo_name; ?>">
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
                    <img src='http://localhost/ImageTerasJapan/logo/<?php echo $sidebar_brand->image; ?>'"
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
        const availablePromos = brandData.available_promos;
        const comingPromos = brandData.coming_promos;

        // Update brand section
        document.querySelector('.brand-logo').src = brandData.logo;
        document.querySelector('.brand-logo').alt = brandData.name;
        document.querySelector('.brand-name').textContent = brandData.name;
        document.querySelector('.brand-image').src = brandData.banner;
        document.querySelector('.brand-image').alt = brandData.name;

        // Update social media links
        const socialContainer = document.querySelector('.brand-social');
        let socialMedia = [];
        
        if (brandData.instagram) {
            socialMedia.push({
                type: 'instagram',
                url: `https://instagram.com/${brandData.instagram.replace(/(@|instagram\.com\/)/g, '')}`,
                icon: '<?php echo base_url("assets/image/icon/instagram.png"); ?>'
            });
        }
        
        if (brandData.tiktok) {
            socialMedia.push({
                type: 'tiktok',
                url: `https://tiktok.com/@${brandData.tiktok.replace('@', '')}`,
                icon: '<?php echo base_url("assets/image/icon/tiktok.png"); ?>'
            });
        }
        
        if (brandData.wa) {
            socialMedia.push({
                type: 'whatsapp',
                url: `https://wa.me/${brandData.wa}`,
                icon: '<?php echo base_url("assets/image/icon/whatsapp.png"); ?>'
            });
        }
        
        if (brandData.web) {
            const webUrl = brandData.web.startsWith('http') ? brandData.web : `https://${brandData.web}`;
            socialMedia.push({
                type: 'website',
                url: webUrl,
                icon: '<?php echo base_url("assets/image/icon/globe.png"); ?>'
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
            <img src="http://localhost/ImageTerasJapan/promo/${promo.promo_image}" 
                 alt="${promo.promo_name}">
        </div>
    `).join('');

        const comingPromoContainer = brandData.coming_promos.map(promo => `
        <div class="coming-item">
            <img src="http://localhost/ImageTerasJapan/promo/${promo.promo_image}" 
                 alt="${promo.promo_name}">
        </div>
    `).join('');

        document.querySelector('.promo-items').innerHTML = availablePromoContainer || '<p>No available promos</p>';
        document.querySelector('.coming-items').innerHTML = comingPromoContainer || '<p>No upcoming promos</p>';
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
</body>


</html>
