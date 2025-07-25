== VNPAY Payment gateway ==
Contributors: tamdt@vnpay
Donate link: 
Tags: WooCommerce, Shopping Cart, Extension, Gateway, VNPAY, Payment Gateway
Requires at least: 3.0.1
Tested up to: 4.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This payment module extends WooCommerce and allows you to accept payments via VNPAY.

== Description ==

Shopping cart software modules for online stores offer a quick and easy integration process as well as smooth shopping experience for your customers. this payment module extends WooCommerce and allows you to accept payments via VNPAY.


== Installation ==
1.Ensure you have latest version of WooCommerce plugin installed
2.Download the plugin zip file
3.Upload the files to the /wp-content/plugins
4.Activate the plugin through the “Plugins” menu in WordPress
5.Click Module WooCommerce=> Click Settings => Click Checkout => VNPAY
Configure your VNPAY Commerce Gateway settings

* Configuration information on Test system:
- Tieu de: Thanh toan truc tuyen qua VNPAY
- Mo ta: ATM/TK-BANK noi dia hoac VISA/JCB/MASTER
- Url khoi tao GD: http://sandbox.vnpayment.vn/paymentv2/vpcpay.html
- Terminal ID: QDN88HPB
- Secret Key: VXNZSZZOHIMJOXIVAPXYAVDHENEFUOFL

*note: 
IPN URL: http://domain-my-website/wp-admin/admin-ajax.php?action=payment_response_vnpay&type=international
(You need to send "ipn url" to VNPAY to complete the payment status update of the order)