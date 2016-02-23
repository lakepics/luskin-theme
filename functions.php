<?php

// CUSTOM FUNCTIONS HAVE BEEN MOVED TO THE BOTTOM OF THIS FILE

// LOAD LUSKIN CORE (if you remove this, the theme will break)
require_once( 'library/luskin.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/* ********************************************************************************
 * LAUNCH LUSKIN
 * Let's get everything up and running.
 * *******************************************************************************/

function luskin_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'luskintheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'luskin_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'luskin_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'luskin_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'luskin_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'luskin_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'luskin_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  luskin_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'luskin_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'luskin_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'luskin_excerpt_more' );

} /* end luskin ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'luskin_ahoy' );


/* ********************************************************************************
 * OEMBED SIZE OPTIONS
 * *******************************************************************************/

if ( ! isset( $content_width ) ) {
  $content_width = 680;
}

/* ********************************************************************************
 * THUMBNAIL SIZE OPTIONS
 * *******************************************************************************/

// Thumbnail sizes
add_image_size( 'luskin-thumb-600', 600, 150, true );
add_image_size( 'luskin-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above and change the dimensions & name. 
As long as you upload a "featured image" as large as the biggest set width or 
height, all the other sizes will be auto-cropped.

To call a different size, simply change the text inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'luskin-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'luskin-thumb-600' ); ?>

You can change the names and dimensions to whatever you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'luskin_custom_image_sizes' );

function luskin_custom_image_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'luskin-thumb-600' => __('600px by 150px'),
    'luskin-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/* ********************************************************************************
 * THEME CUSTOMIZE
 * *******************************************************************************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

  function luskin_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
  }

  add_action( 'customize_register', 'luskin_theme_customizer' );

/* ********************************************************************************
 * ACTIVE SIDEBARS
 * *******************************************************************************/

// Sidebars & Widgetizes Areas
function luskin_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar-right',
    'name' => __( 'Right Sidebar', 'luskintheme' ),
    'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'luskintheme' ),
        // 'before_widget' => '<div id="%1$s" class="widget %2$s">',
        // 'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title"><span class="widget-icon"></span>',
    'after_title' => '</h4>',
    ));

    /*
    to add more sidebars or widgetized areas, just copy and edit the above 
    sidebar code. In order to call your new sidebar just use the following code:

    Just change the name to whatever your new sidebar's id is, for example:

    register_sidebar(array(
        'id' => 'sidebar2',
        'name' => __( 'Sidebar 2', 'luskintheme' ),
        'description' => __( 'The second (secondary) sidebar.', 'luskintheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    To call the sidebar in your template, you can just copy the sidebar.php file 
    and rename it to your sidebar's name. So using the above example, it would 
    be: sidebar-sidebar2.php

    */
} // don't remove this bracket!

/* ********************************************************************************
 * COMMENT LAYOUT
 * *******************************************************************************/

// Comment Layout
function luskin_comments( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new 
          HTML5 data-attribute to display comment gravatars on larger screens 
          only. What this means is that on larger posts, mobile sites don't have 
          a ton of requests for comment images. This makes load time incredibly 
          fast! If you'd like to change it back, just replace it with the 
          regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
          ?>
          <?php // custom gravatar call ?>
          <?php
          // create variable
          $bgauthemail = get_comment_author_email();
          ?>
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
          <?php // end custom gravatar call ?>
          <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'luskintheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'luskintheme' ),'  ','') ) ?>
          <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'luskintheme' )); ?> </a></time>

        </header>
        <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'luskintheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
    <?php // </li> is added by WordPress automatically ?>
    <?php
} // don't remove this bracket!


/*
This is a modification of a function found in the twentythirteen theme where 
we can declare some external fonts. If you're using Google Fonts, you can 
replace these fonts, change it in your scss files and be up and running in 
seconds.
*/
function luskin_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'luskin_fonts');

/* ********************************************************************************
 * CUSTOM FUNCTIONS
 * *******************************************************************************/

// dump function, for development purposes
function dump($var){
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}

// acf options
add_filter('acf/options_page/settings', 'soe_options_page_settings');

function soe_options_page_settings($options){

  $options['title'] = __('Global');
  $options['pages'] = array(
    __('Header'),
    __('Sidebar'),
    __('Footer'),
    __('Blocks')
    );

  return $options;
}

/* Excerpt function
 *
 * $mycontent = string to strip
 * $noc = number of words to strip ( integer )
 */
function my_excerpt($mycontent, $now) {
  //global $post;
  $mycontent = strip_shortcodes($mycontent);
  $mycontent = str_replace(']]>', ']]&gt;', $mycontent);
  $mycontent = strip_tags($mycontent);
  $excerpt_length = $now;
  $words = explode(' ', $mycontent, $excerpt_length + 1);
  foreach ($words as $word) {
    $wordsTrimed[] = preg_replace( '/\s+/', '', $word );;
  }
  if(count($wordsTrimed) > $excerpt_length) :
    array_pop($wordsTrimed);
  array_push($wordsTrimed, '&hellip;');
  $mycontent = implode(' ', $wordsTrimed);
  endif;
  $mycontent = implode(' ', $wordsTrimed);
  $mycontent = '<p>' . $mycontent . '</p>';
  return $mycontent;
}

