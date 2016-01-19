<?php

/*
Remove Head Meta Stuff
*/

remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'index_rel_link');
remove_action( 'wp_head', 'parent_post_rel_link');
remove_action( 'wp_head', 'start_post_rel_link');
remove_action( 'wp_head', 'adjacent_posts_rel_link');
remove_action( 'wp_head', 'wp_generator', 4);
remove_action( 'wp_head', 'wp_shortlink_wp_head');




add_action( 'woocommerce_before_checkout_form', 'xmas_shipping', 20 );
add_action( 'woocommerce_before_cart_table', 'xmas_shipping', 20 );
function xmas_shipping() {
    echo '<div class="woocommerce-info">Orders after Monday, December 14th are NOT guaranteed delivery before Christmas.</div>';
}


function custom_max_srcset_image_width( $max_width, $size_array ) {
    $width = $size_array[0];
 
    if ( $width > 800 ) {
        $max_width = 2048;
    }
 
    return $max_width;
}
add_filter( 'max_srcset_image_width', 'custom_max_srcset_image_width', 10, 2 );

/**
* Remove Contact Form 7 scripts + styles unless we're on the contact page
*
*/
add_action( 'wp_enqueue_scripts', 'ac_remove_cf7_scripts' );
 
function ac_remove_cf7_scripts() {
	if ( !is_page('contact-form') ) {
		wp_deregister_style( 'contact-form-7' );
		wp_deregister_script( 'contact-form-7' );
		}
}

add_action( 'wp_print_styles', 'cf7_deregister_styles', 100 );

function cf7_deregister_styles() {
	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'center_logo' );
}

/**
* Remove InstagramPlugin scripts + styles unless we're on the contact page
*
*/

add_action( 'wp_enqueue_scripts', 'deregister_instagram_scripts', 100 );
 
function deregister_instagram_scripts() {
	if ( !is_front_page()) {
		wp_deregister_style( 'sb_instagram_styles' );
		wp_deregister_script( 'sb_instagram_scripts' );
		}
}

add_action( 'wp_enqueue_scripts', 'deregister_flipcard_scripts', 100 );
 
function deregister_flipcard_scripts() {
	if ( !is_page(15) ) {
		wp_deregister_style( 'fc-style' );
		wp_deregister_script( 'fc-script' );
		}
}


// Function that will return our WordPress menu
function list_menu($atts, $content = null) {
	extract(shortcode_atts(array(  
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => '', 
		'container_id'    => '', 
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 0,
		'walker'          => '',
		'theme_location'  => ''), 
		$atts));

	return wp_nav_menu( array( 
		'menu'            => $menu, 
		'container'       => $container, 
		'container_class' => $container_class, 
		'container_id'    => $container_id, 
		'menu_class'      => $menu_class, 
		'menu_id'         => $menu_id,
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'depth'           => $depth,
		'walker'          => $walker,
		'theme_location'  => $theme_location));
}
//Create the shortcode
add_shortcode("listmenu", "list_menu");


/*
Add any custom functions to your child theme here
*/

function boylan_custom_scripts() {
	wp_enqueue_script( 'contenthover-js', get_template_directory_uri() .'/js/jquery.contenthover.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'custom-js', get_template_directory_uri() .'/js/custom.js', array('jquery'), '', true );
}

add_action( 'wp_enqueue_scripts', 'boylan_custom_scripts' );

remove_action( 'woo_nav_inside', 'woo_add_nav_cart_link' );
add_filter( 'wp_nav_menu_items', 'woo_move_cart_to_top_nav', 10, 2 );
function woo_move_cart_to_top_nav( $items, $args ) {
global $woocommerce;
if ( $args->menu_id == 'top-nav' ) {
$items .= '<li><a class="cart-contents" href="'.esc_url( $woocommerce->cart->get_cart_url() ).'" title="'.esc_attr_e( ' ', 'woothemes' ).'">'.sprintf( _n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes' ), $woocommerce->cart->cart_contents_count ).' - '.$woocommerce->cart->get_cart_total().'</a></li>';
}
return $items;
}


// Add short product description on the cat level

add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_tempalte_single_excerpt', 5);


// Alter product loop individual products


add_action( 'woocommerce_before_shop_loop_item', 'related_product_defaults_wrap_open' , 20 ); //opener
add_action( 'woocommerce_before_shop_loop_item_title', 'new_product_defaults_wrap_open' , 20 ); //opener
add_action( 'woocommerce_after_shop_loop_item_title', 'new_product_defaults_wrap_close', 40); //closer
 
function related_product_defaults_wrap_open() { echo '';}
function new_product_defaults_wrap_open() { echo '<!--</a>--><div class="product-details contenthover">';}
function new_product_defaults_wrap_close() {echo '</div><!--/.product-details .contenthover -->'; }



//Hide sub-category product count in product archives
// bafunction woocommerce_result_count() {
//	return;
//}

//Hide sub-category product count in product archives

add_filter( 'woocommerce_subcategory_count_html', 'jk_hide_category_count' );
function jk_hide_category_count() {
// No count
}

/** Wooslider for Single Product Main **/

add_filter( 'woocommerce_single_product_image_html', 'wc_product_image_slider' );
function wc_product_image_slider() {
  return do_shortcode( '[wooslider slider_type="attachments"]' );
}


// WooCommerce Extra Feature


remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'my_woocommerce_template_loop_add_to_cart', 10 );

function my_woocommerce_template_loop_add_to_cart() {
    global $product;
    echo '<form action="' . esc_url( $product->get_permalink( $product->id ) ) . '" method="get">
            <button type="submit" class="single_add_to_cart_button button alt">' . __('View Product', 'woocommerce') . '</button>
          </form>';
}


// Add Return to Product Page in the individual cat pages

function woocommerce_back_to_store() {
	echo '<p style="width:100%; text-align:center"><a class="button seeall" href="'. get_permalink() .'/boylan-products/">See All Products</a></p>';
	//echo '<div class="" style="display:block;clear:both"><a title="all products" href="'.$url.'/boylan-products/"><div class="relatedproducts"><span></span></div></a></div>';
}

add_action ('woocommerce_after_main_content', 'woocommerce_back_to_store', 20);



// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
woocommerce_related_products(3,3); // Display 4 products in rows of 2
}

