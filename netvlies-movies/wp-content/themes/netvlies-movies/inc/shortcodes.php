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

    //Get the nonce and check if its valid
    if(isset($_POST['search_movies_nonce']))
        $nonce = wp_verify_nonce($_POST['search_movies_nonce'], 'search_movies');

    if(!empty($nonce) && (!empty($_POST['search']) || !empty($_POST['category']))){
        $movies = get_movies_from_search($_POST['search'], $_POST['category']);
    }else{
        $movies = mv_get_movie_list();
    }

    $html .= loop_trough_movies_and_display($movies);

    return $html;
}


add_shortcode('show_movie_detail', 'mv_display_single_movie');

function mv_display_single_movie(): string
{
    global $post;

    $html =     '<div class="movie-container">';
    $html .=        '<div >';

    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()));

    //gets the image url
    if(is_array($image_src)){
        $image_url = $image_src[0];
    }

    if(!empty($image_url)){
        $html .= '<div class="image-container">';
        $html .=    '<img class="movie-image card-img-top" src="' . $image_url . '" alt="' . get_the_title() . '">';
        $html .= '</div>';
    }

    $html .=    '<div class="movie-content">';
    $html .=                '<h5>' . get_the_title() . '</h5>';
    $html .=                '<div class="movie-excerpt">';
    $html .=                    '<p >' . get_the_excerpt() . '</p>';
    $html .=             '</div>';
    $html .=                '<div class="movie-description">';
    $html .=                    '<p >' . get_the_content() . '</p>';
    $html .=                '</div>';
    $html .=            '</div>';
    $html .=        '</div>';
    $html .=    '</div>';

    return $html;
}



?>