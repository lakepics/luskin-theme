<?php
/*
 * Template Name: RSVP
 */
?>
<?php get_header('rsvp'); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <div <?php post_class('container') ?> id="page-<?php the_ID(); ?>">

                <div class="entry-content">
                    <img src="/wp-content/themes/luskin/library/images/retirement_rsvp_header.jpg" id="retirement_head_img">
                    <?php the_content(); ?>
                    <img src="/wp-content/themes/luskin/library/images/retirement_rsvp_footer.jpg" id="retirement_foot_img">
                </div>

            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer('rsvp'); ?>