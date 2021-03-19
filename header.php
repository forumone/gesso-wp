<?php
/**
 * Third party plugins that hijack the theme will call get_header() to get the header template.
 * We use this to start our output buffer and render into the templates/page-plugin.twig template in footer.php
 *
 * @package Gesso
 */

$GLOBALS['timberContext'] = Timber::get_context();
ob_start();
