<?php
/*
 * Template Name: Blogs
 * Template Post Type: blogs
 */

$blog_link = get_field('blog_link');
$blog_main_copy = get_field('blog_main_copy');
$author = get_field("author");
$published_date = get_field("published_date");
 get_header();  ?>



<div class="blog-container">
<div class="blog-container-wrapper">
    <div class="image-container"><img src="<?php echo get_the_post_thumbnail_url() ?>"/></div>
<h1><?php the_title()?></h1>
<div class="blog-info">
    <?php if($author): ?>
    <p>Written By: <?php echo $author ?></p>
    <?php endif; ?>
    <?php if($published_date): ?>
    <p><?php echo $published_date ?></p>
    <?php endif; ?>

</div>
<?php if($blog_main_copy): ?>
<?php echo $blog_main_copy ?>
<?php endif; ?>
</div>

</div>




<?php get_footer() ?>
