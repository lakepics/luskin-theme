<?php get_header(); ?>

<div id="main-content test" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div <?php post_class( 'post-listing' ) ?> id="post-<?php the_ID(); ?>">
                <div class="clearfix">
                    <div class="post-date">
                        <div class="month"><?php the_time( M ) ?></div>
                        <div class="day"><?php the_time( j ) ?></div>
                    </div>
                    <h2 class="entry-title">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
                <div class="xcertp-line clearfix">
                    <div class="entry-content xcerpt">
                        <?php if ( $post->post_excerpt ) { the_excerpt();
} else {
    the_excerpt();
} ?>
                    </div>
                </div>
                <div class="entry-meta clearfix">
                    <p class="no-of-comments"><?php comments_popup_link( '0 Comments ', '1 Comment ', '% Comments ' ); ?> |&nbsp;</p>
                    <p class="post-link"> <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">View Post</a></p>
                </div>
                <div class="tags"><?php the_tags( 'Tags: ', ', ', '<br />' ); ?></div>
            </div>

        <?php endwhile; ?>

        <div class="navigation">
            <?php if ( function_exists( 'wp_pagenavi' ) ) { ?>
                <?php wp_pagenavi(); ?>
            <?php } else { ?>
                <div class="nav-previous"><?php next_posts_link( '&laquo; Older Entries' ) ?></div>
                <div class="nav-next"><?php previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
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

</div><!-- /main content -->

<?php get_footer(); ?>
