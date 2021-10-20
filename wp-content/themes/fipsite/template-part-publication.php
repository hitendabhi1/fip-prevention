<?php

    $publication_title = get_the_title($id);
    
    $publication_thumbnail = get_the_post_thumbnail_url($id);
    $publication_link = get_field('publication_link',$id);
    $publication_copy = get_field('publication_copy',$id);

?>


<div class="publication-block">
    <?php if ($publication_thumbnail): ?>
    <div class="publication-thumbnail">
        <img src="<?php echo $publication_thumbnail; ?>">
    </div>
    <?php endif; ?>
    <div class="publication_content">
        <?php  if ($publication_title) : ?>
            <h3 class="heading-purple post-heading"><?php echo $publication_title ?></h3>
        <?php endif; ?>
        <?php if ( $publication_copy ): ?>
            <div class="publication-copy"><?php echo wp_kses_post($publication_copy); ?></div>
        <?php endif; ?>
        <?php if ($publication_link) : ?>
            <a href="<?php echo $publication_link['url']; ?>" class="publication_link">Read Publication</a>
        <?php endif; ?>
    </div>
    
</div>