<html>
<head>
    <title>NC FASHION </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="css/wmnav.css">
</head>
<body>
    <div class="top-bar">
        <a href="#">Marketplace</a>
        <a href="">Help &amp; FAQs</a>
    </div>
    
    <div class="nav-bar">
      <div class="logo">
      <h1>NC Fashion</h1></div>
          <div class="menu">
              <a href="../frontendwomen/women.html">WOMEN</a>
              <a href="../frontendmen/men.html">MEN</a>
          </div>
       <div class="search-bar">
        <input type="text" placeholder="Search for items and brands" />
       </div>
          
         <div class="navbar1">
              <div class="dropdown">
                  <div class="icon"><i class="fas fa-user"></i></div>
                  <div class="dropdown-content" id="user-dropdown">
                      <div class="close"><i class="fas fa-times"></i></div>
                      <div class="header" id="auth-section">
                          <a href="login.php" id="login-link">Sign In</a> 
                          
                      </div>
                      <a href="myaccount.php" class="menu-item"><i class="fas fa-user"></i> My Account</a>
                      <a href="#" class="menu-item"><i class="fas fa-calendar-alt"></i> My Orders</a>
                      <a href="#" class="menu-item"><i class="fas fa-question-circle"></i> Returns Information</a>
                      <a href="#" class="menu-item"><i class="fas fa-comment-dots"></i> Contact Preferences</a>
                      <a href="#" id="logout-link" class="menu-item" style="display: none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  </div>
         </div>
  
  
            <!-- Wishlist -->
            <div class="dropdown">
              <div class="icon"><i class="fas fa-heart"></i></div>
              <div class="dropdown-content">
                  <div class="close"><i class="fas fa-times"></i></div>
                  <a href="../frontend/wishlist.html" class="menu-item"><i class="fas fa-star"></i> Saved Products</a>
                  <a href="#" class="menu-item"><i class="fas fa-calendar-alt"></i> My Orders</a>
              </div>              
          </div>
  
          <!-- Shopping Bag -->
          <div class="dropdown">
              <div class="icon"><i class="fas fa-shopping-bag"></i></div>
              <div class="dropdown-content">
                  <div class="close"><i class="fas fa-times"></i></div>
                  <a href="../frontend/account.html" class="menu-item"><i class="fas fa-user"></i> My Account</a>
                  <a href="#" class="menu-item"><i class="fas fa-calendar-alt"></i> My Orders</a>
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

    <div class="sub-header">
      <button class="toggle-btn" onclick="toggleNav()">☰</button>
      <div class="nav">
        <div class="dropdown">
          <a href="#">New in</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>NEW PRODUCTS</h2>
                <ul>
                  <li><a href="#">View all</a></li>
                  <li><a href="#">Clothing</a></li>
                  <li><a href="#">Shoes</a></li>
                  <li><a href="#"><strong>New in: Today</strong></a></li>
                  <li><a href="#"><strong>New In: Selling Fast</strong></a></li>
                  <li><a href="#">Dresses</a></li>
                  <li><a href="#">Tops</a></li>
                  <li><a href="#">Activewear</a></li>
                  <li><a href="#">Coats & Jackets</a></li>
                  <li><a href="#">Face + Body</a></li>
                </ul>
              </div>
              <div class="column">
                <h2>SHOP WINTER</h2>
                <ul>
                  <li><a href="#"><img src="../img/b1.jpg" alt="Winter View All" /> View all</a></li>
                  <li><a href="#"><img src="women.jpg" alt="Winter View All" /> Bestsellers</a></li>
                  <li><a href="#"><img src="women.jpg" alt="Winter View All" /> Jumper dresses</a></li>
                  <li><a href="#"><img src="women.jpg" alt="Winter View All" /> Coats & Jackets</a></li>
                  <li><a href="#"><img src="img1.jpg" alt="Winter View All" /> Accessories</a></li>
                  <li><a href="#"><img src="img1.jpg" alt="Winter View All" /> Boots</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>



        <div class="dropdown">
          <a href="#">Clothing</a>
  
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>NEW PRODUCTS</h2>
                <ul>
                <li><a href="category.php?category=Shirts&gender=Men">Shirts</a></li>
                  <li><a href="category.php?category=T-Shirts&gender=Men">T-Shirts</a></li>
                 <li><a href="category.php?category=Jeans&gender=Men">Jeans</a></li>
                  <li><a href="category.php?category=Activewear&gender=Men">Activewear</a></li>
                  
                </ul>
              </div>
              <div class="column">
                <h2>SHOP WINTER</h2>
                <ul>
                  <li><a href="../frontendmen/clothing2.html"><img src="img/acc3.avif" alt="Wi" />Vie all</a></li>
                  <li><a href="../frontendmen/clothing2.html#hoodies"><img src="img/acc3.avif" alt="Wint" />Hoodies </a></li>
                  <li><a href="../frontendmen/clothing2.html#jackets"><img src="img/tt2.jpg" alt="All" />Jackets</a></li>
                 <li><a href="../frontendmen/clothing2.html#jackets"><img src="imgs/a11.webp" alt="View All" /> Coats</a></li>
                 
                </ul>
              </div>
            </div>
          </div>
        </div>
  
  
      








        <div class="dropdown">
          <a href="">Trending</a>
          <div class="content dropdown-content" >
       <div class="sidebar  column">
                <h2>TOP-SEARCHED FAVES</h2>
                <ul>
                    <li>
                        <img src="imgs/m5.webp" alt="Person in leopard print outfit">
                        <a href="#">Graphic tees</a>
                    </li>
                    <li>
                        <img src="imgs/d12.webp" alt="Person in leather and suede outfit">
                        <a href="#">Basics</a>
                    </li>
                    <li>
                        <img src="images/acc.webp" alt="Person in sequin outfit">
                        <a href="#">Burgundy</a>
                    </li>
                    
                </ul>
            </div>
            <div class="main-content column">
                <div class="card">
                    <img src="img/ja1.avif" alt="Person in spring preview outfit">
                    <div class="card-title">DENIM BRANDS </div>
                </div>
                <div class="card">
                    <img src="imgs/a1.webp" alt="Person in basics refresh outfit">
                    <div class="card-title">BASICS REFRESH</div>
                </div>
                <div class="card">
                    <img src="imgs/a19.webp" alt="Person in colour lab outfit">
                    <div class="card-title">SPRING PREVIEW</div>
                </div>
            </div>
        </div>
        </div>
  
  
  
  
  
  
       
  
  
        <div class="dropdown">
          <a href="#">Accessories</a>
  
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>SHOP BY PRODUCTS </h2>
                <ul>
                  <li><a href="#">Caps & Hats</a></li>
                  <li><a href="#">Watches</a></li>
                  <li><a href="#">Ties</a></li>
                  <li><a href="#">Sunglass</a></li>
                  <li><a href="#">Socks</a></li>
                  <li><a href="#">wallets</a></li>
                 
                </ul>
              </div>
              <div class="column">
                <h2>SHOP BY JEWELLERY </h2>
                <ul>
                  <li><a href="#"><img src="img/acc3.avif" alt="View All" /> VIEW ALL</a></li>
                  <li><a href="#"><img src="img/tt2.jpg" alt=" View All" />NECKLACES</a></li>
                  <li><a href="#"><img src="img/acc2.avif" alt=" View All" />BRACELETS</a></li>
                  <li><a href="#"><img src="imgs/a11.webp" alt=" View All" />RINGS</a></li>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
  
  
  
  
  
  
  
          <div class="dropdown">
          <a href="#">Grooming</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>NEW PRODUCTS</h2>
                <ul>
                  <li><a href="#">View all</a></li>
                  <li><a href="#">Skin care</a></li>
                  <li><a href="#">Hair care</a></li>
                  <li><a href="#">Body care</a></li>
                  
                </ul>
              </div>
              <div class="column">
                <h2>MAKE UP</h2>
              
                  <div class="main-content column">
                    <div class="card">
                        <img src="img/ja1.avif" alt="Person in spring preview outfit">
                        <div class="card-title">SHAVING & gROOMING</div>
                    </div>
                    <div class="card">
                        <img src="imgs/a1.webp" alt="Person in basics refresh outfit">
                        <div class="card-title">sKIN</div>
                    </div>
                    <div class="card">
                        <img src="imgs/a19.webp" alt="Person in colour lab outfit">
                        <div class="card-title">BODY</div>
                    </div>
                    <div class="card">
                      <img src="imgs/a19.webp" alt="Person in colour lab outfit">
                      <div class="card-title">HAIR</div>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
        </div>
  
  
  
  
  
  
          <div class="dropdown">
          <a href="#">Activewear</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>SHOP BY PRODUCTS</h2>
                <ul>
                  <li><a href="activewear.html">View all</a></li>
                  <li><a href="activewear.html">Newin</a></li>
                  <li><a href="activewear.html">Trainers</a></li>
                  <li><a href="activewear.html">Shorts</a></li>
                  <li><a href="activewear.html">Jackets</a></li>
                  <li><a href="activewear.html">Accessories</a></li>
                  
                </ul>
              </div>
              <div class="column">
                <h2>SHOP BY ACTIVITY</h2>
                <ul>
                  <li><a href="activewear.html"><img src="img/acc3.avif" alt=" View All" /> View all</a></li>
                  <li><a href="activewear.html"><img src="img/acc4.avif" alt="clothing View All" /> SWIM</a></li>
                  <li><a href="activewear.html"><img src="img/acc2.avif" alt="Tops View All" /> FOOTBALL</a></li>
                  <li><a href="activewear.html"><img src="img/acc3.avif" alt=" shoes All" /> GYM & TRAINIG</a></li>
                 
                  
                </ul>
              </div>
  
              
  
            </div>
          </div>
        </div>
  
  
  
  
  
  
  
  
  
  
             <div class="dropdown">
          <a href="shoe.html">Footwear</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>NEW PRODUCTS</h2>
                <ul>
                  <li><a href="#">View all</a></li>
                  <li><a href="#">Newin</a></li>
                  <li><a href="#">Trainers</a></li>
                  <li><a href="#">Shoes</a></li>
                   <li><a href="#">Boots</a></li>
                 
                </ul>
              </div>
              <div class="column">
                <h2>SHOP BY PRODUCTS</h2>
                <ul>
                  <li><a href="#"><img src="img/acc3.avif" alt="Winter View All" />SLIPERS </a></li>
                  <li><a href="#"><img src="img/tt2.jpg" alt="Winter View All" /> SANDALS</a></li>
                  <li><a href="#"><img src="img/acc2.avif" alt="Winter View All" />SOCKS</a></li>
                  <li><a href="#"><img src="imgs/a11.webp" alt="Winter View All" />rUNNING TRAINERS</a></li>
                
                </ul>
              </div>
            </div>
          </div>
        </div>
  
  
  
  
          <div class="dropdown">
          <a href="lifestyle">Life & Style</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>LIFE STYLES</h2>
                <ul>
                  <li><a href="lifestyle.html#health">Styles</a></li>
                  <li><a href="#health">Fitness</a></li>
                  <li><a href="#travel">Articals</a></li>
                  <li><a href="#home"><strong>New in: Today</strong></a></li>
                  <li><a href="#joinlifestyle ">Join Community</a></li>
                  
                </ul>
              </div>
              <div class="column">
                <h2>FASHION</h2>
                <ul>
                  <li><a href="#"><img src="img/acc3.avif" alt="Winter View All" /> View all</a></li>
                  <li><a href="#"><img src="img/tt2.jpg" alt="Winter View All" /> Bestsellers</a></li>
                  <li><a href="#"><img src="img/acc2.avif" alt="Winter View All" />  dresses</a></li>
             
                </ul>
              </div>
            </div>
          </div>
        </div>
  
  
  
  
  
       
  
          <div class="dropdown">
          <a href="sale.html" style="color: #f35252;">Sale</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>NEW PRODUCTS</h2>
                <ul>
                  <li><a href="#">View all</a></li>
                  <li><a href="#">Clothing</a></li>
                  <li><a href="#">Trending</a></li>
                  <li><a href="#">Shoes</a></li>
                  <li><a href="#"><strong>New in: Today</strong></a></li>
                  <li><a href="#">Tops</a></li>
                  <li><a href="#">Activewear</a></li>
                  <li><a href="#">Coats & Jackets</a></li>
                  <li><a href="#">Face + Body</a></li>
                </ul>
              </div>
              <div class="column">
                <h2>SHOP WINTER</h2>
                <ul>
                  <li><a href="#"><img src="img/acc3.avif" alt="Winter View All" /> View all</a></li>
                  <li><a href="#"><img src="img/tt2.jpg" alt="Winter View All" /> Bestsellers</a></li>
                  <li><a href="#"><img src="img/acc2.avif" alt="Winter View All" />  dresses</a></li>
                  <li><a href="#"><img src="imgs/a11.webp" alt="Winter View All" /> Coats</a></li>
                  <li><a href="#"><img src="img/acc4.avif" alt="Winter View All" /> Accessories</a></li>
                  <li><a href="#"><img src="img/ja2.avif" alt="Winter View All" /> Boots</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
  
  
        
  
  
  
  
  
     
      <div class="back-to-top" onclick="scrollToTop()">
          <i class="fas fa-chevron-up"></i>
      </div>
  
      <script>
          // Back-to-Top Button Logic
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
  
  
  
  
  
  
  <script>
      function toggleNav() {
        const nav = document.querySelector('.sub-header .nav');
        nav.classList.toggle('show');
      }
    </script>
  
   
  
  </body>
  </html>
  
  





   
    