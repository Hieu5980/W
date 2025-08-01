<?php
/*
Template Name: Compare Products
*/

get_header();
?>

<div class="container">
    <div class="page-header">
        <h1>📊 So sánh sản phẩm</h1>
        <p>So sánh thông số kỹ thuật chi tiết giữa các điện thoại</p>
    </div>
    
    <div id="compare-products">
        <div class="compare-search">
            <h3>Thêm sản phẩm để so sánh (tối đa 4 sản phẩm)</h3>
            <div class="search-container">
                <input type="text" id="product-search" placeholder="Tìm kiếm sản phẩm để thêm vào so sánh...">
                <div id="search-results"></div>
            </div>
        </div>
        
        <div id="compare-table-container" style="display: none;">
            <h3>Bảng so sánh</h3>
            <div class="compare-table-wrapper">
                <table id="compare-table" class="compare-table">
                    <thead>
                        <tr id="product-row">
                            <td class="spec-label">Sản phẩm</td>
                        </tr>
                    </thead>
                    <tbody id="compare-body">
                        <!-- Specs sẽ được load bằng JavaScript -->
                    </tbody>
                </table>
            </div>
            <button id="clear-compare" class="button-clear">🗑️ Xóa tất cả</button>
        </div>
        
        <!-- Quick Compare với sản phẩm có sẵn -->
        <div class="quick-compare-section">
            <h3>📱 So sánh nhanh</h3>
            <p>Chọn 2-3 sản phẩm phổ biến để so sánh ngay:</p>
            
            <div class="quick-compare-products">
                <?php
                $popular_products = wc_get_products([
                    'limit' => 6,
                    'orderby' => 'popularity',
                    'status' => 'publish'
                ]);
                
                foreach ($popular_products as $product):
                ?>
                    <div class="quick-product-item">
                        <div class="product-image">
                            <?php echo $product->get_image('thumbnail'); ?>
                        </div>
                        <div class="product-info">
                            <h4><?php echo $product->get_name(); ?></h4>
                            <div class="price"><?php echo $product->get_price_html(); ?></div>
                        </div>
                        <button class="quick-add-compare" data-product-id="<?php echo $product->get_id(); ?>">
                            + Thêm so sánh
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- CSS Styles -->
<style>
.page-header {
    text-align: center;
    padding: 40px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    margin: 20px 0 40px 0;
}

.page-header h1 {
    font-size: 2.2rem;
    margin-bottom: 10px;
}

.page-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.compare-search {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 15px;
    margin: 30px 0;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.compare-search h3 {
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.search-container {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
}

#product-search {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #ddd;
    border-radius: 10px;
    font-size: 16px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#product-search:focus {
    outline: none;
    border-color: #007cba;
}

#search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 10px;
    max-height: 400px;
    overflow-y: auto;
    z-index: 100;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    margin-top: 5px;
}

.search-result-item {
    display: flex;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background 0.3s;
}

.search-result-item:hover {
    background: #f8f9fa;
}

.search-result-item:last-child {
    border-bottom: none;
}

.search-result-item img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    margin-right: 15px;
    border-radius: 8px;
}

.search-result-item .product-info {
    flex: 1;
}

.search-result-item .product-info h4 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 16px;
}

.search-result-item .price {
    font-weight: bold;
    color: #e74c3c;
    font-size: 14px;
}

.add-to-compare {
    background: #28a745;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: background 0.3s;
}

.add-to-compare:hover {
    background: #218838;
}

.compare-table-wrapper {
    overflow-x: auto;
    margin: 30px 0;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.compare-table {
    width: 100%;
    min-width: 800px;
    border-collapse: collapse;
    background: white;
}

.compare-table td {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
    vertical-align: top;
}

.spec-label {
    background: #f8f9fa;
    font-weight: bold;
    text-align: left !important;
    min-width: 150px;
    color: #333;
}

.product-column {
    position: relative;
    min-width: 200px;
}

.product-compare-header {
    position: relative;
    padding: 20px;
}

.product-compare-header img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    margin-bottom: 15px;
    border-radius: 10px;
}

