<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
include ('svg-icons.php');

if ( version_compare( $GLOBALS['wp_version'], '5.2.4', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}


/**
 * Fire on the initialization of WordPress.
 */
function the_dramatist_fire_on_wp_initialization() {
    /** to detect mobile  */
    function my_wp_is_mobile() {

        static $is_mobile;

        if ( isset($is_mobile) )
            return $is_mobile;

        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
            $is_mobile = false;
        } elseif (
            strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
                $is_mobile = true;
        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
                $is_mobile = true;
        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
            $is_mobile = false;
        } else {
            if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
              $is_mobile = 'ie11';
          } else {
              $is_mobile = false;
          }
        }
        return $is_mobile;
    }
}
add_action( 'init', 'the_dramatist_fire_on_wp_initialization' );


/** placeholder image function */
function placeholder_image($attr = ''){
	ob_start();
	echo '<img class="' . ( my_wp_is_IE() == 'ie11' ? ' skip-lazy ' : '' ) . '" src="' . get_template_directory_uri() .'/images/placeholder-image.jpg" alt="' . wp_strip_all_tags( $attr ) . '" />';
	return ob_get_clean();
}


/** wp image function */
function wp_image($imgID = '', $size = 'large', $classes = '' ){
	ob_start();
	// if( my_wp_is_IE() == 'ie11' ){
	// 	echo wp_get_attachment_image( $imgID, $size, '', array( "class" => " attachment-$size size-$size $classes skip-lazy" ) );
	// } else {
	// 	echo wp_get_attachment_image( $imgID, $size, '', array( "class" => "attachment-$size size-$size $classes" ) );
	// }

	$webPUrl = wp_get_attachment_image_url( $imgID, $size ) . '.webp';
	$uploadedfile=parse_url($webPUrl);
	$fileUrl =  $_SERVER['DOCUMENT_ROOT'] . $uploadedfile['path'];
    $path_info = pathinfo( wp_get_attachment_image_url( $imgID, $size ) );
    $imageExt = $path_info['extension'];
	echo '<picture class="cell-12 h-100 ">' .
        (
            file_exists($fileUrl)
            ? (
                $size == 'full'
                ? '<source type="image/webp" media="(min-width:1200px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '.webp">' .
                '<source type="image/webp" media="(min-width:1024px)" srcset="'. wp_get_attachment_image_url( $imgID, 'large' ) . '.webp">' .
                '<source type="image/webp" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '.webp">' .
                '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '.webp">'
                : ''
            ) .
            (
                $size == 'large'
                ? '<source type="image/webp" media="(min-width:1024px)" srcset="'. wp_get_attachment_image_url( $imgID, 'large' ) . '.webp">' .
                '<source type="image/webp" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '.webp">' .
                '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '.webp">'
                : ''
            ) .
            (
                $size == 'medium_large'
                ? '<source type="image/webp" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '.webp">' .
                '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '.webp">'
                : ''
            ) .
            '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '.webp">'
            : ''
        ) .
        (
            $size == 'full'
            ? '<source type="image/' . $imageExt . '" media="(min-width:1200px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:1024px)" srcset="'. wp_get_attachment_image_url( $imgID, 'large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '">'
            : ''
        ) .
        (
            $size == 'large'
            ? '<source type="image/' . $imageExt . '" media="(min-width:1024px)" srcset="'. wp_get_attachment_image_url( $imgID, 'large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '">'
            : ''
        ) .
        (
            $size == 'medium_large'
            ? '<source type="image/' . $imageExt . '" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '">'
            : ''
        ) .
        '<source type="image/' . $imageExt . '" media="(min-width:650px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '">' .
        wp_get_attachment_image( $imgID, $size, '', array( "class" => "attachment-$size size-$size $classes" ) ) .
    '</picture>';

	return ob_get_clean();
}

/** wp icon function **/
function wp_icon( $wp_icon, $classes="" ){
	ob_start();
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $wp_iconSVG = file_get_contents( $wp_icon , false, $context);
        echo $wp_iconSVG;
	return ob_get_clean();
}


function new_excerpt_more($more) {
    return ' <p><a class="read-more" href="' . get_permalink(get_the_ID()) . '"><span>' . __('Read Full Post', 'your-text-domain') . '</span></a></p>';
}
add_filter('excerpt_more', 'new_excerpt_more');


if ( ! function_exists( 'twentynineteen_setup' ) ) :
/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
function twentynineteen_setup() {
    /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
    load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'main-navigation' => __( 'Primary', 'twentynineteen' ),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    /**
		 * Add support for core custom logo.
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
        add_theme_support(
            'custom-logo',
            array(
                'flex-width'  => false,
                'flex-height' => false,
            )
        );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles.
    add_editor_style( 'style-editor.css' );

}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Content Sidebar', 'twentynineteen' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Additional sidebar that appears on the right.', 'twentynineteen' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s pb-0 bg-white">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle text-24 text-white px-15 py-10 mb-0">',
        'after_title' => '</h2>',
    ) );

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function site_styles() {
    //wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    if( is_front_page() ){
        wp_enqueue_style( 'highnpplicance-style', get_template_directory_uri() . '/assets/css/style.css' , array(), wp_get_theme()->get( 'Version' ) );
    } else {
        wp_enqueue_style( 'highnpplicance-style', get_template_directory_uri() . '/assets/css/inner-styles.css' , array(), wp_get_theme()->get( 'Version' ) );
    }
	// wp_enqueue_style( 'general-style', get_template_directory_uri() . '/assets/css/general.css' , array(), wp_get_theme()->get( 'Version' ) );
    wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

    if ( has_nav_menu( 'menu-1' ) ) {
        wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.0', true );
        wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.0', true );
    }

    //wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

  wp_register_style( 'our-brands', get_theme_file_uri() . '/assets/css/parts-our-brands.css' );
	wp_register_style( 'our-testimonials', get_theme_file_uri() . '/assets/css/parts-testimonials.css' );
	wp_enqueue_style( 'aos-css', get_theme_file_uri() . '/assets/css/aos.css' , array(), wp_get_theme()->get( 'Version' ));
	wp_enqueue_style( 'hover-css', get_theme_file_uri() . '/assets/css/hover.css' , array(), wp_get_theme()->get( 'Version' ));
}
add_action( 'wp_enqueue_scripts', 'site_styles' );


function site_script() {
    wp_enqueue_script('jquery');
    wp_script_add_data( 'jquery', 'rtl', 'replace' );
    wp_enqueue_script( 'slick-script', get_theme_file_uri() . '/js/slick.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_enqueue_script( 'matchheight-script', get_theme_file_uri() . '/js/jquery.matchheight.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_enqueue_script( 'general-script', get_theme_file_uri() . '/js/general.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_enqueue_script( 'aos-script', get_theme_file_uri( '/js/aos.js' ), array(), wp_get_theme()->get( 'Version' ), true );
    wp_register_script( 'home-banner-script', get_theme_file_uri() . '/js/home-banner-functions.js', array(), wp_get_theme()->get( 'Version' ) , true );
}
add_action( 'wp_enqueue_scripts', 'site_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
?>
<script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
</script>
<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/** ACF Options page Single choice */
/*if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}*/



function cptui_register_my_cpts() {

    /**
	 * Post Type: Testimonials.
	 */

    $labels = array(
        "name" => __( "Testimonials" ),
        "singular_name" => __( "Testimonial" ),
    );

    $args = array(
        "label" => __( "Testimonials" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "testimonial", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail", "excerpt" ),
    );

    register_post_type( "testimonial", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );



/* ACF Options page Multiple choices */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Options',
        'menu_title'	=> 'Theme options',
        'menu_slug' 	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Options',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Options',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Social Options',
        'menu_title'	=> 'Social',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme 404 Options',
        'menu_title'	=> '404',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme General up',
        'menu_title'	=> 'General',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Home Slider',
        'menu_title'	=> 'Home Slider',
        'parent_slug'	=> 'theme-general-options',
    ));
}


/** svg file upload permission */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Enqueue SVG javascript and stylesheet in admin
 * @author fadupla
 */


/** Admin Logo */
function my_login_logo() { ?>
<style type="text/css">
    #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/admin-logo.png);
        height:100px;
        width:100%;
        background-size: contain;
        background-repeat: no-repeat;
    }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return site_url();
}


/* site url for terms of use and privacy policy page */
function siteUrlFunction(){
	$siteUrlHtml = '<a class="link" href="' . site_url() . '">' . get_bloginfo( 'name' ) . '</a>';
	return $siteUrlHtml;
}
add_shortcode('site-url', 'siteUrlFunction');

/* site name for terms of use and privacy policy page */
function siteNameFunction(){
	$siteNameHTML = get_bloginfo( 'name' );
	return $siteNameHTML;
}
add_shortcode('site-name', 'siteNameFunction');

/* privacy policy for terms of use */
function privacyPolicyUrl( $atts, $content = null ){
	$privacyPolicyHTML = '<a class="link" href="' . site_url() . '/privacy-policy">' . $content . '</a>';
	return $privacyPolicyHTML;
}
add_shortcode('privacy-policy', 'privacyPolicyUrl');

/* state name for terms of use page */
function siteTermsState() {
	$stateHtml = get_field( 'terms_of_use_state', 'options' );
	if( $stateHtml ){
		return $stateHtml;
	}
}
add_shortcode('state-name', 'siteTermsState');



/** Appointment Button Function Start */
 function general_appointment_buttton(){
    ob_start();
    global $calIcon;

    $appointment = get_field('appointment_cta', 'options');
    if ($appointment) {
        $appointment_url = $appointment['url'];
        $appointment_title = $appointment['title'];
        $appointment_target = $appointment['target'] ? $appointment['target'] : '_self';
        echo '<div class="appt-btn"><a class="read-more hvr-pulse " href="' . esc_url($appointment_url) . '" target="' . esc_attr($appointment_target) . '"><span>' . $calIcon . '  '  . esc_html($appointment_title) . '</span></a></div>';
    }
    return ob_get_clean();
 }
/** Appointment Button Function End */


/** Social Media Function Start */
function social_media_options(){
    ob_start();
    global $facebook;
    global $insta;
    global $twitter;
    global $youtube;
    global $linkedin;
    global $yelp;
    global $google;
    if( have_rows('social_media', 'options') ){
        echo '<div class="socialmedialinks"><ul class="justify-content-center">';
            while ( have_rows('social_media', 'options')) : the_row();
            $icon = get_sub_field('social_media_name', 'options');
            echo '<li class="p-0">' .
                    '<a href="' . get_sub_field('social_media_link', 'options') . '" target="_blank" class="' . get_sub_field('social_media_name', 'options') . '">';
                        if($icon == "facebook"){
                            echo $facebook;
                        } else if($icon == "insta") {
                            echo $insta;
                        } else if($icon == "twitter") {
                            echo $twitter;
                        } else if($icon == "youtube") {
                            echo $youtube;
                        } else if($icon == "linkedin") {
                            echo $linkedin;
                        } else if($icon == "yelp") {
                            echo $yelp;
                        } else if($icon == "google") {
                            echo $google;
                        }
                    echo '</a>' .
                '</li>';
            endwhile;
        echo '</ul></div>';
    }
    return ob_get_clean();
}
/** Social Media Function End */



/** stop autoupdate wp-scss plugin  */
function my_filter_plugin_updates( $value ) {
   if( isset( $value->response['WP-SCSS-1.2.4/wp-scss.php'] ) ) {
      unset( $value->response['WP-SCSS-1.2.4/wp-scss.php'] );
    }
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );


/** Location address */
function locationAddress(){
    ob_start();
        $locationAddress = get_field('location_address', 'options');
        $locationMapLink = get_field('location_map_link', 'options');
        if( $locationAddress ){
            echo '<a href="'. $locationMapLink .'" target="_blank">' . $locationAddress . '</a>';
        }
    return ob_get_clean();
}
add_shortcode('location-address', 'locationAddress');

/** Location Phone Number */
function locationPhoneNumber(){
    ob_start();
        $locationPhoneNumber = get_field('location_phone', 'options');
        if( $locationPhoneNumber ){
            echo $locationPhoneNumber;
        }
    return ob_get_clean();
}
add_shortcode('location-phone', 'locationPhoneNumber');


/** Location Email Address */
function locationEmailAddress(){
    ob_start();
    $locationEmailAddress = get_field('location_email', 'options');
    if( $locationEmailAddress ){
        echo '<a href="mailto:' . $locationEmailAddress . '">' . $locationEmailAddress . '</a>';
    }
    return ob_get_clean();
}
add_shortcode('location-email', 'locationEmailAddress');

function locationHours() {
    ob_start();
    $locationWorkingHours = get_field('location_hours', 'options');
    if( $locationWorkingHours ){
        echo $locationWorkingHours;
    }
    return ob_get_clean();
}
add_shortcode('location-hours', 'locationHours');



function is_device_check() {

    static $is_device;

    if ( isset($is_device) )
        return $is_device;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_device = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
            $is_device = 'Android';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
            $is_device = 'iPhone';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_device = 'iPad';
    } else {
        if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
          $is_device = 'ie11';
      } else {
          $is_device = false;
      }
    }

    return $is_device;
}
add_shortcode('is_device', 'is_device_check');


