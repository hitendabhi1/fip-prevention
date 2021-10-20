<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package fipsite
 */

/**
 * Load custom functions.
 */
// require get_template_directory() . '/inc/menus.inc.php';
// require get_template_directory() . '/inc/submenus.inc.php';

// /**
//  * Adds custom classes to the array of body classes.
//  *
//  * @param array $classes Classes for the body element.
//  * @return array
//  */
function fipsite_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'fipsite_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function fipsite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'fipsite_pingback_header' );



/* remove unnessesary actions */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

/* add bootstrap */
function fipsite_enqueue_version($path)
{
    
    return filemtime( $path );
}

function fipsite_bootstrap_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/inc/fw_assets/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
    $version = fipsite_enqueue_version(get_stylesheet_directory() . '/style.css');
    wp_enqueue_style( 'bootstrapstarter-style', get_stylesheet_uri(), $dependencies , $version);
    $version = fipsite_enqueue_version(get_stylesheet_directory() . '/extra.css');
    wp_enqueue_style( 'extra_style', get_template_directory_uri() . '/extra.css' , array(), $version);
    
}



function fipsite_bootstrap_enqueue_scripts() {
    wp_enqueue_script('jquery-331', get_template_directory_uri().'/inc/fw_assets/jquery/jquery-3.3.1.slim.min.js', array(), '', false );
    $dependencies = array('jquery-331');
    wp_enqueue_script('popper', get_template_directory_uri().'/inc/fw_assets/jquery/popper.min.js', $dependencies, '', false );
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/inc/fw_assets/bootstrap/js/bootstrap.min.js', $dependencies, '', false );
}

// add_action( 'wp_enqueue_scripts', 'fipsite_bootstrap_enqueue_styles' );
// add_action( 'wp_enqueue_scripts', 'fipsite_bootstrap_enqueue_scripts' );


// Custom webflow styles
function fipsite_custom_enque_styles(){
    wp_enqueue_style( 'custom_style_3', get_template_directory_uri() . '/inc/fw_assets/css/normalize.css');
    wp_enqueue_style( 'custom_style_2', get_template_directory_uri() . '/inc/fw_assets/css/webflow.css');
    wp_enqueue_style( 'custom_style_1', get_template_directory_uri() . '/inc/fw_assets/css/fip-equity-rx.css');
    wp_enqueue_style( 'custom_style_4', get_template_directory_uri() . '/inc/fw_assets/css/dev-css.css');
}
add_action( 'wp_enqueue_scripts', 'fipsite_custom_enque_styles' );

function fipsite_custom_enque_scripts(){
    wp_enqueue_script('webflow', get_template_directory_uri().'/js/webflow.js');
}
// add_action( 'wp_enqueue_scripts', 'fipsite_custom_enque_scripts' );
/* own login logo */
add_action( 'login_enqueue_scripts', 'fipsite_login_logo_one' );
function fipsite_login_logo_one() {
    ?>
    <style type="text/css"> 
    body.login div#login h1 a {
        background-image: url(<?php  echo get_template_directory_uri(); ?>/inc/fw_assets/images/site-logo.png); /*  own logo image in this url */
        padding-bottom: 0px; 
    }
    </style>
	<?php 
} 



// default email
add_filter( 'wp_mail_from', 'fipwebsite_mail_from' );
function fipwebsite_mail_from( $original_email_address ) {
    return 'fip@fip.org';
}

//remove comments from pages
add_action('init', 'fipsite_remove_comment_support', 100);
add_filter('comments_array', 'fipsite_existing_comments', 10, 2 );

function fipsite_remove_comment_support() {
    remove_post_type_support( 'page', 'comments' );
}

function fipsite_existing_comments( $comments ) {
    $comments = array();
    return $comments;
}


/* no rest outside admin */
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
});

 
/* don't expose, cleanup  header */
remove_action( 'wp_head', 'rest_output_link_wp_head'              );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links'         );
remove_action( 'wp_head', 'feed_links', 2                         );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );


// Custom post types 
/*
* Creating a function to create our custom 
*/
 
function custom_post_type() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Events', 'Post Type General Name', 'twentytwenty' ),
            'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'twentytwenty' ),
            'menu_name'           => __( 'Events', 'twentytwenty' ),
            'parent_item_colon'   => __( 'Parent Event', 'twentytwenty' ),
            'all_items'           => __( 'All Event', 'twentytwenty' ),
            'view_item'           => __( 'View Event', 'twentytwenty' ),
            'add_new_item'        => __( 'Add New Event', 'twentytwenty' ),
            'add_new'             => __( 'Add New', 'twentytwenty' ),
            'edit_item'           => __( 'Edit Event', 'twentytwenty' ),
            'update_item'         => __( 'Update Event', 'twentytwenty' ),
            'search_items'        => __( 'Search Event', 'twentytwenty' ),
            'not_found'           => __( 'Not Found', 'twentytwenty' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'events', 'twentytwenty' ),
            'description'         => __( 'Event Description', 'twentytwenty' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'events' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );
         
        // Registering your Custom Post Type
        register_post_type( 'events', $args );

        $labels = array(
            'name'                => _x( 'Publications', 'Post Type General Name' ),
            'singular_name'       => _x( 'Publication', 'Post Type Singular Name' ),
            'menu_name'           => __( 'Publications' ),
            'parent_item_colon'   => __( 'Parent Publication' ),
            'all_items'           => __( 'All Publication' ),
            'view_item'           => __( 'View Publication' ),
            'add_new_item'        => __( 'Add New Publication' ),
            'add_new'             => __( 'Add New' ),
            'edit_item'           => __( 'Edit Publication' ),
            'update_item'         => __( 'Update Publication' ),
            'search_items'        => __( 'Search Publication' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'publications', 'twentytwenty' ),
            'description'         => __( 'publications Description', 'twentytwenty' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'publications' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );

     register_post_type( 'publications', $args );

        $labels = array(
            'name'                => _x( 'Partnerships', 'Post Type General Name' ),
            'singular_name'       => _x( 'Partership', 'Post Type Singular Name' ),
            'menu_name'           => __( 'Partnerships' ),
            'parent_item_colon'   => __( 'Parent Partership' ),
            'all_items'           => __( 'All Partership' ),
            'view_item'           => __( 'View Partership' ),
            'add_new_item'        => __( 'Add New Partership' ),
            'add_new'             => __( 'Add New' ),
            'edit_item'           => __( 'Edit Partership' ),
            'update_item'         => __( 'Update Partership' ),
            'search_items'        => __( 'Search Partership' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'Partnerships' ),
            'description'         => __( 'Partnerships Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'partnerships' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );

     register_post_type( 'blogs', $args );
    }
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'custom_post_type', 0 );





/**
 * Disable Yoast's Hidden love letter about using the WordPress SEO plugin.
 */
add_action( 'template_redirect', function () {
    
    if ( ! class_exists( 'WPSEO_Frontend' ) ) {
        return;
    }
    
    $instance = WPSEO_Frontend::get_instance();
    
    // make sure, future version of the plugin does not break our site.
    if ( ! method_exists( $instance, 'debug_mark') ) {
        return ;
    }
    
    // ok, let us remove the love letter.
    remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
}, 9999 );

