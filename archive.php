<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */


  get_header();  ?>


    <div id="main-content" role="main">
        <?php if ( have_posts() ) : ?>
        <div class="blog-ribbon">
            <div class="container clearfix"><span class="blog-issue"><?php custom_breadcrumbs(); ?></span></div>
        </div>
        <div class="container  clearfix">
            <div class="blog-content page-col-twothird">

                <?php while ( have_posts() ) : the_post(); ?>
                <div class="blog-post">
                    <div <?php post_class( 'post-listing' ) ?> id="post-
                        <?php the_ID(); ?>">
                        <div class="blog-post-single">
                            <a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="xcertp-line clearfix">
                                <div class="entry-content xcerpt">


                                    <?php the_content(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
    </div>

    </div>

    <div class="container  clearfix">

    <span class="align-left"><a href="<?php next_post_link( '&laquo; Older Entries' ) ?>">Previous Article</a></span><span class="align-right"><a href="<?php previous_post_link( 'Newer Entries &raquo;' ) ?>">Next Article ≫</a></span> </div>
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
