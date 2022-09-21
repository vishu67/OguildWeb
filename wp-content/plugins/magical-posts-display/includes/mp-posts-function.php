<?php 
/*
* All posts function goes here
*
*
*/

// posts title elementor style

if( !function_exists('mp_post_title') ){
    function mp_post_title($show = 1, $tag="h2", $crop_title="5", $class = 'mp-post-title'){
    if( $show ):
         ?>
<a class="mpp-title-link <?php echo esc_attr($class); ?>" href="<?php the_permalink(); ?>">
    <?php
                printf( '<%1$s class="mgp-ptitle">%2$s</%1$s>',
                                tag_escape( $tag ),
                                wp_trim_words( get_the_title(), $crop_title ) );
            ?>
</a>
<?php 
    endif; 
    }
}

// posts tuhumbnail 

if( !function_exists('mp_post_thumbnail') ){
    function mp_post_thumbnail($show = 1, $size="large", $class="mp-card-img"){
        if( has_post_thumbnail() && $show ):
         ?>
<div class="mp-post-img <?php echo esc_attr($class); ?>">
    <figure>
        <?php the_post_thumbnail( $size ); ?>
    </figure>
</div>
<?php 
    endif; 
    }
}



// post catgery display
if( !function_exists('mp_post_cat_display') ){
    function mp_post_cat_display($show = 1, $num = 'one',$all_sep = '/ ', $class="mp-post-cat"){
        if(! $show ){
            return;
        }
        $mpg_cat_list = get_the_category_list( esc_html__( $all_sep, 'magical-addons-for-elementor' ) );

        $mpdr_category = get_the_category();
        if( $mpdr_category && $num == 'one' ){
            $mpd_category = $mpdr_category[mt_rand(0,count( $mpdr_category)-1)];
?>
<div class="mppost-cats mpcat-one <?php echo esc_attr($class); ?>">

    <?php
        echo '<i class="icon-mp-folder-oe"></i> <a href="'.esc_url(get_category_link($mpd_category)).'">'. esc_html($mpd_category->name).'</a>';
?>
</div>
<?php
        }elseif( $mpg_cat_list && $num != 'one'){
        ?>
<div class="mppost-cats mpcat-all <?php echo esc_attr($class); ?>">
    <?php  
                     printf( '<span class="mgp-post-cats">' . esc_html__( ' %1$s', 'magical-addons-for-elementor' ) . '</span>', $mpg_cat_list );
                ?>
</div>
<?php
        }else{
            echo '<div class="mppost-cats no-cat '.esc_attr($class).'"></div>';
        }
    
    }
}