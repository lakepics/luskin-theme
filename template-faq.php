<?php
/*
 * Template Name: FAQ - Template
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php
$intro_text = get_field( 'intro_copy' );
if ( $intro_text ) {
    echo '<div class="two-columns container clearfix">';
    $page_sub_head = get_field( 'page_sub_head' );
    if ( $page_sub_head ) {
        echo '<h1>' . $page_sub_head . '</h1>';
    }
    echo '<div class="res-content bottom-30">'. $intro_text .'</div>';
    echo '</div>';
}
?>

<?php 
	// check for rows (parent repeater)
	if( have_rows('question') ): ?>

	<?php 

	// loop through rows (parent repeater)
	while( have_rows('question') ): the_row(); ?>
			<section class="two-columns container clearfix faqpage" style="
    padding-bottom: 40px;
">
	<div class="faqpage__block">
		<h2 class="faqpage__block--main_heading" style="margin-top:15px;margin-bottom: 30px;">
			<?php the_sub_field('main-heading'); ?>
		</h2>
	<?php 

	// check for rows (sub repeater)
	if( have_rows('faq') ): ?>
	<?php 

		// loop through rows (sub repeater)
		while( have_rows('faq') ): the_row();

			// display each item as a list - with a class of completed ( if completed )
			?>			<div class="faqpage__block--entry" style="margin-bottom:30px;">					
					<h3 class="faqpage__block--entry-question" style="font-family: Proxima Nova SemiBold;margin-bottom: 5px;"><?php the_sub_field('heading'); ?></h3>
					<p class="faqpage__block--entry-answer"><?php the_sub_field('paragraph'); ?></p>
</div>
		<?php endwhile; ?>

	<?php endif; //if( get_sub_field('items') ): ?>
</div>
</section>
	<div class="quick-facts container clearfix" style="padding-bottom:40px;"></div>
	<?php endwhile; // while( has_sub_field('to-do_lists') ): ?>
<?php endif; // if( get_field('to-do_lists') ): ?>


        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
