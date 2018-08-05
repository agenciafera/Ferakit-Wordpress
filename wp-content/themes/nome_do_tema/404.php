<?php

// Context
$context = Timber::get_context();

// Post Data
$post = new TimberPost();
$context['post'] = $post;

// Page Class
$context['page_class'] = 'page-404';

// Render the view
Timber::render('pages/404.twig', $context);


