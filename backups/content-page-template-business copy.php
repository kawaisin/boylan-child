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
	<h2 class="aligncenter home_blogtitle">- More from Boylan -</h2>
	<!-- <h2 class="home_blogsubtitle aligncenter">Things we're doing and things we like.</h2> -->
	 <div class="clearfix"></div>
    <?php 
    $pc = new WP_Query('orderby=desc&posts_per_page=3'); 
    while ($pc->have_posts()):
    	$pc->the_post();
    ?>
    <div class="threecol-one<?php echo$pc->current_post + 1 === $pc->post_count ? ' last' : '' ?>">
    
    <?php the_post_thumbnail('medium', array('class' => 'homepagepost aligncenter swapimg')); ?>
    
    			<div class="aligncenter">
    			<!-- <p class="postdate"><?php //the_date('m/d/y') ?></p> -->
    			<h3 class="home_post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>	
    			<?php the_excerpt(); ?>
    			</div>
    </div>
      <?php endwhile;?>
    <?php endif ?>
	</div>
<?php
	woo_post_inside_after();
?>
