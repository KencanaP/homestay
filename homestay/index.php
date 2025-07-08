<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seri Mendapat Vila</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Header Navigation -->
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="#home" class="logo">
                    <img src="assets/img/logoSMV.png" alt="Seri Mendapat Vila Logo" />
                </a>
            </div>
            <nav class="header-right">
                <a href="#home" class="nav-link">Home</a>
                <a href="#about" class="nav-link">About Us</a>
                <a href="#listing" class="nav-link">Listing</a>
                <div class="dropdown">
                    <button class="dropdown-btn">
                        Account <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="login.php">Log In/Register</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section with Slideshow -->
    <section class="hero" id="home">
        <div class="slideshow-container">
            <!-- Slide 1 -->
            <div class="slide active">
                <img src="assets/img/hs1.jpg" alt="Villa Showcase 1" />
                <div class="slide-content">
                    <h2>Luxury Villa Experience</h2>
                    <p>Discover your perfect getaway destination</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide">
                <img src="assets/img/hs2.jpg" alt="Villa Showcase 2" />
                <div class="slide-content">
                    <h2>Premium Accommodations</h2>
                    <p>Experience comfort and elegance like never before</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide">
                <img src="assets/img/hs3.jpg" alt="Villa Showcase 3" />
                <div class="slide-content">
                    <h2>Unforgettable Memories</h2>
                    <p>Create lasting moments in our beautiful villas</p>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button class="slide-nav prev" onclick="changeSlide(-1)" aria-label="Previous slide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slide-nav next" onclick="changeSlide(1)" aria-label="Next slide">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Slide Indicators -->
        <div class="slide-indicators">
            <button class="indicator active" onclick="currentSlide(1)" aria-label="Go to slide 1"></button>
            <button class="indicator" onclick="currentSlide(2)" aria-label="Go to slide 2"></button>
            <button class="indicator" onclick="currentSlide(3)" aria-label="Go to slide 3"></button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-content">
                <h2>About Seri Mendapat Vila</h2>
                <p>
                    We are a premier villa rental service dedicated to providing exceptional
                    accommodation experiences. Our carefully curated collection of luxury villas
                    offers the perfect blend of comfort, style, and location.
                </p>
                <p>
                    Our mission is to create unforgettable memories for our guests by offering
                    world-class amenities, personalized service, and stunning properties that
                    serve as your home away from home.
                </p>
                <div class="about-features">
                    <div class="feature">
                        <i class="fas fa-home"></i>
                        <h3>Premium Villas</h3>
                        <p>Handpicked luxury accommodations</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-concierge-bell"></i>
                        <h3>Exceptional Service</h3>
                        <p>24/7 customer support</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Prime Locations</h3>
                        <p>Beautiful destinations worldwide</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Listing Section -->
    <section class="listing" id="listing">
        <div class="container">
            <h2>Featured Properties</h2>
            <div class="property-showcase">
                <input type="radio" name="property" id="property1" checked />
                <input type="radio" name="property" id="property2" />
                <input type="radio" name="property" id="property3" />

                <div class="property-cards">
                    <label for="property1" class="property-card">
                        <div class="card-image">
                            <img src="assets/img/villaA.png" alt="1SK Villa" />
                        </div>
                        <div class="card-content">
                            <div class="card-number">01</div>
                            <div class="card-details">
                                <h3>One Storey Kampung Villa</h3>
                                <p>For Those Who Enjoy a Simple Life</p>
                                <div class="card-features">
                                    <span><i class="fas fa-bed"></i> 3 Bedrooms</span>
                                    <span><i class="fas fa-bath"></i> 2 Bathrooms</span>
                                    <span><i class="fas fa-users"></i> 6-8 Guests</span>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label for="property2" class="property-card">
                        <div class="card-image">
                            <img src="assets/img/villaB.png" alt="2SK Villa" />
                        </div>
                        <div class="card-content">
                            <div class="card-number">02</div>
                            <div class="card-details">
                                <h3>Two Storey Kampung Villa</h3>
                                <p>For Those Who Seek Comfort in Their Simple Life</p>
                                <div class="card-features">
                                    <span><i class="fas fa-bed"></i> 5 Bedrooms</span>
                                    <span><i class="fas fa-bath"></i> 4 Bathrooms</span>
                                    <span><i class="fas fa-users"></i> 10-15 Guests</span>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label for="property3" class="property-card">
                        <div class="card-image">
                            <img src="assets/img/villaC.png" alt="Seaside Villa" />
                        </div>
                        <div class="card-content">
                            <div class="card-number">03</div>
                            <div class="card-details">
                                <h3>Modern House Villa</h3>
                                <p>For Those Who Seek a Maximum Confort in Their Life</p>
                                <div class="card-features">
                                    <span><i class="fas fa-bed"></i> 4 Bedrooms</span>
                                    <span><i class="fas fa-bath"></i> 3 Bathrooms</span>
                                    <span><i class="fas fa-users"></i> 8-10 Guests</span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Seri Mendapat Vila</h3>
                    <p>Your gateway to luxury villa experiences</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#listing">Listings</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact</h4>
                    <p>Email: info@serimendapatvila.com</p>
                    <p>Phone: +60 123 456 789</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Seri Mendapat Vila. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" class="scroll-top-btn" onclick="scrollToTop()" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        // Slideshow functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = slides.length;

        function showSlide(index) {
            // Hide all slides
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));

            // Show current slide
            slides[index].classList.add('active');
            indicators[index].classList.add('active');
        }

        function nextSlide() {
            currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
            showSlide(currentSlideIndex);
        }

        function changeSlide(direction) {
            currentSlideIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
            showSlide(currentSlideIndex);
        }

        function currentSlide(index) {
            currentSlideIndex = index - 1;
            showSlide(currentSlideIndex);
        }

        // Auto-advance slideshow
        setInterval(nextSlide, 5000);

        // Scroll to top functionality
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced dropdown functionality
        const dropdown = document.querySelector('.dropdown');
        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdownContent = document.querySelector('.dropdown-content');

        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    </script>
</body>

</html>