.product-compare-header h4 {
    margin: 10px 0;
    color: #333;
    font-size: 16px;
    line-height: 1.4;
}

.product-compare-header h4 a {
    color: inherit;
    text-decoration: none;
}

.product-compare-header h4 a:hover {
    color: #007cba;
}

.product-compare-header .price {
    font-size: 18px;
    font-weight: bold;
    color: #e74c3c;
    margin: 10px 0;
}

.remove-from-compare {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
}

.remove-from-compare:hover {
    background: #c82333;
}

.button-clear {
    background: #dc3545;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    margin: 20px 0;
    transition: background 0.3s;
}

.button-clear:hover {
    background: #c82333;
}

/* Quick Compare Section */
.quick-compare-section {
    background: white;
    padding: 30px;
    border-radius: 15px;
    margin: 40px 0;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.quick-compare-section h3 {
    text-align: center;
    color: #333;
    margin-bottom: 10px;
}

.quick-compare-section p {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
}

.quick-compare-products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

.quick-product-item {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.quick-product-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}

.quick-product-item .product-image img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}

.quick-product-item h4 {
    margin: 10px 0;
    color: #333;
    font-size: 14px;
    line-height: 1.3;
}

.quick-product-item .price {
    font-weight: bold;
    color: #e74c3c;
    margin: 8px 0;
    font-size: 14px;
}

.quick-add-compare {
    background: #007cba;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    width: 100%;
    transition: background 0.3s;
}

.quick-add-compare:hover {
    background: #005a87;
}

.quick-add-compare.added {
    background: #28a745;
    cursor: default;
}

.quick-add-compare.added:hover {
    background: #28a745;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .page-header h1 {
        font-size: 1.8rem;
    }
    
    .compare-search {
        padding: 20px;
    }
    
    .compare-table {
        font-size: 12px;
    }
    
    .product-compare-header img {
        width: 80px;
        height: 80px;
    }
    
    .product-compare-header h4 {
        font-size: 14px;
    }
    
    .search-result-item {
        flex-direction: column;
        text-align: center;
        padding: 10px;
    }
    
    .search-result-item img {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .quick-compare-products {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }
}
</style>

