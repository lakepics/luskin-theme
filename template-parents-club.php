<?php
/*
 * Template Name: Parents Club Sign-up
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php show_hero_slides(); ?>
			<?php
			  	$section_heading = get_field('page_sub_head');
				if ($section_heading) {
					echo '<div class="container clearfix parents"><h2>' . $section_heading . '</h2></div>';
					}			
				$section_content = get_field('sub_head_columns');
					if ($section_content) {
					echo '<div class="container clearfix res-columns">' . $section_content . '</div>';	
					}
            ?>
        <!-- Begin Page Content -->
		<div class="container clearfix parents top-30">
              <?php
				echo '<div class="two-columns container clearfix">';
				$columns = get_field('columns');
				if( $columns[0]['left_column'] ){
					echo '<div class="column left-column"><h2>' . $columns[0]['left_column_header'] . '</h2>'. $columns[0]['left_column'] .'</div>';
				}
				if( $columns[0]['right_column'] ){
					echo '<div class="column right-column"><h2>' . $columns[0]['right_column_header'] . '</h2>'. $columns[0]['right_column'] .'</div>';
				}
				echo '</div>';
				?>
            </div>		
		</div>
        <div class="container clearfix parents top-30">
        	<div class="about-buttons"><a href="/family-club-signup/" class="button">Sign up today!</a></div>
        </div>
		<div class="container clearfix"><br><br>

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>