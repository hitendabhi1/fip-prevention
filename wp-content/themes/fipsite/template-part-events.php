
<?php 
    $title = get_the_title($id);
    $event_date = get_field( 'event_date', $id );
    $event_copy = get_field( 'event_copy', $id );
    $event_link = get_field( 'event_link', $id );
    $thumbnail  = get_the_post_thumbnail_url($id);

?>  


<div class="event-vector-block">

    <div class="event-heading-block">

        <?php if( $title ): ?>
        <div class="event-title-new post-heading">
            <h3 ><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <?php if($thumbnail) : ?>
        <div class="event-banner-image">
            <img src="<?php echo $thumbnail; ?>"  />
        </div>
        <?php endif; ?>
    </div>

    <div class="event-block-copy">
        <?php if ($event_date) : ?>
        
            <p class="event-date heading-purple"><?php echo $event_date; ?></p>
        
        <?php endif; ?>
        <?php if ($event_copy) : ?>
        <div class="event-text">
        <?php echo wp_kses_post($event_copy); ?>
        </div>
        <?php endif; ?>
        <?php if ( $event_link ) : ?>
            <a href="<?php echo $event_link['url'] ?>" class="event-link heading-purple">
            <?php echo $event_link['title'] ?>
            </a>
        <?php else : ?>
            <p>Coming Soon</p>
        <?php endif; ?>
    </div>


    
</div>