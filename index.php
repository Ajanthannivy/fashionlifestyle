<?php 
include('db.php'); 
session_start();

?>

<html>
<head>
    <title>NC FASHION</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="top-bar">
        <a href="#">Marketplace</a>
        <a href="#">Help &amp; FAQs</a>
    </div>

    <div class="nav-bar">
        <div class="logo">
            <h1>NC Fashion</h1>
        </div>
        <div class="menu">
            <a href="womennav.php">WOMEN</a>
            <a href="mennav.php">MEN</a>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search for items and brands" />
        </div>

        <div class="navbar1">
            <div class="dropdown">
                <div class="icon">
                    <i class="fas fa-user"></i>
                    <!-- Display username if logged in -->
                    <?php if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) { ?>
                        <span id="name-display" style="display: inline-block; margin-left: 5px;">Welcome, <span id="name"><?php echo $_SESSION['user_name']; ?></span></span>
                    <?php } else { ?>
                        <span id="name-display" style="display: none; margin-left: 5px;">Welcome, <span id="name"></span></span>
                    <?php } ?>
                </div>
                <div class="dropdown-content" id="user-dropdown">
                    <div class="close"><i class="fas fa-times"></i></div>
                    <div class="header" id="auth-section">
                        <?php if (!isset($_SESSION['user_name'])) { ?>
                            <a href="login.php" id="login-link">Sign In</a>
                        <?php } else { ?>
                            <a href="logout.php" id="logout-link"></a>
                        <?php } ?>
                    </div>
                    <a href="myaccount.php" class="menu-item"><i class="fas fa-user"></i> My Account</a>
                    <a href="my_orders.html" class="menu-item"><i class="fas fa-calendar-alt"></i> My Orders</a>
                    <a href="#" class="menu-item"><i class="fas fa-question-circle"></i> Returns Information</a>
                    <a href="#" class="menu-item"><i class="fas fa-comment-dots"></i> Contact Preferences</a>
                    <?php if (isset($_SESSION['user_name'])) { ?>
                        <a href="logout.php" id="logout-link" class="menu-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php } ?>
                </div>
            </div>
        </div>
 

     
    </div>

    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loginLink = document.getElementById("login-link");
            const logoutLink = document.getElementById("logout-link");
            const authSection = document.getElementById("auth-section");
            
            function checkLoginStatus() {
                if (localStorage.getItem("loggedIn") === "true") {
                    authSection.style.display = "none";
                    logoutLink.style.display = "block";
                } else {
                    authSection.style.display = "block";
                    logoutLink.style.display = "none";
                }
            }

            loginLink.addEventListener("click", function () {
                localStorage.setItem("loggedIn", "true");
                checkLoginStatus();
            });

            logoutLink.addEventListener("click", function () {
                localStorage.removeItem("loggedIn");
                checkLoginStatus();
            });

            checkLoginStatus();
        });
    </script>
   
    <div class="contact-us" onclick="openChat('/frontend/chatbot.html')">
      &#128172; <span>Contact Us</span>
  </div>
  
  <script>
      function openChat(url) {
          window.location.href = url; // Redirects to the chatbot page
      }
  </script>

<!-- Chatbot Modal -->
<div id="chatbotModal" class="modal">
  <div class="modal-content">
      <span class="close" onclick="closeChat()">&times;</span>
      <iframe src="../frontend/chatbot.html" width="100%" height="400px"></iframe>
  </div>
</div>

<script>
  function openChat() {
      document.getElementById('chatbotModal').style.display = 'flex';
  }
  
  function closeChat() {
      document.getElementById('chatbotModal').style.display = 'none';
  }
  </script>


<script>//sigin logout script
 document.addEventListener("DOMContentLoaded", function () {
    const loginLink = document.getElementById("login-link");
    const joinLink = document.getElementById("join-link");
    const logoutLink = document.getElementById("logout-link");
    const authSection = document.getElementById("auth-section");
                  
    function checkLoginStatus() {
       if (localStorage.getItem("loggedIn") === "true") {
           authSection.style.display = "none";
            logoutLink.style.display = "block";
           } else {
              authSection.style.display = "block";
            logoutLink.style.display = "none";
           }
   }
      
    loginLink.addEventListener("click", function () {
       localStorage.setItem("loggedIn", "true");
          checkLoginStatus();
          });
      
          logoutLink.addEventListener("click", function () {
           localStorage.removeItem("loggedIn");
           checkLoginStatus();
            });
      
           checkLoginStatus();
           });
  </script>
     
   <div class="back-to-top" onclick="scrollToTop()">
   <i class="fas fa-chevron-up"></i>
        </div>
    
        <script>
            
            const backToTop = document.querySelector('.back-to-top');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTop.style.display = 'block';
                } else {
                    backToTop.style.display = 'none';
                }
            });
    
            function scrollToTop() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        </script>







    <div class="hero1">
        
        <h1>WELCOME TO OUR NC FASHION</h1>
    </div>

    <script>
        const heroSection = document.querySelector('.hero1');
        const backgrounds = [
             '../img/img7.png',
             '../img/home3.webp',
             '../img/home2.avif',
             '../img/img6.jpg',
            
            '../img/design2.jpg',
          
            
        ];
        let index = 0;
    
      
        function updateBackground() {
            heroSection.style.backgroundImage = `url("${backgrounds[index]}")`;
        }
    
      
        function nextBackground() {
            index = (index + 1) % backgrounds.length;
            updateBackground();
        }
    
        setInterval(nextBackground, 3000);
        updateBackground();
    </script>

