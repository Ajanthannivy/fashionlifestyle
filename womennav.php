<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>NC FASHION </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/wmnav.css">
    
<!DOCTYPE html>
<html lang="ta">
<head>
    <title>NC Fashion</title>
    <link rel="stylesheet" href="css/style.css">
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
            <a href="men.html">MEN</a>
        </div>

        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search for products...">
            <button type="submit">🔍</button>
        </form>

        

<div class="navbar1">
    <div class="dropdown">
        <div class="icon"><i class="fas fa-user"></i></div>
        <div class="dropdown-content" id="user-dropdown">
            <div class="close"><i class="fas fa-times"></i></div>
            <div class="header" id="auth-section">
               
                    <a href="#login-linl"></a> 
                    <a href="#register-link"></a>
          
                <a href="accountcreate/" class="menu-item"><i class="fas fa-user"></i> My Account</a>
                <a href="orders.php" class="menu-item"><i class="fas fa-calendar-alt"></i> My Orders</a>
                <a href="returns.php" class="menu-item"><i class="fas fa-question-circle"></i> Returns Information</a>
                <a href="contact.php" class="menu-item"><i class="fas fa-comment-dots"></i> Contact Preferences</a>
            </div>
        </div>
    </div>


            <!-- Wishlist -->
            <div class="dropdown">
              <a href="wishlistpage.php" class="icon"> <i class="fas fa-heart"></i> </a>
            </div>

   

<script>
  function updateCartCount() {
    fetch("cart_count.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("cart-count").innerText = data;
        })
        .catch(error => console.error('Error updating cart count:', error));
}

// Page Load
document.addEventListener("DOMContentLoaded", updateCartCount);

