<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package foundation
 */

get_header();
?>

<div class="utility-page-wrap">
    <div class="utility-page-content w-form"><img src="<?php echo get_template_directory_uri() ?>/assets/img/Metadataimage.svg" alt="">
      <h2>Page Not Found</h2>
      <div>The page you are looking for doesn&#x27;t exist or has been moved.</div>
    </div>
  </div>

<?php
get_footer();
