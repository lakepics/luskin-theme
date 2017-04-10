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
        echo '<h2>' . $page_sub_head . '</h2>';
    }
    echo '<div class="res-content bottom-30">'. $intro_text .'</div>';
    echo '</div>';
}
?>

        <div id="meet-the-team">

        <?php
$team = get_field( "meet_the_team" );

if ( $team ) {
    foreach ( $team as $team_section ) {
        echo '<div class="container clearfix one-column"><h2>' . $team_section['team_sub_head'] . '</h2>';
        if ( $team_section['team_members'] ) {
            $team_members = $team_section['team_members'];
            foreach ( $team_members as $row ) {
                echo '<div class="clearfix column left-column column-entry">';
                foreach ( $row['left_column'] as $entry ) {
                    echo '<div class="team clearfix">';
                    echo '<img class="team-img" src="'. $entry['image'] .'" alt="' . $entry['alt_text'] . '" />';
                    echo '<h3 class="team-name">' . $entry['name'] . '</h3>';
                    echo '<div class="team-title">' . $entry['title'] . '</div>';
                    echo '<div class="team-phone">' . $entry['phone'] . '</div>';
                    echo '<div class="team-email"><a href="mailto:' . $entry['email'] . '">' . $entry['email'] . '</a></div>';
                    echo '<div class="bio" style="padding-top:20px;">' . $entry['bio'] . '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '<div class="clearfix column right-column column-entry " >';
                foreach ( $row['right_column'] as $entry ) {
                    echo '<div class="team clearfix">';
                    echo '<img class="team-img" src="'. $entry['image'] .'" alt="' . $entry['alt_text'] . '" />';
                    echo '<h3 class="team-name">' . $entry['name'] . '</h3>';
                    echo '<div class="team-title">' . $entry['title'] . '</div>';
                    echo '<div class="team-phone">' . $entry['phone'] . '</div>';
                    echo '<div class="team-email"><a href="mailto:' . $entry['email'] . '">' . $entry['email'] . '</a></div>';
                    echo '<div class="bio">' . $entry['bio'] . '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }
        echo '</div>';
    }
}
?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
