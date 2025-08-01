<?php get_header(); ?>

<div class="container">
    <!-- Hero Section -->
    <section class="hero-section">
        <h1>🏪 Cửa Hàng Điện Thoại Chính Hãng</h1>
        <p>Tìm kiếm và so sánh điện thoại tốt nhất với giá ưu đãi</p>
        
        <!-- Search Form -->
        <div class="phone-search-container">
            <form class="phone-search-form" method="GET" action="<?php echo home_url('/shop/'); ?>">
                <div class="search-main">
                    <input type="text" name="s" placeholder="Tìm kiếm điện thoại..." 
                           value="<?php echo get_search_query(); ?>">
                    <button type="submit" class="search-button">🔍 Tìm kiếm</button>
                </div>
                
                <div class="phone-filters">
                    <select name="filter_brand">
                        <option value="">Tất cả thương hiệu</option>
                        <option value="iphone">iPhone</option>
                        <option value="samsung">Samsung</option>
                        <option value="xiaomi">Xiaomi</option>
                        <option value="oppo">OPPO</option>
                        <option value="vivo">Vivo</option>
                    </select>
                    
                    <select name="filter_ram">
                        <option value="">RAM</option>
                        <option value="3gb">3GB</option>
                        <option value="4gb">4GB</option>
                        <option value="6gb">6GB</option>
                        <option value="8gb">8GB</option>
                        <option value="12gb">12GB+</option>
                    </select>
                    
                    <select name="filter_storage">
                        <option value="">Bộ nhớ</option>
                        <option value="64gb">64GB</option>
                        <option value="128gb">128GB</option>
                        <option value="256gb">256GB</option>
                        <option value="512gb">512GB+</option>
                    </select>
                    
                    <select name="filter_price">
                        <option value="">Khoảng giá</option>
                        <option value="0-5">Dưới 5 triệu</option>
                        <option value="5-10">5-10 triệu</option>
                        <option value="10-15">10-15 triệu</option>
                        <option value="15-20">15-20 triệu</option>
                        <option value="20-100">Trên 20 triệu</option>
                    </select>
                </div>
            </form>
        </div>
    </section>
    
    <!-- Debug: Kiểm tra WooCommerce -->
    <?php if (class_exists('WooCommerce')): ?>
        <div style="background: #f0f0f0; padding: 10px; margin: 20px 0; border-radius: 5px;">
            <strong>WooCommerce Status:</strong> ✅ Active<br>
            <strong>Total Products:</strong> <?php echo wp_count_posts('product')->publish; ?><br>
            <strong>Shop URL:</strong> <a href="<?php echo wc_get_page_permalink('shop'); ?>">Shop Page</a>
        </div>
    <?php else: ?>
        <div style="background: #ffcccc; padding: 10px; margin: 20px 0;">
            ❌ WooCommerce không active
        </div>
    <?php endif; ?>
    
    <!-- Featured Products -->
    <?php if (class_exists('WooCommerce')): ?>
    <section class="featured-products">
        <h2>📱 Sản phẩm nổi bật</h2>
        
        <?php
        // Method 1: Sử dụng WP_Query thay vì wc_get_products
        $featured_query = new WP_Query([
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 8,
            'meta_query' => [
                [
                    'key' => '_stock_status',
                    'value' => 'instock'
                ]
            ]
        ]);
        ?>
        
        <div class="products-grid">
            <?php if ($featured_query->have_posts()): ?>
                <?php while ($featured_query->have_posts()): $featured_query->the_post(); ?>
                    <?php 
                    global $product;
                    if (!$product) {
                        $product = wc_get_product(get_the_ID());
                    }
                    ?>
                    <div class="product-item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="product-image">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium');
                                } else {
                                    echo '<img src="https://via.placeholder.com/300x300?text=No+Image" alt="No Image">';
                                }
                                ?>
                            </div>
                            <div class="product-info">
                                <h3><?php the_title(); ?></h3>
                                <div class="price">
                                    <?php 
                                    if ($product) {
                                        echo $product->get_price_html();
                                    } else {
                                        echo 'Liên hệ';
                                    }
                                    ?>
                                </div>
                                <div class="product-specs">
                                    <?php
                                    if (function_exists('get_field')) {
                                        $ram = get_field('ram');
                                        $storage = get_field('storage');
                                        if ($ram) echo '<span>RAM: ' . strtoupper($ram) . '</span>';
                                        if ($storage) echo '<span>Bộ nhớ: ' . strtoupper($storage) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </a>
                        <div class="product-actions">
                            <?php if ($product): ?>
                                <a href="?add-to-cart=<?php echo get_the_ID(); ?>" class="add-to-cart-btn">
                                    🛒 Thêm vào giỏ
                                </a>
                            <?php endif; ?>
                            <button class="compare-btn" data-product-id="<?php echo get_the_ID(); ?>">
                                ⚖️ So sánh
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <div class="no-products">
                    <p>🚫 Không có sản phẩm nào.</p>
                    <p><a href="<?php echo admin_url('post-new.php?post_type=product'); ?>">Thêm sản phẩm đầu tiên</a></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- Latest Products với shortcode -->
    <section class="latest-products">
        <h2>🆕 Sản phẩm mới nhất</h2>
        <div class="woocommerce-shortcode">
            <?php echo do_shortcode('[products limit="8" columns="4" orderby="date"]'); ?>
        </div>
    </section>
    <?php endif; ?>
</div>

<style>
.hero-section {
    text-align: center;
    padding: 40px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    margin: 20px 0 40px 0;
}

.hero-section h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.hero-section p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.phone-search-container {
    background: rgba(255,255,255,0.95);
    padding: 30px;
    border-radius: 15px;
    margin: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.search-main {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.search-main input {
    flex: 1;
    padding: 15px;
    border: 2px solid #ddd;
    border-radius: 10px;
    font-size: 16px;
}

.search-button {
    background: #007cba;
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: background 0.3s;
}

.search-button:hover {
    background: #005a87;
}

.phone-filters {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.phone-filters select {
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    color: #333;
}

.featured-products, .latest-products {
    margin: 50px 0;
}

.featured-products h2, .latest-products h2 {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 30px;
    color: #333;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
}

.product-item {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.product-image img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.product-info {
    padding: 20px;
}

.product-info h3 {
    margin: 0 0 10px 0;
    color: #333; 
    font-size: 16px;
    line-height: 1.4;
}

.product-info h3 a {
    color: inherit;
    text-decoration: none;
}

.price {
    font-size: 18px;
    font-weight: bold;
    color: #e74c3c;
    margin: 10px 0;
}

.product-specs {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin: 10px 0;
}

.product-specs span {
    background: #f8f9fa;
    color: #666;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.product-actions {
    padding: 15px 20px;
    display: flex;
    gap: 10px;
}

.add-to-cart-btn {
    flex: 1;
    background: #28a745;
    color: white;
    text-decoration: none;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    transition: background 0.3s;
}

.add-to-cart-btn:hover {
    background: #218838;
}

.compare-btn {
    background: #6c757d;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s;
}

.compare-btn:hover {
    background: #5a6268;
}

.no-products {
    text-align: center;
    padding: 40px;
    background: #f8f9fa;
    border-radius: 10px;
    color: #666;
}

.no-products p {
    margin: 10px 0;
    font-size: 18px;
}

.no-products a {
    color: #007cba;
    text-decoration: none;
    font-weight: bold;
}

@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .search-main {
        flex-direction: column;
    }
    
    .phone-filters {
        grid-template-columns: 1fr;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
}
</style>

<?php get_footer(); ?>