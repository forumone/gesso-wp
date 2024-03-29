<?php
/**
 * The template for displaying the front page of the site
 *
 * This theme, out of the box, references the correspondingly named html file
 * in the parts folder. This strategy leverages the quasi-block editor
 * approach that Forum One is taking. If, for the purposes of your current
 * build, it necessitates managing your template in PHP rather than the
 * editor, you can use the following reference as a starter guide.
 *
 * Creating a php based front page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/#home-php
 *
 * Futher information about block template parts in traditional theme.
 * @link https://make.wordpress.org/core/2022/10/04/block-based-template-parts-in-traditional-themes/
 *
 * Further information about the Wordpress template hierarchy.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gesso
 */

get_header();
?>

<?php block_template_part( 'front-page' ); ?>

<?php
get_footer();
