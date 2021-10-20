<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fipsite
 */

?>
<?php 


$footer = 'mainmenu_primary';
$footer_args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false );
$menuLocations = get_nav_menu_locations();

$footer_items = wp_get_nav_menu_items($menuLocations['footer-left']); 

?>


<div class="footer">
    <div class="footer-container">
      <div class="footer-wrapper">
        
        <a href="https://www.fip.org/" target="_blank" class="fotter-logo-link-block w-inline-block"><img src="<?php echo get_template_directory_uri() ?>/assets/img/FIP-LOGO.svg" loading="lazy" alt="" class="image-10"></a>
        <div class="footer-top-section">
          <div class="footer-line-top"></div>
          <div class="footer-link-wrapper">
            <?php foreach($footer_items as $item){?>  
            <a href="<?php echo $item->url ?>" class="footer-link"><?php echo $item->title ?></a>
            
            <?php } ?>
           
          </div>
          <div class="footer-line"></div>
          <div class="footer-bottom-section">
            <div class="footer-link">© Copyright International Pharmaceutical Federation 2021</div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=60086a1b2b3a2f8c744b48aa" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  
<script src="<?php echo get_template_directory_uri().'/js/webflow.js' ?>" type="text/javascript"></script>



<!-- <section class="footerlinks">
    <div class="container">
    <div class="row">
        <div class="column col-12 col-md-6 col-lg-8">
            <div class="row normal">
                <div class="column col-12 col-lg-6">
                    <h3>Highlights</h3>

<?php 
wp_nav_menu(array(
    'menu' => 'footer-left',
    'theme_location' => '__no_such_location'

));

?>
                </div>
                <div class="column col-12 col-lg-6">
                    <h3>Shortcuts</h3>
<?php
wp_nav_menu(array(
    'menu' => 'footer-right',
    'theme_location' => '__no_such_location'

));
?>
					
                </div>
            </div>
        </div>
        <div class="column col-12 col-md-6 col-lg-4  mt-5 mt-md-0">
            <figure>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/fw_assets/images/footer-fip-building.jpg" alt="">
                <figcaption class="blue has-ribbon top center">
                    <span class="title">Our contact details</span>
                    <span class="text">
                    <span class="text--bold">FIP - Events </span><br/>
                        Andries Bickerweg 5<br>
                        2517 JP The Hague<br>
                        Netherlands<br><br>
       

                            <a href="mailto:webinars@fip.org" style="overflow-wrap: break-word;">webinars@fip.org</a>
                        </span>
                </figcaption>
            </figure>
        </div>
    </div>
</div>
</section>	 -->

<!-- <footer class="footer">
    <div class="container contain--relative  footer-container">
    	<div class="row">
    	<div class="col-12 col-md-6">
        <a href="https://www.fip.org" target="_blank" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/fw_assets/images/logo-fip.svg" title="fip" alt="fip"></a>
        <span class="copy">© Copyright International Pharmaceutical Federation <?php echo date("Y");?></span>
        </div>
        <div class="col-12 col-md-6 footer-right">
        <ul class="float-right">

			<li><a href="https://www.fip.org/files/fip/Privacy-Statement.pdf" target="_blank">Privacy statement</a></li>
			<li><a href="<?php echo site_url(); ?>/disclaimer">Disclaimer</a></li>
            <li><a id="btnToTop" href="#">Scroll to top</a></li>
        </ul>
        </div>
        </div>
    </div>
</footer> -->
	
<?php  get_template_part( 'footer-widget' ); ?>

	
</div><!-- #page -->
</div> <!-- #page-wrapper  -->

<!--  *F* -->
<?php wp_footer(); ?>
<!--  *F* -->

</body>
</html>
