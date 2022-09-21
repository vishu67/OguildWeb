<?php 
/*
*
*  Magical Posts Display plugin elementor helper function
*
*
*/




if( !class_exists('mpd_posts_meta_author_date') ){
    function mpd_posts_meta_author_date($author ='', $date ='', $class ='mt-3 text-right') {
    ?>
        <div class="mp-meta mgp-ms2 <?php echo esc_attr($class); ?>">
            <div class="row">
                <?php if( $author ): ?>
                <div class="col-auto">
                    <?php mp_display_posted_by(); ?>
                </div>
                <?php endif; ?>
                <?php if( $date ): ?>
                    <div class="col-auto ml-auto text-right">
                        <span class="mgp-time">
                            <i class="icon-mp-clock"></i>
                            <?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }
}

if( !class_exists('mpd_posts_meta') ){
    function mpd_posts_meta($author ='',$date ='',$comment ='',$class = 'mb-2') {
    ?>
        <div class="mp-meta bottom-meta <?php echo esc_attr($class); ?>">
            <?php
                if( $author ){
                    mp_display_posted_by(); 
                }
                if( $date ){
                    echo '<span class="mp-posts-date">';
                    echo '<i class="icon-mp-clock"></i> ';
                    echo get_the_date();
                    echo '</span>';
                }
                if( $comment ){
                    mp_display_single_comment_icon();
                }
            ?>
        </div>
    <?php
    }
}

if( !class_exists('mpd_post_tags') ){
    function mpd_post_tags( $show ='' ) {
        
        $mgp_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'magical-posts-display' ) );
        if(  $mgp_tags_list && $show == 'yes' ){

        printf( '<span class="mpg-tags-links"><i class="icon-mp-tag"></i>' . esc_html__( ' %1$s', 'magical-posts-display' ) . '</span>', $mgp_tags_list ); 
        }else{
            return;
        }

    }
}

if( !class_exists('mpd_get_allowed_html_tags') ){
    function mpd_get_allowed_html_tags() {
        $allowed_html = [
            'b' => [],
            'i' => [],
            'u' => [],
            'em' => [],
            'br' => [],
            'abbr' => [
                'title' => [],
            ],
            'span' => [
                'class' => [],
            ],
            'strong' => [],
        ];

            $allowed_html['a'] = [
                'href' => [],
                'title' => [],
                'class' => [],
                'id' => [],
            ];
    
        return $allowed_html;
    }
}

if(!function_exists('mpd_kses_tags')){
    function mpd_kses_tags( $string = '' ) {
        return wp_kses( $string, mpd_get_allowed_html_tags() );
    }
}




/* 
* Category list
* return first one
*/
if(!function_exists('mp_display_product_catlist')){
    function mp_display_product_catlist( $id = null, $taxonomy = 'category', $limit = 1 ) { 
        $terms = get_the_terms( $id, $taxonomy );
        $i = 0;
        if ( is_wp_error( $terms ) )
            return $terms;

        if ( empty( $terms ) )
            return false;

        foreach ( $terms as $term ) {
            $i++;
            $link = get_term_link( $term, $taxonomy );
            if ( is_wp_error( $link ) ) {
                return $link;
            }
            echo '<a href="' . esc_url( $link ) . '">' . $term->name . '</a>';
            if( $i == $limit ){
                break;
            }else{ continue; }
        }
    }
}

/**
 * Get Post List
 * return array
 */
if(!function_exists('mp_display_posts_name')){
    function mp_display_posts_name( $post_type = 'post' ){
        $options = array();
        $options['0'] = __('Select','bstoolkit-for-elementor');
    // $perpage = mp_display_get_option( 'loadproductlimit', 'mp_display_others_tabs', '20' );
        $all_post = array( 'posts_per_page' => -1, 'post_type'=> $post_type );
        $post_terms = get_posts( $all_post );
        if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ){
            foreach ( $post_terms as $term ) {
                $options[ $term->ID ] = $term->post_title;
            }
            return $options;
        }
    }
}
/**
 *  Taxonomy List
 * @return array
 */
if(!function_exists('mp_display_taxonomy_list')){
    function mp_display_taxonomy_list( $taxonomy = 'category' ){
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ));
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
            //  $options[ $term->slug ] = $term->name;
                $options[ $term->term_id ] = $term->name;
            }
            return $options;
        }
    }
}
/**
 *  Taxonomy slug List
 * @return array
 */
if(!function_exists('mp_display_taxonomy_sluglist')){
    function mp_display_taxonomy_sluglist( $taxonomy = 'category' ){
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
        ));
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
            //  $options[ $term->slug ] = $term->name;
                $options[ $term->slug ] = $term->name;
            }
            return $options;
        }
    }
}

// posts button 
if( !function_exists('mp_post_btn') ){
    function mp_post_btn( $text= 'Read More', $icon_show='',$icon='', $icon_position = 'right', $target='_self', $class='mp-btn-link'){
       
          
    ?>

<?php if( $icon_show ): ?>
<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>" class="mp-post-btn <?php echo esc_attr($class); ?>">
    <?php if($icon_position=='left'): ?>

    <span class="left"><?php \Elementor\Icons_Manager::render_icon( $icon ); ?></span>

    <?php endif; ?>
    <span><?php echo mpd_kses_tags($text); ?></span>
    <?php if($icon_position=='right'): ?>
    <span class="right"><?php \Elementor\Icons_Manager::render_icon( $icon ); ?></span>
    <?php endif; ?>
</a>
<?php else: ?>
<a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>" class="mp-post-btn <?php echo esc_attr($class); ?>"><?php echo  mpd_kses_tags($text); ?></a>
<?php endif; ?>


<?php
    }
}

if( !function_exists('mp_go_pro_template') ):
 function mp_go_pro_template( $texts ) {
    ob_start();
    
    ?>
    <div class="elementor-nerd-box">
        <img class="elementor-nerd-box-icon" src="<?php echo esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ); ?>" />
        <div class="elementor-nerd-box-title"><?php echo esc_html( $texts['title'] ); ?></div>
            <div class="elementor-nerd-box-message"><?php echo esc_html($texts['massage'] ); ?></div>
<?php
        // Show a `Go Pro` button only if the user doesn't have Pro.
        if ( $texts['link'] ) { ?>
            <a class="elementor-nerd-box-link elementor-button elementor-button-default elementor-button-go-pro" href="<?php echo esc_url(  $texts['link']  ); ?>" target="_blank">
                <?php echo esc_html__( 'Go Pro', 'elementor' ); ?>
            </a>
        <?php } ?>
    </div>
    <?php
    return ob_get_clean();
}
endif;



