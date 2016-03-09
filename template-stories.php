<?php
/*
 * Template Name: Stories
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php $intro_text = get_field('intro_copy');
            if ( $intro_text ) {
                echo '<div class="two-columns container clearfix top-30">';
                    $page_sub_head = get_field('page_sub_head');
                    if ($page_sub_head) {
                        echo '<h2>' . $page_sub_head . '</h2>';
                        }
                echo '<div class="res-content res-columns">'. $intro_text .'</div>';
                echo '</div>';
                }
        ?>

        <?php
        $stories = get_field('stories');
        if( $stories ){
        ?>
        <div class="explore-ucla container clearfix">
            <?php foreach ($stories as $new_row ) {
            echo '<div class="two-columns clearfix top-30">';
            echo '<div class="column left-column column-entry">';
                foreach ( $new_row['left_column'] as $entry ) {
                    echo '<div class="story clearfix">';
                    echo '<img class="story-img" src="'. $entry['image'] .'" alt="' . $entry['alt_text'] . '" />';
                    echo '<h3 class="story-tagline">' . $entry['tagline'] . '</h3>';
                    echo '<div class="story-subject">' . $entry['subject'] . '</div>';
                    echo '<p class="story-title tk-adobe-caslon-pro">' . $entry['title'] . '</p>';
                    echo $entry['content'] . '</div>';
                }
                echo '</div>';
                echo '<div class="column right-column column-entry">';
                foreach ( $new_row['right_column'] as $entry ) {
                    echo '<div class="story clearfix">';
                    echo '<img class="story-img" src="'. $entry['image'] .'" alt="' . $entry['alt_text'] . '" />';
                    echo '<h3 class="story-tagline">' . $entry['tagline'] . '</h3>';
                    echo '<div class="story-subject">' . $entry['subject'] . '</div>';
                    echo '<p class="story-title tk-adobe-caslon-pro">' . $entry['title'] . '</p>';
                    echo $entry['content'] . '</div>';
                }
                echo '</div>';
            echo '</div>';
            }
        echo '</div>';
        }
        $buttons = get_field('button');
        if ($buttons) {
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
