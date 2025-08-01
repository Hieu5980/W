<?php
/*
Template Name: Liên Hệ
File: wp-content/themes/phonestore-theme/page-lien-he.php
*/

get_header();
?>

<div class="container">
    <div class="contact-page-header">
        <h1>📞 Liên Hệ Với Chúng Tôi</h1>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy liên hệ với chúng tôi qua các hình thức dưới đây</p>
    </div>
    
    <!-- Contact Info Cards -->
    <div class="contact-info-section">
        <h2>🏪 Thông Tin Cửa Hàng</h2>
        <div class="contact-cards-grid">
            <div class="contact-card">
                <div class="contact-icon">📍</div>
                <h3>Địa Chỉ</h3>
                <p>Purple House, Ninh Kiều<br>Cần Thơ, Việt Nam</p>
                <a href="https://maps.google.com/?q=Purple+House+Ninh+Kieu+Can+Tho" target="_blank" class="map-link">
                    🗺️ Xem trên bản đồ
                </a>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">📱</div>
                <h3>Số Điện Thoại</h3>
                <p><a href="tel:+84123456789">📞 0123.456.789</a></p>
                <p><a href="tel:+84987654321">📞 098.765.4321</a></p>
                <small>Hotline hỗ trợ 24/7</small>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">✉️</div>
                <h3>Email</h3>
                <p><a href="mailto:info@phonestore.com">info@phonestore.com</a></p>
                <p><a href="mailto:support@phonestore.com">support@phonestore.com</a></p>
                <small>Phản hồi trong 24h</small>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">🕐</div>
                <h3>Giờ Mở Cửa</h3>
                <p><strong>Thứ 2 - Thứ 6:</strong><br>8:00 - 21:00</p>
                <p><strong>Thứ 7 - Chủ Nhật:</strong><br>8:00 - 22:00</p>
            </div>
        </div>
    </div>
    
    <!-- Contact Form & Map Section -->
    <div class="contact-main-section">
        <div class="contact-form-section">
            <h2>💬 Gửi Tin Nhắn Cho Chúng Tôi</h2>
            
            <!-- Success/Error Messages -->
            <div id="contact-messages" style="display: none;"></div>
            
            <form id="contact-form" class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact-name">👤 Họ và Tên *</label>
                        <input type="text" id="contact-name" name="name" required placeholder="Nhập họ và tên của bạn">
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-phone">📱 Số Điện Thoại *</label>
                        <input type="tel" id="contact-phone" name="phone" required placeholder="Nhập số điện thoại">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact-email">✉️ Email *</label>
                        <input type="email" id="contact-email" name="email" required placeholder="Nhập địa chỉ email">
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-subject">📋 Chủ Đề</label>
                        <select id="contact-subject" name="subject">
                            <option value="">-- Chọn chủ đề --</option>
                            <option value="product-inquiry">Hỏi về sản phẩm</option>
                            <option value="warranty">Bảo hành</option>
                            <option value="return-exchange">Đổi trả</option>
                            <option value="technical-support">Hỗ trợ kỹ thuật</option>
                            <option value="complaint">Khiếu nại</option>
                            <option value="partnership">Hợp tác kinh doanh</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="contact-message">💭 Tin Nhắn *</label>
                    <textarea id="contact-message" name="message" rows="6" required placeholder="Nhập tin nhắn của bạn..."></textarea>
                </div>
                
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="contact-privacy" name="privacy" required>
                        <span class="checkmark"></span>
                        Tôi đồng ý với <a href="#" target="_blank">chính sách bảo mật</a> và cho phép cửa hàng liên hệ lại với tôi
                    </label>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="submit-btn">
                        <span class="btn-text">🚀 Gửi Tin Nhắn</span>
                        <span class="btn-loader" style="display: none;">⏳ Đang gửi...</span>
                    </button>
                    <button type="reset" class="reset-btn">🔄 Làm Mới</button>
                </div>
            </form>
        </div>
        
        <div class="map-section">
            <h2>🗺️ Bản Đồ Cửa Hàng</h2>
            <div class="map-container">
                <!-- Google Maps Embed -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841515755836!2d105.78124631542462!3d10.030368592916798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3cf83%3A0x312a8c6f6b2b4e8!2zTmluaCBLacOqdSwgQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1699123456789!5m2!1svi!2s"
                    width="100%" 
                    height="400" 
                    style="border:0; border-radius: 15px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                
                <div class="map-overlay">
                    <div class="store-marker">
                        <div class="marker-icon">🏪</div>
                        <div class="marker-info">
                            <h4>Cửa Hàng Điện Thoại</h4>
                            <p>Purple House, Ninh Kiều</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="directions-info">
                <h3>🚗 Hướng Dẫn Đường Đi</h3>
                <ul>
                    <li><strong>Từ trung tâm Cần Thơ:</strong> Đi theo đường Nguyễn Văn Cừ, rẽ vào khu vực Ninh Kiều</li>
                    <li><strong>Bằng xe bus:</strong> Tuyến số 1, 3, 5 đều đi qua khu vực</li>
                    <li><strong>Bằng xe máy:</strong> Có chỗ đậu xe rộng rãi phía trước cửa hàng</li>
                    <li><strong>Gần các địa điểm:</strong> Chợ Cần Thơ (500m), Bến Ninh Kiều (300m)</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- FAQ Section -->
    <div class="faq-section">
        <h2>❓ Câu Hỏi Thường Gặp</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h3 class="faq-question">🔄 Chính sách đổi trả như thế nào?</h3>
                <div class="faq-answer">
                    <p>Chúng tôi hỗ trợ đổi trả trong vòng 7 ngày kể từ ngày mua với điều kiện sản phẩm còn nguyên seal, không có dấu hiệu sử dụng.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <h3 class="faq-question">🛡️ Bảo hành được bao lâu?</h3>
                <div class="faq-answer">
                    <p>Tất cả sản phẩm đều được bảo hành chính hãng từ 12-24 tháng tùy theo từng dòng máy. Chúng tôi hỗ trợ bảo hành tận nơi trong thành phố Cần Thơ.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <h3 class="faq-question">🚚 Có giao hàng tận nơi không?</h3>
                <div class="faq-answer">
                    <p>Có, chúng tôi giao hàng miễn phí trong bán kính 10km. Với các khu vực xa hơn, chúng tôi có dịch vụ giao hàng qua đối tác vận chuyển.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <h3 class="faq-question">💳 Hỗ trợ những hình thức thanh toán nào?</h3>
                <div class="faq-answer">
                    <p>Chúng tôi nhận thanh toán bằng tiền mặt, chuyển khoản ngân hàng, ví điện tử (MoMo, ZaloPay, VNPay) và các thẻ tín dụng/ghi nợ.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <h3 class="faq-question">📱 Có hỗ trợ trả góp không?</h3>
                <div class="faq-answer">
                    <p>Có, chúng tôi hỗ trợ trả góp 0% lãi suất qua các công ty tài chính Home Credit, FE Credit với thời hạn từ 6-24 tháng.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <h3 class="faq-question">🔧 Có dịch vụ sửa chữa không?</h3>
                <div class="faq-answer">
                    <p>Chúng tôi có dịch vụ sửa chữa, thay thế linh kiện với đội ngũ kỹ thuật viên giàu kinh nghiệm. Báo giá miễn phí trước khi sửa.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Social Media Section -->
    <div class="social-section">
        <h2>📱 Theo Dõi Chúng Tôi</h2>
        <p>Để cập nhật thông tin sản phẩm mới nhất và các chương trình khuyến mãi</p>
        
        <div class="social-links">
            <a href="#" class="social-link facebook">
                <div class="social-icon">📘</div>
                <div class="social-info">
                    <h4>Facebook</h4>
                    <p>facebook.com/phonestore</p>
                </div>
            </a>
            
            <a href="#" class="social-link instagram">
                <div class="social-icon">📷</div>
                <div class="social-info">
                    <h4>Instagram</h4>
                    <p>@phonestore_cantho</p>
                </div>
            </a>
            
            <a href="#" class="social-link youtube">
                <div class="social-icon">🎥</div>
                <div class="social-info">
                    <h4>YouTube</h4>
                    <p>PhoneStore Cần Thơ</p>
                </div>
            </a>
            
            <a href="#" class="social-link zalo">
                <div class="social-icon">💬</div>
                <div class="social-info">
                    <h4>Zalo</h4>
                    <p>0123.456.789</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- JavaScript cho trang liên hệ -->
