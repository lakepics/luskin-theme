<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" <?php language_attributes() ?>>
	<head>
		<!--Meta Tags-->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta name="distribution" content="global" />
		<!-- Mobile viewport optimized: j.mp/bplateviewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
		<?php
			if( !is_admin()){
				wp_deregister_script('jquery');
				wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"), false);
				wp_enqueue_script('jquery');
			}
			wp_head();
		?>
		<script src="<?php bloginfo('stylesheet_directory');?>/scripts/functions.js"></script>
		<!--[if lt IE 9]>
			<script src="<?php bloginfo('stylesheet_directory');?>/scripts/html5shiv.min.js"></script>
		<![endif]-->

		<!--Styles-->
		<!--Temporary Style Sheet - REMOVE LATER-->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory');?>/style.css"/>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory');?>/styles/default.css"/>
		<!--[if lte IE 7]>
			<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo('stylesheet_directory');?>/styles/ie.css"/>
		<![endif]-->
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory');?>/plugins/fancybox/jquery.fancybox-1.3.4.css"/>

		<!--Other //Uncomment to use
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php bloginfo('stylesheet_directory');?>/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory');?>/favicon.ico" />
		-->
		
		<!--Title-->
		<title><?php wp_title('-',true,'right') ?><?php bloginfo('name'); ?></title>

		<!-- add new google analytics, relocated to head element per ScreenPilot -->


	</head>
	<?php
		if( !is_front_page() ){
			$not_front = "not-frontpage";
		} else {
			$not_front = "frontpage";
		}
	?>
	<body <?php body_class($not_front); ?>>
		<div class="mobile-navigation">
			<a href="http://www.ucla.edu/" class="logo-ucla-mobile"><img src="<?php bloginfo('stylesheet_directory');?>/images/ucla-logo-mobile.png" alt="UCLA" /></a> <!-- hidden in CSS -->
			<div class="mobile-room-reservation">
				<span class="mobile-room-label">Toll Free</span>
				<a class="mobile-room-phone" href="tel:8555228252"><?php the_field('room_reservation', 'option'); ?></a>
			</div>
			<div class="mobile-follow">
				<a class="follow-link fb" href="<?php the_field('facebook', 'option'); ?>">Facebook</a>
				<a class="follow-link tw" href="<?php the_field('twitter', 'option'); ?>">Twitter</a>
				<a class="follow-link yt" href="<?php the_field('youtube', 'option'); ?>">Youtube</a>
			</div>
		</div>
		<!--accessibility navigation-->
		<ul class="visuallyhidden">
			<li>
				<a href="#main-content">Skip to main content</a>
			</li>
		</ul>
		<!--/accessibility navigation-->

		<!--container-->
		<div id="container">
			<noscript>
				<p class="warning">You have <a href="http://www.google.com/support/bin/answer.py?answer=23852">JavaScript disabled</a> or are viewing the site on a device that does no support JavaScript.Some features may not work properly.</p>
			</noscript>
			<!--header-->
			<header id="header">
				<div class="container clearfix">
					<div id="navbar" class="navbar">					
                    <span id="toggle-menu">Menu</span>
                        <div id="logo-lockup">
                            <a href="<?php bloginfo('url');?>" id="logo"><img src="<?php bloginfo('stylesheet_directory');?>/images/logo.png" alt="<?php bloginfo('name');?>" /></a>
                        <!-- navigation -->
                        <nav id="site-navigation" class="navigation main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'menu' => 'main_menu', 'container' => '', 'menu_id' => 'main-navigation', 'menu_class' => 'menu nav-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                        </nav>
                        <!-- /navigation -->
                        </div>
					</div>				
            	</div>
			</header>
			<!--/header-->
			<?php if( !is_front_page() ): ?>
			<!--content-->
			<div id="content">
			<?php endif; ?>