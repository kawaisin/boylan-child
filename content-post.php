<?php
/**
 * Post Content Template
 *
 * This template is the default page content template. It is used to display the content of the
 * `single.php` template file, contextually, as well as in archive lists or search results.
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

$settings = array(
				'thumb_w' => 100,
				'thumb_h' => 100,
				'thumb_align' => 'alignleft',
				'post_content' => 'excerpt',
				'comments' => 'both'
				);

$settings = woo_get_dynamic_values( $settings );

$title_before = '<h1 class="blog-entry-title" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
$title_after = '</h1>';

if ( ! is_single() ) {
$title_before = '<h2 class="title entry-title">';
$title_after = '</h2>';
$title_before = $title_before . '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" rel="bookmark" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
$title_after = '</a>' . $title_after;
}

$page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );

woo_post_before();
?>
<article <?php post_class(); ?>>
<!-- < ?php woo_post_meta(); ?> -->
<div class="fix"></div>
<header class="posttitle aligncenter">
	<?php the_title( $title_before, $title_after ); ?>
	</header>

<?php
woo_post_inside_before();
if ( 'content' != $settings['post_content'] && ! is_singular() )
	woo_image( 'width=' . esc_attr( $settings['thumb_w'] ) . '&height=' . esc_attr( $settings['thumb_h'] ) . '&class=thumbnail ' . esc_attr( $settings['thumb_align'] ) );
?>

	

	<section class="entry postsingle aligncenter">
		<?php if (is_home()){ ?>
			<div class="blogexcerpt">			
			<?php } ?>


<?php
if ( 'content' == $settings['post_content'] || is_single() ) { the_content( __( 'Continue Reading >', 'woothemes' ) ); } else { the_excerpt(); }
if ( 'content' == $settings['post_content'] || is_singular() ) wp_link_pages( $page_link_args );
?>
<?php if (is_home()){ ?>
			</div>			
			<?php } ?>
	</section><!-- /.entry -->
	<div class="fix"></div>
	
<?php
woo_post_inside_after();
?>
<hr>
</article><!-- /.post -->
<?php
woo_post_after();
$comm = $settings['comments'];
if ( ( 'post' == $comm || 'both' == $comm ) && is_single() ) { comments_template(); }
?>