<?php
/**
 * Title: Header
 * Slug: mobix-store/header
 * Categories: header
 * Block Types: core/template-part/header
 */
?>

<!-- wp:group {"className":"header-box-upper","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained","contentSize":"90%"}} -->
<div class="wp-block-group header-box-upper" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:columns {"verticalAlignment":"center","className":"header-box-middle","style":{"border":{"radius":"0px"}}} -->
<div class="wp-block-columns are-vertically-aligned-center header-box-middle" style="border-radius:0px"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-logo","style":{"spacing":{"padding":{"left":"0","right":"0","top":"0px","bottom":"0px"}}}} -->
<div class="wp-block-column is-vertically-aligned-center header-logo" style="padding-top:0px;padding-right:0;padding-bottom:0px;padding-left:0;flex-basis:20%"><!-- wp:site-title {"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"18px"},"elements":{"link":{"color":{"text":"var:preset|color|black"}}}},"textColor":"black","fontFamily":"jost"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"80%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:80%"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"border":{"radius":{"topLeft":"0px","bottomLeft":"0px","bottomRight":"15px","topRight":"15px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center" style="border-top-left-radius:0px;border-top-right-radius:15px;border-bottom-left-radius:0px;border-bottom-right-radius:15px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"verticalAlignment":"center","width":"80%","className":"header-menu"} -->
<div class="wp-block-column is-vertically-aligned-center header-menu" style="flex-basis:80%"><!-- wp:navigation {"textColor":"black","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account"]},"style":{"typography":{"fontSize":"17px","fontStyle":"normal","fontWeight":"600"}},"fontFamily":"jost"} -->
<!-- wp:navigation-link {"label":"Home","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"About Us","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Shop","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Pages","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Blog","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- /wp:navigation --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-btn"} -->
<div class="wp-block-column is-vertically-aligned-center header-btn" style="flex-basis:20%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"base","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"border":{"radius":"5px"},"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"14px"},"spacing":{"padding":{"left":"25px","right":"25px","top":"8px","bottom":"8px"}},"color":{"background":"var(--wp--preset--color--primary)"}},"fontFamily":"jost"} -->
<div class="wp-block-button has-custom-font-size has-jost-font-family" style="font-size:14px;font-style:normal;font-weight:500"><a class="wp-block-button__link has-base-color has-text-color has-background has-link-color wp-element-button" style="border-radius:5px;background-color:var(--wp--preset--color--primary);padding-top:8px;padding-right:25px;padding-bottom:8px;padding-left:25px"><?php echo esc_html('Get Started','mobix-store'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"className":"dashed-line"} -->
<p class="dashed-line"></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->