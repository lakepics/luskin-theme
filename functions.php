<?php

// CUSTOM FUNCTIONS HAVE BEEN MOVED TO THE BOTTOM OF THIS FILE

// LOAD LUSKIN CORE (if you remove this, the theme will break)
require_once 'library/luskin.php';

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/* *****************************************************************************
 * LAUNCH LUSKIN
 * Let's get everything up and running.
 * ****************************************************************************/

function luskinAhoy()
{

    // allow editor style
    add_editor_style(get_stylesheet_directory_uri() . '/library/css/editor-style.css');

    // let's get language support going, if you need it
    load_theme_textdomain('luskintheme', get_template_directory() . '/library/translation');

    // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
    //require_once( 'library/custom-post-type.php' );

    // launching operation cleanup
    add_action('init', 'luskinHeadCleanup');

    // a better title
    add_filter('wp_title', 'rwTitle', 10, 3);

    // remove wp version from rss
    add_filter('the_generator', 'luskinRssVersion');

    // remove pesky injected css for recent comments widget
    add_filter('wp_head', 'luskinRemoveWpWidgetRecentCommentsStyle', 1);

    // clean up comment styles in the head
    add_action('wp_head', 'luskinRemoveRecentCommentsStyle', 1);

    // remove injected css from gallery
    add_filter('gallery_style', 'luskinGalleryStyle');

    // enqueue all scripts and styles
    add_action('wp_enqueue_scripts', 'luskinScriptsAndStyles', 999);

    // enqueue all scripts that need to be last
    add_action('wp_enqueue_scripts', 'luskinLoadScriptsLast', 9999, 1);

    // adding wp 3+ functions & theme support after theme setup
    luskinThemeSupport();

    // adding sidebars & widgetizes areas
    add_action('widgets_init', 'luskinRegisterSidebars');

    // remove the p from around imgs
    add_filter('the_content', 'luskinFilterPtagsOnImages');

    // remove the annoying […] to a read more link
    add_filter('excerpt_more', 'luskinExcerptMore');

    // enable scripts in text widgets
    add_filter('widget_text', 'php_text', 99);

    // enable shortcodes in text widgets
    add_filter('widget_text', 'do_shortcode');

    // basic compression
    add_action('get_header', 'wp_html_compression_start');

    // minify output
    add_action('get_header', 'gkp_html_minify_start');

} /* end luskin ahoy */

// okay let's get this party started!!!
add_action('after_setup_theme', 'luskinAhoy');

/* *****************************************************************************
 * OEMBED SIZE OPTIONS
 * ****************************************************************************/

if (!isset($content_width)) {
    $content_width = 680;
}

/* *****************************************************************************
 * CUSTOM IMAGE SIZING OPTIONS
 * ****************************************************************************/

// default image sizes that can be configured in the WordPress Administration
// Media Screen under Settings > Media
// the_post_thumbnail('thumbnail'); // Thumbnail (default 150px x 150px max)
// the_post_thumbnail('medium');    // Medium resolution (default 300px x 300px max)
// the_post_thumbnail('large');     // Large resolution (default 640px x 640px max)
// the_post_thumbnail('full');      // Original image resolution (unmodified)

// add_image_size ( string $name, int $width, int $height, bool|array $crop = false )
// add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)

// ipad with retina screen; hard crop center center
add_image_size( 'luskin-ipad-retina', 2048, 1536, true );

// widescreen computer monitor; hard crop center center
add_image_size( 'luskin-widescreen', 1920, 1200, true );

// hd tv, iphone 6 plus; hard crop center center
add_image_size( 'luskin-hdtv-iphone6plus', 1920, 1080, true );

// luskin_hero image; hard crop center center
add_image_size( 'luskin-hero', 1920, 550, true );

// iphone 6; hard crop center center
add_image_size( 'luskin-iphone6', 1334, 750, true );

// facebook; hard crop center center
add_image_size( 'luskin-facebook', 1200, 630, true );

// twitter; hard crop center center
add_image_size( 'luskin-twitter', 1200, 512, true );

// iphone 5; hard crop center center
add_image_size( 'luskin-iphone5', 1136, 640, true );

// ipad; hard crop center center
add_image_size( 'luskin-ipad', 1024, 768, true );

// iphone 4; hard crop center center
add_image_size( 'luskin-iphone4', 960, 640, true );

// luskin_landscape_thumb image; hard crop center center
add_image_size( 'luskin-landscape-thumb', 640, 480, true);

// luskin_portrait image; hard crop center center
add_image_size( 'luskin-square-thumb', 640, 640, true );

