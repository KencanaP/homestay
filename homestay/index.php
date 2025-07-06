<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Test Page</title>
    <link rel="stylesheet" href="css/style.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link
        href="https://cdn.boxicons.com/fonts/basic/boxicons.min.css"
        rel="stylesheet" />
</head>

<body>
    <header>
        <div class="header">
            <a href="#default" class="logo">Logo</a>
            <div class="header-right">
                <a href="#home">Home</a>
                <a href="#about">About Us</a>
                <a href="#listing">Listing</a>
                <div class="dropdown">
                    <button class="dropdown-btn">
                        Account <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="login.php">Log In</a>
                        <a href="login.phpx">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Slideshow container -->
    <section class="home">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="/assets/img/hs1.jpg" style="width: 100%" />
                <div class="text">Caption Text</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="assets/img/hs2.jpg" style="width: 100%" />
                <div class="text">Caption Two</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="assets/img/hs3.jpg" style="width: 100%" />
                <div class="text">Caption Three</div>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br />

        <!-- Dots -->
        <div style="text-align: center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </section>
    <!--about section-->
    <section class="about" id="about">
        <div class="wrapper">
            <div class="container">
                <h2>About Us</h2>
                <p>
                    We are a team of passionate individuals dedicated to making the
                    world a better place through innovative solutions and community
                    engagement.
                </p>
                <p>
                    Our mission is to empower people with the tools and knowledge they
                    need to create positive change in their lives and communities.
                </p>
            </div>
        </div>
    </section>
    <!-- Listing Section -->
    <section class="listing" id="listing">
        <div class="wrapper">
            <div class="container">
                <input type="radio" name="slide" id="c1" checked />
                <label for="c1" class="card">
                    <div class="row">
                        <div class="icon">1</div>
                        <div class="description">
                            <h4>Winter</h4>
                            <p>Winter has so much to offer - creative activities</p>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c2" />
                <label for="c2" class="card">
                    <div class="row">
                        <div class="icon">2</div>
                        <div class="description">
                            <h4>Digital Technology</h4>
                            <p>
                                Gets better every day - stay tuned Lorem ipsum, dolor sit amet
                                consectetur adipisicing elit. Omnis, earum dolores. Et culpa
                                mollitia blanditiis, minima autem cum magnam sed est repellat
                                aut nisi hic, neque aliquam ratione assumenda voluptate!
                            </p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </section>

    <!-- Scroll to Top Button -->
    <button onclick="topFunction()" id="topBtn" title="Go to top">
        <i class="bx bx-arrow-big-up-line" style="color: #ffffff"></i>
    </button>

    <!-- JS for Scroll to Top Button -->
    <script>
        let mybutton = document.getElementById("topBtn");

        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.classList.add("show");
            } else {
                mybutton.classList.remove("show");
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

    <!-- Carousel JS -->
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 2000);
        }
    </script>
    <script>
        const footer = document.getElementById("pageFooter");

        window.addEventListener("scroll", () => {
            const scrollable =
                document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = window.scrollY || document.documentElement.scrollTop;

            if (scrolled + 5 >= scrollable) {
                footer.classList.add("show");
            } else {
                footer.classList.remove("show");
            }
        });
    </script>
</body>
<footer id="pageFooter">
    <div class="footer-content">
        <p>&copy; 2025 My Website. All rights reserved.</p>
    </div>
</footer>

</html>