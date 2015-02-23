<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="ie6 lt-ie9 lt-ie8 lt-ie7 no-js"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="ie7 lt-ie9 lt-ie8 no-js"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="ie8 lt-ie9 no-js"> <![endif]-->
<!--[if IE 9]>         <html <?php language_attributes(); ?> class="ie9 no-js"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title('', 'gesso'); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" rel="shortcut icon">
		<meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		
		<div class="skiplinks">
      <a href="#main" class="skiplinks__link element-invisible element-focusable">Skip to main content</a>
    </div>

		<header class="header" role="banner">
			<div class="header-inner layout-constrain">
				<?php gesso_nav('secondary'); ?>				 
				<a href="<?php echo home_url(); ?>" class="sitename"><?php bloginfo('name'); ?></a>
				<?php get_template_part('templates/searchform'); ?>
				<?php gesso_nav('primary'); ?>
			</div>
		</header>
