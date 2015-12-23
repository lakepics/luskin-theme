			<?php if( !is_front_page() ): ?>
			</div>
			<!--/content-->

			<!--footer-->
			<footer id="footer" class="clearfix">
				<div class="container">
					<div class="footer-block ucla-logo">
						<a href="http://www.ucla.edu/"><img src="<?php bloginfo('stylesheet_directory');?>/images/ucla-logo.png" alt="UCLA" /></a>
					</div>
					<div class="footer-block address">
						<h5>UCLA Meyer &amp; Renee Luskin<br>Conference Center</h5>
						<?php the_field('address', 'option'); ?>
						<br/><br/>
						<a class="gmaps-link external" href="https://www.google.com/maps/dir/Los+Angeles+International+Airport,+1+World+Way,+Los+Angeles,+CA+90045/425+Westwood+Plaza,+Los+Angeles,+CA+90095/@34.0051917,-118.4488899,13z/data=!4m13!4m12!1m5!1m1!1s0x80c2b0d213b24fb5:0x77a87b57698badf1!2m2!1d-118.40853!2d33.941589!1m5!1m1!1s0x80c2bc88a8fef1bb:0x9d3811ef974a159e!2m2!1d-118.4448196!2d34.0688039" target="_blank">Google Map Directions</a>
					</div>
					<div class="footer-block contact">
						<h5>Contact</h5>
						<a class="contact-option phone" href="tel:8555228252"><?php the_field('phone', 'option'); ?></a>
						<span class="contact-option fax"><?php the_field('fax', 'option'); ?></span>
						<a class="contact-option email" href="mailto:<?php the_field('e-mail', 'option'); ?>"><?php the_field('e-mail', 'option'); ?></a>
					</div>
					<div class="footer-block reservations">
						<h5><a href="/request-proposal">Request for Proposal</a></h5>
						<h5><a href="/mailing-list">Join our Email List</a></h5>
						<h5><a href="/family-club">Join our Family Club</a></h5>
                    	<h5 class="pr-link"><a href="/press-releases/">Press Releases</a></h5>
<!--						<h5>Toll Free</h5>
						<span class="contact-option phone"><?php the_field('room_reservation', 'option'); ?></span> -->
					</div>
					<div class="footer-block follow">
						<h5>Follow</h5>
						<a class="follow-link fb" href="<?php the_field('facebook', 'option'); ?>"></a>
						<a class="follow-link tw" href="<?php the_field('twitter', 'option'); ?>"></a>
						<a class="follow-link ln" href="<?php the_field('linkedin', 'option'); ?>"></a> 
						<a class="follow-link pin" href="<?php the_field('pinterest', 'option'); ?>"></a>
						<a class="follow-link insta" href="<?php the_field('instagram', 'option'); ?>"></a>
						<a class="follow-link yt" href="<?php the_field('youtube', 'option'); ?>"></a> 
					</div>
					<div class="footer-block legal">
						<p>&copy;  <?php echo date('Y'); ?> UC Regents</p>
						<!-- <a href="<?php echo home_url(); ?>/terms-use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo home_url(); ?>/privacy-policy">Privacy Policy</a> -->
						<!--<p class="designer">Design: <a href="http://hdsf.com">HDSF</a></p>-->
					</div>
                <div class="container clearfix hospitality-group">
                    <strong><a href="http://hhs.ucla.edu">UCLA HOSPITALITY GROUP</a></strong> &nbsp; &nbsp; <a href="http://lacc.ucla.edu">Lake Arrowhead Conference Center</a> &nbsp; | &nbsp; <a href="http://guesthouse.ucla.edu">Guest House</a> &nbsp; | &nbsp; <a href="http://conferences.ucla.edu">Conference Services</a> &nbsp; | &nbsp; <a href="http://catering.ucla.edu">Catering</a>
                </div>
				</div>
			</footer>

			<!--/footer-->
			<?php endif; ?>

		</div>
		<!--/container-->

		<!--Scripts-->
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/scripts/jquery.bxslider.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/scripts/isotope.pkgd.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/scripts/lemmon-slider.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/plugins/fancybox/jquery.fancybox-1.3.4.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/scripts/general.js" charset="UTF-8"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory');?>/scripts/form-step.js" charset="UTF-8"></script> <!-- added 11/06/14 to change numeral to text on RFP -->
                <!-- eHunter Code -->
		<script type="text/javascript">
		(function() {
		  var pa = document.createElement('script'), ae = document.getElementsByTagName('script')[0], protocol = (('https:' == document.location.protocol) ? 'https://' : 'http://');pa.async = true;  
  		  pa.src = protocol + 'd2xgf76oeu9pbh.cloudfront.net/57a3c83aeb453d0a65a30db61ecc62c4.js'; pa.type = 'text/javascript'; ae.parentNode.insertBefore(pa, ae);
		})();
		</script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5621358404340cf8" async="async"></script>
		<!-- Typekit support for Adobe Caslon Pro -->
        <script src="https://use.typekit.net/sif5fib.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>

<?php wp_footer(); ?>
	</body>
</html>