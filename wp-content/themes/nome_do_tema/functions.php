<?php

/*==============================
=            Timber            =
==============================*/

Timber::$dirname = array('twig', 'views');


class StarterSite extends TimberSite {

  function __construct() {
    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    parent::__construct();
  }

  function add_to_context( $context ) {
    $context['menu'] = new TimberMenu();
    $context['site'] = $this;

    if ( function_exists( 'yoast_breadcrumb' ) ) {
        $context['breadcrumbs'] = yoast_breadcrumb('<nav id="breadcrumbs" class="main-breadcrumbs">','</nav>', false );
    }

    return $context;
  }

  function myfoo( $text ) {
    $text .= ' bar!';
    return $text;
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own fuctions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
    return $twig;
  }

}

new StarterSite();

/*=====  End of Timber  ======*/


/*==========================================
=            Custom Breadcrumbs            =
==========================================*/

add_filter( 'wpseo_breadcrumb_links', 'custom_trail' );
function custom_trail( $links ) {
    global $post;

    if (is_singular('post')) {
        $breadcrumb[] = array(
            'url' => get_page_link(40),
            'text' => 'Notícias',
        );
        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
}

/*=====  End of Custom Breadcrumbs  ======*/
