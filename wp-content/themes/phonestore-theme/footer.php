</main><!-- .main-content -->

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>📱 Cửa Hàng Điện Thoại</h3>
                <p>Chuyên cung cấp điện thoại chính hãng với giá tốt nhất thị trường.</p>
                <div class="contact-info">
                    <p><strong>📍 Địa chỉ:</strong> Purple House, Ninh Kiều, Cần Thơ</p>
                    <p><strong>📞 Hotline:</strong> 0123.456.789</p>
                    <p><strong>✉️ Email:</strong> info@phonestore.com</p>
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Sản phẩm</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo home_url('/shop/?filter_brand=iphone'); ?>">iPhone</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=samsung'); ?>">Samsung</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=xiaomi'); ?>">Xiaomi</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=oppo'); ?>">OPPO</a></li>
                    <li><a href="<?php echo home_url('/shop/?filter_brand=vivo'); ?>">Vivo</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Hỗ trợ khách hàng</h3>
                <ul class="footer-links">
                    <li><a href="#">Chính sách bảo hành</a></li>
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Phương thức thanh toán</a></li>
                    <?php if (class_exists('WooCommerce')): ?>
                    <li><a href="<?php echo wc_get_account_endpoint_url('orders'); ?>">Tra cứu đơn hàng</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Cửa Hàng Điện Thoại. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background: #2c3e50;
    color: #ecf0f1;
    padding: 40px 0 20px;
    margin-top: 50px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
}

.footer-column h3 {
    color: #3498db;
    margin-bottom: 15px;
    font-size: 18px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-links a:hover {
    color: #3498db;
}

.contact-info p {
    margin: 8px 0;
    font-size: 14px;
}

.footer-bottom {
    border-top: 1px solid #34495e;
    padding-top: 20px;
    text-align: center;
    color: #bdc3c7;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>