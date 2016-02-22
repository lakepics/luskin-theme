<?php
//dump function, for development purposes
function dump($var){
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

// add wp-menus
add_theme_support( 'menus' );

// register sidebar
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => __( 'Right Sidebar', 'luskin' ),
        'id' => 'sidebar-right',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
  		// 'before_widget' => '<li id="%1$s" class="widget %2$s">',
		// 'after_widget'  => '</li>',
		'before_title'  => '<h4 class="widget-title"><span class="widget-icon"></span>',
		'after_title'   => '</h4>',

));

//acf options
add_filter('acf/options_page/settings', 'soe_options_page_settings');

function soe_options_page_settings($options){

	$options['title'] = __('Global');
	$options['pages'] = array(
		__('Header'),
		__('Sidebar'),
		__('Footer'),
		__('Blocks')
	);

	return $options;
}

/* Excerpt function
 *
 * $mycontent = string to strip
 * $noc = number of words to strip ( integer )
 */
function my_excerpt($mycontent, $now) {
//global $post;
$mycontent = strip_shortcodes($mycontent);
$mycontent = str_replace(']]>', ']]&gt;', $mycontent);
$mycontent = strip_tags($mycontent);
$excerpt_length = $now;
$words = explode(' ', $mycontent, $excerpt_length + 1);
foreach ($words as $word) {
$wordsTrimed[] = preg_replace( '/\s+/', '', $word );;
}
if(count($wordsTrimed) > $excerpt_length) :
array_pop($wordsTrimed);
array_push($wordsTrimed, '&hellip;');
$mycontent = implode(' ', $wordsTrimed);
endif;
$mycontent = implode(' ', $wordsTrimed);
$mycontent = '<p>' . $mycontent . '</p>';
return $mycontent;
}
/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  $classes = 'img'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  } else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
  return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',10,8);

//sort array by column
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
	$sort_col = array();
	foreach ($arr as $key=> $row) {
		$sort_col[$key] = $row[$col];
	}

	array_multisort($sort_col, $dir, $arr);
}

/**
 * var $postType: The post type where we should look for prev/next articles
 * var $postId: The postId in relation to which we need to find the prev/next
 * var $fieldValue: Pair of field with value
 */
function getPrevNext($postType, $postId, $fieldValue = null) {
	if ($fieldValue != null) {
		$args = array(
			'numberposts' => -1,
			'post_type' => $postType,
			'order' => 'ASC',
			'meta_key'         => $fieldValue['meta_key'],
			'meta_value'       => $fieldValue['meta_value'],
			'orderby' => 'title'
		);
	} else {
		$args = array(
			'numberposts' => -1,
			'post_type' => $postType,
			'order' => 'ASC',
			'orderby' => 'menu_order'
		);
	}

	$items = get_posts($args);

	$numItems = count($items);
	$i = 0; $isLast = false; $isFirst = false;
	foreach($items as $key => $item) {
	  	$newitems[$item->ID] = $item;
		$ids[] = $item->ID;
	}

	// $postId = get_the_ID();

	$i = 0;
	foreach ($newitems as $key => $item) {
		if ($key == $postId) {
			if ($i+1 == count($ids)) {
				// last
				$nextId = $newitems[$ids[0]]->ID;
				$prevId = $newitems[$ids[0]]->ID;
			} else {
				$nextId = $newitems[$ids[$i+1]]->ID;
				$prevId = $newitems[$ids[$i-1]]->ID;
			}

		}
		$i++;
	}

	$nextPermalink = get_permalink( $nextId );
	$prevPermalink = get_permalink( $prevId );
	wp_reset_query();

	return array('next' => $nextPermalink, 'prev' => $prevPermalink);
}

// turn string into slug
function create_slug($string){
	$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return strtolower($slug);
}

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );

	$image = wp_get_attachment_image_src ($attachment_id, 'full');

	return array(
	    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
	    'caption' => $attachment->post_excerpt,
	    'description' => $attachment->post_content,
	    'href' => get_permalink( $attachment->ID ),
	    'src' => $attachment->guid,
	    'width' => $image[1],
	    'height' => $image[2],
	    'title' => $attachment->post_title
	);
}

/**
 * [show_hero_slides Outputs the hero slideshow for the page where it is called]
 * @return [type] [HTML]
 */
function show_hero_slides() {
	if( get_field('slides') ){
		$slides = get_field('slides');
		$caption = $slide['caption'];
		$container_id = $slides[0]['container_id'];
		    if ( $container_id ) {
				echo '<div id="' . $container_id . '" class="full-width-gallery">';
			}
			else {
				echo '<div class="full-width-gallery">';
			}
			if (count($slides) > 1) {
				echo '<ul>';
					foreach ( get_field('slides') as $slide ){
					$image = wp_get_attachment($slide['image']['id']);
					$portrait_image = wp_get_attachment($slide['portrait_image']['id']);
					echo '<li>';
						echo '<img src="'. $image['src'] .'" alt="'.$image['alt'].'" />';
						echo '<img class="mobile-image" src="'. $portrait_image['src'] .'" alt="'.$portrait_image['alt'].'" />';
					echo '</li>';
					}
				echo '</ul>';
			} else {
				foreach ( get_field('slides') as $slide ){
					$image = wp_get_attachment($slide['image']['id']);
					$portrait_image = wp_get_attachment($slide['portrait_image']['id']);
					echo '<img src="'. $image['src'] .'" alt="'.$image['alt'].'" />';
					echo '<img class="mobile-image" src="'. $portrait_image['src'] .'" alt="'.$portrait_image['alt'].'" />';
				}
			// echo '<pre>' . print_r ($slides); '</pre>';
			}
			if ( get_field('ghost_type_on_image') ) {
				$page_heading = get_field('ghost_type_on_image');
				echo '<div class="container">';
				echo '<div class="text-overlay">' . $page_heading . '</div>';
				echo '</div>';
			}
			echo '</div>';
			if ($caption) {
					echo '<div class="container"><span class="caption">' . $caption . '</span></div>';
					}
			if ( get_field('page_heading') ) {
				$page_heading = get_field('page_heading');
				echo '<div class="container page-heading">';
				echo '<h1>' . $page_heading . '</h1>';
				echo '</div>';
			}	
	}
}

// fixes media list of empty/broken images
add_filter( 'wp_image_editors', 'change_graphic_lib' );
function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}