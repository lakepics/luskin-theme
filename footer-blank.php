			<?php if( !is_front_page() ): ?>
			</div>
			<!--/content-->

			<!--footer-->
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

<?php wp_footer(); ?>
	</body>
</html>