// luskin_portrait_thumb image; hard crop center center
add_image_size( 'luskin-portrait-thumb', 480, 640, true);

/*
to add more sizes, simply copy a line from above and change the dimensions &
name. as long as you upload a "featured image" as large as the biggest set
width or height, all the other sizes will be auto-cropped.

To call a different size, simply change the text inside the thumbnail function.

For example, to call the 1200 x 512 sized image,
we would use the function:
<?php the_post_thumbnail( 'luskin_twitter' ); ?>

you can change the names and dimensions to whatever you like. Enjoy!
*/

add_filter('image_size_names_choose', 'luskinCustomImageSizes');

function luskinCustomImageSizes($sizes)
{
    return array_merge($sizes, array(
        'luskin-widescreen'         => __('Widescreen'),
        'luskin-hero'               => __('Luskin Hero'),
        'luskin-facebook'           => __('Facebook'),
        'luskin-twitter'            => __('Facebook'),
        'luskin-landscape-thumb'    => __('Landscape Thumb'),
        'luskin-portrait-thumb'     => __('Portrait Thumb'),
        'luskin-square-thumb'       => __('Square Thumb'),
    ));
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
 */

/* *****************************************************************************
 * THEME CUSTOMIZE
 * ****************************************************************************/

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
add_action('customize_register', 'luskinThemeCustomizer');

function luskinThemeCustomizer($wp_customize)
{
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

/* *****************************************************************************
 * RELATED POSTS FUNCTION
 * ****************************************************************************/

// related posts function (call using luskinRelatedPosts();)
function luskinRelatedPosts()
{
    echo '<ul id="luskin-related-posts">';
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_arr .= $tag->slug . ',';
        }
        $args = array(
            'tag' => $tag_arr,
            'numberposts' => 5, /* you can change this to show more */
            'post__not_in' => array($post->ID),
        );
        $related_posts = get_posts($args);
        if ($related_posts) {
            foreach ($related_posts as $post): setup_postdata($post);?>
              <li class="related_post"><a class="entry-unrelated" href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title();?></a></li><?php
             endforeach;}
        else {
          echo '<li class="no_related_post">' . __('No Related Posts Yet!', 'luskintheme') . '</li>';
        }
    }
    wp_reset_postdata();
    echo '</ul>';
} /* end related posts function */

/* *****************************************************************************
 * PAGE NAVI
 * ****************************************************************************/

// numeric page navi (built into the theme by default)
function luskinPageNavi()
{
    global $wp_query;
    $bignum = 999999999;
    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    echo '<nav class="pagination">';
    echo paginate_links(array(
        'base' => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
        'format' => '',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3,
    ));
    echo '</nav>';
} /* end page navi */

/* *****************************************************************************
 * COMMENT LAYOUT
 * ****************************************************************************/

// comment layout
function luskinComments($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment;?>
  <div id="comment-<?php comment_ID();?>" <?php comment_class('cf');?>>
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
        ;?>
        <?php // custom gravatar call ;?>
        <?php
        // create variable
        $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ;?>
        <?php printf(__('<cite class="fn">%1$s</cite> %2$s', 'luskintheme'), get_comment_author_link(), edit_comment_link(__('(Edit)', 'luskintheme'), '  ', ''));?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php comment_time(__('F jS, Y', 'luskintheme'));?> </a></time>
      </header>
      <?php if ($comment->comment_approved == '0'): ?>
      <div class="alert alert-info">
        <p><?php _e('Your comment is awaiting moderation.', 'luskintheme');?></p>
      </div>
      <?php endif;?>
      <section class="comment_content cf">
        <?php comment_text();?>
      </section>
      <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));?>
    </article>
    <?php // </li> is added by WordPress automatically ;?>
    <?php
} /* end comment layout */

/* *****************************************************************************
 * CUSTOM FUNCTIONS
 * ****************************************************************************/

// load typekit fonts
function luskinTypekit()
{
    // ucla url to typekit
    wp_enqueue_script( 'theme_typekit', '//use.typekit.net/sif5fib.js');
}
add_action('wp_enqueue_scripts', 'luskinTypekit');

// force async load of typekit fonts
function luskinTypekitInline()
{
    if (wp_script_is('theme_typekit', 'done')) {
      echo '<script type="text/javascript">try{Typekit.load({ async: true });}catch(e){}</script>';
    }
}
add_action('wp_head', 'luskinTypekitInline');

// dump function, for development purposes
function dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

