<?php

$context = Timber::get_context();
$context['options'] = get_fields('options');
$context['page_class'] = 'page-home';

$post = new TimberPost();
$context['post'] = $post;

// Pagination
global $paged; if (!isset($paged) || !$paged) $paged = 1;

//adding post type to context
$args_myposttype = array(
  'post_type' => 'myposttype',
  'posts_per_page' => 3,
  'paged' => $paged
);
query_posts($args_myposttype);
$context['myposttype'] = Timber::get_posts($args_myposttype);

//Adding categories to context
$context['categories'] = Timber::get_terms( 'category', array(
    'exclude' => array(5, 1),
) );

Timber::render('twig/pages/home.twig', $context);
