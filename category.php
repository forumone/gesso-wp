<?php

$args = array(
    'posts_per_page' => 10,
    'paged' => $paged
);
// query_posts($args);
$data = Timber::get_context();
$data['pagination'] = Timber::get_pagination();
$data['archive_title'] = get_cat_name(get_query_var('cat'));
$data['archive_description'] = term_description();
$data['page'] = 'category';
$template = 'category.twig';

Timber::render($template, $data);

?>
