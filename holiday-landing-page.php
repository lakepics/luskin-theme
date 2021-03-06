<?php
/*
 * Template Name: Holiday Landing Page
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
    // check for rows (parent repeater)
    if( have_rows('two-to-one') ): ?>
<?php 

    // loop through rows (parent repeater)
    while( have_rows('two-to-one') ): the_row(); ?>
<div class="guest-services amenities top-30">
    <div class="container clearfix">
        <div class="page-col-twothird">
            <?php the_sub_field('content'); ?>
        </div>
        <div class="page-col-onethird">
            <?php 

    // check for rows (sub repeater)
    if( have_rows('photos') ): ?>
            <?php 

        // loop through rows (sub repeater)
        while( have_rows('photos') ): the_row();

            // display each item as a list - with a class of completed ( if completed )
            ?>
            <div class="square-img">
                <img src=" <?php the_sub_field('image'); ?>">
            </div>
            <?php endwhile; ?>
            <?php endif; //if( get_sub_field('items') ): ?>
        </div>
    </div>
    <?php endwhile; // while( hass_sub_field('to-do_lists') ): ?>
    <?php endif; // if( get_field('to-do_lists') ): ?>
    <?php endwhile; ?>
    <?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>
