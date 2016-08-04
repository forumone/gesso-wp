<?php
$data = Timber::get_context();
$context['post'] = $post;
Timber::render( '404.twig', $context );
?>
