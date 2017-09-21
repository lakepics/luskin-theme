<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="distribution" content="global" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title><?php wp_title( '-', true, 'right' ) ?><?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>
</head>
<?php
if ( !is_front_page() ) {
    $not_front = "not-frontpage";
} else {
    $not_front = "frontpage";
}
?>
<body <?php body_class( $not_front ); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PM45X6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- must remove the google_gtm_code_snippet from Dever server, important -->
<?php the_field( 'google_gtm_code_snippet', 'option' ); ?>

    <div class="mobile-navigation">
        <a href="/" class="logo-ucla-mobile"><img src="<?php bloginfo( 'stylesheet_directory' );?>/library/images/ucla-logo-mobile.png" alt="UCLA" /></a>
        <div class="mobile-room-reservation">
            <span class="mobile-room-label">Toll Free</span>
            <a class="mobile-room-phone" href="tel:<?php the_field( 'room_reservation_no_spaces', 'option' ); ?>"><?php the_field( 'room_reservation_special', 'option' ); ?> (<?php the_field( 'room_reservation', 'option' ); ?>)</a>
        </div>
    </div>

    <ul class="visuallyhidden accessibility_nav">
        <li>
            <a href="#main-content">Skip to main content</a>
        </li>
    </ul>

    <div id="container">

        <noscript>
            <p class="alert-info">You have <a href="//www.google.com/support/bin/answer.py?answer=23852">JavaScript disabled</a> or are viewing the site on a device that does no support JavaScript.Some features may not work properly.</p>
        </noscript>

        <header id="header">
            <div class="container clearfix">
                <div id="navbar" class="navbar">
                <span id="toggle-menu">Menu</span>
                    <div id="logo-lockup">
                        <a href="<?php bloginfo( 'url' );?>" id="logo"><img src="<?php bloginfo( 'stylesheet_directory' );?>/library/images/logo.png" alt="<?php bloginfo( 'name' );?>" /></a>
                        <nav id="site-navigation" class="navigation main-navigation">
                        <?php wp_nav_menu( array( 'menu' => 'main_menu', 'container' => '', 'menu_id' => 'main-navigation', 'menu_class' => 'menu nav-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                        </nav>
                    </div>
                </div>
            </div>
        </header>


        <?php

if ( !is_front_page() ) {

    if ( get_field( 'slides' ) ) {

        $slides = get_field( 'slides' );

        $contentWrapper = '<div id="content" data-slides="true">';

    } else {

        $contentWrapper = '<div id="content" class="no-hero" data-slides="false">';

    }

} else {

    $contentWrapper = '<div id="content" class="front-page">';

}

echo $contentWrapper;

?>

        <!--// END HEADER //-->

        <!--// BEGIN PAGE //-->
