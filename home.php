<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php showHeroSlides(); ?>
    <div class="blog-ribbon">
        <div class="container clearfix"><span class="blog-issue"><?php custom_breadcrumbs(); ?></span></div>
    </div>
    <div class="container clearfix">
        <h1>Blog</h1>
    </div>
    <div class="container  clearfix">
        <div class="blog-content page-col-twothird test">
    <div <?php post_class( 'post-listing' ) ?> id="post-
        <?php the_ID(); ?>">
                <?php query_posts('posts_per_page=12'); /*1, 2*/
            if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <?php if ( has_post_thumbnail() ) : ?>
                <article class="blog-post">
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
                </article>
        </div>
                <!-- blog-post -->
                <?php endif; ?>
                <?php endwhile; ?>

                <div class="nav-previous alignleft">
                    <?php next_posts_link( 'Older posts' ); ?>
                </div>
                <div class="nav-next alignright">
                    <?php previous_posts_link( 'Newer posts' ); ?>
                </div>
                <?php wp_reset_query(); ?>
                <!-- Add the pagination functions here. -->
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
    <div class="navigation">
        <?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
        <?php wp_pagenavi(); ?>
        <?php } else { ?>
        <div class="nav-previous">
            <?php next_posts_link( '&laquo; Older Entries' ) ?>
        </div>
        <div class="nav-next">
            <?php previous_posts_link( 'Newer Entries &raquo;' ) ?>
        </div>
        <?php } ?>
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
