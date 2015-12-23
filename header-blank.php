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
		<style>
        .gform_button {
            padding: 3px 6px;
            font-size: 15px;
            border: 1px solid #999;
            background: #efefef;
            line-height: 1;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-family: 'Proxima Nova Light', Arial, Helvetica, sans-serif;
            min-width: 80px;
        }
		#gform_confirmation_message_5 {
			text-align: center;
			}        
        </style>
	</head>
	<?php
		if( !is_front_page() ){
			$not_front = "not-frontpage";
		} else {
			$not_front = "frontpage";
		}
	?>
	<body <?php body_class($not_front); ?>>

		<!--container-->
		<div id="container">
			<noscript>
				<p class="warning">You have <a href="http://www.google.com/support/bin/answer.py?answer=23852">JavaScript disabled</a> or are viewing the site on a device that does no support JavaScript.Some features may not work properly.</p>
			</noscript>
			<?php if( !is_front_page() ): ?>
			<!--content-->
			<div id="content" style="padding-top: 10px;">
			<?php endif; ?>