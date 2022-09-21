<?php
/**
 * Dashboard home tab template
 */

defined( 'ABSPATH' ) || die();
?>

<div id="mgpdp1" class="magical-post-display mgpdp1">
    <div class="mg-cols">
    	<section class="sec-wel" <?php if(!class_exists('magicalPostDisplayPro')): ?> style="background-image: url(<?php echo MAGICAL_POSTS_DISPLAY_ASSETS; ?>img/blue.svg);" <?php else: ?>style="background-image: url(<?php echo MAGICAL_POSTS_DISPLAY_ASSETS; ?>img/purple.svg);"<?php endif; ?>>
    		<div class="wel-center-text">
    			<div class="welsec-icon">
    				<img src="<?php echo MAGICAL_POSTS_DISPLAY_ASSETS; ?>img/icons/coffee.svg">
    			</div>
    			<div class="wel-sect-text">
    				<h1><?php esc_html_e( 'Welcome Magical Posts Display', 'magical-post-display' ); ?></h1>
    				<h5><?php esc_html_e( 'Thank you for installing Magical Posts Display WordPress plugin, It\'s awesome !! ', 'magical-post-display' ); ?><br ><?php esc_html_e( ' Now You can show your site posts awesome way!!', 'magical-post-display' ); ?></h5>
					<a class="button button-mgp1 venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=7BCThHcUSHk">
					<?php esc_html_e( 'See Short Video', 'magical-post-display' ); ?>
                    </a>
    				
                <?php if(!class_exists('magicalPostDisplayPro')): ?>
    				<a href="https://wpthemespace.com/product/magical-posts-display-lifetime/" class="button button-mgp1 button-mgp2"><?php esc_html_e( 'Buy Pro Now', 'magical-post-display' ); ?></a>
                <?php endif; ?>
    			</div>
    			
    		</div>
    	</section>
    	<section class="mgfeature mgf1">
    		<div class="cols">
    			<div class="col-2">
    				<div class="mgfimg">
    					<img src="<?php echo MAGICAL_POSTS_DISPLAY_ASSETS; ?>img/blocks-intro.svg">
    				</div>
    			</div>
    			<div class="col-2">
    				<div class="mgftext">
    					<h2><?php esc_html_e( 'Elementor and Gutenberg blocks WordPress Posts Display plugin', 'magical-post-display' ); ?></h2>
    					<p><?php esc_html_e( 'Now you can easily display your site posts many diffrent way. You can show your posts by posts carousel, posts grid, posts list grid, posts list, posts accordion, posts categories tab, So save your time and money.', 'magical-post-display' ); ?></p>
						<a href="<?php echo get_admin_url(); ?>post-new.php?post_type=page" class="button button-mgp1 button-mgp2"><?php esc_html_e( 'Create Your Page With Magical Posts Blocks', 'magical-post-display' ); ?></a>
    				</div>
    			</div>
    		</div>
    	</section>
    	<section id="mgvideos" class="mgfeature mgf2">
    		<div class="wel-center-text">
    			<div class="mpd-sect-text">
    				<h1><?php esc_html_e( 'Video Tutorial', 'magical-post-display' ); ?></h1>
    				<h5><?php esc_html_e( 'How to use Magical Posts Display WordPress plugin in your site? ', 'magical-post-display' ); ?></h5>
    			</div>
    			<div class="cols">
    				<div class="col-4">
    					<div class="mgvideo">
    						<a class="btn btn-danger venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=oZJYe4HEI4A">
                                <img src="https://img.youtube.com/vi/oZJYe4HEI4A/0.jpg" alt="<?php echo esc_attr__( 'Video tutorial', 'magical-post-display' ); ?>">
                            </a>
                            <h3><?php esc_html_e( 'Magical Posts Carousel Video', 'magical-post-display' ); ?></h3>
    						</div>
    				</div>
    				<div class="col-4">
    					<div class="mgvideo">
    						<a class="btn btn-danger venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=0z5JoFWRyw0">
                                <img src="https://img.youtube.com/vi/0z5JoFWRyw0/0.jpg" alt="<?php echo esc_attr__( 'Video tutorial', 'magical-post-display' ); ?>">
                            </a>
                            <h3><?php esc_html_e( 'Magical Posts Grid Video', 'magical-post-display' ); ?></h3>
    						</div>
    				</div>
    				<div class="col-4">
    					<div class="mgvideo">
    						<a class="btn btn-danger venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=Y3btoJtd0h8">
                                <img src="https://img.youtube.com/vi/Y3btoJtd0h8/0.jpg" alt="<?php echo esc_attr__( 'Video tutorial', 'magical-post-display' ); ?>">
                            </a>
                            <h3><?php esc_html_e( 'Magical Posts Accordion Video', 'magical-post-display' ); ?></h3>
    						</div>
    				</div>
    				<div class="col-4">
    					<div class="mgvideo">
    						<a class="btn btn-danger venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=a2NPlkreH7Y">
                                <img src="https://img.youtube.com/vi/a2NPlkreH7Y/0.jpg" alt="<?php echo esc_attr__( 'Video tutorial', 'magical-post-display' ); ?>">
                            </a>
                            <h3><?php esc_html_e( 'Magical Posts Awesome List Video', 'magical-post-display' ); ?></h3>
    						</div>
    				</div>
    				<div class="col-4">
    					<div class="mgvideo">
    						<a class="btn btn-danger venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=itaSNU8_Zr8">
                                <img src="https://img.youtube.com/vi/itaSNU8_Zr8/0.jpg" alt="<?php echo esc_attr__( 'Video tutorial', 'magical-post-display' ); ?>">
                            </a>
                            <h3><?php esc_html_e( 'Magical Posts Tab Video', 'magical-post-display' ); ?></h3>
    						</div>
    				</div>
    				<div class="col-4">
    					<div class="mgvideo">
    						<a class="btn btn-danger venoboxvid btn-lg vbox-item mgyouvideo" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=AjWr7-YeJx4">
                                <img src="https://img.youtube.com/vi/AjWr7-YeJx4/0.jpg" alt="<?php echo esc_attr__( 'Video tutorial', 'magical-post-display' ); ?>">
                            </a>
                            <h3><?php esc_html_e( 'Magical Posts List Card Video', 'magical-post-display' ); ?></h3>
    						</div>
    				</div>
    				
    			</div>
    			
    		</div>
    	</section>
    	<section class="mgrating-sec">
    		<div class="mgrating">
    			<div class="mgrat-left">
    				<img src="<?php echo MAGICAL_POSTS_DISPLAY_ASSETS; ?>img/icons/coffee.svg">
    			</div>
    			<div class="mgrat-right">
    				<h2><?php echo esc_html('Happy with Our Work?','magical-post-display'); ?></h2>
    				<p><?php echo esc_html('We are really thankful to you that you have chosen our plugin. If our plugin brings a smile in your face while working, please share your happiness by giving us a 5***** rating in WordPress Org. It will make us happy and won’t take more than 2 mins.','magical-post-display'); ?></p>
    				<a class="mgstar-link" href="https://wordpress.org/support/plugin/magical-posts-display/reviews/?filter=5" target="_blank"><?php echo esc_html('I’m Happy to Give You 5*','magical-post-display'); ?></a>
    			</div>
    		</div>
    	</section>
	    
    </div>
</div>