<?php
/* Template Name: Vaccination */
/**
 * template-vax.php
 * The template for displaying the content of the vector
 *
 * @package fipsite
 */

get_header();


$vaccination_hero = get_field( 'vaccination_hero' );

$vaccination_hero_title = $vaccination_hero['vax_hero_title'];
$vaccination_hero_copy = $vaccination_hero['vax_hero_copy'];
$vaccination_hero_image = $vaccination_hero['vax_hero_image'];

$vax_image_banner_1 = get_field('vax_image_banner_1');
$vax_image_banner_2 = get_field('vax_image_banner_2');
$vax_image_banner_3 = get_field('vax_image_banner_3');

?>


<?php if($vaccination_hero) : ?>
<div class="vector-hero">
    <div class="vector-hero-content">
        <?php if($vaccination_hero_title) : ?>
            <h1 class="vector-hero-content-title heading-purple"><?php echo $vaccination_hero_title; ?></h1>
        <?php endif; ?>
        <div class="vector-link-container">
        <?php for($i=1; $i <=4; $i++){
            $vector_tab_button = get_field("vector_tab_{$i}_title");
            if ($vector_tab_button) :
            ?>
            <a href="#1" class="vector-hero-link" onclick="selectTab(<?php echo $i ?>)"><?php echo $vector_tab_button; ?></a>
            <?php endif; ?>
       <?php } ?>

        </div>
        
        <?php if($vaccination_hero_copy) :  ?>
            <div class="vector-hero-copy">
                <?php echo wp_kses_post($vaccination_hero_copy); ?>
            </div>
        <?php endif; ?>

    </div>
    <?php if( $vaccination_hero_image ) : ?>
    <div class="vector-hero-image">
        <img src="<?php echo $vaccination_hero_image['url']  ?>" />
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>


<?php if ($vax_image_banner_1) : ?>
    <div class="vax-image-banner">
        <img src="<?php echo $vax_image_banner_1['url']; ?>"  />
    </div>
<?php endif; ?>
<?php if ($vax_image_banner_2) : ?>
    <div class="vax-image-banner">
        <img src="<?php echo $vax_image_banner_2['url']; ?>"  />
    </div>
<?php endif; ?>
<?php if ($vax_image_banner_3) : ?>
    <div class="vax-image-banner">
    <img src="<?php echo $vax_image_banner_3['url']; ?>"  />
    </div>
<?php endif; ?>

<div class="vaccination-container">
<div id="1" class="vector-tab-section">
    <div class="vector-tab-container">
        <?php for($i=1; $i <=4; $i++){
            $vector_tab_button = get_field("vector_tab_{$i}_title");
            if ($vector_tab_button) :
            ?>
            <button class="vector-tab-button tab-button <?php if ($i === 1) : echo 'vector-tab-link-active'; endif ?>  " onclick="selectTab(<?php echo $i ?>)"><?php echo $vector_tab_button; ?></button>
            <?php endif; ?>
       <?php } ?>
    </div>
    <?php get_template_part('template-part','vector-tab'); ?>
</div>
</div>

<script>
        function setTabContent(){
          let tab_content = document.querySelectorAll('.vector-tab-content');

        }
        setTabContent();

        function selectTab(element){
            let vectorTab = document.querySelector('.vector-tab');
            let vectorTabContainer = document.querySelector('.vector-tab-container');
            

            for (const childContainer of vectorTabContainer.children) {

                if (childContainer.classList.contains('vector-tab-link-active')){
                    childContainer.classList.remove('vector-tab-link-active');
                }
            }
            for (const child of vectorTab.children) {
                child.classList.add('vector-tab-not-active');
                if (child.classList.contains('vector-tab-active')){
                child.classList.remove('vector-tab-active');
                }
            }

            vectorTabContainer.children[element-1].classList.add('vector-tab-link-active');
            vectorTab.children[element-1].classList.remove('vector-tab-not-active');
            vectorTab.children[element-1].classList.add('vector-tab-active');

        }
        

      </script>
<?php get_footer(); ?>