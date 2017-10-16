<?php
/*
 * Template Name: Specials - 1st Subpage
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

        <div class="specials__firstsubpage">

        <?php
$special = get_field( "special" );

if ( $special ) {
    foreach ( $special as $entry ) {
                echo '<div class="clearfix container">';
					echo '<div class="clearfix entry">';
                    echo '<img class="specials__firstsubpage-img" src="'. $entry['image'] .'" alt="' . $entry['image'] . '" />';
						echo '<h2 class="specials__firstsubpage-heading">' . $entry['heading'] . '</h2>';
                        echo '<h4 class="specials__firstsubpage-heading">' . $entry['subheading'] . '</h4>';
						echo '<div class="specials__firstsubpage-copy">' . $entry['list'] . '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
?>

        </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
