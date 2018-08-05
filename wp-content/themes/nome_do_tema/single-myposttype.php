<?php

// Context
$context = Timber::get_context();
$context['page_class'] = 'page-myposttype';


// Post
$post = new TimberPost();
$context['post'] = $post;

// Render view
Timber::render('pages/single-myposttype.twig', $context);


