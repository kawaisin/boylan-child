<?php
/**
 * Page Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();
?>
       
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
	<div class="custombg-<?php the_ID(); ?>">
		<div class="customheader-container-<?php the_ID(); ?>">
			<div class="customheaderimg"> 
				<div class="col-full">
					<div class="main-title aligncenter"><h1 class="pagetitle"><?php echo get_post_meta($post->ID, 'main_title', true); ?></h1></div>
					<div class="sub-title aligncenter"><p class="subtitle"><?php echo get_post_meta($post->ID, 'sub_title', true); ?></p></div>
				</div>
			</div>
		</div>
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <section id="main">                     
<?php
	woo_loop_before();
	
	if (have_posts()) { $count = 0;
		while (have_posts()) { the_post(); $count++;
			woo_get_template_part( 'content', 'page' ); // Get the page content template file, contextually.
		}
	}
	
	woo_loop_after();
?>     
            </section><!-- /#main -->
            <?php woo_main_after(); ?>
    
            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar( 'alt' ); ?>

    </div><!-- /#content -->
   </div><!-- /#content -->
  
	<?php woo_content_after(); ?>

<?php get_footer(); ?>