<div class="product-section">
  <h2>New Arrivals</h2>
  <div class="product-container">
      <button class="scroll-btn left">&lt;</button> <!-- Left Scroll Button -->
      <div class="product-list">
          <div class="product-item">
              <img src="../img/banner1.jpg" alt="Product 1">
              <p>Stylish Jacket</p>
              <span>$49.99</span>
          </div>
          <div class="product-item">
              <img src="../img/banner1.jpg" alt="Product 2">
              <p>Casual Sneakers</p>
              <span>$39.99</span>
          </div>
          <div class="product-item">
              <img src="../img/banner1.jpg" alt="Product 3">
              <p>Elegant Dress</p>
              <span>$59.99</span>
          </div>
          <div class="product-item">
              <img src="../img/banner1.jpg" alt="Product 4">
              <p>Denim Jeans</p>
              <span>$44.99</span>
          </div>
          <div class="product-item">
              <img src="../img/banner1.jpg" alt="Product 5">
              <p>Summer T-Shirt</p>
              <span>$19.99</span>
          </div>
          <div class="product-item">
            <img src="../img/banner1.jpg" alt="Product 3">
            <p>Elegant Dress</p>
            <span>$59.99</span>
        </div>
        <div class="product-item">
            <img src="../img/banner1.jpg" alt="Product 4">
            <p>Denim Jeans</p>
            <span>$44.99</span>
        </div>
        <div class="product-item">
            <img src="../img/banner1.jpg" alt="Product 5">
            <p>Summer T-Shirt</p>
            <span>$19.99</span>
        </div>
      </div>
      <button class="scroll-btn right">&gt;</button> <!-- Right Scroll Button -->
  </div>
</div>
<script>document.addEventListener("DOMContentLoaded", function () {
  const scrollContainer = document.querySelector(".product-list");
  const leftBtn = document.querySelector(".scroll-btn.left");
  const rightBtn = document.querySelector(".scroll-btn.right");

  leftBtn.addEventListener("click", () => {
      scrollContainer.scrollBy({ left: -200, behavior: "smooth" });
  });

  rightBtn.addEventListener("click", () => {
      scrollContainer.scrollBy({ left: 200, behavior: "smooth" });
  });
});
</script>

   <div class="main-banner">
    <h1> 1000S OF STYLES IN NC </h1>
    <div class="code">With code: <span>25OFF</span></div>
    <div class="terms">Valid on selected products only .See website banner for full Ts&Cs.</div>
</div>
 
<section id="nc-banner" class="section-p1">
    <div class="banner-box">
    <h4>crazy deals</h4>
    <h2>buy 1 get 1 free</h2>
    <span>The best classic dress is on sale at NC</span>
    <button class="white ">learn more</button>
    </div>

    <div class="banner-box banner-box2" >
        <h4>Beach Clothes </h4>
        <h2>upcomming season</h2>
        <span>The best classic dress is on sale at NC</span>
        <button class="white ">collection</button>
        </div>
 </section>

<section id="banner3">
    <div class="banner-box ">
    <h2>SUMMER SALE</h2>
    <h3>THE WEEKEND ONLY</h3>
    </div>
    <div class="banner-box banner-box2 ">
        <h2>New Arrivals </h2>
        <h3>Fashion Sale</h3>
    </div>
    <div class="banner-box banner-box3 ">
            <h2>Unlock</h2>
            <h3>Your New Style</h3>
       </div>    
 </section>




<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <h2>About Us</h2>
            <p>
                NC Fashion is your one-stop destination for the latest trends in fashion. Discover a curated collection of clothing, accessories, and more to elevate your style.
            </p>
        </div>
        <div class="footer-section links">
            <h2>Quick Links</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop Women</a></li>
                <li><a href="#">Shop Men</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">FAQs</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h2>Contact Us</h2>
            <p><i class="fas fa-map-marker-alt"></i> 123 Fashion Street, Colombo</p>
            <p><i class="fas fa-phone-alt"></i> +94 (023) 456-789</p>
            <p><i class="fas fa-envelope"></i> support@ncfashion.com</p>
        </div>
        <div class="footer-section newsletter">
            <h2>Stay Connected</h2>
            <p>Subscribe to our newsletter to get the latest updates and offers.</p>
            <form>
                <input type="email" placeholder="Enter your email" required />
                <button type="submit">Subscribe</button>
            </form>
            <div class="social-icons">

              <p>Follow us on 
              
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/login?"><i class="fab fa-twitter"></i></a>
                <a href= "https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                </p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 NC Fashion. All rights reserved. Designed with ❤️ by NC Team.</p>
    </div>
</footer>





<script>
   
    const menLink = document.querySelector('.menu a[href="men.html"]');
    menLink.addEventListener('click', (e) => {
      e.preventDefault(); 
  
      
      menLink.classList.add('men-animation');
  
      menLink.addEventListener('animationend', () => {
        menLink.classList.remove('men-animation');
      });
  
      setTimeout(() => {
        window.location.href = 'men.html';
      }, 500); 
    });
  </script>



</body>
</html>
    
    

        













