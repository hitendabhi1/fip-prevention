<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package foundation
 */
get_header();

$post_title = get_the_title();
$strParentTitle = "Search";
$strTitle = "Search Results";
?>

<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-8">
	<main id="main" class="site-main">
		<?php
            echo fipsite_pageHeader(null, $strTitle, $strParentTitle);
            // Start the Loop
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    if (empty(get_the_content())) continue; // filter empty pages from results
                    //
                    // Run the loop for the search to output the results.
                    // If you want to overload this in a child theme then include a file
                    // called content-search.php and that will be used instead.
                    //
                    get_template_part('template-parts/content', 'search');
                }
                the_posts_navigation();
            } else {
                
                get_template_part('template-parts/content', 'none');
            }
        ?>

		</main>
	<!-- #main -->
</section>
<!-- #primary -->

<?php
get_sidebar();
get_footer();


