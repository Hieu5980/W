<?php
/*
File: wp-content/themes/phonestore-theme/header.php
Cập nhật header với navigation đầy đủ
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-container">
        <div class="site-branding">
            <h1 class="site-title">
                <a href="<?php echo home_url(); ?>">
                    📱 Cửa Hàng Điện Thoại
                </a>
            </h1>
        </div>
        
 <nav class="main-navigation">
    <ul class="nav-menu">
        <li class="<?php echo (is_home() || is_front_page()) ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo home_url(); ?>">🏠 Trang chủ</a>
        </li>
        
        <li class="<?php echo (is_shop() || is_product_category() || is_product()) ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo home_url('/shop/'); ?>">🛒 Sản phẩm</a>
        </li>
        
        <li class="has-submenu <?php echo (is_product_category()) ? 'current-menu-item' : ''; ?>">
            <a href="#">📱 Thương hiệu ▼</a>
            <ul class="sub-menu">
                <li><a href="<?php echo home_url('/shop/?filter_brand=iphone'); ?>">📱 iPhone</a></li>
                <li><a href="<?php echo home_url('/shop/?filter_brand=samsung'); ?>">📱 Samsung</a></li>
                <li><a href="<?php echo home_url('/shop/?filter_brand=xiaomi'); ?>">📱 Xiaomi</a></li>
                <li><a href="<?php echo home_url('/shop/?filter_brand=oppo'); ?>">📱 OPPO</a></li>
                <li><a href="<?php echo home_url('/shop/?filter_brand=vivo'); ?>">📱 Vivo</a></li>
            </ul>
        </li>
        
        <li class="<?php echo (is_page('so-sanh-san-pham')) ? 'current-menu-item' : ''; ?>">
            <a href="<?php 
                $so_sanh_page = get_page_by_path('so-sanh-san-pham');
                echo $so_sanh_page ? get_permalink($so_sanh_page->ID) : home_url('/so-sanh-san-pham/');
            ?>">⚖️ So sánh</a>
        </li>
        
        <li class="<?php echo (is_page('lien-he')) ? 'current-menu-item' : ''; ?>">
            <a href="<?php 
                $lien_he_page = get_page_by_path('lien-he');
                echo $lien_he_page ? get_permalink($lien_he_page->ID) : home_url('/lien-he/');
            ?>">📞 Liên hệ</a>
        </li>
    </ul>
</nav>
        
        <div class="header-actions">
            <?php if (class_exists('WooCommerce')): ?>
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link">
                🛒 Giỏ hàng (<?php echo WC()->cart->get_cart_contents_count(); ?>)
            </a>
            <a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>" class="account-link">
                👤 Tài khoản
            </a>
            <?php endif; ?>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    
    <!-- Mobile Navigation -->
    <nav class="mobile-navigation">
        <ul class="mobile-nav-menu">
            <li><a href="<?php echo home_url(); ?>">🏠 Trang chủ</a></li>
            <li><a href="<?php echo home_url('/shop/'); ?>">🛒 Sản phẩm</a></li>
            <li class="mobile-submenu">
                <a href="#" class="submenu-toggle">📱 Thương hiệu</a>
                <ul class="mobile-sub-menu">
                    <li><a href="<?php echo home_url('/shop/?filter_brand=iphone'); ?>">iPhone</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=samsung'); ?>">Samsung</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=xiaomi'); ?>">Xiaomi</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=oppo'); ?>">OPPO</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=vivo'); ?>">Vivo</a></li>
                </ul>
            </li>
            <li><a href="<?php echo home_url('/so-sanh-san-pham/'); ?>">⚖️ So sánh</a></li>
            <li><a href="<?php echo home_url('/lien-he/'); ?>">📞 Liên hệ</a></li>
            <?php if (class_exists('WooCommerce')): ?>
            <li><a href="<?php echo wc_get_cart_url(); ?>">🛒 Giỏ hàng</a></li>
            <li><a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>">👤 Tài khoản</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<style>
/* === UPDATED HEADER STYLES === */
.site-header {
  background: rgba(255, 255, 255, 0.98);
  backdrop-filter: blur(20px);
  box-shadow: 0 8px 32px rgba(0,0,0,0.12);
  padding: 20px 0;
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 1px solid rgba(255,255,255,0.3);
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.site-title a {
  background: linear-gradient(135deg, #e53e3e 0%, #fd9644 50%, #38a169 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-decoration: none;
  font-size: 28px;
  font-weight: 900;
  letter-spacing: -0.5px;
}

/* Navigation */
.main-navigation .nav-menu {
  display: flex;
  list-style: none;
  gap: 8px;
  margin: 0;
  padding: 0;
}

.nav-menu > li {
  position: relative;
}

.nav-menu a {
  color: #2d3748;
  text-decoration: none;
  padding: 12px 20px;
  display: block;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  font-weight: 600;
  font-size: 15px;
  border-radius: 12px;
  position: relative;
}

.nav-menu a:hover,
.nav-menu .current-menu-item a {
  background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(56, 161, 105, 0.3);
}

/* Dropdown menu */
.nav-menu .sub-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background: white;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15);
  min-width: 220px;
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  list-style: none;
  padding: 15px 0;
  margin: 0;
  border-radius: 16px;
  border: 1px solid rgba(0,0,0,0.06);
}

