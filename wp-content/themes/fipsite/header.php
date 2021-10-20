<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fipsite
 */

// include_once ("inc/navbar.inc.php");
// include_once ("inc/common.inc.php");


?><!doctype html>

<?php 

$myArray = [
    "homepage" => "60086a1b2b3a2f53714b48ab",
    "programmed-areas" => "600ad2b4e500edd44eaf9f0d",
    "events" => "600dafb5f83397001b75a6cc",
	"publications" => "600d76a0d1a244f6e1e74489",
	"programme-drop" => "600afbf9cbdd525d37827e92",
	"equity-collection" => "604f6ec93b61dd9cbf176849",
  "fx-blog" => "600d7d2f7e43ed9e7fd7431f"

];



$template = explode("template-", basename( get_page_template() ) );
$page = explode(".", $template[1] );




?>
<html  data-wf-site="60086a1b2b3a2f8c744b48aa"  <?php language_attributes();?>  style="margin-top: 0px !important;" >

<head >
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
  
	<?php wp_head(); ?>
  <link rel="stylesheet" href="https://use.typekit.net/ltt3uqy.css">

<script>
// $(function(){
//     $('.nav-link').click(function(){
//    	 	var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
//         var href = $(this).attr('href');

//         var desktop = $('.navbar-toggler').hasClass("navbar-expand-lg");
        
//         if (w>=992) 
//         	if (href!='#')window.location=href;
//     });
// });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-BEBNVWRQLQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  //gtag('config', 'G-BEBNVWRQLQ');
</script> -->

<!-- <script src="https://use.typekit.net/oht1uzq.js" type="text/javascript"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->
</head>

<body <?php body_class(); ?> id="<?php echo "body-" . basename(get_permalink()); ?>">

<?php

$menu = 'Main Nav';
$args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false );
$items = wp_get_nav_menu_items( $menu, $args ); 

?>

<div data-collapse="medium" data-animation="default" data-duration="400" data-doc-height="1" role="banner" class="navbar w-nav">
    <div class="nav-container">
      <a href="http://www.fip.org" class="brand w-nav-brand"><img src="<?php echo get_template_directory_uri() ?>/assets/img/FIP-LOGO.svg" loading="lazy" alt="" class="image-8"></a>
      <nav role="navigation" class="nav-menu w-nav-menu">
        <?php foreach($items as $item) : ?>
          <a href="<?php echo $item->url ?>" class="nav-link w-nav-link"><?php echo $item->title ?></a>
        <?php endforeach; ?>
        
       
      </nav>
      <div class="menu-button w-nav-button">
        <div class="icon w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  
 






 
 
<?php // echo _getOffSite(); ?>
<!-- <div id="page-wrapper">
<div id="page" class="site">
	 -->

		

<?php 
// if ( is_front_page() ) {
// 	echo fipsite_homeSlider();
// }
?>
<!-- <div id="content" class="site-content container">

	<div id="content--row" class="row"> -->
	

<?php 


// function fipsite_homeSlider()
// { 
//     $strSiteUrl = site_url();
//     $strThemeUrl = get_template_directory_uri();
//     $strContent = <<< HOME_SLIDER
    
// <header class="banner col-12 bootstrap-breakout  contain-wide" >
// 	<div class="banner-slider contain contain-wide slick-initialized slick-slider" id="sliderHome">
	    
//         <div id="carouselExampleFade" class="carousel slide carousel-fade " data-ride="carousel">
//           <div class="carousel-inner" style="height:100%">
//           <div class="carousel-item active" style="background-image:url({$strThemeUrl}/assets/img/frontpage-banner.jpg);">
//               <img class="d-block w-100"  src="{$strThemeUrl}/assets/img/frontpage-banner.jpg?auto=yes&bg=777&fg=555&text=First slide" alt="First slide">
//             </div>
//           </div>
//         </div>

//             <div class="banner-title has-ribbon">
//                 <span class="pre">FIP EVENTS 2021</span>
//                 <h1>one FIP!</h1>
//             </div>
		    
// 	</div> <!--  banner slider -->
// 	<div class="contain contain-banner-slider">
//     </div>

// </header>

// HOME_SLIDER;
//     return $strContent;
    
// }
	