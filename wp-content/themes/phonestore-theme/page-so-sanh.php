<?php
/*
Template Name: So Sánh Sản Phẩm
File: wp-content/themes/phonestore-theme/page-so-sanh.php
*/

get_header();
?>

<div class="container">
    <div class="compare-page-header">
        <h1>⚖️ So Sánh Sản Phẩm</h1>
        <p>So sánh thông số kỹ thuật chi tiết giữa các điện thoại để chọn được sản phẩm phù hợp nhất</p>
    </div>
    
    <!-- Search & Add Products Section -->
    <div class="compare-search-section">
        <div class="search-container">
            <h3>🔍 Thêm sản phẩm để so sánh (tối đa 4 sản phẩm)</h3>
            <div class="product-search-wrapper">
                <input type="text" id="product-search" placeholder="Tìm kiếm sản phẩm để thêm vào so sánh..." autocomplete="off">
                <div id="search-results" class="search-dropdown"></div>
            </div>
        </div>
        
        <!-- Selected Products for Compare -->
        <div id="selected-products" class="selected-products">
            <h4>📱 Sản phẩm đã chọn:</h4>
            <div id="selected-list" class="selected-list">
                <div class="empty-state">
                    <span>Chưa có sản phẩm nào được chọn</span>
                </div>
            </div>
            <button id="start-compare" class="start-compare-btn" disabled>
                🚀 Bắt đầu so sánh
            </button>
        </div>
    </div>
    
    <!-- Compare Table Section -->
    <div id="compare-table-section" class="compare-table-section" style="display: none;">
        <div class="compare-header">
            <h3>📊 Bảng so sánh chi tiết</h3>
            <button id="clear-all" class="clear-all-btn">🗑️ Xóa tất cả</button>
        </div>
        
        <div class="compare-table-wrapper">
            <table id="compare-table" class="compare-table">
                <thead>
                    <tr id="product-headers">
                        <th class="spec-label">Thông số</th>
                    </tr>
                </thead>
                <tbody id="compare-body">
                    <!-- Specs sẽ được load bằng JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Quick Compare với sản phẩm phổ biến -->
    <div class="quick-compare-section">
        <h3>⚡ So sánh nhanh</h3>
        <p>Chọn 2-3 sản phẩm phổ biến để so sánh ngay:</p>
        
        <div class="quick-compare-grid">
            <?php
            // Lấy sản phẩm phổ biến
            $popular_products = wc_get_products([
                'limit' => 6,
                'orderby' => 'popularity',
                'status' => 'publish'
            ]);
            
            if (empty($popular_products)) {
                // Fallback nếu không có products từ WooCommerce
                $popular_products = get_posts([
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'post_status' => 'publish'
                ]);
            }
            
            foreach ($popular_products as $product):
                if (is_object($product) && method_exists($product, 'get_id')) {
                    $product_id = $product->get_id();
                    $product_name = $product->get_name();
                    $product_price = $product->get_price_html();
                    $product_image = $product->get_image('thumbnail');
                } else {
                    $product_id = $product->ID;
                    $product_name = $product->post_title;
                    $wc_product = wc_get_product($product_id);
                    $product_price = $wc_product ? $wc_product->get_price_html() : 'Liên hệ';
                    $product_image = get_the_post_thumbnail($product_id, 'thumbnail');
                }
            ?>
                <div class="quick-product-card">
                    <div class="product-image">
                        <?php echo $product_image ?: '<img src="https://via.placeholder.com/150x150?text=No+Image" alt="No Image">'; ?>
                    </div>
                    <div class="product-info">
                        <h4><?php echo esc_html($product_name); ?></h4>
                        <div class="price"><?php echo $product_price; ?></div>
                        
                        <?php
                        // Hiển thị specs nếu có
                        if (function_exists('get_field')) {
                            $ram = get_field('ram', $product_id);
                            $storage = get_field('storage', $product_id);
                            $brand = get_field('brand', $product_id);
                            
                            if ($ram || $storage || $brand) {
                                echo '<div class="quick-specs">';
                                if ($brand) echo '<span>📱 ' . ucfirst($brand) . '</span>';
                                if ($ram) echo '<span>💾 ' . strtoupper($ram) . '</span>';
                                if ($storage) echo '<span>💿 ' . strtoupper($storage) . '</span>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <button class="quick-add-btn" data-product-id="<?php echo $product_id; ?>">
                        ➕ Thêm so sánh
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- How to use section -->
    <div class="how-to-use-section">
        <h3>❓ Cách sử dụng</h3>
        <div class="steps-grid">
            <div class="step">
                <div class="step-number">1</div>
                <h4>Tìm kiếm sản phẩm</h4>
                <p>Gõ tên điện thoại vào ô tìm kiếm hoặc chọn từ danh sách sản phẩm phổ biến</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h4>Thêm vào so sánh</h4>
                <p>Click "Thêm so sánh" để thêm sản phẩm vào danh sách so sánh (tối đa 4 sản phẩm)</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h4>Xem kết quả</h4>
                <p>Bảng so sánh sẽ hiển thị chi tiết thông số kỹ thuật để bạn dễ dàng đưa ra quyết định</p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript cho trang so sánh -->
<script>
jQuery(document).ready(function($) {
    let selectedProducts = [];
    const maxProducts = 4;
    
    // Product search functionality
    let searchTimeout;
    $('#product-search').on('input', function() {
        const searchTerm = $(this).val().trim();
        
        clearTimeout(searchTimeout);
        
        if (searchTerm.length < 2) {
            $('#search-results').hide().empty();
            return;
        }
        
        searchTimeout = setTimeout(function() {
            searchProducts(searchTerm);
        }, 300);
    });
    
    // Search products via AJAX
    function searchProducts(term) {
        $.ajax({
            url: phonestore_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'phonestore_search_products_compare',
                term: term,
                nonce: phonestore_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    displaySearchResults(response.data);
                }
            }
        });
    }
    
    // Display search results
    function displaySearchResults(products) {
        const resultsHtml = products.map(product => `
            <div class="search-result-item" data-product-id="${product.id}">
                <img src="${product.image}" alt="${product.title}">
                <div class="product-details">
                    <h5>${product.title}</h5>
                    <div class="price">${product.price}</div>
                </div>
                <button class="add-to-compare-btn" ${selectedProducts.includes(product.id) ? 'disabled' : ''}>
                    ${selectedProducts.includes(product.id) ? '✓ Đã thêm' : '+ Thêm'}
                </button>
            </div>
        `).join('');
        
        $('#search-results').html(resultsHtml).show();
    }
    
    // Add product to compare
    $(document).on('click', '.add-to-compare-btn, .quick-add-btn', function() {
        const productId = $(this).data('product-id') || $(this).closest('.search-result-item').data('product-id');
        
        if (selectedProducts.length >= maxProducts) {
            alert('Tối đa chỉ có thể so sánh 4 sản phẩm cùng lúc!');
            return;
        }
        
        if (!selectedProducts.includes(productId)) {
            addProductToCompare(productId);
        }
    });
    
    // Add product to compare list
    function addProductToCompare(productId) {
        $.ajax({
            url: phonestore_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'phonestore_get_product_compare',
                product_id: productId,
                nonce: phonestore_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    selectedProducts.push(parseInt(productId));
                    updateSelectedProductsList();
                    updateCompareTable();
                    
                    // Update UI
                    $(`.add-to-compare-btn[data-product-id="${productId}"], .quick-add-btn[data-product-id="${productId}"]`)
                        .prop('disabled', true)
                        .text('✓ Đã thêm');
                }
            }
        });
    }
    
    // Update selected products list
    function updateSelectedProductsList() {
        if (selectedProducts.length === 0) {
            $('#selected-list').html('<div class="empty-state"><span>Chưa có sản phẩm nào được chọn</span></div>');
            $('#start-compare').prop('disabled', true);
            return;
        }
        
        const selectedHtml = selectedProducts.map(productId => `
            <div class="selected-product" data-product-id="${productId}">
                <span>Sản phẩm ${productId}</span>
                <button class="remove-product" data-product-id="${productId}">×</button>
            </div>
        `).join('');
        
        $('#selected-list').html(selectedHtml);
        $('#start-compare').prop('disabled', selectedProducts.length < 2);
    }
    
    // Remove product from compare
    $(document).on('click', '.remove-product', function() {
        const productId = parseInt($(this).data('product-id'));
        selectedProducts = selectedProducts.filter(id => id !== productId);
        updateSelectedProductsList();
        updateCompareTable();
        
        // Re-enable add buttons
        $(`.add-to-compare-btn[data-product-id="${productId}"], .quick-add-btn[data-product-id="${productId}"]`)
            .prop('disabled', false)
            .text('+ Thêm');
    });
    
    // Start compare
    $('#start-compare').on('click', function() {
        if (selectedProducts.length >= 2) {
            $('#compare-table-section').show();
            $('html, body').animate({
                scrollTop: $('#compare-table-section').offset().top - 100
            }, 800);
        }
    });
    
    // Update compare table
    function updateCompareTable() {
        if (selectedProducts.length < 2) {
            $('#compare-table-section').hide();
            return;
        }
        
        // Load compare data via AJAX
        $.ajax({
            url: phonestore_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'phonestore_load_compare_table',
                product_ids: selectedProducts,
                nonce: phonestore_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('#compare-table').html(response.data);
                    $('#compare-table-section').show();
                }
            }
        });
    }
    
    // Clear all products
    $('#clear-all').on('click', function() {
        selectedProducts = [];
        updateSelectedProductsList();
        $('#compare-table-section').hide();
        
        // Re-enable all add buttons
        $('.add-to-compare-btn, .quick-add-btn').prop('disabled', false).text('+ Thêm');
    });
    
    // Hide search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.product-search-wrapper').length) {
            $('#search-results').hide();
        }
    });
});
</script>

<?php get_footer(); ?>