<?php

declare(strict_types=1);


require_once(__DIR__ . '/inc/shortcodes.php');

add_action('init', 'mv_init');

function mv_init(){
   add_theme_support( 'post-thumbnails' ); 
   mv_setup_post_type();
   mv_load_stylesheets();
}

function mv_load_stylesheets(){
    wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/css/style.css');
}

function mv_setup_post_type(){
    register_post_type('movies', array(
        'labels' => array(
            'name' => 'Movies',
            'singular_name' => 'Movie'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'movies'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'post-formats'),
        'taxonomies' => array('category', 'post_tag')
    ));
}

function mv_get_movie_list(int $post_count) : WP_Query{
    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => -1
    );
    $movies = new WP_Query($args);
    return $movies;
}
?>
