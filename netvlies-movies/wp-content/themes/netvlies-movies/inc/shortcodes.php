<?php
add_shortcode( 'mv_get_movies', 'show_movies');

function show_movies($atts = []) : string{
    //set the attributes for the shortcode
    $show_movies_atts = shortcode_atts( [
        'post_count' => -1,
    ], $atts);

    $movies = mv_get_movie_list($show_movies_atts['post_count']);

    return loop_trough_movies_and_display($movies);
}

add_shortcode('mv_seach_movies', 'mv_search_filter');

function mv_search_filter() : string{
    global $post;

    $categories = get_categories();

    $html = '<div class="search-form">
                <form  action="' . esc_url(get_the_permalink()) . '" method="POST" >
                    <div class="form-inputs">
                        <div class="search-and-category">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search Movies">        
                            <select name="category" id="category">
                                <option value="" selected>Select a category</option>';
                                foreach ($categories as $category) {
                                    $html .= '<option value="' . $category->name . '">' . $category->name . '</option>';
                                }
    $html .=              '</select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>            
                    </div>
                    ' .  wp_nonce_field("search_movies", "search_movies_nonce") . ' 
                </form>
             </div>';


    if(wp_verify_nonce($_POST['search_movies_nonce'], 'search_movies') && (!empty($_POST['search']) || !empty($_POST['category']))){
        $movies = get_movies_from_search($_POST['search'], $_POST['category']);
    }else{
        $movies = mv_get_movie_list();
    }

    $html .= loop_trough_movies_and_display($movies);

    return $html;
}

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

?>