<!-- JavaScript -->
<script>
jQuery(document).ready(function($) {
    var compareProducts = JSON.parse(localStorage.getItem('phonestore_compare') || '[]');
    var maxProducts = 4;
    
    // Load existing compare table if any
    updateCompareDisplay();
    
    // Search sản phẩm
    var searchTimeout;
    $('#product-search').on('input', function() {
        var searchTerm = $(this).val();
        
        clearTimeout(searchTimeout);
        
        if (searchTerm.length >= 2) {
            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: phonestore_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'phonestore_ajax_product_search',
                        term: searchTerm,
                        nonce: phonestore_ajax.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            showSearchResults(response.data);
                        }
                    },
                    error: function() {
                        $('#search-results').html('<div class="search-result-item"><p>Lỗi khi tìm kiếm. Vui lòng thử lại.</p></div>');
                    }
                });
            }, 300);
        } else {
            $('#search-results').empty();
        }
    });
    
    // Click outside to close search results
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-container').length) {
            $('#search-results').empty();
        }
    });
    
    function showSearchResults(products) {
        var html = '';
        if (products.length > 0) {
            products.forEach(function(product) {
                html += '<div class="search-result-item" data-id="' + product.id + '">';
                html += '<img src="' + (product.image || '') + '" alt="">';
                html += '<div class="product-info">';
                html += '<h4>' + product.title + '</h4>';
                html += '<div class="price">' + product.price + '</div>';
                html += '</div>';
                html += '<button class="add-to-compare">Thêm</button>';
                html += '</div>';
            });
        } else {
            html = '<div class="search-result-item"><p>Không tìm thấy sản phẩm nào.</p></div>';
        }
        $('#search-results').html(html);
    }
    
    // Thêm sản phẩm vào compare từ search
    $(document).on('click', '.add-to-compare', function() {
        var productId = parseInt($(this).closest('.search-result-item').data('id'));
        addToCompare(productId);
    });
    
    // Thêm sản phẩm vào compare từ quick section
    $(document).on('click', '.quick-add-compare', function() {
        var productId = parseInt($(this).data('product-id'));
        var button = $(this);
        
        if (!button.hasClass('added')) {
            addToCompare(productId);
            button.addClass('added').text('✓ Đã thêm');
        }
    });
    
    function addToCompare(productId) {
        if (compareProducts.length >= maxProducts) {
            alert('Chỉ có thể so sánh tối đa ' + maxProducts + ' sản phẩm');
            return;
        }
        
        if (compareProducts.indexOf(productId) === -1 && productId) {
            compareProducts.push(productId);
            localStorage.setItem('phonestore_compare', JSON.stringify(compareProducts));
            updateCompareDisplay();
            $('#search-results').empty();
            $('#product-search').val('');
            
            // Update quick buttons
            $('.quick-add-compare[data-product-id="' + productId + '"]')
                .addClass('added').text('✓ Đã thêm');
            
            alert('Đã thêm sản phẩm vào so sánh!');
        } else if (compareProducts.indexOf(productId) !== -1) {
            alert('Sản phẩm đã có trong danh sách so sánh!');
        }
    }
    
    function updateCompareDisplay() {
        if (compareProducts.length === 0) {
            $('#compare-table-container').hide();
            // Reset quick buttons
            $('.quick-add-compare').removeClass('added').text('+ Thêm so sánh');
            return;
        }
        
        // Show compare table
        $('#compare-table-container').show();
        $('#compare-table-container h3').text('Bảng so sánh (' + compareProducts.length + ' sản phẩm)');
        
        // Load compare data (simplified version - would need AJAX to get full product data)
        loadCompareTableData();
        
        // Update quick buttons state
        compareProducts.forEach(function(id) {
            $('.quick-add-compare[data-product-id="' + id + '"]')
                .addClass('added').text('✓ Đã thêm');
        });
    }
    
    function loadCompareTableData() {
        // Basic table structure - would need AJAX call for full implementation
        var headerHtml = '<td class="spec-label">Sản phẩm</td>';
        for (var i = 0; i < compareProducts.length; i++) {
            headerHtml += '<td class="product-column">Sản phẩm ' + (i + 1) + '</td>';
        }
        $('#product-row').html(headerHtml);
        
        // Add basic specs rows
        var specsRows = [
            'Giá',
            'Thương hiệu', 
            'Màn hình',
            'Vi xử lý',
            'RAM',
            'Bộ nhớ',
            'Camera',
            'Pin'
        ];
        
        var bodyHtml = '';
        specsRows.forEach(function(spec) {
            bodyHtml += '<tr><td class="spec-label">' + spec + '</td>';
            for (var i = 0; i < compareProducts.length; i++) {
                bodyHtml += '<td>Đang tải...</td>';
            }
            bodyHtml += '</tr>';
        });
        
        $('#compare-body').html(bodyHtml);
    }
    
    // Remove from compare
    $(document).on('click', '.remove-from-compare', function() {
        var productId = parseInt($(this).data('product-id'));
        removeFromCompare(productId);
    });
    
    function removeFromCompare(productId) {
        var index = compareProducts.indexOf(productId);
        if (index > -1) {
            compareProducts.splice(index, 1);
            localStorage.setItem('phonestore_compare', JSON.stringify(compareProducts));
            updateCompareDisplay();
            
            // Update quick button
            $('.quick-add-compare[data-product-id="' + productId + '"]')
                .removeClass('added').text('+ Thêm so sánh');
        }
    }
    
    // Clear all compare
    $('#clear-compare').on('click', function() {
        if (confirm('Bạn có chắc muốn xóa tất cả sản phẩm khỏi danh sách so sánh?')) {
            compareProducts = [];
            localStorage.setItem('phonestore_compare', JSON.stringify(compareProducts));
            updateCompareDisplay();
        }
    });
});
</script>

<?php get_footer(); ?>