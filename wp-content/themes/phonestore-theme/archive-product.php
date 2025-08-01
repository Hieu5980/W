<?php
/**
 * Archive Product Template - Shop Page
 */

get_header();
?>

<div class="container">
    <div class="shop-header">
        <h1>🛒 <?php woocommerce_page_title(); ?></h1>
        <p>Tìm kiếm và mua sắm điện thoại chính hãng với giá tốt nhất</p>
    </div>

    <!-- Search và Filter Form -->
    <div class="shop-filters">
        <form class="shop-filter-form" method="GET">
            <div class="filter-row">
                <input type="text" name="s" placeholder="Tìm kiếm sản phẩm..." 
                       value="<?php echo get_search_query(); ?>">
                
                <select name="filter_brand">
                    <option value="">Tất cả thương hiệu</option>
                    <option value="iphone" <?php selected($_GET['filter_brand'] ?? '', 'iphone'); ?>>iPhone</option>
                    <option value="samsung" <?php selected($_GET['filter_brand'] ?? '', 'samsung'); ?>>Samsung</option>
                    <option value="xiaomi" <?php selected($_GET['filter_brand'] ?? '', 'xiaomi'); ?>>Xiaomi</option>
                    <option value="oppo" <?php selected($_GET['filter_brand'] ?? '', 'oppo'); ?>>OPPO</option>
                    <option value="vivo" <?php selected($_GET['filter_brand'] ?? '', 'vivo'); ?>>Vivo</option>
                </select>
                
                <select name="orderby">
                    <option value="menu_order" <?php selected($_GET['orderby'] ?? '', 'menu_order'); ?>>Sắp xếp mặc định</option>
                    <option value="popularity" <?php selected($_GET['orderby'] ?? '', 'popularity'); ?>>Phổ biến nhất</option>
                    <option value="rating" <?php selected($_GET['orderby'] ?? '', 'rating'); ?>>Đánh giá cao</option>
                    <option value="date" <?php selected($_GET['orderby'] ?? '', 'date'); ?>>Mới nhất</option>
                    <option value="price" <?php selected($_GET['orderby'] ?? '', 'price'); ?>>Giá thấp đến cao</option>
                    <option value="price-desc" <?php selected($_GET['orderby'] ?? '', 'price-desc'); ?>>Giá cao đến thấp</option>
                </select>
                
                <button type="submit" class="filter-button">Lọc</button>
            </div>
        </form>
    </div>

    <!-- Debug Info -->
   <!-- Thay thế debug section trong archive-product.php -->
<div class="debug-info" style="background: #f0f0f0; padding: 15px; margin: 20px 0; border-radius: 5px;">
    <strong>Debug Info:</strong><br>
    <?php
    global $wp_query;
    
    echo "Found posts: " . $wp_query->found_posts . "<br>";
    echo "Post count: " . $wp_query->post_count . "<br>";
    
    // Kiểm tra sản phẩm trực tiếp từ database
    $direct_products = get_posts([
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '='
            ]
        ]
    ]);
    
    echo "Direct product count: " . count($direct_products) . "<br>";
    
    if (!empty($direct_products)) {
        echo "<strong>Products found directly:</strong><br>";
        foreach ($direct_products as $prod) {
            $wc_product = wc_get_product($prod->ID);
            echo "- ID: {$prod->ID}, Title: {$prod->post_title}, Status: {$prod->post_status}";
            if ($wc_product) {
                echo ", Stock: " . $wc_product->get_stock_status();
                echo ", Visibility: " . $wc_product->get_catalog_visibility();
                echo ", Price: " . $wc_product->get_price();
            }
            echo "<br>";
        }
    }
    
    // Test WooCommerce shortcode
    echo "<br><strong>WooCommerce Shortcode Test:</strong><br>";
    ?>
    <div style="border: 1px solid #ccc; padding: 10px;">
        <?php echo do_shortcode('[products limit="4"]'); ?>
    </div>
