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
                        <div id="featured">

</div>
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
            <nav class="navigation post-navigation" role="navigation">
        <h2 class="screen-reader-text">Continue Reading</h2>
        <div class="nav-links"><div class="nav-previous"><a href="http://themes.89elements.com/definity/opfl/2017/07/02/blog-post-example-2/" rel="prev"><span class="linea-arrows-slim-left"></span> previous post</a></div><div class="nav-next"><a href="http://themes.89elements.com/definity/opfl/2017/07/02/blog-post-example-3/" rel="next">next post <span class="linea-arrows-slim-right"></span></a></div></div>
    </nav>
<?php
$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
$pages = array();
foreach ($pagelist as $page) {
   $pages[] += $page->ID;
}

$current = array_search(get_the_ID(), $pages);
$prevID = $posts[$current-1];
$nextID = $posts[$current+1];
?>


<div class="container clearfix news-pagination">
<?php if (!empty($prevID)) { ?>
<div class="align-left">
<a href="<?php echo get_permalink($prevID); ?>"
  title="<?php echo get_the_title($prevID); ?>"><< Previous</a>
</div>
<?php }
if (!empty($nextID)) { ?>
<div class="align-right">
<a href="<?php echo get_permalink($nextID); ?>" 
 title="<?php echo get_the_title($nextID); ?>">Next >></a>
</div>
<?php } ?>
</div><!-- .navigation -->>



<div class="container clearfix news-pagination"> <span class="align-left"><a href="<?php next_post_link( '&laquo; Older Entries' ) ?>">Previous Article</a></span><span class="align-right"><a href="<?php previous_post_link( 'Newer Entries &raquo;' ) ?>">Next Article ≫</a></span> </div>


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
