<?php
/*
 * Template Name: Press Release Index
 */
?>
<?php get_header(); ?>

<!-- main content -->
<div id="main-content" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		<?php show_hero_slides(); ?>
        <div class="container clearfix two-columns">
        	<div class="column left-column">
                <h1 class="press-release">Press Releases</h1>
                <p class="bottom-30">Welcome to the Press and Media Center for The UCLA Meyer and Renee Luskin Conference Center.  Here you will find information on the Conference Center, current press releases and our fact sheet.  Should you need anything more on the Luskin Conference Center, please contact our media relations manager, Ken Ellens.</p>
                <a class="button-abt down-arrow" href="http://luskinconferencecenter.ucla.edu/wp-content/uploads/2015/02/Luskin_Fact-Sheet.pdf" target="_blank">FACT SHEET</a>
            </div>
            <div class="media-contact column right-column">
                <h2>For Press Inquiries, please contact:</h2>
                <div id="hcard-Ken-Ellens" class="vcard">
                 <span class="fn">Ken Ellens</span>
                 <div class="org">Ken Ellens Communications</div>
                 <span class="tel">(201) 758-2864</span> | <a class="email" href="mailto:kenellens@aol.com">kenellens@aol.com</a><br>
                 <div class="social-wrapper">
                 <a href="https://www.facebook.com/pages/Ken-Ellens-Communications/408447145920353?ref=br_tf" class="luskin-social fb"></a>
                 <a href="http://twitter.com/#!/KenEllens" class="luskin-social tw"></a>
                 <a href="http://www.linkedin.com/home?trk=ppro_pbli" class="luskin-social in"></a>
                 <span class="ken">@Ken Ellens</span>
                 </div>
                </div>
            </div>
        </div>
        <div class="container clearfix press-release-list">
        	<h2 class="view-press-release">View our press releases</h2>
            <table id="press-release-table">
              <?php
			  $press_releases = get_field('press_releases');
			  // echo '<pre>' .  var_dump($press_releases) . '</pre>';
			  if ($press_releases) {
				  foreach ($press_releases as $release) {
					  echo '<tr class="releases">';
					  echo '<td class="date">' . $release['date']. '</td>';
					  echo '<td class="title"><a href="' . $release['link'] . '">' . $release['title'] . '</a></td>';
					  echo '<td class="download"><a href="' . $release['pdf_link'] . '" target="_blank" class="button-abt down-arrow">PDF</a></td>';
					  echo '</tr>';
					  }
				  }
			  ?>
			</table>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
        <div class="container clearfix"></div><br><br>

<!-- /main content -->

<?php get_footer(); ?>