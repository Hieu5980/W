<?php
/*
File: wp-content/themes/phonestore-theme/woocommerce/cart/cart.php
Custom Cart Page Template
*/

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="cart-page-container">
    <div class="cart-header">
        <h1>🛒 Giỏ Hàng Của Bạn</h1>
        <p>Xem lại sản phẩm và tiến hành thanh toán</p>
    </div>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
            
            <!-- Cart Items -->
            <div class="cart-items-section">
                <h2>📦 Sản phẩm trong giỏ (<?php echo WC()->cart->get_cart_contents_count(); ?> sản phẩm)</h2>
                
                <div class="cart-table-wrapper">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-table__table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Hình ảnh</th>
                                <th class="product-name">Sản phẩm</th>
                                <th class="product-price">Đơn giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Thành tiền</th>
                                <th class="product-remove">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    ?>
                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                        <!-- Product Image -->
                                        <td class="product-thumbnail">
                                            <div class="product-image-wrapper">
                                                <?php
                                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                                if ( ! $product_permalink ) {
                                                    echo $thumbnail; // PHPCS: XSS ok.
                                                } else {
                                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                                }
                                                ?>
                                            </div>
                                        </td>

                                        <!-- Product Name -->
                                        <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                            <div class="product-info">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="product-title">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                }

                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                // Meta data.
                                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                                // Backorder notification.
                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                                
                                                <!-- Product Specs -->
                                                <div class="product-specs-mini">
                                                    <?php
                                                    if (function_exists('get_field')) {
                                                        $ram = get_field('ram', $product_id);
                                                        $storage = get_field('storage', $product_id);
                                                        if ($ram) echo '<span class="spec">💾 ' . strtoupper($ram) . '</span>';
                                                        if ($storage) echo '<span class="spec">💿 ' . strtoupper($storage) . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Product Price -->
                                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <div class="price-wrapper">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                        </td>

                                        <!-- Product Quantity -->
                                        <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                            <div class="quantity-wrapper">
                                                <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                } else {
                                                    $product_quantity = woocommerce_quantity_input(
                                                        array(
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $_product->get_max_purchase_quantity(),
                                                            'min_value'    => '0',
                                                            'product_name' => $_product->get_name(),
                                                        ),
                                                        $_product,
                                                        false
                                                    );
                                                }

                                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                        </td>

                                        <!-- Product Subtotal -->
                                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                            <div class="subtotal-wrapper">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                        </td>

                                        <!-- Remove Product -->
                                        <td class="product-remove">
                                            <div class="remove-wrapper">
                                                <?php
                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">🗑️</a>',
                                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                                            esc_attr( $product_id ),
                                                            esc_attr( $_product->get_sku() )
                                                        ),
                                                        $cart_item_key
                                                    );
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>

                            <!-- Cart Actions Row -->
                            <tr class="cart-actions-row">
                                <td colspan="6" class="actions">
                                    <div class="cart-actions">
                                        <div class="coupon">
                                            <label for="coupon_code">🎟️ Mã giảm giá:</label>
                                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Nhập mã giảm giá" />
                                            <button type="submit" class="button coupon-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">Áp dụng</button>
                                        </div>

                                        <div class="cart-buttons">
                                            <button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                                                🔄 Cập nhật giỏ hàng
                                            </button>
                                            
                                            <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="button continue-shopping">
                                                🛒 Tiếp tục mua sắm
                                            </a>
                                        </div>
                                    </div>

                                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else : ?>
            
            <!-- Empty Cart -->
            <div class="cart-empty">
                <div class="empty-cart-icon">🛒</div>
                <h2>Giỏ hàng của bạn đang trống</h2>
                <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                
                <div class="empty-cart-actions">
                    <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="button shop-now">
                        🛒 Mua sắm ngay
                    </a>
                </div>

                <!-- Featured Products -->
                <div class="suggested-products">
                    <h3>🌟 Sản phẩm gợi ý</h3>
                    <div class="suggested-grid">
                        <?php
                        $featured_products = wc_get_products([
                            'limit' => 4,
                            'orderby' => 'popularity',
                            'status' => 'publish'
                        ]);

                        foreach ($featured_products as $product) :
                        ?>
                            <div class="suggested-item">
                                <a href="<?php echo get_permalink($product->get_id()); ?>">
                                    <?php echo $product->get_image('thumbnail'); ?>
                                    <h4><?php echo $product->get_name(); ?></h4>
                                    <div class="price"><?php echo $product->get_price_html(); ?></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>

    <?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
        <!-- Cart Totals -->
        <div class="cart-totals-section">
            <div class="cart-collaterals">
                <?php
                    /**
                     * Cart collaterals hook.
                     *
                     * @hooked woocommerce_cross_sell_display
                     * @hooked woocommerce_cart_totals - 10
                     */
                    do_action( 'woocommerce_cart_collaterals' );
                ?>
            </div>
        </div>

        <!-- Shipping Calculator -->
        <div class="shipping-calculator-section">
            <h3>🚚 Tính phí vận chuyển</h3>
            <div class="shipping-info">
                <p>Nhập địa chỉ để tính phí vận chuyển chính xác</p>
                <?php woocommerce_shipping_calculator(); ?>
            </div>
        </div>

        <!-- Security & Trust -->
        <div class="trust-section">
            <h3>🔒 Mua sắm an toàn</h3>
            <div class="trust-items">
                <div class="trust-item">
                    <div class="trust-icon">🛡️</div>
                    <div class="trust-info">
                        <h4>Bảo mật SSL</h4>
                        <p>Thông tin thanh toán được mã hóa</p>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">🔄</div>
                    <div class="trust-info">
                        <h4>Đổi trả 7 ngày</h4>
                        <p>Miễn phí đổi trả trong 7 ngày</p>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">🚚</div>
                    <div class="trust-info">
                        <h4>Giao hàng nhanh</h4>
                        <p>Giao hàng trong 24h tại TP.HCM</p>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">💬</div>
                    <div class="trust-info">
                        <h4>Hỗ trợ 24/7</h4>
                        <p>Luôn sẵn sàng hỗ trợ khách hàng</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

<script>
jQuery(document).ready(function($) {
    // Auto update cart when quantity changes
    $('.qty').on('change', function() {
        var $form = $(this).closest('form');
        $form.find('[name="update_cart"]').prop('disabled', false);
        
        // Auto submit after 1 second
        setTimeout(function() {
            if ($form.find('[name="update_cart"]').length > 0) {
                $form.find('[name="update_cart"]').click();
            }
        }, 1000);
    });
    
    // Confirm remove item
    $('.remove').on('click', function(e) {
        if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            e.preventDefault();
        }
    });
    
    // Coupon code input enhancement
    $('#coupon_code').on('keypress', function(e) {
        if (e.which == 13) { // Enter key
            e.preventDefault();
            $(this).siblings('.coupon-btn').click();
        }
    });
    
    // Add loading states
    $('.update-cart, .coupon-btn').on('click', function() {
        var $btn = $(this);
        var originalText = $btn.text();
        
        $btn.prop('disabled', true).text('⏳ Đang xử lý...');
        
        // Re-enable after form submission
        setTimeout(function() {
            $btn.prop('disabled', false).text(originalText);
        }, 3000);
    });
    
    // Quantity input validation
    $('.qty').on('input', function() {
        var val = parseInt($(this).val());
        var min = parseInt($(this).attr('min')) || 0;
        var max = parseInt($(this).attr('max')) || 999;
        
        if (val < min) $(this).val(min);
        if (val > max) $(this).val(max);
    });
});
</script>