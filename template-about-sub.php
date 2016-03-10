<?php
/*
 * Template Name: About - Subpage
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php $intro_text = get_field( 'intro_text' );
if ( $intro_text ) {
    echo '<div class="two-columns container clearfix">';
    $intro_text_heading = get_field( 'intro_text_heading' );
    if ( $intro_text_heading ) {
        echo '<h2>' . $intro_text_heading . '</h2>';
    }
    echo '<div class="res-content res-columns">'. $intro_text .'</div>';
    echo '</div>';
}
?>

        <?php
$attraction_section = get_field( 'attraction_section' );
if ( $attraction_section ) {
?>

        <div class="two-columns explore-ucla container clearfix">
            <?php foreach ( $attraction_section as $new_row ) {
        echo '<div class="two-columns clearfix">';
        echo '<div class="column left-column column-entry">';
        foreach ( $new_row['left_column'] as $entry ) {
            if ( $entry['image'] ) {
                if ( $entry['visit_site_url'] ) {
                    echo '<a class="img-overlay" href="'. $entry['visit_site_url'] .'"><img src="'. $entry['image'] .'" alt="" /><span>Visit Site</span></a>';
                } else {
                    echo '<img src="'. $entry['image'] .'" alt="" />';
                }
            }
            if ( $entry['title'] ) {
                if ( $entry['visit_site_url'] ) {
                    echo '<h4><a href="'. $entry['visit_site_url'] .'">'. $entry['title'] .'</a></h4>';
                } else {
                    echo '<h4>'. $entry['title'] .'</h4>';
                }
            }
            if ( $entry['content'] ) {
                echo '<p>' . $entry['content'] . '</p>';
            }
        }
        echo '</div>';
        echo '<div class="column right-column column-entry">';
        foreach ( $new_row['right_column'] as $entry ) {
            if ( $entry['image'] ) {
                if ( $entry['visit_site_url'] ) {
                    echo '<a class="img-overlay" href="'. $entry['visit_site_url'] .'"><img src="'. $entry['image'] .'" alt="" /><span>Visit Site</span></a>';
                } else {
                    echo '<img src="'. $entry['image'] .'" alt="" />';
                }
            }
            if ( $entry['title'] ) {
                if ( $entry['visit_site_url'] ) {
                    echo '<h4><a href="'. $entry['visit_site_url'] .'">'. $entry['title'] .'</a></h4>';
                } else {
                    echo '<h4>'. $entry['title'] .'</h4>';
                }
            }
            if ( $entry['content'] ) {
                echo '<p>' . $entry['content'] . '</p>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
$buttons = get_field( 'button' );
if ( $buttons ) {
    echo '<div class="container clearfix bottom-30"><ul class="about-buttons align-left">';
    foreach ( $buttons as $button ) {
        echo '<li><a class="button ' . $button[button_class] . ' " href="' . $button[button_url] . '" target="_blank">' . $button[button_text] . '</a></li> ';
        echo '</ul></div>';
    }
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
