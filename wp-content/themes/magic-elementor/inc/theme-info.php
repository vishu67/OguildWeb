<?php

/**
 * Magic Theme dashboard info
 *
 * The info will be very helpfull for theme user
 *
 * @package Magic Elementor
 */

class magicElementorUserInfo
{
	/**
	 * The slug name to refer to this menu by.
	 *
	 * @var string $menu_slug The menu slug.
	 */
	public $slug = 'magic-elementor';
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		add_action('admin_notices', array($this, 'notice'));
		add_action('admin_enqueue_scripts', array($this, 'admin_info_assets'));
		add_action('wp_ajax_dismissopenot', array($this, 'welcome_video_infohide'));
		add_action('switch_theme', array($this, 'change_the_theme'));
	}

	/**
	 * Html Notice
	 */
	public function notice()
	{
		global $pagenow;
		$screen = get_current_screen();
		$admin_info = get_option('mge-admin-winfo');
		if ($admin_info) {
			return;
		}

		if ('themes.php' === $pagenow && 'themes' === $screen->base) {

?>
			<div class="mgadin-notice notice notice-success mgadin-theme-dashboard mgadin-theme-dashboard-notice mge is-dismissible meis-dismissible">
				<?php $this->html_hero();
				?>
			</div>
		<?php

		}
	}

	function change_the_theme()
	{
		delete_option('mge-admin-winfo');
	}


	/**
	 * Html Hero
	 *
	 * @param string $location The location.
	 */
	public function html_hero()
	{

		?>
		<div class="mgadin-hero">
			<div class="mge-info-content">
				<div class="mge-info-hello">
					<?php esc_html_e('Hello, ', 'magic-elementor'); ?>

					<?php
					$current_user = wp_get_current_user();
					$video_link = 'https://www.youtube.com/watch?v=jTEckmVe9dE';

					echo esc_html($current_user->display_name);
					?>

					<?php esc_html_e('👋🏻', 'magic-elementor'); ?>
				</div>

				<div class="mge-info-title">
					<?php esc_html_e('Welcome to Magic Elementor', 'magic-elementor'); ?>
				</div>
				<div class="mge-info-desc">
					<?php esc_html_e('Thanks for choosing Magic Elementor. We recommend that you see the Magic Elementor Theme Guide Video to know the basics of Magic Elementor.', 'magic-elementor'); ?>
				</div>
				<div class="mge-info-actions">
					<a href="<?php echo esc_url($video_link); ?>" target="_blank" class="button button-primary">
						<?php esc_html_e('Theme Guide Video', 'magic-elementor'); ?>
						<i class="dashicons dashicons-video-alt3"></i>
					</a>
				</div>

			</div>

			<div class="mge-info-image">
				<span>
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/info-banner.jpg'); ?>">
				</span>
			</div>
		</div>
<?php
	}
	/*
	*
	* Admin info style and scripts
	*
	*/
	public function admin_info_assets()
	{
		$ajax_url = admin_url('admin-ajax.php');
		$nonce = wp_create_nonce('dismissopenot');

		wp_enqueue_style('magic-elementor-admininfo-style', get_template_directory_uri() . '/assets/css/admin-info.css', array(), MAGIC_ELEMENTOR_VERSION);

		wp_enqueue_script('magic-elementor-admininfo-scripts', get_template_directory_uri() . '/assets/js/admin-info.js', array(), MAGIC_ELEMENTOR_VERSION, true);
		wp_localize_script('magic-elementor-admininfo-scripts', 'mgelajinfo', ['ajax_url' => $ajax_url, 'nonce' => $nonce]);
	}

	public function welcome_video_infohide()
	{
		if (check_ajax_referer('dismissopenot', 'nonce')) {
			if (isset($_POST['dismiss']) && $_POST['dismiss'] == 1) {
				update_option('mge-admin-winfo', 1);
				wp_die('done');
			}
		}
	}
}

new magicElementorUserInfo();
