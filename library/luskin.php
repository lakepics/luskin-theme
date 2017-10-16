<?php

/* *****************************************************************************
/* Welcome to Luskin :)

This is the core Luskin file where most of the main functions & features
reside. If you have any custom functions, it's best to put them in the
functions.php file.

- head cleanup (remove rsd, uri links, junk css, ect)
- enqueueing scripts & styles
- theme support functions
- custom menu output & fallbacks
- related post function
- page-navi function
- removing <p> from around images
- customizing the post excerpt
 * ****************************************************************************/

/* *****************************************************************************
 * WP_HEAD GOODNESS
 * The default wordpress head is a mess. Let's clean it up by removing all
 * the junk we don't need.
 * ****************************************************************************/

// remove stuff that really doen't need to be in the output of the head tag
function luskinHeadCleanup()
{
    // category feeds
    remove_action('wp_head', 'feed_links_extra', 3);
    // post and comment feeds
    remove_action('wp_head', 'feed_links', 2);
    // edituri link
    remove_action('wp_head', 'rsd_link');
    // windows live writer
    remove_action('wp_head', 'wlwmanifest_link');
    // previous link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    // start link
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    // links for adjacent posts
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    // wp version
    remove_action('wp_head', 'wp_generator');
    // remove wp version from css
    add_filter('style_loader_src', 'luskinRemoveWpVerCssJs', 9999);
    // remove wp version from scripts
    add_filter('script_loader_src', 'luskinRemoveWpVerCssJs', 9999);
    // remove emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    // remove wp-embed scripts
    //add_action('init', 'disable_embeds_init', 9999);

} /* end luskin head cleanup */

// remove wp version from scripts
function luskinRemoveWpVerCssJs($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}

// a better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rwTitle($title, $sep, $seplocation)
{
    global $page, $paged;

    // Don't affect in feeds.
    if (is_feed()) {
        return $title;
    }

    // Add the blog's name
    if ('right' == $seplocation) {
        $title .= get_bloginfo('name');
    } else {
        $title = get_bloginfo('name') . $title;
    }

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');

    if ($site_description && (is_home() || is_front_page())) {
        $title .= " {$sep} {$site_description}";
    }

    // Add a page number if necessary:
    if ($paged >= 2 || $page >= 2) {
        $title .= " {$sep} " . sprintf(__('Page %s', 'dbt'), max($paged, $page));
    }

    return $title;

} // end better title

// remove wp version from rss
function luskinRssVersion()
{return '';}

// remove pesky injected css for recent comments widget
function luskinRemoveWpWidgetRecentCommentsStyle()
{
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
        remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
}

// remove wp-embed scripts
function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

// clean up comment styles in the head
function luskinRemoveRecentCommentsStyle()
{
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }
}

