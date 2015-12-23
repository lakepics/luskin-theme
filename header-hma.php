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
    <link href="http://www.tfaforms.com/form-builder/4.1.0/css/wforms-layout.css" rel="stylesheet" type="text/css" />
    <!--[if IE 8]>
    <link href="http://www.tfaforms.com/form-builder/4.1.0/css/wforms-layout-ie8.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 7]>
    <link href="http://www.tfaforms.com/form-builder/4.1.0/css/wforms-layout-ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if IE 6]>
    <link href="http://www.tfaforms.com/form-builder/4.1.0/css/wforms-layout-ie6.css" rel="stylesheet" type="text/css" />
    <![endif]-->

    <link href="http://www.tfaforms.com/themes/get/default" rel="stylesheet" type="text/css" />
    <link href="http://www.tfaforms.com/form-builder/4.1.0/css/wforms-jsonly.css" rel="alternate stylesheet" title="This stylesheet activated by javascript" type="text/css" />
    <script type="text/javascript" src="http://www.tfaforms.com/wForms/3.7/js/wforms.js"></script>
    <script type="text/javascript">
        wFORMS.behaviors.prefill.skip = false;
    </script>
        <script type="text/javascript" src="http://www.tfaforms.com/wForms/3.7/js/localization-en_US.js"></script>


<link rel='stylesheet' id='gforms_reset_css-css'  href='/wp-content/plugins/gravityforms/css/formreset.css?ver=1.8.9' type='text/css' media='all' />
<link rel='stylesheet' id='gforms_formsmain_css-css'  href='/wp-content/plugins/gravityforms/css/formsmain.css?ver=1.8.9' type='text/css' media='all' />
<link rel='stylesheet' id='gforms_ready_class_css-css'  href='/wp-content/plugins/gravityforms/css/readyclass.css?ver=1.8.9' type='text/css' media='all' />
<link rel='stylesheet' id='gforms_browsers_css-css'  href='/wp-content/plugins/gravityforms/css/browsers.css?ver=1.8.9' type='text/css' media='all' />
<script type='text/javascript' src='/wp-content/plugins/gravityforms/js/jquery.json-1.3.js?ver=1.8.9'></script>
<script type='text/javascript' src='/wp-content/plugins/gravityforms/js/jquery.placeholders.2.1.1.min.js?ver=1.8.9'></script>
<script type='text/javascript' src='/wp-content/plugins/gravityforms/js/gravityforms.js?ver=1.8.9'></script>
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
<style type="text/css">
.style1 {font-size: 13px}
.style2 {
	font-size: 13px;	
}
td, th {
}
.border-side {
}
.border-bottom {
}
.marginLeft {
	margin-left:10px !important;
}
.wFormTitle { display: none }
form, fieldset { 
        background-image: none !important; 
        background-color: transparent !important; 
}
#formContainer {
	width:100%;
	margin:0 auto;
        padding: 0;
}
.wForm {
	width:100%;
	margin:0 auto;
        padding: 0;
	font-size:16px;
	font-family: 'Proxima Nova Light', Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.wForm .inputWrapper {
	width:95%;
	display:block;
	padding: 0px;
	margin:0px;
}
.float {
	display: block;
	float:left;
	width:47%;
}
select, input[type="text"], input[type="email"], input[type="tel"] {
	width:100% !important;
	font-size:16px;
        outline-style: none;
        outline: 0;
}
label.label.preField.checkLabel {
    display: block;
    padding-left: 0px;
}
.float label {
	padding: 0px;
}
.wForm fieldset {
	margin-left:14px;
	margin-right:14px;
}
.wForm .secondaryAction, .wForm .primaryAction, .wForm .wfPagePreviousButton, .wForm .wfPageNextButton {
  background-image: none;
  border-radius:0;
}
input[type="submit"] {
	padding: 8px 8px !important;
	color: #FFFFFF !important;
	font-size: 18px !important;
	width: 220px;
	height:50px;
	display: block;
	cursor: pointer;
	font-weight: normal !important;
	text-transform: uppercase;
	background-color: #1C4D71 !important;
	background-image:none;
	border: 0 !important;
	outline:0 !important;
    font-size: 24px;
	text-align: center;
	-webkit-appearance: none;
	-webkit-border-radius: 0;
	border-radius: 0;
}
 
 input[type="submit"]:hover {
	cursor: pointer;
	background-color: #184363 !important;
}

textarea:focus,
input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
.uneditable-input:focus {
    outline: 0;
    outline-style: none;
  /* IE6-9 */
}
input[type=checkbox], input[type=radio] {
  -webkit-transform: scale(1,1) !important;
  display:inline;
  vertical-align:middle;
}
.wForm input[type="checkbox"] {
   	width: auto !important;
   	height: auto !important;
	}

	.wForm input[type="radio"] {
	width: auto !important;
	height: auto !important;
	}
.wForm select {
		margin:0px !important;
	}
.wForm form .errFld .errMsg {
	 color:#BB0D10;
	 padding-bottom:4px;
 }
 
 .errMsg::before {
	 content: "\21D1";
	 color:#BB0D10;
 }
 
 .wFormContainer .errMsg {
	padding-left: 0px !important;
}
.oneField.errFld input {
	border: 1px solid #BB0D10 !important;
}

.wForm form .errFld {
	border:none;
}

.wForm .oneField {
	border: none;
}

.supportInfo {
    display: none;
 }
 
 .wForm input, .wForm textarea, .wForm .preField, .wForm .postField {
 }

/* Smaller Screens */
@media only screen and (max-width : 400px) {
	.float {
	         width:100%;
        }
}

/* Override HMA Styles to match Luskin Site */
.wForm .oneField input, .wForm .oneField select {
     background: #FFFFFF;
     border-color: #A9A9A9;
     border-style: solid;
     border-width: 1px;
     padding: 5px 2px 5px 2px;
}

.wForm .oneField {
     width: 50%; 
     margin: 0;
     padding: 0;
}

.wForm fieldset {
border: none;
margin: 20px 0px;
padding: 0 0 15px;
}

.wForm fieldset legend {
margin: 0;
padding: 0;
}

.wForm h2 {
  font-size: 100%;
  font-weight: bold;
}

div.hma-radio {
  font-weight: normal;
  font-family: 'Proxima Nova Regular', Arial, Helvetica, sans-serif;
  width: 100% !important;
}
.wForm .postField {
  margin: 0;
  margin-right: 6px;
}
label.label.preField.checkLabel {
  display: block;
  padding-left: 0px;
}
input.radio {
  margin-right: 6px;
  padding-right: 6px;
}
label.hma-optin-label {
    display: block;
    padding-left: 15px;
    text-indent: -15px;
}
input.hma-optin-input {
    width: 13px;
    height: 13px;
    padding: 0;
    margin:0;
    vertical-align: middle!important;
    position: relative;
    top: -1px;
    *overflow: hidden;
}
</style>
		<!--Title-->
		<title><?php wp_title('-',true,'right') ?><?php bloginfo('name'); ?></title>
        
        		<!-- add new google analytics, relocated to head element per ScreenPilot -->
		<script>
 		 	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		 	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 		 	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 		 	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 		 	ga('create', 'UA-60141822-1', 'auto');
 		 	ga('send', 'pageview');

		</script>

        
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
				<span class="mobile-room-phone"><?php the_field('room_reservation', 'option'); ?></span>
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
			</header>
			<!--/header-->
			<?php if( !is_front_page() ): ?>
			<!--content-->
			<div id="content">
			<?php endif; ?>