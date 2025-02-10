<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/feedback.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/header.css'); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/image/logo/logo-amigos.png'); ?>">
</head>
<body>

    <div class="header">
        <div class="back-btn" onclick="history.back()">←</div>
        <div class="title">Send Feedback</div>
    </div>
    <div class="feedback-container">
        <h2 class="feedback-title">Feedback</h2>

        <form action="<?php echo base_url('profile/submit_feedback'); ?>" method="post">
            <textarea id="feedback-text" name="feedback_text" placeholder="your feedback will be anonymous" maxlength="1000" required></textarea>
            <p class="char-count"><span id="char-count">0</span>/1000 chars</p>

            <div class="feedback-category">
                <button type="button" class="category-btn active" onclick="selectCategory(this)">Suggestion</button>
                <button type="button" class="category-btn" onclick="selectCategory(this)">Bug</button>
                <button type="button" class="category-btn" onclick="selectCategory(this)">Other</button>
                <input type="hidden" name="category" id="category" value="Suggestion">
            </div>

            <p class="feedback-question">How was your experience with us?</p>
            <div class="feedback-rating">
                <span class="emoji" onclick="selectEmoji(this)" data-rating="1">😭</span>
                <span class="emoji" onclick="selectEmoji(this)" data-rating="2">☹️</span>
                <span class="emoji" onclick="selectEmoji(this)" data-rating="3">😐</span>
                <span class="emoji" onclick="selectEmoji(this)" data-rating="4">🙂</span>
                <span class="emoji" onclick="selectEmoji(this)" data-rating="5">😊</span>
                <input type="hidden" name="rating" id="rating" value="5">
            </div>

            <button type="submit" id="send-feedback">Submit Feedback</button>
        </form>
    </div>

    <script>
        document.getElementById("feedback-text").addEventListener("input", function() {
            document.getElementById("char-count").innerText = this.value.length;
        });

        function selectCategory(element) {
            document.querySelectorAll(".category-btn").forEach(btn => btn.classList.remove("active"));
            element.classList.add("active");
            document.getElementById("category").value = element.innerText;
        }

        function selectEmoji(element) {
            document.querySelectorAll(".emoji").forEach(emoji => emoji.classList.remove("active"));
            element.classList.add("active");
            document.getElementById("rating").value = element.getAttribute("data-rating");
        }
    </script>
</body>
<?php include 'application/views/layout/Footer.php'; ?>
</html>