.nav-menu .has-submenu:hover .sub-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.sub-menu li a {
  padding: 12px 25px;
  font-size: 14px;
  border-radius: 0;
  margin: 0 10px;
  border-radius: 8px;
}

.sub-menu li a:hover {
  background: #f8fafc;
  color: #38a169;
  transform: translateX(5px);
  box-shadow: none;
}

/* Header actions */
.header-actions {
  display: flex;
  align-items: center;
  gap: 15px;
}

.cart-link, .account-link {
  color: #2d3748;
  text-decoration: none;
  padding: 10px 16px;
  border-radius: 10px;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.3s ease;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
}

.cart-link:hover, .account-link:hover {
  background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(56, 161, 105, 0.3);
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
  display: none;
  flex-direction: column;
  background: none;
  border: none;
  cursor: pointer;
  padding: 8px;
  gap: 4px;
}

.mobile-menu-toggle span {
  width: 25px;
  height: 3px;
  background: #2d3748;
  border-radius: 2px;
  transition: all 0.3s ease;
}

.mobile-menu-toggle:hover span {
  background: #38a169;
}

/* Mobile Navigation */
.mobile-navigation {
  display: none;
  background: white;
  border-top: 1px solid #e2e8f0;
  padding: 20px;
}

.mobile-nav-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.mobile-nav-menu li {
  margin-bottom: 10px;
}

.mobile-nav-menu a {
  display: block;
  padding: 12px 0;
  color: #2d3748;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  border-bottom: 1px solid #f1f5f9;
  transition: color 0.3s ease;
}

.mobile-nav-menu a:hover {
  color: #38a169;
}

.mobile-sub-menu {
  list-style: none;
  padding: 0;
  margin: 10px 0 0 20px;
  display: none;
}

.mobile-sub-menu li {
  margin-bottom: 5px;
}

.mobile-sub-menu a {
  font-size: 14px;
  padding: 8px 0;
  color: #4a5568;
}

.mobile-submenu.active .mobile-sub-menu {
  display: block;
}

.submenu-toggle::after {
  content: ' ▼';
  font-size: 12px;
  transition: transform 0.3s ease;
}

.mobile-submenu.active .submenu-toggle::after {
  transform: rotate(180deg);
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
  .main-navigation {
    display: none;
  }
  
  .mobile-menu-toggle {
    display: flex;
  }
  
  .mobile-navigation.active {
    display: block;
  }
  
  .header-actions .cart-link,
  .header-actions .account-link {
    display: none;
  }
  
  .header-container {
    flex-wrap: wrap;
  }
  
  .site-title a {
    font-size: 24px;
  }
}

@media (max-width: 480px) {
  .header-container {
    padding: 0 15px;
  }
  
  .site-title a {
    font-size: 20px;
  }
  
  .mobile-menu-toggle {
    padding: 5px;
  }
}
</style>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNav = document.querySelector('.mobile-navigation');
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    
    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function() {
            mobileNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // Submenu toggles
    submenuToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.closest('.mobile-submenu');
            parent.classList.toggle('active');
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.site-header') && mobileNav) {
            mobileNav.classList.remove('active');
            mobileToggle.classList.remove('active');
        }
    });
});
</script>

<?php
// Add current page indicators
if (is_page('lien-he')) {
    echo '<script>document.body.classList.add("page-lien-he");</script>';
}
if (is_page('so-sanh-san-pham')) {
    echo '<script>document.body.classList.add("page-so-sanh");</script>';
}
?>