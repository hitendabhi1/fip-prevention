
<?php

    $title = get_the_title($id);
    $thumbnail = get_the_post_thumbnail_url($id);
    $copy = get_field('copy',$id);

?>



<div class="publication-post-content">
    <?php if($thumbnail): ?>
    <div class="publication-post-image">
        <img src="<?php echo $thumbnail; ?>" />
    </div>
    <?php endif; ?>
    <div class="publication-post-text">
        <?php if($title) : ?>
            <h3 class="post-heading heading-purple"><?php echo $title; ?></h3>
        <?php endif; ?>
        <?php if($copy) : ?>
            <p class="publication-post-copy"><?php echo wp_kses_post($copy); ?></p>
        <?php endif; ?>
    </div>
</div>