<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * This theme, out of the box, references the correspondingly named html file
 * in the parts folder. This strategy leverages the quasi-block editor
 * approach that Forum One is taking. If, for the purposes of your current
 * build, it necessitates managing your template in PHP rather than the
 * editor, you can use the following reference as a starter guide.
 *
 * Creating a php based 404 page.
 * @link https://developer.wordpress.org/themes/functionality/404-pages/
 *
 * Futher information about block template parts in traditional theme.
 * @link https://make.wordpress.org/core/2022/10/04/block-based-template-parts-in-traditional-themes/
 *
 * Further information about the Wordpress template hierarchy.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#category
 *
 * @package Gesso
 *
*/

get_header();
?>

<?php block_template_part( '404' ); ?>

<?php
get_footer();
