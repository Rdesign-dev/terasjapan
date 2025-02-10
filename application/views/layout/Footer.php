<div class="footer">
        <a href="<?php echo base_url('home/index'); ?>" class="home-link">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 12h3v8h6v-6h2v6h6v-8h3L12 2z"/>
                </svg>
            </span>
            Beranda
        </a>
        <a href="<?php echo base_url('explore'); ?>" onclick="setActive(this)">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </span>
            Explore
        </a>
        <a href="<?php echo base_url('history'); ?>" class="history-link" onclick="setActive(this)">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                </svg>
            </span>
            History
        </a>
        <a href="<?php echo base_url('profile'); ?>" onclick="setActive(this)">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </span>
            Profil  
        </a>
    </div>
    <script>
        function setActive(element) {
            // Remove active class from all links
            document.querySelectorAll('.footer a').forEach(link => {
                link.classList.remove('active');
            });
            // Add active class to clicked link
            element.classList.add('active');
        }

        // Set active class based on current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            console.log('Current Page:', currentPage);
            const links = document.querySelectorAll('.footer a');
            
            links.forEach(link => {
                const href = link.getAttribute('href');
                console.log('Checking link:', href);
                if (href && currentPage === href) {
                    link.classList.add('active');
                }
            });
        });
    </script>