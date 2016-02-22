<?php
/*
 * Template Name: Accomodations - Suites
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php
		show_hero_slides();
		?>
        <div class="container clearfix">
        	<div class="intro-copy bottom-30">
        <?php
		$intro_copy = get_field('intro_copy');
		if ($intro_copy) { echo $intro_copy; }
		?>
            </div>
        </div>
        <?php

		$page_content = get_field('two-to-one');
		if( $page_content ){
		?>
		<div class="guest-services amenities">
			<div class="container clearfix">
				<div class="page-col-twothird">
					<?php echo $page_content[0]['content']; ?>
				</div>
				<div class="page-col-onethird">
                    <h2>
                    <?php $amenities_header = get_field('amenities_header');
                        if ($amenities_header) { echo $amenities_header; } ?>
                    </h2>
                        <?php
                        $page_content[0]['amenities'];
                        foreach ( $page_content[0]['amenities'] as $service ){
                                echo '<div class="service '. create_slug($service['icon']) .'"><span class="service-name"><span>'. $service['title'] .'</span></span></div>';
                        }
                        ?>
                    </div>
			</div>
		</div>
		<?php
		}
		?>

		<div class="room-types">
			<div class="room-type-container clearfix">
				<?php $section_title = get_field('section_title'); 
                    if ($section_title) {
                        echo '<h2 class="section-title">' . $section_title . '</h2>';
                        }                    
				$rooms = get_field('room_types');
				//d($rooms);
				$room_count = 0;
				foreach ( $rooms as $room ){
					echo '<div class="room-col-thirds">';
						if( $room['content'] ){
							echo '<div class="content">'. $room['content'] .'</div>';
						}
						if( $room['image'] ){
								echo '<img src="'. $room['image'] .'" alt="" />';
						}
					echo '</div>';
					$room_count++;
				}
				?>
				<div class="room-types-mobile">
				<?php 
				$room_count = 0;
				foreach ( $rooms as $room ){
					if( $room_count == 0 ){
						echo '<div class="room-type-div first">';
					} elseif( $room_count == 1 ){
						echo '<div class="room-type-div second">';
					} elseif( $room_count == 2 ){
						echo '<div class="room-type-div third">';
					} else {
						echo '<div class="room-type-div">';
					}
						echo '<div class="room-type-div-toggle-trigger">';
							if( $room['content'] ){
								echo '<div class="content">'. $room['content'] .'</div>';
							}
						echo '</div>';
					
						echo '<div class="room-type-div-toggle">';
							if( $room_count == 2 ){
								if( $room['content'] ){
									echo '<div class="content">'. $room['content'] .'</div>';
								}
							} else {
								if( $room_count != 2 ){
									if( $room['image'] ){
										echo '<img src="'. $room['image'] .'" alt="" />';
									}
								}
							}
							
						echo '</div>';
						
					echo '</div>';
					$room_count++;
				}
				?>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /main content -->

<?php get_footer(); ?>