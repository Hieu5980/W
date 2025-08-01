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
    
    <!-- Featured Products -->
    <?php if (class_exists('WooCommerce')): ?>
    <section class="featured-products">
        <h2>📱 Sản phẩm nổi bật</h2>
        <div class="products-grid">
            <?php
            $featured_products = wc_get_products([
                'limit' => 8,
                'orderby' => 'popularity',
                'status' => 'publish'
            ]);
            
            if ($featured_products):
                foreach ($featured_products as $product):
            ?>
                <div class="product-item">
                    <a href="<?php echo $product->get_permalink(); ?>">
                        <div class="product-image">
                            <?php echo $product->get_image('medium'); ?>
                        </div>
                        <div class="product-info">
                            <h3><?php echo $product->get_name(); ?></h3>
                            <div class="price"><?php echo $product->get_price_html(); ?></div>
                            <div class="product-specs">
                                <?php
                                $ram = get_field('ram', $product->get_id());
                                $storage = get_field('storage', $product->get_id());
                                if ($ram) echo '<span>RAM: ' . strtoupper($ram) . '</span>';
                                if ($storage) echo '<span>Bộ nhớ: ' . strtoupper($storage) . '</span>';
                                ?>
                            </div>
                        </div>
                    </a>
                    <div class="product-actions">
                        <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="add-to-cart-btn">
                            🛒 Thêm vào giỏ
                        </a>
                        <button class="compare-btn" data-product-id="<?php echo $product->get_id(); ?>">
                            ⚖️ So sánh
                        </button>
                    </div>
                </div>
            <?php 
                endforeach;
            else:
                echo '<p>Chưa có sản phẩm nào.</p>';
            endif;
            ?>
        </div>
    </section>
    
    <section class="latest-products">
        <h2>🆕 Sản phẩm mới nhất</h2>
        <div class="products-grid">
            <?php
            $latest_products = wc_get_products([
                'limit' => 8,
                'orderby' => 'date',
                'order' => 'DESC',
                'status' => 'publish'
            ]);
            
            foreach ($latest_products as $product):
            ?>
                <div class="product-item">
                    <a href="<?php echo $product->get_permalink(); ?>">
                        <div class="product-image">
                            <?php echo $product->get_image('medium'); ?>
                        </div>
                        <div class="product-info">
                            <h3><?php echo $product->get_name(); ?></h3>
                            <div class="price"><?php echo $product->get_price_html(); ?></div>
                            <div class="product-specs">
                                <?php
                                $ram = get_field('ram', $product->get_id());
                                $storage = get_field('storage', $product->get_id());
                                if ($ram) echo '<span>RAM: ' . strtoupper($ram) . '</span>';
                                if ($storage) echo '<span>Bộ nhớ: ' . strtoupper($storage) . '</span>';
                                ?>
                            </div>
                        </div>
                    </a>
                    <div class="product-actions">
                        <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="add-to-cart-btn">
                            🛒 Thêm vào giỏ
                        </a>
                        <button class="compare-btn" data-product-id="<?php echo $product->get_id(); ?>">
                            ⚖️ So sánh
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
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