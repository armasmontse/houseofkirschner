<?php 

function getInstagramPosts($args = []) {

    if(!function_exists('getSelfMediaRecent')){
        return [];
    }

    return getSelfMediaRecent($args);
}

function add_to_global_query($post = 0) {

    global $query_args;

    $post = get_post( $post );

    if(array_key_exists('post__not_in', $query_args)) {
        $query_args['post__not_in'] = array_merge($query_args['post__not_in'], [$post->ID]);
    }else {
        $query_args['post__not_in'] = [$post->ID];
    }
}

function get_thumbnail_image_url($thumbnailId = 0, $size = 'full') {

    if($thumbnailId == 0){
        $thumbnailId = get_post_thumbnail_id();
    }

    return wp_get_attachment_image_src($thumbnailId, $size)[0];

}

function get_terms_of_post($post = 0, $taxonomy = '', $output = false) {

    $post = get_post( $post );

    $terms = get_the_terms($post->ID, $taxonomy);

    
    if(!$output) {
        return $terms;
    }
    
    $echo = '';
    
    if($terms) {

        $terms = array_map(function($term) {
            $term->order = get_term_meta($term->term_id, 'order', true) ?: 0;
            return $term;
        }, $terms);

        usort($terms, function($a, $b) {
            return $a->order > $b->order;
        });

        $echo .= '<ul>';
        foreach($terms as $term) {
            $echo .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
        }
        $echo .= '</ul>';
    }

    return $echo;
}

function the_terms_of_post($post = 0, $taxonomy = '') {
    echo get_terms_of_post($post, $taxonomy, true);
}

function return_404() {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
}