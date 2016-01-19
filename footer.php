<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options;

 woo_footer_top();
 	woo_footer_before();
?>
	<footer id="footer" class="col-full">

		<?php woo_footer_inside(); ?>
<?php woo_footer_after(); ?>
	</footer>
</div><!-- /#inner-wrapper -->
</div><!-- /#wrapper -->

<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>