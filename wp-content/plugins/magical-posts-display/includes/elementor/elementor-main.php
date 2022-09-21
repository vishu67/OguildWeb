<?php 
/*
*
* Elementor main class
*
*/

class mgPostsElementorMain{

	 function __construct(){

	 	require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/extra.php' );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_new_category' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_widget_styles' ] );
		add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'frontend_assets_scripts' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_widget_style' ] );


	}


	public function init_widgets() {

//Posts Grid
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-grid.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEPostsGrid() );
//Posts list
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-list.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEPostsList() );
//Awesome Posts list
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/awesome-posts-list.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEAwesomePostsList() );
// Posts Carousel
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-carousel.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgPosts_carousel() );
	
// Posts Slider
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-slider.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEPostsSlider() );

// Posts Accordion
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-accordion.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEPostsAccordion() );

// Posts Tabs
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-tab.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEPostsTab() );
// Posts Tabs
		require_once( MAGICAL_POSTS_DISPLAY_DIR. '/includes/elementor/widgets/posts-ticker.php' );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mgpdEPostsTicker() );

		

	}
	
public function register_new_category(\Elementor\Elements_Manager $elements_manager){

		 //add our categories
 		$category_prefix = 'mgp-';

	if(class_exists('magicalPostDisplayPro')){
		$elements_manager->add_category($category_prefix.'mgposts',[
			'title' => esc_html__('Magical Posts Display','magical-posts-display'),
			'icon' => 'fa fa-magic',
		]);
	}else{
			$elements_manager->add_category(
				$category_prefix.'mgposts',
				[
					'title' => esc_html__('Magical Posts Display','magical-posts-display'),
					'icon' => 'fa fa-magic',
				]
			);
			$reorder_cats = function() use($category_prefix){
				uksort($this->categories, function($keyOne, $keyTwo) use($category_prefix){
					if(substr($keyOne, 0, 4) == $category_prefix){
						return -1;
					}
					if(substr($keyTwo, 0, 4) == $category_prefix){
						return 1;
					}
					return 0;
				});

			};
			$reorder_cats->call($elements_manager);

		} // check pro version

	}


	/**
	 * Add style and scripts
	 *
	 * Add the plugin style and scripts for this
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	/*
	plugin css
	*/
	function frontend_widget_styles(){
		wp_enqueue_style("mp-accordion-style", MAGICAL_POSTS_DISPLAY_ASSETS.'css/widget-style/mp-accordion.css',array(),MAGICAL_POSTS_DISPLAY_VERSION, 'all');

		wp_enqueue_style("mp-tab-style", MAGICAL_POSTS_DISPLAY_ASSETS.'css/widget-style/mp-tabs.css',array(),MAGICAL_POSTS_DISPLAY_VERSION, 'all');


	}


		/*
	plugin elementor js
	*/
	function frontend_assets_scripts(){
		//posts carousel active
		wp_enqueue_script("mpd-carousel-script-js", MAGICAL_POSTS_DISPLAY_ASSETS.'js/widgets-active/posts-carousel-active.js',array('jquery'),MAGICAL_POSTS_DISPLAY_VERSION,true);
		// posts slider active
		wp_enqueue_script("mpd-slider-script-js", MAGICAL_POSTS_DISPLAY_ASSETS.'js/widgets-active/post-slider-active.js',array('jquery'),MAGICAL_POSTS_DISPLAY_VERSION,true);
		// posts ticker active
		wp_enqueue_script("mpd-ticker-script-js", MAGICAL_POSTS_DISPLAY_ASSETS.'js/widgets-active/posts-ticker-active.js',array('jquery'),MAGICAL_POSTS_DISPLAY_VERSION,true);

	}

		/*
	plugin elementor js
	*/
	function editor_widget_style(){

		wp_enqueue_style("mp-elementor-style", MAGICAL_POSTS_DISPLAY_ASSETS.'css/elementor-admin.css',array(),MAGICAL_POSTS_DISPLAY_VERSION, 'all');
	
	
		
		

	}

		

}

new mgPostsElementorMain();


