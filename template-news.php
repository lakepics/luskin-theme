<?php
/*
 * Template Name: News
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main" class="news">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php
if ( get_field( 'slides' ) ) {
    while ( has_sub_field( 'slides' ) ) {
        $caption = get_sub_field( 'caption' );
        if ( $caption ) {
            echo '<div class="container"><span class="caption">' . $caption . '</span></div>';
            echo '<div class="container clearfix"></div>';
        }
    }
}
$issue = get_field ( 'issue' );
if ( $issue ) {
    echo '<div class="news-ribbon"><span class="container news-issue">' . $issue . '</span></div>';
}
$heading = get_field( 'heading' );
$sub_head = get_field( 'sub_head' );
echo '<div class="container news">';
if ( $heading ) { echo '<h1>' . $heading . '</h1>'; }
if ( $sub_head ) { echo '<h2>' . $sub_head . '</h2>'; }
echo '</div>';
?>

        <div class="container clearfix">

        <?php
$article = get_field( 'article' );
echo '<div class="news-content page-col-twothird">'. $article .'</div>';
$sidebar = get_field( 'sidebar' );
if ( $sidebar ) {
    echo '<div class="page-col-onethird news-sidebar-content">';
    foreach ( $sidebar as $sidebar_content ) {
        echo '<h3>' . $sidebar_content['section_header'] . '</h3>
                            <ul class="news-sidebar-link">';
        foreach ( $sidebar_content['section_content'] as $section_content ) {
            echo '<li><a href="' . $section_content['article_link'] . '">' . $section_content['article_link_title'] . '</a></li>';
        }
        echo '</ul>';
    }
    echo '</div>';
}
?>

        </div>

        <div class="container clearfix news-pagination">

        <?php
$previous = get_field( 'previous_article' );
$next = get_field( 'next_article' );
if ( $previous ) {
    echo '<span class="align-left"><a href="' . $previous[0]['article_link'] . '">&#8810; Previous Article</a></span>';
}
if ( $next ) {
    echo '<span class="align-right"><a href="' . $next[0]['article_link'] . '">Next Article &#8811;</a></span>';
}
?>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
