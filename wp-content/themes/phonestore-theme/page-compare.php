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

/* Search Suggestions */
.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    z-index: 100;
    max-height: 300px;
    overflow-y: auto;
    margin-top: 5px;
}

.suggestion-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background 0.3s;
}

.suggestion-item:hover {
    background: #f8f9fa;
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-item img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 4px;
    margin-right: 12px;
}

.suggestion-content {
    flex: 1;
}

.suggestion-title {
    display: block;
    color: #333;
    font-weight: 500;
    margin-bottom: 4px;
}

.suggestion-price {
    display: block;
    color: #e74c3c;
    font-weight: bold;
    font-size: 14px;
}

/* Compare Notification */
.compare-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #28a745;
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    z-index: 9999;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.compare-notification a {
    color: white;
    text-decoration: underline;
    font-weight: bold;
}

.close-notification {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
}

.compare-btn.added {
    background: #28a745 !important;
}

.compare-btn.added:hover {
    background: #218838 !important;
}