// acf options
function soeOptionsPageSettings($options)
{

    $options['title'] = __('Global');
    $options['pages'] = array(
        __('Header'),
        __('Sidebar'),
        __('Footer'),
        __('Blocks'),
    );

    return $options;
}
add_filter('acf/options_page/settings', 'soeOptionsPageSettings');

/* excerpt function
 *
 * $mycontent = string to strip
 * $noc = number of words to strip ( integer )
 */
function myExcerpt($mycontent, $now)
{
    //global $post;
    $mycontent = strip_shortcodes($mycontent);
    $mycontent = str_replace(']]>', ']]&gt;', $mycontent);
    $mycontent = strip_tags($mycontent);
    $excerpt_length = $now;
    $words = explode(' ', $mycontent, $excerpt_length + 1);
    foreach ($words as $word) {
        $wordsTrimed[] = preg_replace('/\s+/', '', $word);
    }
    if (count($wordsTrimed) > $excerpt_length):
        array_pop($wordsTrimed);
        array_push($wordsTrimed, '&hellip;');
        $mycontent = implode(' ', $wordsTrimed);
    endif;
    $mycontent = implode(' ', $wordsTrimed);
    $mycontent = '<p>' . $mycontent . '</p>';
    return $mycontent;
}

/**
 * attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function giveLinkedImagesClass($html, $id, $caption, $title, $align, $url, $size, $alt = '')
{
    $classes = 'img'; // separated by spaces, e.g. 'img image-link'

    // check if there are already classes assigned to the anchor
    if (preg_match('/<a.*? class=".*?">/', $html)) {
        $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
    } else {
        $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
    }
    return $html;
}
add_filter('image_send_to_editor', 'giveLinkedImagesClass', 10, 8);

// sort array by column
function arraySortByColumn(&$arr, $col, $dir = SORT_ASC)
{
    $sort_col = array();
    foreach ($arr as $key => $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

/**
 * var $postType: The post type where we should look for prev/next articles
 * var $postId: The postId in relation to which we need to find the prev/next
 * var $fieldValue: Pair of field with value
 */
function getPrevNext($postType, $postId, $fieldValue = null)
{
    if ($fieldValue != null) {
        $args = array(
            'numberposts' => -1,
            'post_type' => $postType,
            'order' => 'ASC',
            'meta_key' => $fieldValue['meta_key'],
            'meta_value' => $fieldValue['meta_value'],
            'orderby' => 'title',
        );
    } else {
        $args = array(
            'numberposts' => -1,
            'post_type' => $postType,
            'order' => 'ASC',
            'orderby' => 'menu_order',
        );
    }

    $items = get_posts($args);

    $numItems = count($items);
    $i = 0;
    $isLast = false;
    $isFirst = false;
    foreach ($items as $key => $item) {
        $newitems[$item->ID] = $item;
        $ids[] = $item->ID;
    }

    // $postId = get_the_ID();

    $i = 0;
    foreach ($newitems as $key => $item) {
        if ($key == $postId) {
            if ($i + 1 == count($ids)) {
                // last
                $nextId = $newitems[$ids[0]]->ID;
                $prevId = $newitems[$ids[0]]->ID;
            } else {
                $nextId = $newitems[$ids[$i + 1]]->ID;
                $prevId = $newitems[$ids[$i - 1]]->ID;
            }

        }
        $i++;
    }

    $nextPermalink = get_permalink($nextId);
    $prevPermalink = get_permalink($prevId);
    wp_reset_query();

    return array('next' => $nextPermalink, 'prev' => $prevPermalink);
}

// turn string into slug
function createSlug($string)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower($slug);
}

function wpGetAttachment($attachment_id)
{

    $attachment = get_post($attachment_id);

    $image = wp_get_attachment_image_src($attachment_id, 'full');

    return array(
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink($attachment->ID),
        'src' => $attachment->guid,
        'width' => $image[1],
        'height' => $image[2],
        'title' => $attachment->post_title,
    );
}

/**
 * [showHeroSlides Outputs the hero slideshow for the page where it is called]
 * @return [type] [HTML]
 */