// Edit Instagram Title

add_filter( 'woocommerce_instagram_section_title', 'woocommerce_remove_instagram_columns', 99);
function woocommerce_remove_instagram_columns() {
    echo '<h2 class="title padding10"> Something Here </h2>';
}


// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
		return 3; // 3 products per row
	}
}



// remove woocommerce-tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {
 
unset( $tabs['description'] ); // Remove the description tab
unset( $tabs['reviews'] ); // Remove the reviews tab
unset( $tabs['additional_information'] ); // Remove the additional information tab
 
return $tabs;
 
}

// Custom Excerpt Length
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more){
	global $post;
	return '<a class="moretag" href="'.get_permalink($post->ID).'">...</a>';
	}
add_filter('excerpt_more', 'new_excerpt_more');

// Add "magazine" CSS class to <body> tag on category archive.
add_filter( 'body_class', 'woo_custom_add_magazine_bodyclass', 12 );
function woo_custom_add_magazine_bodyclass ( $classes ) {
	if ( is_category() ) {
		$classes[] = 'magazine';
	}
	return $classes;
} // End woo_custom_add_magazine_bodyclass()

// Add "block" CSS class to each post.
add_filter( 'post_class', 'woo_custom_add_block_postclass', 12 );

function woo_custom_add_block_postclass ( $classes) {
	global $wp_query;
	
	$current_count = $wp_query->current_post + 1;
	
	if ( is_category() ) {
		$classes[] = 'block';
		
		if ( $current_count % 2 == 0 ) {
			$classes[] = 'last';
		} // End IF Statement
	}
	
	return $classes;
} // End woo_custom_add_block_postclass()

// Add the "fix" DIV tag after every second post.
add_action( 'woo_post_after', 'woo_custom_add_magazine_blockfix', 12 );

function woo_custom_add_magazine_blockfix () {
	global $wp_query;
	
	$current_count = $wp_query->current_post + 1;
	
	if ( is_category() && ( $current_count % 2 == 0 ) ) {
?>
<div class="fix"></div><!--/.fix-->
<?php
	} // End IF Statement
} // End woo_custom_add_magazine_blockfix()

// Make sure the "content-magazine-grid.php" file is used instead of the default "content-*.php" file.
add_filter( 'woo_template_parts', 'woo_custom_category_archive_templatepart_magazine', 12 );

function woo_custom_category_archive_templatepart_magazine ( $templates ) {
	if ( is_category() ) {
		$index_to_replace = count( $templates ) - 2;
		
		$templates[$index_to_replace] = 'content-magazine-grid.php'; // Preserve the default Canvas content templating system.
		
		// $templates = array( 'content-magazine-grid.php' ); // Override the content templating system entirely.
	}
	return $templates;
} // End woo_custom_category_archive_templatepart_magazine()


// Custom text for Contact Form 7 dropdown

function my_wpcf7_form_elements($html) {
	function boylan_replace_include_blank($name, $text, &$html) {
		$matches = false;
		preg_match('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $html, $matches);
		if ($matches) {
			$select = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $matches[0]);
			$html = preg_replace('/<select name="' . $name . '"[^>]*>(.*)<\/select>/iU', $select, $html);
		}
	}
	boylan_replace_include_blank('your-state', '-- Select US State --', $html);
	boylan_replace_include_blank('your-canada', '-- Canada Province --', $html);
	return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');



// Change PayPal icon
 
function replacePPicon($iconUrl) {
    return 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_pponly_142x27.png'; // change this to your IMAGE URL
}
  
add_filter('woocommerce_paypal_icon', 'replacePPicon');

    
?>