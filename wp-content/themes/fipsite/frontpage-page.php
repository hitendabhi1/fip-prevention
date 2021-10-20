<?php
/* Template Name: Homepage */
/**
 * front-page.php
 * The template for displaying the content of the Homepage
 *
 * @package fipsite
 */

get_header();

?>
<div id="primary" class="content-area col-sm-12 col-md-12 col-lg-8">
		
		<main id="main" class="site-main">

		<div class="indent">
		<?php
		while ( have_posts() ) :
		  the_post();
		  get_template_part( 'template-parts/content', 'page' );
		/* If comments are open or we have at least one comment, load up the comment template.
		  if ( comments_open() || get_comments_number() ) :
		      comments_template();
		  endif;
		*/
		endwhile; // End of the loop.
		?>
		</div><!--  indent -->

	</main><!-- #main -->
</div><!-- #primary -->

	
<?php get_sidebar(); ?>
<?php get_footer();
