<?php
/*
 * Template Name: Press Release Index
 */
?>
<?php get_header(); ?>

<div id="main-content" role="main">

    <?php
if ( have_posts() ) :

  while ( have_posts() ) : the_post();

  showHeroSlides(); ?>

        <div class="container clearfix column">
           <h1>In The News</h1>
            <h2 class="view-press-release">View our Press Clippings</h2>
            <table id="press-release-table">
              <?php
$press_clippings = get_field( 'press_clipping' );
if ( $press_clippings ) {
  foreach ( $press_clippings as $clip ) {
    echo '<tr class="releases">';
    echo '<td class="date">' . $clip['date']. '</td>';
    echo '<td class="title"><a href="' . $clip['link'] . '">' . $clip['title'] . '</a></td>';
    echo '</tr>';
  }
}
?>
            </table>
        </div>

        <div class="container clearfix"></div><br><br>

        <div class="container clearfix two-columns">
            <div class="column left-column">
                <h1>Press Releases</h1>
                <p class="bottom-30">Welcome to the Press Center for The UCLA Meyer and Renee Luskin Conference Center.  Here you will find information on the Conference Center, current press releases and our fact sheet.  Should you need anything more on the Luskin Conference Center, please contact our Director of Sales &amp; Marketing, Cindy Gagle.</p>
                <a class="button-abt down-arrow" href="/docs/ucla-luskin-conference-center-fact-sheet.pdf" target="_blank">FACT SHEET</a>
            </div>
            <div class="media-contact column right-column">
                <h2>For Press Inquiries, please contact:</h2>
                <div id="hcard-Cindy-Gagle" class="vcard">
                 <span class="fn">Cindy Gagle</span>
                 <div class="org">Director of Sales &amp; Marketing</div>
                 <span class="tel">(310) 825-7738</span> | <a class="email" href="mailto:cgagle@ha.ucla.edu">cgagle@ha.ucla.edu</a><br>
                 <div style="display: none;" class="social-wrapper">
                 <a href="https://www.facebook.com/pages/Ken-Ellens-Communications/408447145920353?ref=br_tf" class="luskin-social fb"></a>
                 <a href="//twitter.com/#!/KenEllens" class="luskin-social tw"></a>
                 <a href="//www.linkedin.com/home?trk=ppro_pbli" class="luskin-social in"></a>
                 </div>
                </div>
            </div>
        </div>

        <div class="container clearfix press-release-list">
            <h2 class="view-press-release">View our press releases</h2>
            <table id="press-release-table">
              <?php
$press_releases = get_field( 'press_releases' );
if ( $press_releases ) {
  foreach ( $press_releases as $release ) {
    echo '<tr class="releases">';
    echo '<td class="date">' . $release['date']. '</td>';
    echo '<td class="title"><a href="' . $release['link'] . '">' . $release['title'] . '</a></td>';
    echo '</tr>';
  }
}
?>
            </table>
        </div>

        <div class="container clearfix"></div><br><br>

      <?php
endwhile;
else :
  echo wpautop( 'Sorry, no posts were found' );
endif; ?>

</div><!-- /main content -->

<?php get_footer(); ?>
