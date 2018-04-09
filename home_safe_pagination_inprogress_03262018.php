<?php get_header(); ?>

<div id="main-content" class="blog-index" role="main">

    <div class="blog-ribbon">
        <div class="container clearfix"><span class="blog-issue"><?php custom_breadcrumbs(); ?></span></div>
    </div>
    <div class="container  clearfix">
        <div class="blog-content page-col-twothird">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php query_posts('posts_per_page=6'); /*1, 2*/
            if ( has_post_thumbnail() ) : ?>
            <article class="blog-post">
                <div <?php post_class( 'post-listing' ) ?> id="post-
                    <?php the_ID(); ?>">
                    <div class="blog-post-single">
                        <a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('full'); ?>
                        </a>
                        <div class="bp-content">
                            <div class="post-meta">
                                <div class="post-date">
                                    <span><?php the_time('F j, Y') ?></span>
                                </div>
                            </div>
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title();?>
                                </a>
                            </h2>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                            <p><a class="button read-more-btn" href="<?php the_permalink(); ?>">Read More</a></p>
                        </div>
                    </div>
                </div>
            </article>

            <!-- blog-post -->
            <?php endif; ?>



            <?php wp_reset_query(); ?>
            <?php endwhile; ?>

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


    <?php
// Previous/next page navigation.
the_posts_pagination( array(
    'prev_text'          => __( 'Previous page', 'luskintheme' ),
    'next_text'          => __( 'Next page', 'luskintheme' ),
    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'luskintheme' ) . ' </span>',
) );
?>

    <!-- Paginiation for posts-->
    <?php if ( get_next_posts_link() ) : ?>
    <div class="container clearfix news-pagination">
        <span class="align-left"><a href="<?php next_posts_link( 'Older posts' ); ?>">Previous Article</a></span>
        <span class="align-right"><a href="<?php previous_posts_link( 'Newer posts' ); ?>">Next Article ≫</a></span>
    </div>
  <?php endif; ?>

</div>


    <?php else : ?>
    <div class="hentry post">
        <h2 class="entry-title">Not Found</h2>
        <div class="entry-content">
            <p>Sorry, but you are looking for something that isn't here.</p>
        </div>
        <?php get_search_form(); ?>
    </div>
    <?php endif; ?>

</div>
<!-- /main content -->

<?php get_footer(); ?>
