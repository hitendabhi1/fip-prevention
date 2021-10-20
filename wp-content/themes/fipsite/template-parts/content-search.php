<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fipsite
 */
$postID = get_the_ID();
$post = get_post($postID);
?>

<article id="post-<?php echo $postID; ?>" <?php post_class('search-results-item'); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" 
			rel="bookmark" class="search-results-link"><?php echo $post->post_title; ?></a></h2>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">***
			<?php
			//fipsite_posted_on();
			//fipsite_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php fipsite_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php echo fipsite_get_excerpt($post->post_content); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php fipsite_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
