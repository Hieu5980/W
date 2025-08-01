<?php
/**
 * WooCommerce Fallback Template
 */

get_header();
?>

<div class="container">
    <h1>🛒 Shop Page</h1>
    
    <!-- Simple product display -->
    <div class="simple-products">
        <?php
        $products = get_posts([
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 12
        ]);
        
        if ($products) {
            echo '<div class="products-grid">';
            foreach ($products as $product) {
                $wc_product = wc_get_product($product->ID);
                ?>
                <div class="product-item">
                    <a href="<?php echo get_permalink($product->ID); ?>">
                        <?php echo get_the_post_thumbnail($product->ID, 'medium'); ?>
                        <h3><?php echo $product->post_title; ?></h3>
                        <?php if ($wc_product): ?>
                            <div class="price"><?php echo $wc_product->get_price_html(); ?></div>
                        <?php endif; ?>
                    </a>
                    <a href="?add-to-cart=<?php echo $product->ID; ?>" class="add-to-cart">Add to cart</a>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo '<p>No products found</p>';
        }
        ?>
    </div>
    
    <!-- WooCommerce default content -->
    <div class="woocommerce-content">
        <?php woocommerce_content(); ?>
    </div>
</div>

<style>
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.product-item {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
}

.product-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 10px;
}

.product-item h3 {
    margin: 10px 0;
    font-size: 16px;
}

.price {
    font-size: 18px;
    font-weight: bold;
    color: #e74c3c;
    margin: 10px 0;
}

.add-to-cart {
    background: #28a745;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
    margin-top: 10px;
}
</style>

<?php get_footer(); ?>