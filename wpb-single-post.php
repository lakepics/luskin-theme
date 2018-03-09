<?php
/*
 * Template Name: Featured Article
 * Template Post Type: post, page, product
 */
  


 get_header();  ?>


<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div <?php post_class( 'post-listing' ) ?> id="post-<?php the_ID(); ?>">
                <div class="container  clearfix">
                	<div class="blog-content page-col-twothird">
                        <div class="post-date">
                            <div class="month"><?php the_time( M ) ?></div>
                            <div class="day"><?php the_time( j ) ?></div>
                        </div>
                        <h2 class="entry-title">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h2>
                            <div class="xcertp-line clearfix">
                                <div class="entry-content xcerpt">
                                    <?php if ( $post->post_excerpt ) { the_excerpt();
                                    } else {
                                        the_excerpt();
                                    } ?>
                                </div>
                            </div>
                        <div class="tags"><?php the_tags( 'Tags: ', ', ', '<br />' ); ?></div>
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
<div class="container clearfix news-pagination"> <span class="align-left"><a href="https://luskin-dev.hhs.ucla.edu/hedy-jj-sales-team-1115/">≪ Previous Article</a></span><span class="align-right"><a href="https://luskin-dev.hhs.ucla.edu/planner-buzz-082115/">Next Article ≫</a></span> </div>
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