//remove injected css from gallery
function luskinGalleryStyle($css)
{
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/* *****************************************************************************
 * SCRIPTS & ENQUEUEING
 * ****************************************************************************/

// enqueue all scripts and styles
function luskinScriptsAndStyles()
{

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // not admin area/control panel
    if (!is_admin()) {

        /* *********************************************************************
         * register/deregister and enqueue STYLES in the HEADER section
         * ********************************************************************/

        /* **************************************************
         * ...on all pages
         * **************************************************/

        // main stylesheet
        wp_enqueue_style('luskin-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.min.css', array(), '', 'all');

        // ie-only style sheet
        wp_enqueue_style('luskin-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.min.css', array('luskin-stylesheet'), '');
        // add conditional wrapper for Internet Explorer versions less than 7
        $wp_styles->add_data('luskin-ie-only', 'conditional', 'lt IE 7');

        // get the path of page template in current or parent template
        $pageTemplate = get_page_template();
        // break into usable sections; seperated by the forward slash
        $pageArray = explode("/", $pageTemplate);
        // grab the last usable section
        $pageTemplate = end($pageArray);

        // test for error page
        if (is_404()) {
            wp_enqueue_style('404-stylesheet', get_stylesheet_directory_uri() . '/library/css/404.min.css', array('luskin-stylesheet'), '', 'all');
        }

        // test for author page
        if (is_author()) {

        }

        // test for category page
        if (is_category()) {

        }

        // test for front page
        // On the site, front page, 'is_front_page()' will always return TRUE, regardless of whether the site front page displays the blog posts index or a static page.
        if (is_front_page()) {

        }

        // // test for home page
        // On the blog posts index, 'is_home()' will always return TRUE, regardless of whether the blog posts index is displayed on the site front page or a separate page.
        if (is_home()) {

        }

        // test for search  page
        if (is_search()) {

        }

        // test for single page
        if (is_single()) {

        }

        // test for tag page
        if (is_tag()) {

        }

        // test for taxtaxonomy page
        if (is_tax()) {

        }

        // test the pageTemplate and assign section stylesheet to it
        switch ($pageTemplate) {
            case '404.php':
                wp_enqueue_style('404-stylesheet', get_stylesheet_directory_uri() . '/library/css/404.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-about-dir.php':
                wp_enqueue_style('about-us-dir-stylesheet', get_stylesheet_directory_uri() . '/library/css/about-us-dir.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-about-sub.php':
                wp_enqueue_style('about-us-sub-stylesheet', get_stylesheet_directory_uri() . '/library/css/about-us-sub.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-about.php':
                wp_enqueue_style('about-stylesheet', get_stylesheet_directory_uri() . '/library/css/about.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-accommodations-amenities.php':
                wp_enqueue_style('accommodations-amenities-stylesheet', get_stylesheet_directory_uri() . '/library/css/accommodations-amenities.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-accommodations-rooms.php':
                wp_enqueue_style('accommodations-rooms-stylesheet', get_stylesheet_directory_uri() . '/library/css/accommodations-rooms.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-accommodations-suites.php':
                wp_enqueue_style('accommodations-suites-stylesheet', get_stylesheet_directory_uri() . '/library/css/accommodations-suites.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-accommodations.php':
                wp_enqueue_style('accommodations-stylesheet', get_stylesheet_directory_uri() . '/library/css/accommodations.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-contact-team.php':
                wp_enqueue_style('contact-team-stylesheet', get_stylesheet_directory_uri() . '/library/css/contact-team.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-contact.php':
                wp_enqueue_style('contact-stylesheet', get_stylesheet_directory_uri() . '/library/css/contact.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-dining.php':
                wp_enqueue_style('dining-stylesheet', get_stylesheet_directory_uri() . '/library/css/dining.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-dining-chef.php':
                wp_enqueue_style('dining-chef-stylesheet', get_stylesheet_directory_uri() . '/library/css/dining-chef.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-flip-book.php':
                wp_enqueue_style('flip-book-stylesheet', get_stylesheet_directory_uri() . '/library/css/flip-book.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-gallery.php':
                wp_enqueue_style('gallery-stylesheet', get_stylesheet_directory_uri() . '/library/css/gallery.min.css', array('luskin-stylesheet', 'fancybox-stylesheet'), '', 'all');
                break;
            case 'template-hma-opt-in-thank-you.php':
                wp_enqueue_style('hma-opt-in-thank-you-stylesheet', get_stylesheet_directory_uri() . '/library/css/hma-opt-in-thank-you.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-homepage.php':
                wp_enqueue_style('homepage-stylesheet', get_stylesheet_directory_uri() . '/library/css/homepage.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-meetings-amenities.php':
                wp_enqueue_style('meetings-amenities-stylesheet', get_stylesheet_directory_uri() . '/library/css/meetings-amenities.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-meetings-floorplans.php':
                wp_enqueue_style('meetings-floorplans-stylesheet', get_stylesheet_directory_uri() . '/library/css/meetings-floorplans.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-meetings-resources-faq.php':
                wp_enqueue_style('meetings-resources-faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/meetings-resources-faq.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-meetings-resources.php':
                wp_enqueue_style('meetings-resources-stylesheet', get_stylesheet_directory_uri() . '/library/css/meetings-resources.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-meetings.php':
                wp_enqueue_style('meetings-stylesheet', get_stylesheet_directory_uri() . '/library/css/meetings.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-news.php':
                wp_enqueue_style('news-stylesheet', get_stylesheet_directory_uri() . '/library/css/news.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-one-col.php':
                wp_enqueue_style('one-column-stylesheet', get_stylesheet_directory_uri() . '/library/css/one-column.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-parents-club-thank-you.php':
                wp_enqueue_style('parents-club-thank-you-stylesheet', get_stylesheet_directory_uri() . '/library/css/parents-club-thank-you.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-parents-club.php':
                wp_enqueue_style('parents-club-stylesheet', get_stylesheet_directory_uri() . '/library/css/parents-club.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-partner-program.php':
                wp_enqueue_style('partner-signup-stylesheet', get_stylesheet_directory_uri() . '/library/css/partner-signup.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-partner-form.php':
                wp_enqueue_style('partner-signup-stylesheet', get_stylesheet_directory_uri() . '/library/css/partner-signup.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-press-release-index.php':
                wp_enqueue_style('press-release-index-stylesheet', get_stylesheet_directory_uri() . '/library/css/press-release-index.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-press-release.php':
                wp_enqueue_style('press-release-stylesheet', get_stylesheet_directory_uri() . '/library/css/press-release.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-room-gallery.php':
                wp_enqueue_style('room-gallery-stylesheet', get_stylesheet_directory_uri() . '/library/css/room-gallery.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-rsvp.php':
                wp_enqueue_style('rsvp-stylesheet', get_stylesheet_directory_uri() . '/library/css/rsvp.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-stories.php':
                wp_enqueue_style('stories-stylesheet', get_stylesheet_directory_uri() . '/library/css/stories.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-two-col.php':
                wp_enqueue_style('two-column-stylesheet', get_stylesheet_directory_uri() . '/library/css/two-column.min.css', array('luskin-stylesheet'), '', 'all');
                break;
              case 'template-testimonials.php':
                wp_enqueue_style('testimonials', get_stylesheet_directory_uri() . '/library/css/testimonials.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-faq.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/faq.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-explore-section.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/explore-section.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-explore-section-sub.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/explore-section-sub.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-specials-sub.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/specials-sub.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'holiday-landing-page.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/holiday-landing-page.min.css', array('luskin-stylesheet'), '', 'all');
                break;
            case 'template-specials-landingpage.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/specials_master.min.css', array('luskin-stylesheet'), '', 'all');
                break;            
            case 'template-specials-first-subpage.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/specials_master.css', array('luskin-stylesheet'), '', 'all');
                break;            
            case 'template-specials-second-subpage.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/specials_master.min.css', array('luskin-stylesheet'), '', 'all');
                break;           
            case 'template-sustainability.php':
                wp_enqueue_style('faq-stylesheet', get_stylesheet_directory_uri() . '/library/css/sustainability.min.css', array('luskin-stylesheet'), '', 'all');
                break;

            default : '';
        }

        /* **************************************************
         * ...on the gallery & room gallery template
         * **************************************************/
        if (is_page_template(array('template-gallery.php',
            'template-room-gallery.php'))) {
            wp_enqueue_style('fancybox-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/fancybox/jquery.fancybox.min.css', array(), '', 'all');
        }

        /* **************************************************
         * ...on the flipbook template
         * **************************************************/
        if (is_page_template('template-flip-book.php')) {
            wp_enqueue_style('flipbook-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/flipbook/style.min.css', array(), '', 'all');
            wp_enqueue_style('flipbook-page-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/flipbook/page-styles.min.css', array('flipbook-stylesheet'), '', 'all');
            wp_enqueue_style('luskin-flipbook-stylesheet', get_stylesheet_directory_uri() . '/library/css/flip-book.min.css', array('flipbook-page-stylesheet'), '', 'all');
        }

        /* **************************************************
         * ...on the hma opt-in template
         * **************************************************/
        if (is_page_template('template-hma.php' || 'template-partner-form.php')) {

            // layout stylesheet
            wp_enqueue_style('wforms-layout-stylesheet', '//www.tfaforms.com/form-builder/4.1.0/css/wforms-layout.css', array(), '', 'all');

            // ie8 layout stylesheet
            wp_enqueue_style('wforms-layout-ie8-stylesheet', '//www.tfaforms.com/form-builder/4.1.0/css/wforms-layout-ie8.css', array('wforms-layout-stylesheet'), '', 'all');
            $wp_styles->add_data('wforms-layout-ie8-stylesheet', 'conditional', 'if IE 8');

            // ie7 layout stylesheet
            wp_enqueue_style('wforms-layout-ie7-stylesheet', '//www.tfaforms.com/form-builder/4.1.0/css/wforms-layout-ie7.css', array('wforms-layout-stylesheet'), '', 'all');
            $wp_styles->add_data('wforms-layout-ie7-stylesheet', 'conditional', 'if IE 7');

            // ie6 layout stylesheet
            wp_enqueue_style('wforms-layout-ie6-stylesheet', '//www.tfaforms.com/form-builder/4.1.0/css/wforms-layout-ie6.css', array('wforms-layout-stylesheet'), '', 'all');
            $wp_styles->add_data('wforms-layout-ie6-stylesheet', 'conditional', 'if IE 6');

            // default stylesheet
            wp_enqueue_style('wforms-default-stylesheet', '//www.tfaforms.com/themes/get/default.css', array('wforms-layout-stylesheet'), '', 'all');

            // this stylesheet activated by javascript
            wp_enqueue_style('wforms-jsonly-stylesheet', '//www.tfaforms.com/form-builder/4.1.0/css/wforms-jsonly.css', array('wforms-default-stylesheet'), '', 'all');

            // override styles to force wforms to look like others on the site
            wp_enqueue_style('wforms-override-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/hma/style.css', array('wforms-jsonly-stylesheet'), '', 'all');

        }

        /* **************************************************
         * ...on the targeted pages
         * - contact-us
         * - mailing-list-old
         * - parents-club-signup-old
         * - request-proposal
         * - rsvp
         * **************************************************/
        if (is_page(array('contact-us',
            'mailing-list-old',
            'parents-club-signup-old',
            'request-proposal',
            'rsvp'))) {
            wp_enqueue_style('gforms-override-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/gravityforms/style.min.css', array(), '', 'all');
        }

        /* **************************************************
         * ...on the targeted pages
         * - mailing-list
         * - parents-club-signup
         * **************************************************/
        if (is_page(array('mailing-list',
            'parents-club-signup'))) {
            wp_enqueue_style('hma-forms-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/hma/style.min.css', array(), '', 'all');
        }

        /* **************************************************
         * ...on the targeted templates
         *
         * - template-accommodations-amenities
         * - template-accommodations
         * - template-dining
         * - template-meetings-floorplans
         * - template-meetings
         * - template-opt-in-thank-you
         * **************************************************/
        if (is_page_template(array('template-accommodations-amenities.php',
            'template-accommodations.php',
            'template-accommodations-suites.php',
            'template-testimonials.php',
            'template-dining.php',
            'template-meetings-floorplans.php',
            'template-meetings.php',
            'template-opt-in-thank-you.php',
            'template-hma-opt-in-thank-you.php'))) {
            // BX Slider
            //wp_enqueue_style('bxslider-stylesheet', get_stylesheet_directory_uri() . '/library/plugins/jquery.bxslider/jquery.bxslider.min.css', array(), '', 'all');
            // Lemmon Slider
            wp_enqueue_style('lemmonslider-stylesheet', get_stylesheet_directory_uri() . '/library/css/sections/slider.min.css', array(), '', 'all');
        }

        /* *********************************************************************
         * register/deregister and enqueue JAVASCRIPTS in the HEADER section
         * ********************************************************************/

        /* **************************************************
         * ...on all pages
         * **************************************************/

        // modernizr (without media query polyfill)
        wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), false, false);

        // jquery swap out; remove wordpress version of jquery and replace with a CDN hosted version that's more recent
        wp_deregister_script('jquery');
        //wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js', array('modernizr'), false, false);
        wp_enqueue_script('jquery', '//code.jquery.com/jquery-1.12.1.min.js', array('modernizr'), false, false);

        

        /* **************************************************
         * ...on the flipbook template
         * **************************************************/
        if (is_page_template('template-flip-book.php')) {
            //wp_enqueue_script('swfobject2', get_stylesheet_directory_uri() . '/library/js/libs/swfobject2.min.js', array('jquery'), false, false);
            wp_enqueue_script('jq-easing', get_stylesheet_directory_uri() . '/library/js/libs/jquery.easing.1.3.min.js', array('jquery'), false, false);
            wp_enqueue_script('jq-doubletap', get_stylesheet_directory_uri() . '/library/js/libs/jquery.doubletap.min.js', array('jquery'), false, false);
            wp_enqueue_script('jq-color', get_stylesheet_directory_uri() . '/library/js/libs/jquery.color.min.js', array('jquery'), false, false);
            wp_enqueue_script('turn', get_stylesheet_directory_uri() . '/library/js/libs/turn.min.js', array('jquery'), false, false);
            wp_enqueue_script('flipbook', get_stylesheet_directory_uri() . '/library/plugins/flipbook/flipbook.js', array('turn'), false, false);
        }

        /* **************************************************
         * ...on singular pages that allow comments
         * *************************************************/
        if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }

        /* *********************************************************************
         * register/deregister and enqueue JAVASCRIPTS in the FOOTER section
         * ********************************************************************/

        /* **************************************************
         * ...on all pages
         * **************************************************/

        // example
        //wp_enqueue_script( 'luskin-script', get_stylesheet_directory_uri() . '/library/js/some-script-file.min.js', array('jquery'), false, true );

        // remove wp-embed scripts
        wp_deregister_script( 'wp-embed' );

        /* **************************************************
         * ...on the homepage template
         * **************************************************/
        if (is_page_template('template-homepage.php')) {
            // Box Slider
            wp_enqueue_script('bxslider', get_stylesheet_directory_uri() . '/library/plugins/jquery.bxslider/jquery.bxslider.min.js', array('jquery'), false, true);
            // Homepage Scripts
            wp_enqueue_script('luskin-homepage', get_stylesheet_directory_uri() . '/library/js/hp/homepage.min.js', array('bxslider'), false, true);
        }

        /* **************************************************
         * ...on the news template
         * **************************************************/
        if (is_page_template('template-news.php')) {
            // add wp-embed scripts
            wp_enqueue_script('wp-embed', '/wp-includes//js/wp-embed.min.js', array('jquery'), false, true);
        }

        /* **************************************************
         * ...on the gallery & room gallery template
         * **************************************************/
        if (is_page_template(array('template-gallery.php',
            'template-room-gallery.php'))) {
            // Images Loaded
            wp_enqueue_script('imagesLoaded', get_stylesheet_directory_uri() . '/library/js/libs/imagesloaded.pkgd.min.js', array('jquery'), false, true);
            // Isotope
            wp_enqueue_script('isotope', get_stylesheet_directory_uri() . '/library/js/libs/isotope.pkgd.min.js', array('imagesLoaded'), false, true);
            // Fancybox
            wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/library/plugins/fancybox/jquery.fancybox.min.js', array('isotope'), false, true);
            // MediaElement
            wp_enqueue_script('mediaelement', get_stylesheet_directory_uri() . '/library/plugins/mediaelement/mediaelement-and-player.min.js', array('fancybox'), false, true);
            // Gallery Scripts
            wp_enqueue_script('luskin-gallery', get_stylesheet_directory_uri() . '/library/js/gallery/masonry-gallery.min.js', array('mediaelement'), false, true);
        }

        // /* **************************************************
        //  * ...on the targeted templates
        //  *
        //  * - template-accommodations-amenities
        //  * - template-accommodations
        //  * - template-dining
        //  * - template-meetings-floorplans
        //  * - template-meetings
        //  * - template-opt-in-thank-you
        //  * - template-hma-opt-in-thank-you
        //  * **************************************************/
        if (is_page_template(array('template-accommodations-amenities.php',
            'template-accommodations.php',
            'template-accommodations-suites.php',
            'template-testimonials.php',
            'template-dining.php',
            'template-meetings-floorplans.php',
            'template-meetings.php',
            'template-opt-in-thank-you.php',
            'template-hma-opt-in-thank-you.php'))) {
            // Box Slider
            wp_enqueue_script('bxslider', get_stylesheet_directory_uri() . '/library/plugins/jquery.bxslider/jquery.bxslider.min.js', array('jquery'), false, true);
            // Lemmon Slider
            wp_enqueue_script('lemmon-slider', get_stylesheet_directory_uri() . '/library/plugins/lemmon-slider/lemmon-slider.min.js', array('jquery'), false, true);
            // Luskin Customized Lemon Slider
            wp_enqueue_script('luskin-lemmon-slider', get_stylesheet_directory_uri() . '/library/js/slider/slider.min.js', array('lemmon-slider'), false, true);

        }

        /* **************************************************
         * ...on the targeted pages by name/slug/id:
         *
         * - "Request for Proposal" @ /request-proposal/
         * **************************************************/
        if (is_page(array('request-proposal'))) {
            // form step
            wp_enqueue_script('form-step', get_stylesheet_directory_uri() . '/library/js/forms/form-step.min.js', array('jquery'), false, true);
        }

        /* **************************************************
         * ...on the targeted pages by name/slug/id:
         *
         * - "Join Our Email List" @ /mailing-list/
         * - "Join the Luskin Conference Center Family Club Today!" @ /parents-club-signup/
         * **************************************************/
        if (is_page(array('mailing-list',
            'parents-club-signup', 'partner-form'))) {
            // form processing scripts
            wp_enqueue_script('wforms', '//www.tfaforms.com/wForms/3.7/js/wforms.js', array(), false, true);
            wp_enqueue_script('wforms-localization', '//www.tfaforms.com/wForms/3.7/js/localization-en_US.js', array('wforms'), false, true);
        }

    }

    // admin/control panel
    if (is_admin()) {

        /* *********************************************************************
         * register/deregister and enqueue STYLES in the HEADER section
         * ********************************************************************/

        /* load the lato font from google fonts - this is a modification of a
        function found in the twentythirteen theme where we can declare some
        external fonts. If you're using Google Fonts, you can replace these
        fonts, change it in your scss files and be up and running in seconds. */
        wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic', array(), false, false);

        /* *********************************************************************
         * register/deregister and enqueue JAVASCRIPTS in the HEADER section
         * ********************************************************************/

        // wp_enqueue_script('script-name', get_stylesheet_directory_uri() . '/library/js/script.min.js', array('jquery'), false, false);

        /* *********************************************************************
         * register/deregister and enqueue JAVASCRIPTS in the FOOTER section
         * ********************************************************************/

        // wp_enqueue_script('script-name', get_stylesheet_directory_uri() . '/library/js/script.min.js', array('jquery'), false, true);

    }

}

function luskinLoadScriptsLast()
{
    // luskin general scripts
    wp_enqueue_script('luskin-general', get_stylesheet_directory_uri() . '/library/js/scripts.min.js', array(), false, true);
}

/* *****************************************************************************
 * THEME SUPPORT
 * ****************************************************************************/

// adding wp 3+ functions & theme support after theme setup
function luskinThemeSupport()
{

    // wp menus
    add_theme_support('menus');

    // wp thumbnails (sizes handled in functions.php)
    // Note: To enable featured images, the current theme must include
    // "add_theme_support( 'post-thumbnails' );".
    // See also Post Thumbnails https://codex.wordpress.org/Post_Thumbnails
    add_theme_support( 'post-thumbnails' );

    // set the default Featured Image (formerly Post Thumbnail) dimensions
    set_post_thumbnail_size(100, 100, true);

    // wp custom background (thx to @bransonwerner for update)
    // add_theme_support('custom-background',
    //     array(
    //         'default-image' => '', // background image default
    //         'default-color' => '', // background color default (dont add the #)
    //         'wp-head-callback' => '_custom_background_cb',
    //         'admin-head-callback' => '',
    //         'admin-preview-callback' => '',
    //     )
    // );

    // rss thingy
    add_theme_support('automatic-feed-links');

    // adding post format support
    add_theme_support('post-formats',
        array(
            'aside', // title less blurb
            'gallery', // gallery of images
            'link', // quick link to other site
            'image', // an image
            'quote', // a quick quote
            'status', // a Facebook like status update
            'video', // video
            'audio', // audio
            'chat', // chat transcript
        )
    );

    // registering wp3+ menus
    register_nav_menus(
        array(
            'main-nav' => __('Primary Nav', 'luskintheme'),
            'footer-links' => __('Secondary Nav', 'luskintheme'),
            'sub-footer-links' => __('Tertiary Nav', 'luskintheme'),
        )
    );

    // enable support for HTML5 markup.
    add_theme_support('html5', array(
        'comment-list',
        'search-form',
        'comment-form',
    ));

} /* end theme support */

/* *****************************************************************************
 * ACTIVE SIDEBARS
 * ****************************************************************************/

// adding sidebars & widgetizes areas
function luskinRegisterSidebars()
{
    register_sidebar(array(
        'id' => 'sidebar-right',
        'name' => __('Right Sidebar', 'luskintheme'),
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'luskintheme'),
        // 'before_widget' => '<div id="%1$s" class="widget %2$s">',
        // 'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title"><span class="widget-icon"></span>',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-footer-first',
        'name' => __('Footer First Position', 'luskintheme'),
        'description' => __('Widgets in this area will be shown on all posts and pages within the footer within the first position (i.e., left outside).', 'luskintheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title"><span class="widget-icon"></span>',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-footer-second',
        'name' => __('Footer Second Position', 'luskintheme'),
        'description' => __('Widgets in this area will be shown on all posts and pages within the footer within the second position (i.e., left inside).', 'luskintheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title"><span class="widget-icon"></span>',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-footer-third',
        'name' => __('Footer Third Position', 'luskintheme'),
        'description' => __('Widgets in this area will be shown on all posts and pages within the footer within the third position (i.e., right inside).', 'luskintheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title"><span class="widget-icon"></span>',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-footer-forth',
        'name' => __('Footer Forth Position', 'luskintheme'),
        'description' => __('Widgets in this area will be shown on all posts and pages within the footer within the forth position (i.e., right outside).', 'luskintheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title"><span class="widget-icon"></span>',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-sub-footer',
        'name' => __('Sub Footer', 'luskintheme'),
        'description' => __('Widgets in this area will be shown on all posts and pages below the footer (i.e., the very bottom).', 'luskintheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title"><span class="widget-icon"></span>',
        'after_title' => '</h5>',
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
} /* end sidebars & widgetizes areas */


// Enable Scripts and Shortcodes in WordPress Text Widgets
function php_text($text) {
    if (strpos($text, '<' . '?') !== false) {
        ob_start();
        eval('?' . '>' . $text);
        $text = ob_get_contents();
        ob_end_clean();
    }
    return $text;
}

/* *****************************************************************************
 * RANDOM CLEANUP ITEMS
 * ****************************************************************************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function luskinFilterPtagsOnImages($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// remove the annoying […] to a read more link
function luskinExcerptMore($more)
{
    global $post;
    // edit here if you like
    return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read ', 'luskintheme') . esc_attr(get_the_title($post->ID)) . '">' . __('Read more &raquo;', 'luskintheme') . '</a>';
}
