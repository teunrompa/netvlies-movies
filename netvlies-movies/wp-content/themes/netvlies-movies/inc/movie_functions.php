<?php
function loop_trough_movies_and_display(WP_Query $movies) : string{
    $html = '<div class="movie-container">';
    $html   .= '<div class="movie-list">';
    while($movies->have_posts()){
        $movies->the_post();

        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()));

        //gets the image url
        if(is_array($image_src)){
            $image_url = $image_src[0];
        }
        $html .= '<div class="card movie-item">';

        if(isset($image_url)){
            $html .= '<div class="image-container">';
            $html .=  '<img class="img-top img-thumbnail rounded mx-auto movie-image" src=' . $image_url . '>';
            $html .= '</div>';
        }
        $html .=    '<div class="card-body">';
        $html .=        '<h5 class="card-title">' . get_the_title() . '</h5>';

        $html .=        '<p class="card-text">' . get_the_excerpt() . '</p>';
        $html .=        '<a class="btn btn-primary" href="' . get_the_permalink() . '">Read more</a>';
        $html .=    '</div>';
        $html .= '</div>';
    }
    $html .= '</div></div>';

    return $html;
}


function get_movies_from_search(string $search, string $category) : WP_Query{
    if(!empty($search) && !empty($category))
        return mv_get_movie_by_category_and_name($category, $search);

    if(!empty($search))
        return mv_get_movie_by_name($search);

    if(!empty($category))
        return mv_get_movie_by_category($category);

    return mv_get_movie_list();
}

/** Get movies from database
 * @param int $post_count
 * @return WP_Query
 */
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

function mv_get_movie_by_name(string $name, int $post_count = -1) : WP_Query{
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
