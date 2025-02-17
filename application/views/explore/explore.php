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
                <img class="header-logo" src="<?php echo base_url('assets/image/logo/' . $brand->image); ?>" 
                     alt="<?php echo $brand->name; ?>" />
                <h1 class="header-title-text">Teras Heroes Club</h1>
            </div>
        </div>

        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-container">
                <div class="brand-items">
                    <div class="brand-title">
                        <img class="brand-logo" src="<?php echo base_url('assets/image/logo/' . $brand->image); ?>"
                            alt="<?php echo $brand->name; ?>">
                        <p class="brand-name"><?php echo $brand->name; ?></p>
                    </div>
                    <img class="brand-image" src="<?php echo base_url('assets/image/banner/' . $brand->banner); ?>"
                        alt="<?php echo $brand->name; ?>" />
                    <div class="brand-detail">
                        <div class="brand-social">
                            <?php if($brand->wa): ?>
                            <a class="whatsapp" href="https://wa.me/<?php echo $brand->wa; ?>" target="_blank">
                                <img src="<?php echo base_url('assets/image/icon/whatsapp.png'); ?>" alt="Whatsapp" />
                            </a>
                            <?php endif; ?>
                            
                            <?php if($brand->web): ?>
                            <a class="website" href="<?php echo $brand->web; ?>" target="_blank">
                                <img src="<?php echo base_url('assets/image/icon/globe.png'); ?>" alt="Website" />
                            </a>
                            <?php endif; ?>
                            
                            <?php if($brand->tiktok): ?>
                            <a class="tiktok" href="https://www.tiktok.com/@<?php echo $brand->tiktok; ?>" target="_blank">
                                <img src="<?php echo base_url('assets/image/icon/tiktok.png'); ?>" alt="tiktok" />
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="brand-description">
                            <a href="<?php echo base_url('brand/detail?brand_name=' . strtolower(str_replace(' ', '', $brand->name))); ?>">
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
                        <img src="<?php echo base_url('assets/image/promo/' . $promo->promo_image); ?>" 
                             alt="<?php echo $promo->promo_name; ?>">
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No available promos</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Coming Soon Promo Section -->
        <div class="promo-section">
            <h2>Coming Soon Promo</h2>
            <div class="promo-items">
                <?php if (!empty($coming_promos)): ?>
                    <?php foreach ($coming_promos as $promo): ?>
                    <div class="promo-item">
                        <img src="<?php echo base_url('assets/image/promo/' . $promo->promo_image); ?>" 
                             alt="<?php echo $promo->promo_name; ?>">
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No upcoming promos</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar hidden">
            <div class="sidebar-content">
                <?php foreach ($all_brands as $sidebar_brand): ?>
                <a href="#" data-brand="<?php echo $sidebar_brand->id; ?>" class="brand-link">
                    <img src="<?php echo base_url('assets/image/logo/' . $sidebar_brand->image); ?>" 
                         alt="<?php echo $sidebar_brand->name; ?>" />
                </a>
                <?php endforeach; ?>
            </div>
        </div>

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
                const response = await fetch(`<?php echo base_url('explore/get_brand_data?brand='); ?>${brandId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const brandData = await response.json();

                // Update the page content
                updatePageContent(brandData);
                // Smooth scroll
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                // Update URL without page reload
                window.history.pushState({}, '', `<?php echo base_url('explore?brand='); ?>${brandId}`);
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    // Function to update page content
    function updatePageContent(brandData) {
        // Update brand section
        document.querySelector('.brand-logo').src = brandData.logo;
        document.querySelector('.brand-name').textContent = brandData.name;
        document.querySelector('.brand-image').src = brandData.banner;
        document.querySelector('.whatsapp').href = brandData.linkWa;
        document.querySelector('.website').href = brandData.linkWeb;
        document.querySelector('.tiktok').href = brandData.linkTiktok;
        document.querySelector('.brand-description a').href = brandData.link;

        // Update promo section
        const promoContainer = brandData.promos.map(promo => `
            <div class="promo-item">
                <img src="${promo.image}" alt="${promo.name}">
            </div>
        `).join('');

        // Update first promo section
        document.querySelector('.promo-items').innerHTML = promoContainer;

        // Update second promo section
        document.querySelector('.promo2-items').innerHTML = promoContainer;
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
<?php include 'application/views/layout/Footer.php'; ?>
</html>