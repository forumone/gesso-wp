<?php
/**
 * This template is for displaying the site header
 *
 * This theme, out of the box, references the correspondingly named html file
 * in the parts folder. The header and footer files are exceptions based on
 * the challenges that we unearthed that led us to this theme structure. These
 * Files are php-based out of the box but can be modified to leverage template
 * parts if desired. If, for the purposes of your current build, it necessitates
 * managing your header in a template part rather than php, you can delete any
 * unnecessary php references below and add the following snippet of code.
 *
 * @example block_template_part( 'header' );
 *
 * Futher information about block template parts in traditional theme.
 * @link https://make.wordpress.org/core/2022/10/04/block-based-template-parts-in-traditional-themes/
 *
 * Further information about the Wordpress template hierarchy.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Gesso
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'gesso' ); ?></a>
	<!-- Reference Header logo to home -->
	<?php block_template_part( 'header' ); ?>

