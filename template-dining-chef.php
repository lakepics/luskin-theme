<?php
/*
 * Template Name: Dining - Chef
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <div class="container clearfix">
            <div class="intro-copy bottom-30">
        <?php
$intro_copy = get_field( 'intro_copy' );
if ( $intro_copy ) { echo $intro_copy; }
?>
            </div>
        </div>
        <?php

$page_content = get_field( 'two-to-one' );
if ( $page_content ) {
?>
        <div class="guest-services amenities">
            <div class="container clearfix">
                <div class="page-col-twothird">
                    <?php if ($page_content[0]['left_column']) { echo $page_content[0]['left_column']; }?>
                </div>
                <div class="page-col-onethird">
                     <?php if ($page_content[0]['right_column']) { echo $page_content[0]['right_column']; }?>
                </div>
            </div>
        </div>
        <?php
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
