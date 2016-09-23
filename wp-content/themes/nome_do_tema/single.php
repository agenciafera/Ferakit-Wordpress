<?php

// Context
$context = Timber::get_context();

// The Post
$post = Timber::query_post();
$context['post'] = $post;

// Render template
Timber::render('pages/single.twig', $context);
