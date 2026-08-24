<?php
if(!defined('ABSPATH')){
    exit;
}

class Epicurisme_Newsletter_Posts{
    public function get_latest_posts($limit= 5){
        return new WP_Query(
            array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $limit,
                'orderby' => 'date',
                'order' => 'DESC',
            )
        );
    }

    private function get_post_category($post_id){
        $categories = get_the_category($post_id);

        if(empty($categories)){
            return '';
        }

        foreach($categories as $category){
            if(0 !==(int)$category->parent){
                return $category->name;
            }
        }
        return $categories[0]->name;
    }

    public function get_newsletter_posts( $limit = 5){
        $query = $this->get_latest_posts($limit);

        $posts =array();

        foreach($query->posts as $post){
            $image = get_the_post_thumbnail_url($post->ID, 'large');

            if( ! $image){
                 $image = EPICURISME_NEWSLETTER_URL
                . 'assets/images/default-article.webp';
            }

            $posts[] = array(
                'title'    => html_entity_decode(
                                get_the_title( $post->ID ),
                                ENT_QUOTES,
                                'UTF-8'
                            ),
                'url'      => get_permalink( $post->ID ),
                'image'    => $image,
                'category' => $this->get_post_category( $post->ID ),
            );
        }
        return $posts;
    }

}