</div>

    <!-- Products Grid -->
    <div class="shop-products">
        <?php if (have_posts()): ?>
            
            <div class="products-count">
                <p>Hiển thị <?php echo $wp_query->post_count; ?> trong tổng số <?php echo $wp_query->found_posts; ?> sản phẩm</p>
            </div>
            
            <div class="products-grid">
                <?php while (have_posts()): the_post(); ?>
                    <?php 
                    global $product;
                    if (!$product) {
                        $product = wc_get_product(get_the_ID());
                    }
                    ?>
                    
                    <div class="product-item">
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium');
                                } else {
                                    echo '<img src="https://via.placeholder.com/300x300?text=No+Image" alt="No Image">';
                                }
                                ?>
                            </a>
                        </div>
                        
                        <div class="product-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            
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
                                    $brand = get_field('brand');
                                    
                                    if ($brand) echo '<span>📱 ' . ucfirst($brand) . '</span>';
                                    if ($ram) echo '<span>💾 RAM: ' . strtoupper($ram) . '</span>';
                                    if ($storage) echo '<span>💿 ' . strtoupper($storage) . '</span>';
                                }
                                ?>
                            </div>
                            
                            <div class="product-actions">
                                <?php if ($product && $product->is_purchasable()): ?>
                                    <a href="?add-to-cart=<?php echo get_the_ID(); ?>" 
                                       class="add-to-cart-btn ajax_add_to_cart" 
                                       data-product_id="<?php echo get_the_ID(); ?>">
                                        🛒 Thêm vào giỏ
                                    </a>
                                <?php endif; ?>
                                
                                <button class="compare-btn" data-product-id="<?php echo get_the_ID(); ?>">
                                    ⚖️ So sánh
                                </button>
                                
                                <a href="<?php the_permalink(); ?>" class="view-details-btn">
                                    👁️ Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                    
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="shop-pagination">
                <?php
                echo paginate_links([
                    'total' => $wp_query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'prev_text' => '← Trước',
                    'next_text' => 'Tiếp →'
                ]);
                ?>
            </div>
            
        <?php else: ?>
            
            <!-- No Products Found -->
            <div class="no-products-found">
                <h2>🚫 Không tìm thấy sản phẩm</h2>
                <p>Không có sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
                
                <div class="no-products-actions">
                    <a href="<?php echo home_url('/shop/'); ?>" class="button">Xem tất cả sản phẩm</a>
                    <a href="<?php echo home_url(); ?>" class="button">Về trang chủ</a>
                </div>
            </div>
            
        <?php endif; ?>
    </div>
</div>

<style>
.shop-header {
    text-align: center;
    padding: 30px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
    margin: 20px 0;
}

.shop-header h1 {
    font-size: 2.2rem;
    margin-bottom: 10px;
}

.shop-filters {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
}

.filter-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
    gap: 15px;
    align-items: center;
}

.filter-row input,
.filter-row select {
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.filter-button {
    background: #007cba;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
}

.products-count {
    margin: 20px 0;
    color: #666;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin: 30px 0;
}

.product-item {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
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
    font-size: 16px;
    line-height: 1.4;
}

.product-info h3 a {
    color: #333;
    text-decoration: none;
}

.product-info h3 a:hover {
    color: #007cba;
}

.price {
    font-size: 18px;
    font-weight: bold;
    color: #e74c3c;
    margin: 10px 0;
}

.product-specs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 15px 0;
}

.product-specs span {
    background: #f1f3f4;
    color: #5f6368;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.product-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-top: 15px;
}

.add-to-cart-btn,
.compare-btn,
.view-details-btn {
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s;
}

.add-to-cart-btn {
    background: #28a745;
    color: white;
    grid-column: 1 / -1;
}

.add-to-cart-btn:hover {
    background: #218838;
}

.compare-btn {
    background: #6c757d;
    color: white;
}

.compare-btn:hover {
    background: #5a6268;
}

.view-details-btn {
    background: #007cba;
    color: white;
}

.view-details-btn:hover {
    background: #005a87;
}

.no-products-found {
    text-align: center;
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 12px;
    margin: 40px 0;
}

.no-products-found h2 {
    color: #666;
    margin-bottom: 15px;
}

.no-products-actions {
    margin-top: 30px;
}

.no-products-actions .button {
    display: inline-block;
    background: #007cba;
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 6px;
    margin: 0 10px;
    font-weight: 600;
}

.shop-pagination {
    text-align: center;
    margin: 40px 0;
}

.shop-pagination .page-numbers {
    display: inline-block;
    padding: 8px 16px;
    margin: 0 4px;
    background: #f8f9fa;
    color: #007cba;
    text-decoration: none;
    border-radius: 4px;
    font-weight: 500;
}

.shop-pagination .page-numbers.current {
    background: #007cba;
    color: white;
}

@media (max-width: 768px) {
    .shop-header h1 {
        font-size: 1.8rem;
    }
    
    .filter-row {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
}
</style>

<?php get_footer(); ?>