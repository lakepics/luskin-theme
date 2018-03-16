<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Luskin
 * @since Luskin 2.0
 */
?>

<div class="lcc-search">
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( '', 'label', 'luskintheme' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Website &hellip;', 'placeholder', 'luskintheme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( '', 'label', 'luskintheme' ); ?>" />
    </label>
    <button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( '<i class="fa icon-search icon"></i>', 'submit button', 'luskintheme' ); ?></span></button>
</form>
</div>
