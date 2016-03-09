<?php
/*
 * Template Name: Parents Club - Thank You
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

        <?php showHeroSlides(); ?>

        <?php
        if( get_field('slides') ) {
            while( has_sub_field('slides') ) {
                $caption = get_sub_field('caption');
                if ($caption) {
                    echo '<div class="container"><span class="caption">' . $caption . '</span></div>';
                    echo '<div class="container clearfix"></div>';
                    }
                }
            }
        ?>

        <div class="clearfix container-1024">

        <?php $heading = get_field('centered_page_heading');
            echo '<div class="page-heading"><h1 class="parents">'. $heading .'</h1></div>';
        ?>
            <div class="two-columns container clearfix">
              <?php
                    $columns = get_field('columns');
                    if( $columns[0]['left_column'] ){
                        echo '<div class="parents-column left-column">'. $columns[0]['left_column'] .'</div>';
                    }
                    if( $columns[0]['right_column'] ){
                        echo '<div class="parents-column right-column">';
                            foreach ( $columns[0]['right_column'] as $column_image ){
                                if ($column_image['column_image']){
                                    echo '<img src="'.$column_image['column_image'].'"><br><div class="small-caption">'.$column_image['column_image_caption'].'</div>';
                                    }
                            }
                        echo '</div>';
                    }
                ?>
            </div>

        </div>

        <div class="container clearfix">
            <div class="parents-callout">
            <?php $closing = get_field('centered_closing_block');
            if ($closing) {
                echo $closing;
            }
            ?>
            </div>
        </div>

        <div class="container clearfix"><br><br>

        <?php endwhile; ?>

    <?php endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
