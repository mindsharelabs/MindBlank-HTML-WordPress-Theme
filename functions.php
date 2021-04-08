<?php
/**
 * Author: Mindshare Labs | @mindsharelabs
 * URL: https://mind.sh/are | @mindblank
 *
 */
define('THEME_VERSION', '3.0.0');
/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

include 'inc/content-functions.php';
include 'mindevents/mindevents.php';
include 'inc/cpt.php';
include 'inc/acf-functions.php';
include 'inc/aq_resize.php';



/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
    $content_width = 900;
}

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
    Functions
\*------------------------------------*/

function mindblank_setup_theme() {

}



function mapi_post_edit() {
  $post_type = get_post_type();
  $post_type_obj = get_post_type_object($post_type);
  edit_post_link( 'Edit this ' . $post_type_obj->labels->singular_name, '', '', get_the_id(), 'btn btn-sm btn-info mt-3 mb-3 float-right post-edit-link' );
}


// mind Blank navigation
function mindblank_nav($location)
{
  wp_nav_menu(
    array(
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
    )
  );
}


/**
* Allow SVG files upload in WordPress Media panel
*
* By default the WordPress doesn't allows you to upload SVG files.
* This function is used to remove that restriction so that you can
* upload SVG files.
*
*/
function mind_fix_svg_upload_error($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}




/**
* Remove default WordPress login  logo link
*
* This function removes the default link on the login screen logo.
* Makes this logo go to homepage of the website.
*
*/
function mind_login_logo_url($url) {
	return '"' . home_url() . '"';
}

add_filter( 'login_headerurl', 'mind_login_logo_url' );




/*  Add responsive container to embeds
/* ------------------------------------ */
function mind_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}

// Load mind Blank scripts (header.php)
function mindblank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

      wp_register_script('mindblankscripts-min', get_template_directory_uri() . '/js/scripts.js', array('bootstrap', 'slick-slider'), THEME_VERSION, true);
      wp_enqueue_script('mindblankscripts-min');

      wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '4.4.1');
      wp_enqueue_script('bootstrap');

      wp_register_script('slick-slider', get_template_directory_uri() . '/js/slick.min.js', array(), THEME_VERSION);
      wp_enqueue_script('slick-slider');


      wp_register_script('fontawesome', 'https://kit.fontawesome.com/2376b7dee0.js', array(), THEME_VERSION, true);
      wp_enqueue_script('fontawesome');
      add_action('wp_head', function() {
        echo '<link rel="preconnect" href="https://kit-pro.fontawesome.com">';
      });


    }
}

// Load mind Blank conditional scripts
function mindblank_conditional_scripts()
{
    // if (is_page_template('template-fullwidth.php')) {
    //     // Conditional script(s)
    //
    // }
    if(is_404()) :
      wp_register_style('404-styles', get_template_directory_uri() . '/css/404-styles.css', array(), THEME_VERSION);
      wp_enqueue_style('404-styles');
    endif;
}


/*
 * Add async attributes to enqueued scripts where needed.
 * The ability to filter script tags was added in WordPress 4.1 for this purpose.
 */

add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $scripts = array( 'fontawesome');

    if ( in_array( $handle, $scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" data-search-pseudo-elements></script>';
    }

    return $tag;
}, 10, 3 );



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


// Load mind Blank styles
function mindblank_styles()
{
    wp_register_style('mindblankcssmin', get_template_directory_uri() . '/css/style.css', array(), THEME_VERSION);
    wp_enqueue_style('mindblankcssmin');

    wp_register_style('typekit-fonts', 'https://use.typekit.net/iax7txx.css', array(), THEME_VERSION);
		add_action('wp_head', function() {
			echo '<link rel="preload" href="https://use.typekit.net/">';
		});


}

function mind_add_footer_styles() {
		wp_enqueue_style('typekit-fonts');
};
add_action( 'get_footer', 'mind_add_footer_styles' );


// Register mind Blank Navigation
function register_mind_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'mindblank'), // Main Navigation
        'footer-menu' => __('Footer Menu', 'mindblank'), // Sidebar Navigation
        'mobile-menu' => __('Mobile Menu', 'mindblank'), // Sidebar Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1

    register_sidebar(array(
        'name' => __('Widget Area 1', 'mindblank'),
        'description' => __('Widgets on all sub-pages', 'mindblank'),
        'id' => 'page-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Widgets', 'mindblank'),
        'description' => __('Widgets in the footer', 'mindblank'),
        'id' => 'footer-widgets',
        'before_widget' => '<div id="%1$s" class="%2$s col-xs-12 col-md-3">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;

    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function mindwp_pagination()
{
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

function mindblank_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'mindblank_excerpt_length', 999);


// Custom View Article link to Post
function mind_blank_view_article($more)
{
    global $post;
    return '...';
}


// Remove 'text/css' from our enqueued stylesheet
function mind_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}



// define the embed_html callback
function mindblank_filter_embed_html( $output, $post, $width, $height ) {
  $theme_slug = get_option('stylesheet');
    $output = str_replace ( 'wp-admin/images/w-logo-blue.png' , 'wp-content/' . $theme_slug . '/img/logo.svg' , $output);
    return $output;
};


function mind_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg);
            width: 300px;
            background-size: 300px 105px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'mind_login_logo' );




/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'mindblank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'mindblank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'mindblank_styles'); // Add Theme Stylesheet
add_action('init', 'register_mind_menu'); // Add mind Blank Menu
add_filter( 'get_the_archive_title', 'mindblank_remove_prepend_archives');

add_filter('upload_mimes', 'mind_fix_svg_upload_error');

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'mindwp_pagination'); // Add our mind Pagination
add_action('after_setup_theme', 'mindblank_setup_theme'); //add embed container around embeds
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter( 'embed_html', 'mindblank_filter_embed_html', 10, 4 ); //Filters embeded posts HTML to remove WP Logo
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter( 'embed_oembed_html', 'mind_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'mind_embed_html' ); // Jetpack

// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'mind_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'mind_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10); // Remove width and height dynamic attributes to post images
add_filter( 'embed_oembed_html', 'mind_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'mind_embed_html' ); // Jetpack

// Elminiate the emoji script
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('mind_shortcode_demo', 'mind_shortcode_demo'); // You can place [mind_shortcode_demo] in Pages, Posts now.
add_shortcode('mind_shortcode_demo_2', 'mind_shortcode_demo_2'); // Place [mind_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [mind_shortcode_demo] [mind_shortcode_demo_2] Here's the page title! [/mind_shortcode_demo_2] [/mind_shortcode_demo]

//SVG UPLOADS
add_filter( 'upload_mimes', 'mindblank_mime_types' );
add_filter( 'wp_check_filetype_and_ext', 'mindblank_check_filetype', 10, 4 );

// Allow SVG
function mindblank_check_filetype($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

};

function mindblank_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
