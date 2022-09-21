<?php
/**
 * Widget API: mgpd_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
if(!class_exists('mgpd_Recent_Posts')):
class mgpd_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'mgpd_Recent_Posts',
			'description' => __( 'You can show your site popular posts and recent posts by this Magical Posts display widget.','magical-posts-display' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'mpdw-recent-posts', __( 'Magical Posts','magical-posts-display' ), $widget_ops );
		$this->alt_option_name = 'mgpd_Recent_Posts';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : true;
		$psourch = isset($instance['psourch'])?$instance['psourch']:'one-psourch';

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		if( $psourch == 'one-psourch' ){
			$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		), $instance ) );
		}else{
			$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'meta_key' => 'mpd_my_post_viewed',
		 	'orderby' => 'meta_value_num',
		), $instance ) );

		}
		

		if ( ! $r->have_posts() ) {
			return;
		}
		?>
		<?php echo $args['before_widget']; ?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul class="mpdw-recent-posts">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title = get_the_title( $recent_post->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				?>
				<li class="mpdw-recent-item mb-3">
					<div class="row">
						<?php if(has_post_thumbnail( $recent_post->ID )): ?>
						<div class="col-sm-4">
							<div class="mpdw-recent-img mb-1">
								<?php echo get_the_post_thumbnail( $recent_post->ID, 'medium' ); ?>
							</div>
							
						</div>
						<div class="col-sm-8">
						<?php else: ?>
						<div class="col-sm-12">
						<?php endif; ?>
							<div class="mpdw-recent-text">
								<h4><a href="<?php the_permalink( $recent_post->ID ); ?>"><?php echo esc_html(wp_trim_words($title,'6','..'));  ; ?></a></h4>
							<?php if ( $show_date ) : ?>
								<span class="post-date"><?php echo get_the_date( 'M j, Y', $recent_post->ID ); ?></span>
							<?php endif; ?>
							</div>
						</div>
					</div>
					
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : true;
		$instance['psourch'] = isset($new_instance['psourch'])?$new_instance['psourch']: 'one-psourch';

		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
		$psourch = isset($instance['psourch'])?$instance['psourch']:'one-psourch';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<p>
            <label for="<?php echo $this->get_field_id( 'psourch' ); ?>"><?php esc_html_e('Posts show by:','magical-posts-display'); ?></label>
            <select id="<?php echo $this->get_field_id( 'psourch' ); ?>" name="<?php echo $this->get_field_name( 'psourch' ); ?>">
                <option value="one-psourch" <?php selected( $psourch, 'one-psourch'); ?>>
                    <?php echo esc_html_e('Recent post','magical-posts-display'); ?>
                </option>
                <option value="two-psourch" <?php selected( $psourch, 'two-psourch' ); ?>>
                    <?php echo esc_html_e('Popular post','magical-posts-display'); ?>
                </option>
                
             </select>
        </p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}

function reg_mpd_recent_widget(){
	register_widget( 'mgpd_Recent_Posts' );
}
add_action('widgets_init','reg_mpd_recent_widget');

endif;