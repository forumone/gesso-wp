<?php
  $context = Timber::get_context();
  $post = new Timber\Post();
  $context['post'] = $post;
  Timber::render( '404.twig', $context );
?>
