<?php

/*
Template Name: Blog
*/

// Context
$context = Timber::get_context();
$context['options'] = get_fields('options');
$context['page_class'] = 'page-blog';

// Page
$post = new TimberPost();
$context['post'] = $post;

// Pagination
global $paged; if (!isset($paged) || !$paged) $paged = 1;


$args = array(
  'post_type' => 'post',
  'posts_per_page' => 10,
  'paged' => $paged
);
query_posts($args);
$context['blogs'] = Timber::get_posts();


// Render view
Timber::render('twig/pages/blog.twig', $context);