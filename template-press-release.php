<?php
/*
 * Template Name: Press Release 
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post();
            
            echo '<div id="press-release" class="container press-release-heading">';
            if ( get_field('page_heading') ) {
                $page_heading = get_field('page_heading');
                echo '<h2 class="bottom-30">' . $page_heading . '</h2>';
            }
            if ( get_field('body') ) {
                $press_release_body = get_field('body');
                echo '<div class="container clearfix press-release-body">';
                echo $press_release_body;
                }
            if ( get_field('media_links') ) {
                $media = get_field('media_links');
                echo '<h3 class="text-align-left">Attachments</h3><ul class="clearfix bottom-30">';
                foreach ( $media as $attachment ) {
                    echo '<li><a href="' . $attachment['url'] . '">'. $attachment['title'] . '</a>';    
                    } 
                echo '</ul>';
                }
                echo '<a href="/press-releases/">Back to Press Release Index</a></div>
                </div>
                <div class="container clearfix"></div><br><br>';
        
        endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>