<?php

declare(strict_types=1);

require_once(__DIR__ . '/inc/shortcodes.php');

add_action('init', 'mv_init');

function mv_init(){
   add_theme_support( 'post-thumbnails' ); 
   custom_load_bootstrap();
   mv_setup_post_type();
   mv_load_stylesheets();
}

function custom_load_bootstrap(){
    wp_enqueue_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), 1, true);
}

function mv_load_stylesheets(){

    //Dont aplly styles on the admin page or login pages
    if(is_admin() || is_login()) return;

    wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/css/style.css');
}

function is_login() : bool{
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
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

function mv_get_movie_list(int $post_count = -1) : WP_Query{
    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => $post_count
    );
    return new WP_Query($args);
}

function mv_get_movie_by_category_and_name( string $category, string $search ,int $post_count = -1) : WP_Query{
    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => $post_count,
        's' => $search,
        'category_name' => $category,
    );
    return new WP_Query($args);
}

function mv_get_movie_by_name(string $name, int $post_count = -1){
    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => $post_count,
        's' => $name,
    );
    return new WP_Query($args);
}

function mv_get_movie_by_category(string $category, int $post_count = -1) : WP_Query{
    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => $post_count,
        'category_name' => $category,
    );
    return new WP_Query($args);
}

function get_movies_from_search(string $search, string $category) : WP_Query{
    if(!empty($search) && !empty($category))
        return mv_get_movie_by_category_and_name($category, $search);

    if(!empty($search))
        return mv_get_movie_by_name($search);

    if(!empty($category))
        return mv_get_movie_by_category($category);
}

?>
