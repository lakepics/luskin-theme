<?php
/*
 * Template Name: Featured Article
 * Template Post Type: post, page, product
 */



 get_header();  ?>


    <div id="main-content" role="main">
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="blog-ribbon">
            <div class="container clearfix"><span class="blog-issue"><?php custom_breadcrumbs(); ?></span></div>
        </div>


        <div <?php post_class( 'post-listing' ) ?> id="post-
            <?php the_ID(); ?>">
            <div class="container  clearfix">
                <div class="blog-content page-col-twothird">
                    <div class="blog-post-individual">
                        <div class="bp-content">
                            <div class="blog-post-single">
                                <a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                                <div class="post-meta">
                                    <div class="post-date">
                                        <span><?php the_time('F j, Y') ?></span>
                                    </div>
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                </div>
                                <div class="xcertp-line clearfix">
                                    <div class="entry-content xcerpt">
                                        <?php if ( $post->post_excerpt ) { the_content();
                                  } else {

                                        the_content();
                                    } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-meta-footer">
                        <div class="blog-post-categories"><span class="span-title">Categories: </span>
                            <?php the_category('<span class="blog-space">&#47;</span>'); ?></div>
                        <div class="blog-post-tags"><span>Tags:</span>
                            <?php the_tags( '', '' ); ?>
                        </div>
                    </div>
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

    </div>
    <!-- /main content -->

    <?php get_footer(); ?>
