<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $news->title ?? 'News Detail'; ?> - Teras Japan</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/news.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Transaction</div>
    </div>

    <!-- News Card -->
    <div class="news-container">
      <?php if (isset($news)): ?>
      <div class="news-card">
        <div class="news-header">
          <img class="news-image" 
               src="<?php echo news_url($news->image); ?>" 
               alt="<?php echo $news->title; ?>" />
          <div>
            <div class="news-title"><?php echo $news->title; ?></div>
            <div class="news-subtitle">Teras Japan</div>
          </div>
        </div>

        <div class="news-section-title">What's going on?</div>
        <div class="news-description">
          <?php echo $news->description; ?>
        </div>
      </div>
      <?php else: ?>
      <div class="no-news">
        <p>News not found or no longer available.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?php include 'application/views/layout/Footer.php'; ?>
</body>

</html>
