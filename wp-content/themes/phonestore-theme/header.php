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
                <li><a href="<?php echo home_url(); ?>">Trang chủ</a></li>
                <li><a href="<?php echo home_url('/shop/'); ?>">Sản phẩm</a></li>
                <li class="has-submenu">
                    <a href="#">Thương hiệu ▼</a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo home_url('/shop/?filter_brand=iphone'); ?>">iPhone</a></li>
                        <li><a href="<?php echo home_url('/shop/?filter_brand=samsung'); ?>">Samsung</a></li>
                        <li><a href="<?php echo home_url('/shop/?filter_brand=xiaomi'); ?>">Xiaomi</a></li>
                        <li><a href="<?php echo home_url('/shop/?filter_brand=oppo'); ?>">OPPO</a></li>
                        <li><a href="<?php echo home_url('/shop/?filter_brand=vivo'); ?>">Vivo</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo home_url('/so-sanh-san-pham/'); ?>">So sánh</a></li>
                <li><a href="<?php echo home_url('/lien-he/'); ?>">Liên hệ</a></li>
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
        </div>
    </div>
</header>

<style>
.site-header {
    background: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 10px 0;
    position: sticky;
    top: 0;
    z-index: 999;
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.site-title a {
    color: #007cba;
    text-decoration: none;
    font-size: 22px;
    font-weight: bold;
}

.nav-menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 25px;
}

.nav-menu li {
    position: relative;
}

.nav-menu a {
    color: #333;
    text-decoration: none;
    padding: 10px 15px;
    display: block;
    transition: color 0.3s;
    font-weight: 500;
}

.nav-menu a:hover {
    color: #007cba;
}

/* Dropdown menu */
.nav-menu .sub-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    min-width: 180px;
    opacity: 0;
    visi