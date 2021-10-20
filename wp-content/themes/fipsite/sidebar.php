<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foundation
 */

?>

<aside id="secondary" class="widget-area sidebar col-sm-12 col-lg-4">
	<?php 
	get_search_form();
	?>

    <div class="sidebar-header" >Sign-up
         to the newsletter
         <div class="row"><div class=col-12><a href='https://mailchi.mp/fip/digitalevents' target=_blank>Join</a> </div></div>
        
    </div>
    <p>

    <?php
    if (is_front_page()) {
        // code for only front page if needed
    }
    
    $strSubMenus = fipsite_getMenuSibblings("MainMenu-Primary");
    echo $strSubMenus;

	// dynamic_sidebar( 'sidebar-1' ); ?>

	<div class="social clearfix indent">
        <h2>Follow us</h2>
        <a href="https://www.facebook.com/FIPpharmacists" target="_blank" class="btn btn-outline"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
        <a href="https://www.linkedin.com/in/fippharmacists/" target="_blank" class="btn btn-outline"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
        <a href="https://twitter.com/FIP_org" target="_blank" class="btn btn-outline"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://www.flickr.com/photos/fipcongress/" target="_blank" class="btn btn-outline"><i class="fa fa-flickr" aria-hidden="true"></i></a>
    	<a href="https://www.instagram.com/fip_org/?hl=en" target="_blank" class="btn btn-outline"><i class="fa fa-instagram" aria-hidden="true"></i></a>
    </div>


</aside><!-- #secondary -->
