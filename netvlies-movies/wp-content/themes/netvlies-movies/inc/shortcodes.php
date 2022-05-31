<?php
add_shortcode( 'mv_get_movies', 'show_movies');

function show_movies($atts = []) : string{
    //set the attributes for the shortcode
    $show_movies_atts = shortcode_atts( [
        'post_count' => -1,
    ], $atts);

    $movies = mv_get_movie_list($show_movies_atts['post_count']);

    $html = '<div class="movie-list">';

    if($movies->have_posts()){
        while($movies->have_posts()){
            
            $movies->the_post();

            $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $movies->post_ID )); 

            //gets the image url
            if(is_array($image_src)){
                $image_url = $image_src[0];
            }

            $html .= '<div class="movie-item">';
            $html .= '<h5>' . get_the_title() . '</h5>';

            if(isset($image_url))
                $html .=  '<img src=' . $image_url . '>';
            
            $html .= '<p>' . get_the_excerpt() . '</p>';
            $html .= '<a href="' . get_the_permalink() . '">Read more</a>';
            $html .= '</div>';
        }
    }

    $html .= '</div>';

    return $html;
}

?>