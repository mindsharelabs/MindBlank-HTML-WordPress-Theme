<?php
/**
 * Author: Mindshare Labs | @mindsharelabs
 * URL: https://mind.sh/are | @mindblank
 *
 */
define('THEME_VERSION', '1.2.5');
/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/






/*------------------------------------*\
    Cusomizer Support
\*------------------------------------*/

function themeslug_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.
}
add_action( 'customize_register', 'themeslug_customize_register' );



/*------------------------------------*\
    Theme Support
\*------------------------------------*/
if (function_exists('add_theme_support')) {
    add_image_size( 'loop-thumb', 350, 150, true);

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enable mind support
    add_theme_support('mind', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    // Localisation Support
    load_theme_textdomain('mindblank', get_template_directory() . '/languages');

}


/*------------------------------------*\
    Script and Style Loading
\*------------------------------------*/
function mind_header_scripts(){
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('bootstrap-min', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), THEME_VERSION, true);
        wp_enqueue_script('bootstrap-min');
      
        wp_register_script('mind-scripts-min', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'bootstrap-min'), THEME_VERSION, true);
        wp_enqueue_script('mind-scripts-min');

        wp_register_script('fontawesome', 'https://kit.fontawesome.com/5bcc5329ee.js', array(), THEME_VERSION, true);
        wp_enqueue_script('fontawesome');
        add_action('wp_head', function() {
            echo '<link rel="preconnect" href="https://kit-pro.fontawesome.com">';
         });

    }
}

function mind_styles(){
    wp_register_style('mindblankcssmin', get_template_directory_uri() . '/css/styles.css', array(), THEME_VERSION);
    wp_enqueue_style('mindblankcssmin');


    wp_register_style('google-fonts-vibes', 'https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap', array(), THEME_VERSION);
    wp_register_style('google-fonts-open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,800;1,300;1,500;1,800&display=swap', array(), THEME_VERSION);
	add_action('wp_head', function() {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
	});


}

function mind_add_footer_styles() {
    wp_enqueue_style('google-fonts-vibes');
    wp_enqueue_style('google-fonts-open-sans');
};



function mind_conditional_scripts(){
    // if (is_page_template('template-fullwidth.php')) {
    //     // Conditional script(s)
    //
    // }
    if(is_404()) :
      wp_register_style('404-styles', get_template_directory_uri() . '/css/404-styles.css', array(), THEME_VERSION);
      wp_enqueue_style('404-styles');
    endif;
}

add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $scripts = array( 'fontawesome');

    if ( in_array( $handle, $scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" data-search-pseudo-elements></script>';
    }

    return $tag;
}, 10, 3 );


add_action( 'get_footer', 'mind_add_footer_styles' );
add_action('wp_enqueue_scripts', 'mind_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'mind_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'mind_styles');



/*------------------------------------*\
    Functions
\*------------------------------------*/
// mind Blank navigation
function mind_nav($location, $args = array()){
    $defaults = array(
      'theme_location' => $location,
      'menu' => '',
      'container' => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id' => '',
      'menu_class' => 'menu',
      'menu_id' => '',
      'echo' => true,
      'fallback_cb' => 'wp_page_menu',
      'before' => '',
      'after' => '',
      'link_before' => '',
      'link_after' => '',
      'items_wrap' => '<ul>%3$s</ul>',
      'depth' => 2,
      'walker' => ''
    );
    $options = wp_parse_args( $args, $defaults);
    wp_nav_menu($options);
  }

function register_mind_menu(){
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'mindblank'), // Main Navigation
        'main-menu' => __('Main Menu', 'mindblank'), // Main Navigation
        // 'footer-menu' => __('Footer Menu', 'mindblank'), // Sidebar Navigation
        'mobile-menu' => __('Mobile Menu', 'mindblank'), // Sidebar Navigation
    ));
}
add_action('init', 'register_mind_menu'); // Add mind Blank Menu




/**
* Remove default WordPress login logo link
*
* This function removes the default link on the login screen logo.
* Makes this logo go to homepage of the website.
*
*/
function mind_login_logo_url($url) {
	return '"' . home_url() . '"';
}
add_filter( 'login_headerurl', 'mind_login_logo_url' );


//Removes the prepend wording from all archive titles
function mindblank_remove_prepend_archives ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'mindblank_remove_prepend_archives');



// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function mind_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'next_text' => '<i class="fas fa-angle-double-right"></i>',
        'prev_text' => '<i class="fas fa-angle-double-left"></i>',

    ));
}


/*  Add responsive container to embeds
/* ------------------------------------ */
function mind_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'mind_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'mind_embed_html' ); // Jetpack



/*------------------------------------*\
    Markup Cleanup
\*------------------------------------*/

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function mind_wp_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'mind_wp_nav_menu_args');




// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function mind_css_attributes_filter($var){
    return is_array($var) ? array() : '';
}
// add_filter('nav_menu_css_class', 'mind_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'mind_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'mind_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)




// Remove invalid rel attribute values in the categorylist
function mind_remove_category_rel_from_category_list($thelist){
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'mind_remove_category_rel_from_category_list');


 

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function mind_add_slug_to_body_class( $classes ) {
    global $post;
    if ( is_home() ) {
        $key = array_search( 'blog', $classes, true );
        if ( $key > -1 ) {
            unset( $classes[$key] );
        }
    } elseif ( is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    } elseif ( is_singular() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    }

    return $classes;
}
add_filter('body_class', 'mind_add_slug_to_body_class');





// Remove the width and height attributes from inserted images
function remove_width_attribute($html){
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_width_attribute', 10); 
add_filter('image_send_to_editor', 'remove_width_attribute', 10); 





// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function mind_remove_thumbnail_dimensions($html){
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'mind_remove_thumbnail_dimensions', 10); 

/*------------------------------------*\
    Development Support
\*------------------------------------*/

if( !function_exists('mapi_write_log') ){
    function mapi_write_log($log){
        if( is_array($log) || is_object($log) ){
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

if( !function_exists('mapi_var_dump') ){
    function mapi_var_dump($dump){
        var_dump($dump);
    }
}