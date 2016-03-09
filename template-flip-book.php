<?php
/*
 * Template Name: Flip Book
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

        <div <?php post_class('container') ?> id="page-<?php the_ID(); ?>">

            <div class="entry-content">
                <?php $flipbook = get_field('content'); echo $flipbook; ?>
            </div>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
