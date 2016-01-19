<?php
/**
 * Default Content Template
 *
 * This template is the default content template. It is used to display the content of a
 * template file, when no more specific content-*.php file is available.
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
 $title_before = '<h1 class="title entry-title">';
 $title_after = '</h1>';

 $page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );

 woo_post_before();
?>
<article <?php post_class(); ?>>
			<?php
				woo_post_inside_before();
			?>
			<section class="entry">
	  			  <?php
	    			the_content();
	    			if ( $woo_options['woo_post_content'] == 'content' || is_singular() ) wp_link_pages( $page_link_args );
	   			 ?>
			
<?php
	woo_post_after();
/*
	$comm = $woo_options[ 'woo_comments' ];
	if ( ( $comm == 'page' || $comm == 'both' ) && is_page() ) { comments_template(); }
*/
?>

<?php if (is_front_page()) : ?>

</section><!-- /.entry -->
			</article><!-- /.post -->
		</div><!-- /.main-sidebar-container -->
    </div><!-- /.inner-wrapper -->
</div><!-- /.wrapper -->

<div id="homepost"><!-- /.blogpost wrapper -->	
	<div class="col-full"><!-- /.blogpost wrapper -->
	 <div class="clearfix"></div>
	<h2 class="aligncenter home_blogtitle">More from Boylan</h2>
	<h2 class="home_blogsubtitle aligncenter">things we're doing &amp; things we like.</h2> 
	 <div class="clearfix"></div>
	 
	 

<?php echo do_shortcode("[instagram-feed]") ?>
	

    <?php endif ?>
	</div>
	
    
<?php
	woo_post_inside_after();
?>
