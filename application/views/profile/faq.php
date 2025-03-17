<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/faq.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/index.css')?>"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.history.back()">←</button>
        <div class="title">FAQ</div>
    </div>

    <!-- FAQ Container -->
    <div class="faq-container">
        <?php if (!empty($faqs)): ?>
            <?php foreach ($faqs as $faq): ?>
                <div class="faq-item">
                    <div class="faq-question"><?php echo $faq->question; ?></div>
                    <div class="faq-answer"><?php echo $faq->answer; ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-faq">
                <p>No FAQs available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Toggle FAQ answers
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
