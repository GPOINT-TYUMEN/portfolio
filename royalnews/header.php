<!DOCTYPE html>
<html xmlns="http<?php echo (is_ssl())? 's' : ''; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title><?php wp_title('|', true, 'right'); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="google-site-verification" content="hLt0WkLrDCHd6lP9D4RnWz-SZD0tYdaHTYH22GxbwQA" />
	<?php 
		global $wlm_shortname;
		if (get_option($wlm_shortname.'_favicon')) {
	?>
	<link rel="shortcut icon" href="<?php echo get_option($wlm_shortname.'_favicon'); ?>" />
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<?php } ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class('custom-background'); ?>>
        
<div class="main-cont">

	<!-- // header // -->
	<header class="header">
	  <div class="header-a"></div>
	</header>
	<!-- \\ header \\ -->

	<div class="conteiner1">

		<!-- // left col // -->
		<section class="left-col">
			<div class="nano">
				<div class="overthrow nano-content description">
					<p>
						<?php if (get_option($wlm_shortname.'_sitelogo')) { ?>
							<a href="<?php echo home_url(); ?>" class="head-logo"><img src="<?php echo get_option($wlm_shortname.'_sitelogo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } else { ?> 
							<a href="<?php echo home_url(); ?>" class="head-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } ?>

						<?php if (get_option($wlm_shortname.'_sitelogo_small')) { ?>
							<a href="<?php echo home_url(); ?>" class="header-logo-small"><img src="<?php echo get_option($wlm_shortname.'_sitelogo_small'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } ?>

						<?php if (get_option($wlm_shortname.'_sitelogo_smaller')) { ?>
							<a href="<?php echo home_url(); ?>" class="header-logo-small-a"><img src="<?php echo get_option($wlm_shortname.'_sitelogo_smaller'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } ?>

						<?php if (get_option($wlm_shortname.'_sitelogo_retina')) { ?>
							<a href="<?php echo home_url(); ?>" class="header-logo-retina"><img src="<?php echo get_option($wlm_shortname.'_sitelogo_retina'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
						<?php } ?>
						  
						<a href="#" class="l-menu-open"></a>
						<div class="left-coll-a">
							<a href="#" class="l-menu-hide"></a>
							<!-- // left menu start // -->
							<nav class="left-c-menu">
								<?php
									//the main menu
									wp_nav_menu(array(
									'echo'              => true,
									'fallback_cb'       => 'wp_page_menu',
									'depth'             => 0,
									'theme_location'    => 'main_navigation'
									));
								?>
							</nav>
							
							<div class="left-c-devider"></div>
							
							<aside class="left-c-sidebar">
								<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar')) : ?>
								<?php endif; ?>
							</aside>
						</div>
					</p>
				</div>
			</div>
		</section>
		<!-- \\ left col \\ -->

		<!-- \\\center col\\\ -->
		<div class="center-col">
		  <div class="center-col-b">
			<div class="padding">
			  <div class="main-content">         
			  
				<div class="main-content-a">
				  <!-- // page header start // --> 
				  <header class="page-header">
				  	<a href="http://booker-online.ru" target="_blank"><img style="max-width: 100%" src="http://thegarlicpress.ru/wp-content/uploads/2014/12/banner.gif" /></a>			  
					<?php if ( (is_home() || is_front_page()) && get_option($wlm_shortname."_header_date_search_socila_homepage") == 'true') { ?>
						<?php // ?>
					<?php } else { ?>
					
						<?php if (get_option($wlm_shortname."_header_date") == 'true') { ?>
						<div class="page-header-date"><?php echo  date( 'M jS l, Y', current_time( 'timestamp', 0 )); ?></div>
						<?php } ?>
						
						<?php if ( (!is_404()) && (!is_page_template('404.php')) && (get_option($wlm_shortname."_header_search") == 'true') ) { ?>
						<div class="page-header-search">
							<form action="<?php echo home_url(); ?>" method="get">
								<input type="text" name="s" id="s" value="Search the site..." />
								<input value="" type="submit" />
							</form>
							<div class="clear"></div>
						</div>
						<?php } ?>
						
						<?php if (get_option($wlm_shortname."_header_sociallinks") == 'true') { ?>
						<div class="page-header-subscribe">
						  <span><?php _e('Subscribe','royalnews'); ?></span>
						  <?php if (get_option($wlm_shortname.'_twitter')) { ?><a href="<?php echo get_option($wlm_shortname.'_twitter'); ?>" class="subscribe-twitter"></a><?php } ?>
						  <?php if (get_option($wlm_shortname.'_facebook')) { ?><a href="<?php echo get_option($wlm_shortname.'_facebook'); ?>" class="subscribe-facebook"></a><?php } ?>
						  <?php if (get_option($wlm_shortname.'_pinterest')) { ?><a href="<?php echo get_option($wlm_shortname.'_pinterest'); ?>" class="subscribe-pinterest"></a><?php } ?>
						  <?php if (get_option($wlm_shortname.'_googleplus')) { ?><a href="<?php echo get_option($wlm_shortname.'_googleplus'); ?>" class="subscribe-googleplus"></a><?php } ?>
						  <?php if (get_option($wlm_shortname.'_instagram')) { ?><a href="<?php echo get_option($wlm_shortname.'_instagram'); ?>" class="subscribe-instagram"></a><?php } ?>
						</div>
						<?php } ?>
					
						<div class="clear"></div>
					
					<?php } ?>
					
				  </header>
				  <!-- \\ page header end \\ -->
