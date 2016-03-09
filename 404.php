<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */

get_header(); ?>

<div id="main-content" role="main">

	<div class="error-404 not-found">

		<h2 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'luskintheme' ); ?></h2>

		<div class="entry-content">
            
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'luskintheme' ); ?></p>

            <?php get_search_form(); ?>

        </div>

    </div>

</div><!-- /main content -->

<?php get_footer(); ?>