/** main navigation */
function main_navigation(){
    ob_start();
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_class' => 'nav_menu',
        )
    );
    return ob_get_clean();
}

// Vimeo video duration in Second, Minutes & Hours
function format_time($time,$f=':'){
    if( $time < 60 ) {
       return sprintf("%02d%s%02d", ($time/60)%60, $f, $time%60);
    }elseif( $time > 60 && $time < 3600){
       return sprintf("%02d%s%02d", ($time/60)%60, $f, $time%60);
    }else{
       return sprintf("%02d%s%02d%s%02d", floor($time/3600), $f, ($time/60)%60, $f, $time%60);
    }
}

/**
* Vimeo video duration in seconds
*
* @param $video_url
* @return integer|null Duration in seconds or null on error
*/
function vimeoVideoDuration($video_url) {

    $video_id = (int)substr(parse_url($video_url, PHP_URL_PATH), 1);

    $json_url = 'http://vimeo.com/api/v2/video/' . $video_id . '.xml';

    $ch = curl_init($json_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    $check_valid_response = @simplexml_load_string($data);
    if (!$check_valid_response) {
        return 'Please check valid video URL';
    }

    $data = new SimpleXmlElement($data, LIBXML_NOCDATA);

    if (!isset($data->video->duration)) {
        return null;
    }

    $duration = format_time($data->video->duration);

    return $duration;
}
