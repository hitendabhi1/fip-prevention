<div class="vector-tab">
        <?php for($i=1; $i <=4; $i++){ 
            $vector_tab_title   = get_field("vector_tab_{$i}_title");
            $vector_tab_copy    = get_field("vector_tab_{$i}_copy");
            $post_id            = get_field("post_content_tab_{$i}"); ?>
            <div class="vector-tab-content <?php if ($i === 1) : echo 'vector-tab-active'; else:  echo "vector-tab-not-active"; endif; ?>">
                <?php if($vector_tab_title) : ?>
                    <h2 class="heading-purple"><?php echo $vector_tab_title; ?></h2>
                <?php endif; ?>
                <?php if($vector_tab_copy): ?>
                    <div class="vector-tab-copy <?php if ($i == 4) : echo 'extended-container'; endif; ?>">
                        <?php echo $vector_tab_copy; ?>
                    </div>
                <?php endif; ?>
                <?php if($post_id ) : ?>
                <div class="post-content-container">
                        <?php foreach($post_id as $id) : ?>
                                <?php 
                                if ($i == 1){ 
                                        get_template_part('template-part','publication', $id);
                                }
                                if ($i == 2){ 
                                        get_template_part('template-part','events', $id);
                                }
                                if ($i == 3){ 
                                        get_template_part('template-part','partnerships', $id);
                                }
                                
                                
                                ?>
                        <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        <?php } ?>
    </div>