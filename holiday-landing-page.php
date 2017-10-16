<?php
/*
 * Template Name: Holiday Landing Page
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
    <?php if (get_field('slides')) {
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
                        $issue = get_field('issue');
            echo '<div class="container">';
            echo '<div class="text-overlay">' . $page_heading . '</div>';
            echo '</div>';
            if ($issue) {
            echo '<div class="news-ribbon"><div class="container"><span class="news-issue">' . $issue . '</span></div></div>';
        }
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
    } ?>
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
        <div class="container clearfix news-pagination">

        <?php
$previous = get_field( 'previous_article' );
$next = get_field( 'next_article' );
if ( $previous ) {
    echo '<span class="align-left"><a href="' . $previous[0]['article_link'] . '">&#8810; Previous Article</a></span>';
}
if ( $next ) {
    echo '<span class="align-right"><a href="' . $next[0]['article_link'] . '">Next Article &#8811;</a></span>';
}
?>
    <?php endwhile; // while( hass_sub_field('to-do_lists') ): ?>
    <?php endif; // if( get_field('to-do_lists') ): ?>
    <?php endwhile; ?>
    <?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>
