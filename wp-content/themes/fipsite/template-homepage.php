<?php
/* Template Name: New Home */
/**
 * template-homepage.php
 * The template for displaying the content of the Homepage
 *
 * @package fipsite
 */

get_header();

$hero_group = get_field('home_hero');
$hero_title = $hero_group['title'];
$hero_image = $hero_group['background_image'];


?>

  <div class="about-hero-section" style="background-image: url('<?php echo $hero_image['url'] ?>)">
  <div class="hero-icon-overlay"></div>
  <div class="home-hero-gradient"></div>
  <div class="background-mask-hero" style="background-image:url('<?php echo get_template_directory_uri() ?>/assets/img/hero-mask-b.svg')"></div>
    <div class="home-hero-content">
    <?php if($hero_title) : ?>
     <h1 class="hero-title "><?php echo $hero_title ?></h1> 
    <?php endif; ?>
    </div>
    
  </div>
 
  <?php

  $body_group = get_field('home_body');
  $body_title = $body_group['disease_prevention_title'];
  $body_copy = $body_group['disease_prevention_copy'];
  $body_image = $body_group['image_logo'];
  ?>

      <div class="prevention-section">
      <div class="prevention-section_content">
        <?php if( $body_title ): ?>
          <h3 class="prevention-section_content-title heading-purple"><?php echo $body_title; ?></h3>
        <?php endif; ?>
        <?php if( $body_copy ): ?>
          <div class="prevention-section_content-copy"><?php echo $body_copy; ?></div>
        <?php endif; ?>
      </div>
      <?php if ($body_image) :  ?>
      <div class="prevention-section_image">
        <img class="prevention-section_image-img" src="<?php echo $body_image['url'] ?>"  />
      </div>
      <?php endif; ?>
      </div>
      
      <?php
      $logo_list = get_field('logo_list');
      ?>
      <?php if ($logo_list): ?>
      <div class="home-image-row-block">
        <?php for($i=1; $i <= 6; $i++ ){ 
                $logo = $logo_list["box_{$i}"];?>
        <?php if ($logo): ?>
        <img class="home-image-row-block_logo" src="<?php echo $logo['url'] ?>" />
        <?php endif; ?>
        <?php } ?>
      </div>
      <?php endif ?>
      <?php $development_goal = get_field('development_goal'); ?>
      <?php if($development_goal): ?>
      <div class="development-goals">
            <?php for($i=1; $i<=3; $i++){
              $goal_image = $development_goal["image_{$i}"];
              $goal_title = $development_goal["title_{$i}"];
              $goal_copy  = $development_goal["copy_{$i}"]; ?>
              <div class="goal-block">
              <?php if ($goal_image): ?>
              <img class="goal-image" src="<?php echo $goal_image['url'];?>" />  
              <?php endif; ?>
              <?php if($goal_title): ?>
              <h3 class="goal-title heading-purple"><?php echo $goal_title; ?></h3>
              <?php endif; ?>
              <?php if($goal_copy):?>
              <div class="goal-copy">
                <?php echo wp_kses_post($goal_copy); ?>
              </div>
              <?php endif; ?>
              </div>
              <?php } ?>
      </div>
      <?php endif; ?>
      <script>let previousTab = 1;</script>
      <div class="tab-section">
        <div class="tab-section-block tab-button-block">
          <?php  for($i=1; $i<=3; $i++){ 
                  $tab_button = get_field("tab_{$i}_title");
                  ?>
                  <?php if ($tab_button) : ?>
                    <button class="tab-button" onclick="changeTab(<?php echo $i ?>,true)" onmouseover="changeTab(<?php echo $i ?>)" onmouseleave="changeTab(previousTab)"><?php echo $tab_button ?></button>
                  <?php endif; ?>
            
          <?php } ?>
        </div>
        <div class="tab-section-block mobile-image-block">
         <img class="mobile-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/Group-222.png"/>
        </div>
        <div class="tab-section-block tab-image-block">
         <img class="background-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/Group-228.png"/>
         <img class="tab-image-icon active-tab-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/Group-219.png"/>
         <img class="tab-image-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/Group-221.png"/>
         <img class="tab-image-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/Group-223.png"/>
        </div>
        <div class="tab-section-block tab-main-content">
        <?php  for($i=1; $i<=3; $i++){ 
                  $tab_content = get_field("tab_{$i}_copy");
                  $tab_button = get_field("tab_{$i}_title");
                  $tab_link = get_field("tab_{$i}_link");

                  ?>
                  <?php if ( $tab_content ) : ?>
                    <div class="tab-content tab-not-active">
                    <?php if ($tab_button): ?>
                      <h3 class="tab-title heading-purple"><?php echo $tab_button ?></h3>
                    <?php endif; ?>
                    <?php echo wp_kses_post($tab_content); ?>

                    <?php if ($tab_link) : ?>
                      
                      <a class="link-blue" href="<?php echo $tab_link['url'] ?>" >More Info</a>
                    <?php endif; ?>
                  
                  </div>
                  <?php endif; ?>
            
          <?php } ?>
        </div>
      </div>

      <script>
        function setTabContent(){
          let tab_content = document.querySelectorAll('.tab-content');
          let button_tab = document.querySelectorAll('.tab-button');
          
          tab_content[0].classList.add('tab-is-active');
          button_tab[0].classList.add('button-tab-is-active');
        }
        setTabContent();

        function changeTab(element,event){
          let currentElement = element - 1;
          let tabContent = document.querySelector('.tab-main-content');
          let tabs = document.querySelectorAll('.tab-content');
          let buttonTab = document.querySelector('.tab-button-block');

          let tabImageBlock = document.querySelector('.tab-image-block');

          
         
          for (const icon of tabImageBlock.children) {
            if (icon.classList.contains('tab-image-icon')){
                if(icon.classList.contains('active-tab-icon')){
                  icon.classList.remove('active-tab-icon')
                }
            }
          }
          for (const button of buttonTab.children) {
            if (button.classList.contains('button-tab-is-active')){
              button.classList.remove('button-tab-is-active');
            }
          }
          for (const child of tabContent.children) {
            child.classList.add('tab-not-active');
            if (child.classList.contains('tab-is-active')){
              child.classList.remove('tab-is-active');
            }
          }


          if(event){
            previousTab = element;
          }
          

          
          tabImageBlock.children[currentElement+1].classList.add('active-tab-icon');
          buttonTab.children[currentElement].classList.add('button-tab-is-active');
          tabContent.children[currentElement].classList.remove('tab-not-active');
          tabContent.children[currentElement].classList.add('tab-is-active');

        }

      </script>
  
  <div style="display:none;" id="template-id"><?php echo get_page_template() ?></div>

  <?php get_footer(); ?>