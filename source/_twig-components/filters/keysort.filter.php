<?php
/**
 * Sort an array by key
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
function addKeySortFilter( \Twig_Environment &$env, $config ) {
	$env->addFilter(
		new \Twig_SimpleFilter(
			'keysort',
			function ( $array ) {
				ksort( $array );
				return $array;
			}
		)
	);
}