/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
    $classes = 'img'; // separated by spaces, e.g. 'img image-link'

    // check if there are already classes assigned to the anchor
    if ( preg_match('/<a.*? class=".*?">/', $html) ) {
      $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
    } else {
      $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
    }
    return $html;
  }
  add_filter('image_send_to_editor','give_linked_images_class',10,8);

  // sort array by column
  function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
      $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
  }

/**
 * var $postType: The post type where we should look for prev/next articles
 * var $postId: The postId in relation to which we need to find the prev/next
 * var $fieldValue: Pair of field with value
 */
function getPrevNext($postType, $postId, $fieldValue = null) {
  if ($fieldValue != null) {
    $args = array(
      'numberposts' => -1,
      'post_type' => $postType,
      'order' => 'ASC',
      'meta_key'         => $fieldValue['meta_key'],
      'meta_value'       => $fieldValue['meta_value'],
      'orderby' => 'title'
      );
  } else {
    $args = array(
      'numberposts' => -1,
      'post_type' => $postType,
      'order' => 'ASC',
      'orderby' => 'menu_order'
      );
  }

  $items = get_posts($args);

  $numItems = count($items);
  $i = 0; $isLast = false; $isFirst = false;
  foreach($items as $key => $item) {
    $newitems[$item->ID] = $item;
    $ids[] = $item->ID;
  }

    // $postId = get_the_ID();

  $i = 0;
  foreach ($newitems as $key => $item) {
    if ($key == $postId) {
      if ($i+1 == count($ids)) {
                // last
        $nextId = $newitems[$ids[0]]->ID;
        $prevId = $newitems[$ids[0]]->ID;
      } else {
        $nextId = $newitems[$ids[$i+1]]->ID;
        $prevId = $newitems[$ids[$i-1]]->ID;
      }

    }
    $i++;
  }

  $nextPermalink = get_permalink( $nextId );
  $prevPermalink = get_permalink( $prevId );
  wp_reset_query();

  return array('next' => $nextPermalink, 'prev' => $prevPermalink);
}

// turn string into slug
function create_slug($string){
  $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
  return strtolower($slug);
}

function wp_get_attachment( $attachment_id ) {

  $attachment = get_post( $attachment_id );

  $image = wp_get_attachment_image_src ($attachment_id, 'full');

  return array(
    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
    'caption' => $attachment->post_excerpt,
    'description' => $attachment->post_content,
    'href' => get_permalink( $attachment->ID ),
    'src' => $attachment->guid,
    'width' => $image[1],
    'height' => $image[2],
    'title' => $attachment->post_title
    );
}

/**
 * [show_hero_slides Outputs the hero slideshow for the page where it is called]
 * @return [type] [HTML]
 */
function show_hero_slides() {
  if( get_field('slides') ){
    $slides = get_field('slides');
    $caption = $slide['caption'];
    $container_id = $slides[0]['container_id'];
    if ( $container_id ) {
      echo '<div id="' . $container_id . '" class="full-width-gallery">';
    }
    else {
      echo '<div class="full-width-gallery">';
    }
    if (count($slides) > 1) {
      echo '<ul>';
      foreach ( get_field('slides') as $slide ){
        $image = wp_get_attachment($slide['image']['id']);
        $portrait_image = wp_get_attachment($slide['portrait_image']['id']);
        echo '<li>';
        echo '<img src="'. $image['src'] .'" alt="'.$image['alt'].'" />';
        echo '<img class="mobile-image" src="'. $portrait_image['src'] .'" alt="'.$portrait_image['alt'].'" />';
        echo '</li>';
      }
      echo '</ul>';
    } else {
      foreach ( get_field('slides') as $slide ){
        $image = wp_get_attachment($slide['image']['id']);
        $portrait_image = wp_get_attachment($slide['portrait_image']['id']);
        echo '<img src="'. $image['src'] .'" alt="'.$image['alt'].'" />';
        echo '<img class="mobile-image" src="'. $portrait_image['src'] .'" alt="'.$portrait_image['alt'].'" />';
      }
            // echo '<pre>' . print_r ($slides); '</pre>';
    }
    if ( get_field('ghost_type_on_image') ) {
      $page_heading = get_field('ghost_type_on_image');
      echo '<div class="container">';
      echo '<div class="text-overlay">' . $page_heading . '</div>';
      echo '</div>';
    }
    echo '</div>';
    if ($caption) {
      echo '<div class="container"><span class="caption">' . $caption . '</span></div>';
    }
    if ( get_field('page_heading') ) {
      $page_heading = get_field('page_heading');
      echo '<div class="container page-heading">';
      echo '<h1>' . $page_heading . '</h1>';
      echo '</div>';
    }   
  }
}

/* DON'T DELETE THIS CLOSING TAG */ ?>
