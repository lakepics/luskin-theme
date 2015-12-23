<?php
/*
 * Template Name: About Us
 */
?>
<?php get_header(); ?>

<!-- main content -->

<div id="main-content" role="main">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
			//d(get_fields());
		?>
<?php show_hero_slides(); ?>
<?php 
$sub_head = get_field('sub_head');
$intro_copy = get_field('intro_copy');
if ($sub_head) {
	echo '<div class="container clearfix">';
	echo '<h2 class="subhead">' . $sub_head . '</h2>';
	echo '<div class="res-columns">' . $intro_copy . '</div>';
	echo '</div>';
}
?>
<div class="two-columns container clearfix top-30">
  <?php
			$columns = get_field('columns');
			if( $columns[0]['left_column'] ){
				echo '<div class="column left-column">'. $columns[0]['left_column'] .'</div>';
			}
			if( $columns[0]['right_column'] ){
				echo '<div class="column right-column">'. $columns[0]['right_column'] .'</div>';
			}
		?>
</div>
  <?php
  			$buttons = get_field('buttons');
			echo '<div class="container clearfix"><ul class="about-buttons">';
			foreach ( $buttons as $button ) {
				if ( $button[button_text] === 'Fact Sheet') {
					echo '<li><div class="button-wrapper"><a class="button-abt ' . $button[button_class] . '" target="_blank" href="' . $button[button_url] . '">' . $button[button_text] . '</a>';
					}
				else { 
					echo '<li><div class="button-wrapper"><a class="button-abt ' . $button[button_class] . ' " href="' . $button[button_url] . '">' . $button[button_text] . '</a>';
				}
				$second_icon = $button[second_icon];
				if ($second_icon) {
					echo '<a class="button-abt second-icon ' . $button[second_icon] . '" target="_blank" href="' . $button[second_url] . '">&nbsp;</a>';
 					}
				$third_icon = $button[third_icon];
				if ($third_icon) {
					echo '<a class="button-abt third-icon ' . $button[third_icon] . '" href="' . $button[third_url] . '">&nbsp;</a>';
 					}	
				echo '</div></li> ';
				}
			echo '</ul></div>';	
  ?>
<div class="quick-facts container clearfix"><span id="eligibility" class="anchor-offset-about-eligibility "></span>
  <div class="quick-facts-description">
    <h3>AFFILIATION &amp; ELIGIBILITY POLICY</h3>
  </div>
  <div class="clearfix"></div>
  <?php
			$quick_facts = get_field('quick_facts');
			if( $quick_facts ){
				echo '<div class="quick-facts-description res-columns">'. $quick_facts[0]['content'] .'</div>';
				if( $quick_facts[0]['quick_facts_file'] ){
					echo '<div class="generic-button"><a class="button download-btn" href="'. $quick_facts[0]['quick_facts_file'] .'" target="_blank">DOWNLOAD FACT SHEET</a></div>';
				}
			}
		?>
</div>
<div class="features clearfix">
  <h2 class="title">Features of the UCLA Luskin Conference Center</h2>
  <?php
			$features = get_field('features');
			echo '<div class="features-column">';
			foreach ( $features[0]['left_column'] as $feature ){
				if( $feature['background_image'] ){
					echo '<div class="feature feature-left" style="background-image: url('. $feature['background_image'] .');">';
				} else {
					echo '<div class="feature">';
				}
					echo '<div class="feature-wrapper">';
						if( $feature['icon'] ){
							echo '<img class="feature-icon" src="'. $feature['icon'] .'" alt="" />';
						}
						echo '<div class="description">'. $feature['content'] .'</div>';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
			echo '<div class="features-column">';
			foreach ( $features[0]['right_column'] as $feature ){
				if( $feature['background_image'] ){
					echo '<div class="feature feature-right" style="background-image: url('. $feature['background_image'] .');">';
				} else {
					echo '<div class="feature">';
				}
					echo '<div class="feature-wrapper">';
						if( $feature['icon'] ){
							echo '<img class="feature-icon" src="'. $feature['icon'] .'" alt="" />';
						}
						echo '<div class="description">'. $feature['content'] .'</div>';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		?>
</div>

<div class="section-description container clearfix">
  <h2>Explore UCLA, Southern California, and Beyond!</h2>
  <a id="plan-your-visit" class="anchor-offset-visit"></a>
    <div class="res-columns">
      <p>UCLA is one of those special places where you know that you are at the center of what’s happening… a place buzzing with activities, culture, arts and ideas. And it’s all taking place against the exciting backdrop of Los Angeles.</p>
    <p>As a guest at the Luskin Conference Center, we encourage you to take full advantage of the opportunity to explore the many possibilities that both UCLA and Southern California have to offer!</p>
    </div>
      <div class="container explore-callout">Engage your mind, become inspired and experience the uniqueness of UCLA and the Los Angeles area during your stay.</div>
  <?php endwhile; ?>
  <?php endif; ?>
</div>
<div class="explore-more clearfix">
    <div class="explore-column">
        <div class="explore-teaser explore-left" style="background-image: url('/wp-content/assets/cap-feature.jpg');">
                <div class="about-sub img-overlay"><div class="explore-title">Explore UCLA</div><span><a href="/about/things-to-do-ucla/">Things to Do<br>&amp; See at UCLA</a></span></div>
        </div>
    </div>
    <div class="explore-column">
        <div class="explore-teaser explore-right" style="background-image: url('/wp-content/assets/beach-feature.jpg');">
                <div class="about-sub img-overlay"><div class="explore-title">Discover LA</div><span><a href="/about/discover-los-angeles/">Things to Do &amp; See in Southern California</a></span></div>
        </div>
    </div>
</div>
<!-- /main content -->

<?php get_footer(); ?>
