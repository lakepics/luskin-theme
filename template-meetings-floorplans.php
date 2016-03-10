<?php
/*
 * Template Name: Meetings - Floor Plans
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

		<?php showHeroSlides();

$intro_text = get_field( 'intro_copy' );
if ( $intro_text ) {
	echo '<div class="two-columns container clearfix">';
	$page_sub_head = get_field( 'intro_h2' );
	if ( $page_sub_head ) {
		echo '<h2>' . $page_sub_head . '</h2>';
	}
	echo '<div class="res-content res-columns">'. $intro_text .'</div>';
	echo '</div>';
}
?>
        <div class="container clearfix top-30"></div>
		<?php
$floorplan = get_field( 'floor_plan' );
if ( $floorplan ) {
?>
		<div class="top-30">
			<div class="clearfix">
			<?php $section_title = get_field( 'floorplan_h2' );
	if ( $section_title ) {
		echo '<h2 class="floorplan-heading">' . $section_title . '</h2>';
	}
?>

        <div class="lemmonslider floorplan-slider clearfix">
			<div id="floorplan-slider" class="slider">
				<ul>
				<?php
	foreach ( get_field( 'separator_images' ) as $image ) {
		if ( $image['image'] ) {
			echo '<li><h2 class="subhead">' . $image['floor_plan_heading'] . '</h2><img src="'. $image['image'] .'" alt="" /></li>';
		}
	}
?>
				</ul>
			</div>
			<div class="controls">
				<a href="#" class="prev-slide">Prev Slide</a>
				<a href="#" class="next-slide">Next Slide</a>
			</div>
		</div>
		<div class="container clearfix bottom-30 top-30">
        	<?php
	$capacity_table = get_field( 'capacity_table' );
	if ( $capacity_table ) {
		echo $capacity_table;
	}
?>
		</div>
        <div class="container clearfix top-30">
        </div>
		<?php
}
?>

		<?php endwhile; ?>

	<?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
