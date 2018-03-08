<?php
/*
 * Template Name: Blog Index
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php showHeroSlides(); ?>
        <div class="container clearfix">

        </div>
            <div <?php post_class( 'post-listing' ) ?> id="post-<?php the_ID(); ?>">
                <div class="container  clearfix">
            <div class="blog-content page-col-twothird"><h1>Blog</h1>
                    <?php 
                    // the query
                    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>
                     
                    <?php if ( $wpb_all_query->have_posts() ) : ?>
                     
                    <ul>
                     
                        <!-- the losop -->
                        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                        <!-- end of the loop -->
                     
                    </ul>
                     
                        <?php wp_reset_postdata(); ?>
                     
                    <?php else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
</div>
                    <!-- Sidebar right -->
                    <div class="page-col-onethird news-sidebar-content">
                        <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
                            <div id="blog-sidebar" class="" role="complementary">
                            <?php dynamic_sidebar( 'blog-sidebar' ); ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <!-- sidebar end -->
                </div>
            </div>

        <div class="navigation">
            <?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
                <?php wp_pagenavi(); ?>
            <?php } else { ?>
                <div class="nav-previous"><a href="<?php next_posts_link( '&laquo; Older Entries' ) ?>">Back</a></div>
                <div class="nav-next"><a href="<?php previous_posts_link( 'Newer Entries &raquo;' ) ?>">Next</a></div>
            <?php } ?>
        </div>


                <?php endwhile; ?>

    <?php else : ?>
        <div class="hentry post">
            <h2 class="entry-title">Not Found</h2>
            <div class="entry-content">
                <p>Sorry, but you are looking for something that isn't here.</p>
            </div>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