<script>
jQuery(document).ready(function($) {
    // FAQ Toggle
    $('.faq-question').on('click', function() {
        const faqItem = $(this).parent();
        const faqAnswer = faqItem.find('.faq-answer');
        
        // Toggle current item
        faqItem.toggleClass('active');
        faqAnswer.slideToggle(300);
        
        // Close other items
        $('.faq-item').not(faqItem).removeClass('active');
        $('.faq-answer').not(faqAnswer).slideUp(300);
    });
    
    // Contact Form Submission
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = $('.submit-btn');
        const btnText = $('.btn-text');
        const btnLoader = $('.btn-loader');
        const messagesDiv = $('#contact-messages');
        
        // Show loading
        submitBtn.prop('disabled', true);
        btnText.hide();
        btnLoader.show();
        
        // Get form data
        const formData = {
            action: 'phonestore_contact_form',
            name: $('#contact-name').val(),
            phone: $('#contact-phone').val(),
            email: $('#contact-email').val(),
            subject: $('#contact-subject').val(),
            message: $('#contact-message').val(),
            privacy: $('#contact-privacy').is(':checked'),
            nonce: phonestore_ajax.nonce
        };
        
        // Submit via AJAX
        $.ajax({
            url: phonestore_ajax.ajax_url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    messagesDiv.html(`
                        <div class="success-message">
                            <h4>✅ Gửi tin nhắn thành công!</h4>
                            <p>${response.data.message}</p>
                        </div>
                    `).show();
                    
                    // Reset form
                    $('#contact-form')[0].reset();
                    
                    // Scroll to message
                    $('html, body').animate({
                        scrollTop: messagesDiv.offset().top - 100
                    }, 500);
                    
                } else {
                    messagesDiv.html(`
                        <div class="error-message">
                            <h4>❌ Có lỗi xảy ra!</h4>
                            <p>${response.data.message}</p>
                        </div>
                    `).show();
                }
            },
            error: function() {
                messagesDiv.html(`
                    <div class="error-message">
                        <h4>❌ Lỗi kết nối!</h4>
                        <p>Vui lòng thử lại sau hoặc liên hệ trực tiếp qua số điện thoại.</p>
                    </div>
                `).show();
            },
            complete: function() {
                // Hide loading
                submitBtn.prop('disabled', false);
                btnText.show();
                btnLoader.hide();
            }
        });
    });
    
    // Phone number formatting
    $('#contact-phone').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 3) {
                value = value;
            } else if (value.length <= 6) {
                value = value.slice(0, 3) + '.' + value.slice(3);
            } else if (value.length <= 9) {
                value = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6);
            } else {
                value = value.slice(0, 3) + '.' + value.slice(3, 6) + '.' + value.slice(6, 9);
            }
        }
        $(this).val(value);
    });
    
    // Auto-hide messages after 5 seconds
    setTimeout(function() {
        $('#contact-messages').fadeOut();
    }, 5000);
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
});
</script>

<?php get_footer(); ?>