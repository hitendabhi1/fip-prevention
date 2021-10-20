<?php
/**
 * The template for displaying search forms in _tk
 *
 * @package _tk
 */
/**
 * @param mixed $menu
 * @param int   $post_id
 *
 * @return WP_Post|bool
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<input type="hidden" value="12" name="posts_per_page">
	<label class="search-label" id="search-label<?php echo '';  ?>">
		<input type="search" 
				class="search-field" 
				placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', '_tk' ); ?>" 
				value="<?php echo esc_attr( get_search_query() ); ?>" 
				name="s" 
				title="<?php _ex( 'Search for:', 'label', '_tk' ); ?>">
	</label>

	<button class="btn btn-primary search-submit" type="submit" id="seach-submit-button<?php  ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>

<?php ?>
