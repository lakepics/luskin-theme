<?php
/*
 * Template Name: Testimonials
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

        <div id="testimonials">

        <?php
$testimonial = get_field( "testimonial" );

if ( $testimonial ) {
    foreach ( $testimonial as $entry ) {
                echo '<div class="clearfix container">';
					echo '<div class="clearfix entry" style="margin-bottom:0px !important;">';
						echo '<img class="client-img" src="'. $entry['client_image'] .'" alt="' . $entry['client_name'] . '" />';
						echo '<h3 class="client-contact">' . $entry['client_contact'] . '</h3>';
						echo '<div class="client-title">' . $entry['client_contact_title'] . '</div>';
						echo '<div class="client-name">' . $entry['client_name'] . '</div>';
						echo '<div class="testimonial" style="padding-top:20px;padding-bottom:40px;">' . $entry['testimonial'] . '</div>';
                    echo '</div>';
                echo '</div>';
        echo '<div class="quick-facts container clearfix" style="padding-bottom:40px;"></div>';
            }
        }
?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
