<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// allows a custom search form template 
add_theme_support( 'html5', array( 'search-form' ) );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Unhooking and conditionally re-hooking the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
add_action( 'genesis_site_description', 'maybe_site_description' );
/**
 * Display site description on home or front page.
 */
function maybe_site_description() {

	if ( is_home() && is_front_page() ) {
		genesis_seo_site_description();
	}

}

// genesis breadcrumbs - remove the 'you are here' prefix

function b3m_prefix_breadcrumb( $args ) {
	$args['labels']['prefix'] = '';
	$args['sep'] = ' - ';
	return $args;
}
add_filter( 'genesis_breadcrumb_args', 'b3m_prefix_breadcrumb' );


// enqueu MCcoder's js

function mc_enqueue_mccode() {
  // tether is required for bootstrap 4
  wp_enqueue_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js', array('jquery'), true);
     // jQuery is stated as a dependancy of bootstrap-js - it will be loaded by WordPress before the BS scripts  
    wp_enqueue_script( 'mccoder-js', get_stylesheet_directory_uri() . '/assets/js/mccoder.js'); // all the bootstrap javascript goodness
    wp_enqueue_script( 'library-hours', get_stylesheet_directory_uri() . '/assets/js/library-hours.js');
    wp_enqueue_script( 'sticky-js', get_stylesheet_directory_uri() . '/assets/js/sticky-kit.js');
        wp_enqueue_script( 'mobile-menu', get_stylesheet_directory_uri() . '/assets/js/mobilemenu-script.js');
    wp_enqueue_script( 'google-trans', 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit');
    wp_enqueue_script( 'userway', 'https://cdn.userway.org/widget.js');
     wp_enqueue_script( 'ekko-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js');   

}
add_action('wp_enqueue_scripts', 'mc_enqueue_mccode');

function mc_enqueue_my_scripts() {
    // jQuery is stated as a dependancy of bootstrap-js - it will be loaded by WordPress before the BS scripts 
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array('jquery'), true); // all the bootstrap javascript goodness

}
add_action('wp_enqueue_scripts', 'mc_enqueue_my_scripts');


function mc_enqueue_my_styles() {

    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' );
    
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/font-awesome/css/font-awesome.min.css' );  

    wp_enqueue_style( 'google-material', 'https://fonts.googleapis.com/icon?family=Material+Icons' );   

    wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/custom.css' );    
    wp_enqueue_style( 'mobile-menucss', get_stylesheet_directory_uri() . '/assets/css/mobilemenu-styles.css' );      

    wp_enqueue_style( 'animate-css', get_stylesheet_directory_uri() . '/assets/css/animate.css' );       
    wp_enqueue_style( 'ekkolightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css' ); 
}
// webslide menu code

function slidemenu(){
  get_template_part('template-parts/slidemenu');
}
add_action('genesis_before', 'slidemenu');

// webslide menu code


// remove title on homepage MCcoder
add_action('wp_enqueue_scripts', 'mc_enqueue_my_styles');

//* Add conatiner class to the site-container so bootstrap columns will work

add_filter( 'genesis_attr_site-container', 'atp_cont_class' );
function atp_cont_class( $attributes ) {
 $attributes['class'] = 'container';
return $attributes;
}
add_action('genesis_before_header','sticky_header');
function sticky_header(){
    get_template_part('template-parts/sticky-header');
  genesis_widget_area( 'top-right-widget',
    array(
      'before' => '<div class="wcag">',
      'after' => '</div>',
    )
  );
};
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
add_theme_support( 'genesis-menus', array( 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ) ) );


add_action('genesis_before_sidebar_alt_widget_area','before_left_sidebar_menu');
function before_left_sidebar_menu(){
	get_template_part('template-parts/sticky-sidebar-menu');	
}

add_action('genesis_before_entry','flexing');
function flexing(){
  get_template_part('parts/flex');  
};
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

add_action('genesis_after_entry','lib_foot');
function lib_foot(){
    get_template_part('template-parts/footer-area');  
}

        remove_action( 'genesis_post_title', 'genesis_do_post_title' );
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
        remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
        remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


include_once( get_stylesheet_directory() . '/includes/widget-areas.php' );

include_once( get_stylesheet_directory() . '/includes/acf-custom-widget.php');


// Make CTA widget
if(!class_exists('CtaWidget')) {

  class CtaWidget extends WP_Widget {

    /**
    * Sets up the widgets name etc
    */
    public function __construct() {
      $widget_ops = array(
        'classname' => 'cta_widget',
        'description' => 'CTA Widget built with ACF Pro',
      );
      parent::__construct( 'cta_widget', 'CTA Widget', $widget_ops );
    }

    /**
    * Outputs the content of the widget
    *
    * @param array $args
    * @param array $instance
    */
    public function widget( $args, $instance ) {
      // outputs the content of the widget
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
    	// outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
    	// processes widget options to be saved
    }

  }

}

/**
 * Register our CTA Widget
 */
function register_cta_widget()
{
  register_widget( 'CtaWidget' );
}
add_action( 'widgets_init', 'register_cta_widget' );

// ACF Pro Options Page



if (function_exists('acf_add_options_page')) {



    acf_add_options_page(array(

        'page_title' => 'Theme General Settings',

        'menu_title' => 'Theme Settings',

        'menu_slug' => 'theme-general-settings',

        'capability' => 'edit_posts',

        'redirect' => false

    ));



}

// lets add us some menyahs(menus)
function register_my_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'mobile-menu' => __( 'Mobile Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );

 add_action('genesis_before_sidebar_widget_area','nice_buttons');
 function nice_buttons(){
 		get_template_part('template-parts/sticky-sidebar');
	
 }


 function google_fonts() {
  $query_args = array(
    'family' => 'family=Noto+Sans:400,400i,700,700i',
    'subset' => 'latin,latin-ext'
  );
  wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
            }
            
add_action('wp_enqueue_scripts', 'google_fonts');

 
 function ordinal($num)
  {
    $last=substr($num,-1);
    if( $last>3  or 
        $last==0 or 
        ( $num >= 11 and $num <= 19 ) )
    {
      $ext='th';
    }
    else if( $last==3 )
    {
      $ext='rd';
    }
    else if( $last==2 )
    {
      $ext='nd';
    }
    else 
    {
      $ext='st';
    }
    return $num.$ext;
  }

/** Adding custom Favicon */
add_filter( 'genesis_pre_load_favicon', 'custom_favicon' );
function custom_favicon( $favicon_url ) {
  $rootfolder = get_stylesheet_directory_uri();
 return $rootfolder.'/favicon.png';
}
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Search Widget', // find in parts-> flexible folder->search.php
    'before_widget' => '<div id="sitesearch" class="searchwidget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

function hours_language_mobile(){
	if(!is_front_page()){
		get_template_part('template-parts/hours_language_mobile');
	}
}

add_action('genesis_before_loop', 'hours_language_mobile');

// mobile menu

class CSS_Menu_Maker_Walker extends Walker {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';        
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }

    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'has-sub';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'><span>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</span></a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}

/**
 * Hides the admin bar on a template page.
 */
function hide_admin_bar() {
    wp_add_inline_style('admin-bar', '<style> html { margin-top: 0 !important; } </style>');
    return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar' );


// this filter adds a dashboard button near the edit btn for easy dash access
add_filter( 'genesis_edit_post_link', function(){ 
edit_post_link( __( 'EDIT', 'textdomain' ), '', ' | <a href="/wp-admin/">Dashboard</a>' );
 });