</script>

  
          <!-- Shopping Bag -->
          <div class="dropdown">
          <a href="cart.php"  class="icon"><i class="fa fa-shopping-bag" id="cart-icon"></i>
          <span id="cart-count"></span></a>
          </div>     
          
          
      
       </div>
    </div>
      

    <div class="sub-header">
      <button class="toggle-btn" onclick="toggleNav()">☰</button>
      <div class="nav">

        <div class="dropdown">
          <a href="#">Clothing</a>
  
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>SHOP BY PRODUCTS</h2>
                <ul>
               
                  <li><a href="category.php?category=Dresses&gender=Women">Dresses</a></li>
                  <li><a href="category.php?category=T-Shirts&gender=Women">T-Shirts</a></li>
                  <li><a href="category.php?category=Coats&gender=Women">Coats</a></li>
                  <li><a href="category.php?category=Shorts&gender=Women">Shorts</a></li>
                  <li><a href="category.php?category=Jeans&gender=Women">Jeans</a></li>
                </ul>
            </div>
              <div class="column">
                <h2>SHOP BY EDIT</h2>
                <ul>
                 <li><a href="category.php?category=Wedding&gender=Women"><img src="../img/women/clothes/we.jpg" alt="Wi" />WEDDING</a></li>
                  <li><a href="category.php?category=Denim&gender=Women"><img src="../img/women/clothes/d2.webp" alt="Wint" />DENIM</a></li>
                  <li><a href="category.php?category=Holiday&gender=Women"><img src="../img/women/clothes/ho.jpg" alt="All" />HOLIDAY</a></li>
                 <li><a href="category.php?category=Modest&gender=Women"><img src="../img/women/clothes/m1.jpg" alt="View All" />MODEST FASHION </a></li>
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
               <img src="../img/women/trending/se4.avif" alt="Person in leather and suede outfit">
                <a href="category.php?category=Sequin Edit&gender=Women">Sequin Edit</a>
            </li>
            <li>
               <img src="../img/women/clothes/ho3.avif" alt="Person in leopard print outfit">
                <a href="category.php?category=Winter sun&gender=Women">Winter sun</a>
            </li>
            <li>
               <img src="../img/women/clothes/d3.webp" alt="Person in leopard print outfit">
               <a href="category.php?category=Denim&gender=Women ">Denim </a>
            </li>
           </ul>
        </div>
      <div class="main-content column">
          <div class="card">
               <img src="../img/women/clothes/ho4.avif" alt="Person in basics refresh outfit">
          </div>
           <div class="card">
                <img src="../img/women/clothes/sp5.avif" alt="Person in colour lab outfit">
           </div>      
          <div class="card-title">SPRING PREVIEW</div>
          </div>
      </div>
     </div>
  

        <div class="dropdown">
          <a >Accessories</a>
  
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>SHOP BY PRODUCTS </h2>
                <ul>
                  
                  <li><a href="category.php?category=Caps&gender=Women">Caps & Hats</a></li>
                  <li><a href="category.php?category=HairAccessories&gender=Women">Hair Accessories</a></li>
                  <li><a href="category.php?category=Sunglass&gender=Women">Sunglass</a></li>
                  <li><a href="category.php?category=Bags&gender=Women">Bags & purses</a></li>
                </ul>
              </div>
              <div class="column">
                <h2>SHOP BY JEWELLERY </h2>
                <ul>
                
                  <li><a href="category.php?category=Earings&gender=Women"><img src="../img/women/accssories/e4.avif" alt=" View All" />EARINGS</a></li>
                  <li><a href="category.php?category=Necklace&gender=Women"><img src="../img/women/accssories/n5.avif" alt=" View All" />NECKLACES</a></li>
                  <li><a href="category.php?category=Bracelets&gender=Women"><img src="../img/women/accssories/b2.avif" alt=" View All" />BRACELETS</a></li>
                  <li><a href="category.php?category=Rings&gender=Women"><img src="../img/women/accssories/r2.avif" alt=" View All" />RINGS</a></li>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>


        <div class="dropdown">
          <a href="">Face+Body</a>
          <div class="content dropdown-content" >
       <div class="sidebar  column">
                <h2>TOP-SEARCHED FAVES</h2>
                <ul>
                    <li>
                        <img src="../img/women/makeup/m11.webp" alt="Person ">
                        <a href="category.php?category=Makeup&gender=Women">Makeup</a>
                    </li>
                    <li>
                        <img src="" alt="Person">
                        <a href="category.php?category=Skincare&gender=Women">Skin Care</a>
                    </li>
                    <li>
                      <img src="../img/women/makeup/h.avif" alt="Person">
                      <a href="category.php?category=Haircare&gender=Women">Hair Care</a>
                  </li>
                  <li>
                    <img src="../img/women/makeup/hb1.avif" alt="Person">
                    <a href="category.php?category=Bodycare&gender=Women">Body Care</a>
                </li>
                    
                </ul>
            </div>
            <div class="main-content column">
                <div class="card">
                    <img src="../img/women/makeup/m6.webp" alt="Person in spring preview outfit">
                    <div class="card-title">fashion look</div>
                </div>
                <div class="card">
                    <img src="../img/women/makeup/h2.avif" alt="Person in basics refresh outfit">
                    <div class="card-title">Hair smooth</div>
                </div>
                <div class="card">
                    <img src="../img/women/makeup/hb2.avif" alt="Person in colour lab outfit">
                    <div class="card-title">Body care</div>
                </div>
            </div>
        </div>
        </div>

        
  
  
  
          <div class="dropdown">
          <a href="">Activewear</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>SHOP BY PRODUCTS</h2>
                <ul>
                  
                  <li><a href="category.php?category=Trainers&gender=Women">Trainers</a></li>
                  <li><a href="category.php?category=Shorts&gender=Women">Shorts</a></li>
                  <li><a href="category.php?category=Jackets&gender=Women">Jackets</a></li>
                  <li><a href="category.php?category=Activeaccessories&gender=Women">Accessories</a></li>
                  
                </ul>
              </div>
              <div class="column">
                <h2>SHOP BY ACTIVITY</h2>
                <ul>
                  <li><a href="category.php?category=Leggings&gender=Women"><img src="../img/women/activewear/a12.webp" alt="" /> LEGGINGS</a></li>
                  <li><a href="category.php?category=Swim&gender=Women"><img src="../img/women/activewear/swim.jpeg" alt="" /> SWIM</a></li>
                  <li><a href="category.php?category=Football&gender=Women"><img src="../img/women/clothes/tt4.jpg" alt="" /> FOOTBALL</a></li>
                  <li><a href="category.php?category=Gymshoes&gender=Women"><img src="../img/women/footwear/sh7.jpg" alt=" " /> GYM </a></li>
                </ul>
              </div>
              </div>
          </div>
        </div>
  
  
   <div class="dropdown">
          <a href="">Footwear</a>
          <div class="dropdown-content">
            <div class="container">
              <div class="column">
                <h2>NEW PRODUCTS</h2>
                <ul>
                  <li><a href="category.php?category=Heels&gender=Women">Heels</a></li>
                  <li><a href="category.php?category=Sandals&gender=Women">Sandals</a></li>
                </ul>
              </div>
              <div class="column">
              <h2>SHOP BY PRODUCTS</h2>
                <ul>
                  <li><a href="category.php?category=Shoes&gender=Women"><img src="../img/women/footwear/sh03.jpg" alt="Winter View All" /> SHOES</a></li>
                  <li><a href="category.php?category=Gymshoes&gender=Women"><img src="../img/women/footwear/s1.avif" alt="Winter View All" />RUNNING TRAINERS</a></li>
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
                  <li><a href="../frontendwomen/lifestylewomen.html#health">Styles</a></li>
                  <li><a href="../frontendwomen/lifestylewomen.html#health">Fitness</a></li>
                  <li><a href="../frontendwomen/lifestylewomen.html#travel">Articals</a></li>
                  <li><a href="../frontendwomen/lifestylewomen.html#home"><strong>New in: Today</strong></a></li>
                  <li><a href="../frontendwomen/lifestylewomen.html#joinlifestyle ">Join Community</a></li>
                  
                </ul>
              </div>
              <div class="column">
                <h2>FASHION</h2>
                <ul>
                  <li><a href="#"><img src="../img/acc3.avif" alt="Winter View All" /> View all</a></li>
                  <li><a href="#"><img src="../img/tt2.jpg" alt="Winter View All" /> Bestsellers</a></li>
                  <li><a href="#"><img src="../img/acc2.avif" alt="Winter View All" />  dresses</a></li>
             
                </ul>
              </div>
            </div>
          </div>
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

