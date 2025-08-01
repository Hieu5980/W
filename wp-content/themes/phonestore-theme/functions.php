<?php
// Enqueue styles và scripts
function phonestore_enqueue_styles() {
    wp_enqueue_style('phonestore-style', get_stylesheet_uri());
    wp_enqueue_script('phonestore-script', get_template_directory_uri() . '/js/phonestore.js', array('jquery'), '1.0', true);
    
    // Localize script cho AJAX
    wp_localize_script('phonestore-script', 'phonestore_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('phonestore_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'phonestore_enqueue_styles');

// Thêm hỗ trợ WooCommerce
function phonestore_add_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'phonestore_add_woocommerce_support');

// Thêm support cho navigation menus
function phonestore_setup_theme() {
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu'
    ));
}
add_action('after_setup_theme', 'phonestore_setup_theme');

// Tùy chỉnh số sản phẩm trên trang
function phonestore_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'phonestore_products_per_page', 20);

// Remove default WooCommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// AJAX handler cho product search
function phonestore_ajax_product_search() {
    if (!wp_verify_nonce($_POST['nonce'], 'phonestore_nonce')) {
        wp_die('Security check failed');
    }
    
    $search_term = sanitize_text_field($_POST['term']);
    
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        's' => $search_term,
        'posts_per_page' => 5,
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock'
            )
        )
    );
    
    $products = get_posts($args);
    $suggestions = array();
    
    foreach ($products as $product) {
        $wc_product = wc_get_product($product->ID);
        $suggestions[] = array(
            'title' => $product->post_title,
            'url' => get_permalink($product->ID),
            'price' => $wc_product->get_price_html(),
            'image' => get_the_post_thumbnail_url($product->ID, 'thumbnail')
        );
    }
    
    wp_send_json_success($suggestions);
}
add_action('wp_ajax_phonestore_ajax_product_search', 'phonestore_ajax_product_search');
add_action('wp_ajax_nopriv_phonestore_ajax_product_search', 'phonestore_ajax_product_search');

// AJAX handler cho product filter
function phonestore_ajax_filter_products() {
    if (!wp_verify_nonce($_POST['nonce'], 'phonestore_nonce')) {
        wp_die('Security check failed');
    }
    
    parse_str($_POST['filters'], $filters);
    
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'meta_query' => array('relation' => 'AND')
    );
    
    // Filter theo thương hiệu
    if (!empty($filters['filter_brand'])) {
        $args['meta_query'][] = array(
            'key' => 'brand',
            'value' => $filters['filter_brand'],
            'compare' => '='
        );
    }
    
    // Filter theo RAM
    if (!empty($filters['filter_ram'])) {
        $args['meta_query'][] = array(
            'key' => 'ram',
            'value' => $filters['filter_ram'],
            'compare' => '='
        );
    }
    
    // Filter theo Storage
    if (!empty($filters['filter_storage'])) {
        $args['meta_query'][] = array(
            'key' => 'storage',
            'value' => $filters['filter_storage'],
            'compare' => '='
        );
    }
    
    $products = get_posts($args);
    $html = '';
    
    if ($products) {
        $html .= '<div class="products">';
        foreach ($products as $product) {
            $wc_product = wc_get_product($product->ID);
            $html .= '<div class="product">';
            $html .= '<a href="' . get_permalink($product->ID) . '">';
            $html .= get_the_post_thumbnail($product->ID, 'medium');
            $html .= '<div class="product-info">';
            $html .= '<h3>' . $product->post_title . '</h3>';
            $html .= '<div class="price">' . $wc_product->get_price_html() . '</div>';
            
            // Hiển thị specs ngắn gọn
            $ram = get_field('ram', $product->ID);
            $storage = get_field('storage', $product->ID);
            if ($ram || $storage) {
                $html .= '<div class="quick-specs">';
                if ($ram) $html .= '<span>RAM: ' . strtoupper($ram) . '</span> ';
                if ($storage) $html .= '<span>Bộ nhớ: ' . strtoupper($storage) . '</span>';
                $html .= '</div>';
            }
            $html .= '</div></a>';
            $html .= '<a href="?add-to-cart=' . $product->ID . '" class="button add-to-cart">Thêm vào giỏ</a>';
            $html .= '</div>';
        }
        $html .= '</div>';
    } else {
        $html = '<p>Không tìm thấy sản phẩm phù hợp.</p>';
    }
    
    wp_send_json_success($html);
}
// Fix WooCommerce shop query
function fix_shop_query($q) {
    if (!is_admin() && $q->is_main_query()) {
        if (is_shop() || is_product_category() || is_product_tag()) {
            $q->set('post_type', 'product');
            $q->set('posts_per_page', 12);
            
            // Handle custom filters
            if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) {
                $meta_query = $q->get('meta_query') ?: [];
                $meta_query[] = [
                    'key' => 'brand',
                    'value' => sanitize_text_field($_GET['filter_brand']),
                    'compare' => '='
                ];
                $q->set('meta_query', $meta_query);
            }
        }
    }
}
add_action('pre_get_posts', 'fix_shop_query');

// Force WooCommerce to show products
function force_product_visibility($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
        $query->set('meta_query', [
            [
                'key' => '_visibility',
                'value' => ['catalog', 'visible'],
                'compare' => 'IN'
            ]
        ]);
    }
}
// Thêm vào functions.php tạm thời
function debug_shop_query() {
    if (is_shop()) {
        global $wp_query;
        echo '<pre>';
        echo "Query vars: ";
        print_r($wp_query->query_vars);
        echo "\nSQL Query: " . $wp_query->request;
        echo '</pre>';
    }
}
// Fix product visibility issues
function fix_product_visibility_issues() {
    $products = get_posts([
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ]);
    
    foreach ($products as $product) {
        $wc_product = wc_get_product($product->ID);
        if ($wc_product) {
            // Force set visibility
            $wc_product->set_catalog_visibility('visible');
            $wc_product->set_stock_status('instock');
            $wc_product->save();
            
            // Update meta directly
            update_post_meta($product->ID, '_visibility', 'visible');
            update_post_meta($product->ID, '_stock_status', 'instock');
        }
    }
}

// Chạy 1 lần để fix
if (isset($_GET['fix_products'])) {
    fix_product_visibility_issues();
    echo "Products fixed!";
    exit;
}
add_action('wp_footer', 'debug_shop_query');
add_action('pre_get_posts', 'force_product_visibility');
add_action('wp_ajax_phonestore_ajax_filter_products', 'phonestore_ajax_filter_products');
add_action('wp_ajax_nopriv_phonestore_ajax_filter_products', 'phonestore_ajax_filter_products');
?>