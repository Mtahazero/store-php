 <!-- Footer -->
 <footer>
        <div class="footer-container">
            <div class="footer-col">
                <h3>ShopNow</h3>
                <p>Your one-stop shop for all your needs. We offer quality products at affordable prices with excellent customer service.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h3>Customer Service</h3>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Order Tracking</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Street, City, Country</li>
                    <li><i class="fas fa-phone"></i> +1 234 567 890</li>
                    <li><i class="fas fa-envelope"></i> info@shopnow.com</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2023 ShopNow. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenu = document.querySelector('.mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });
    </script>