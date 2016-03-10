<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-content">
                    <?php the_content( 'Read the rest of this entry &raquo;' ); ?>
                </div>
                <div class="entry-meta"><?php the_tags( 'Tags: ', ', ', '<br />' ); ?> Posted in <?php the_category( ', ' ) ?> | <?php edit_post_link( 'Edit', '', ' | ' ); ?>  <?php comments_popup_link( 'No Comments &#187;', '1 Comment &#187;', '% Comments &#187;' ); ?></div>
                <?php comments_template(); ?>
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

        <div <?php post_class() ?>>
            <h1 class="entry-title">Not Found</h1>
            <div class="entry-content">
                <p>Sorry, but you are looking for something that isn't here.</p>
            </div>
            <?php get_search_form(); ?>
        </div>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
