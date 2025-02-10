<?php
// Include brands.php file
require_once 'brands.php';

// Ternary operator to check if $_GET['brand'] is set, and the default value is 'terasjapan'
$currentBrand = isset($_GET['brand']) ? $_GET['brand'] : 'terasjapan';

// Get the brand data
$brandData = $brands[$currentBrand] ?? $brands['terasjapan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shogun App</title>
    <link rel="stylesheet" href="../assets/css/explore.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="icon" type="image/x-icon" href="../assets/image/logo/logo-amigos.png">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header-wrapper">
            <div class="header-top-container">
                <img class="header-logo" src="../assets/image/logo/logo-terasjapan-white.png" alt="Teras Japan Logo" />
                <h1 class="header-title-text">Teras Heroes Club</h1>
            </div>
        </div>

        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-container">
                <div class="brand-items">
                    <div class="brand-title">
                        <img class="brand-logo" src="<?php echo $brandData['logo']; ?>"
                            alt="<?php echo $brandData['name']; ?>">
                        <p class="brand-name"><?php echo $brandData['name']; ?></p>
                    </div>
                    <img class="brand-image" src="<?php echo $brandData['banner']; ?>"
                        alt="<?php echo $brandData['name']; ?>" />
                    <div class="brand-detail">
                        <div class="brand-social">
                            <a class="whatsapp" href="<?php echo $brandData['linkWa']; ?>" target="_blank">
                                <img src="../assets/image/icon/whatsapp1.png" alt="Whatsapp" />
                            </a>
                            <a class="website" href="<?php echo $brandData['linkWeb']; ?>" target="_blank">
                                <img src="../assets/image/icon/globe.png" alt="Website" />
                            </a>
                            <a class="tiktok" href="<?php echo $brandData['linkTiktok']; ?>" target="_blank">
                                <img src="../assets/image/icon/tiktok1.png" alt="tiktok" />
                            </a>
                        </div>
                        <div class="brand-description">
                            <a href="<?php echo $brandData['link']; ?>">Brand detail...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Section -->
        <div class="promo-section">
            <h2>Available Promo</h2>
            <div class="promo-items">
                <?php foreach ($brandData['promos'] as $promo): ?>
                <div class="promo-item">
                    <img src="<?php echo $promo['image']; ?>" alt="<?php echo $promo['name']; ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="promo2-section">
            <h2>Coming Soon Promo</h2>
            <div class="promo2-items">
                <?php foreach ($brandData['promos'] as $promo): ?>
                <div class="promo2-item">
                    <img src="<?php echo $promo['image']; ?>" alt="<?php echo $promo['name']; ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar hidden">
            <div class="sidebar-content">
                <?php foreach ($brands as $brand): ?>
                <a href="#" data-brand="<?php echo $brand['id']; ?>" class="brand-link">
                    <img src="<?php echo $brand['logo']; ?>" alt="<?php echo $brand['name']; ?>" />
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
                const response = await fetch(`get_brand_data.php?brand=${brandId}`);
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
                window.history.pushState({}, '', `explore.php?brand=${brandId}`);
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
<?php include 'Footer.php'; ?>

</html>