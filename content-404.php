<?php
/**
 * Error Content Template
 *
 * This template is the content template for error screens. It is used to display a message
 * to the viewer when no appropriate page can be found by WordPress.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */

 global $woo_options;

 $title_before = '<h1 class="title entry-title featured aligncenter">';
 $title_after = '</h1>';

 $page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );

 woo_post_before();
?>
<article <?php post_class(); ?>>
<?php woo_post_inside_before();	?>

	

	<section class="entry aligncenter">
	    <?php
	    	//echo apply_filters( 'woo_404_content', __( 'The page you are trying to reach does not exist, or has been moved.', 'woothemes' ) );
	    	if (  ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) || is_singular() ) wp_link_pages( $page_link_args );
	    ?>
	    <img class="aligncenter paddingtop" src="<?php echo site_url('wp-content/uploads'); ?>/2014/09/page-not-found.png" title="Page Not Found" alt="page not found" />
	    
	</section><!-- /.entry -->
<?php
	woo_post_inside_after();
?>
</article><!-- /.post -->
<?php
	woo_post_after();
?>