function showHeroSlides()
{
    if (get_field('slides')) {
        $slides = get_field('slides');
        $caption = $slide['caption'];
        $container_id = $slides[0]['container_id'];
        if ($container_id) {
            echo '<div id="' . $container_id . '" class="full-width-gallery">';
        } else {
            echo '<div class="full-width-gallery">';
        }
        if (count($slides) > 1) {
            echo '<ul>';
            foreach (get_field('slides') as $slide) {
                $image = wpGetAttachment($slide['image']['id']);
                $portrait_image = wpGetAttachment($slide['portrait_image']['id']);
                echo '<li>';
                echo '<img src="' . $image['src'] . '" alt="' . $image['alt'] . '" />';
                echo '<img class="mobile-image" src="' . $portrait_image['src'] . '" alt="' . $portrait_image['alt'] . '" />';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            foreach (get_field('slides') as $slide) {
                $image = wpGetAttachment($slide['image']['id']);
                $portrait_image = wpGetAttachment($slide['portrait_image']['id']);
                echo '<img src="' . $image['src'] . '" alt="' . $image['alt'] . '" />';
                echo '<img class="mobile-image" src="' . $portrait_image['src'] . '" alt="' . $portrait_image['alt'] . '" />';
            }
            // echo '<pre>' . print_r ($slides); '</pre>';
        }
        if (get_field('ghost_type_on_image')) {
            $page_heading = get_field('ghost_type_on_image');
            echo '<div class="container">';
            echo '<div class="text-overlay">' . $page_heading . '</div>';
            echo '</div>';
        }
        echo '</div>';
        if ($caption) {
            echo '<div class="container"><span class="caption">' . $caption . '</span></div>';
        }
        if (get_field('page_heading')) {
            $page_heading = get_field('page_heading');
            echo '<div class="container page-heading">';
            echo '<h1>' . $page_heading . '</h1>';
            echo '</div>';
        }
    }
};

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;
    public function __construct($html)
    {
     if (!empty($html))
     {
         $this->parseHTML($html);
     }
    }
    public function __toString()
    {
     return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
     $raw = strlen($raw);
     $compressed = strlen($compressed);

     $savings = ($raw-$compressed) / $raw * 100;

     $savings = round($savings, 2);

     return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
     $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
     preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
     $overriding = false;
     $raw_tag = false;
     // Variable reused for output
     $html = '';
     foreach ($matches as $token)
     {
         $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;

         $content = $token[0];

         if (is_null($tag))
         {
             if ( !empty($token['script']) )
             {
                 $strip = $this->compress_js;
             }
             else if ( !empty($token['style']) )
             {
                 $strip = $this->compress_css;
             }
             else if ($content == '<!--wp-html-compression no compression-->')
             {
                 $overriding = !$overriding;

                 // Don't print the comment
                 continue;
             }
             else if ($this->remove_comments)
             {
                 if (!$overriding && $raw_tag != 'textarea')
                 {
                     // Remove any HTML comments, except MSIE conditional comments
                     $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                 }
             }
         }
         else
         {
             if ($tag == 'pre' || $tag == 'textarea')
             {
                 $raw_tag = $tag;
             }
             else if ($tag == '/pre' || $tag == '/textarea')
             {
                 $raw_tag = false;
             }
             else
             {
                 if ($raw_tag || $overriding)
                 {
                     $strip = false;
                 }
                 else
                 {
                     $strip = true;

                     // Remove any empty attributes, except:
                     // action, alt, content, src
                     $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);

                     // Remove any space before the end of self-closing XHTML tags
                     // JavaScript excluded
                     $content = str_replace(' />', '/>', $content);
                 }
             }
         }

         if ($strip)
         {
             $content = $this->removeWhiteSpace($content);
         }

         $html .= $content;
     }

     return $html;
    }

    public function parseHTML($html)
    {
     $this->html = $this->minifyHTML($html);

     if ($this->info_comment)
     {
         $this->html .= "\n" . $this->bottomComment($html, $this->html);
     }
    }

    protected function removeWhiteSpace($str)
    {
     $str = str_replace("\t", ' ', $str);
     $str = str_replace("\n",  '', $str);
     $str = str_replace("\r",  '', $str);

     while (stristr($str, '  '))
     {
         $str = str_replace('  ', ' ', $str);
     }

     return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}

function gkp_html_minify_start()  {
    ob_start( 'gkp_html_minyfy_finish' );
}

function gkp_html_minyfy_finish( $html )  {

   // Suppression des commentaires HTML,
   // sauf les commentaires conditionnels pour IE
   $html = preg_replace('/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s', '', $html);

   // Suppression des espaces vides
   $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
   while ( stristr($html, '  '))
       $html = str_replace('  ', ' ', $html);
   return $html;

}


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 45;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Breadcrumbs
//https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
function custom_breadcrumbs() {

    // Settings
    $separator          = '&#47;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
    $blog               = 'Blog';

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

        } else if ( is_single() ) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            // Get post category info
            $category = get_the_category();

            if(!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            } else {

                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            }

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ul>';

    }

}
/* DON'T DELETE THIS CLOSING TAG */?>
