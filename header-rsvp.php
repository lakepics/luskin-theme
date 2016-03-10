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
<?php wp_head(); ?></head>
<?php
if ( !is_front_page() ) {
    $not_front = "not-frontpage";
} else {
    $not_front = "frontpage";
}
?>
<body <?php body_class( $not_front ); ?>>

<?php the_field( 'google_gtm_code_snippet', 'option' ); ?>

    <div id="container">

        <noscript>
            <p class="alert-info">You have <a href="//www.google.com/support/bin/answer.py?answer=23852">JavaScript disabled</a> or are viewing the site on a device that does no support JavaScript.Some features may not work properly.</p>
        </noscript>

        <?php if ( !is_front_page() ): ?>

        <div id="content">

        <?php endif; ?>
