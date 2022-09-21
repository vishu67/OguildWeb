<?php



/**
 * Magical post display Pro notice 
 */
class mgpFreeNotice
{


	/*private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}*/

	function __construct()
	{

		add_action('admin_notices', [$this, 'admin_free_notice']);
		add_action('init', [$this, 'mgfree_notice_hide_options']);
		global $pagenow;
		if (in_array($pagenow, array('plugins.php', 'admin.php'))) {
			add_action('admin_notices', [$this, 'admin_notice_missing_magic_plugin']);
		}
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site active free verision of magical post display
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_free_notice()
	{
		$mgpnpro_hide_date = get_option('mgpnpro_hide_date');
		if (!empty($mgpnpro_hide_date)) {
			$clickhide = round((time() - strtotime($mgpnpro_hide_date)) / 24 / 60 / 60);
			if ($clickhide < 15) {
				return;
			}
		}

		$mgposte_install_date = get_option('mgposte_install_date');
		if (!empty($mgposte_install_date)) {
			$install_day = round((time() - strtotime($mgposte_install_date)) / 24 / 60 / 60);
			if ($install_day < 4) {
				return;
			}
		}

		global $pagenow;
		if ($pagenow == 'themes.php') {
			return;
		}

		$message_head = esc_html__('Good News!! Magcial Posts Display Pro Version Now only $21 !!', 'magical-posts-display');
		$message_body = esc_html__('By Upgrading to Magical Posts Display Pro you get access to all features and much more!!', 'magical-posts-display');
		$btn_text = esc_html__('Upgrade Pro', 'magical-posts-display');
		$btn_link = esc_url('https://wpthemespace.com/product/magical-posts-display-lifetime/?add-to-cart=3640');
		$btn2_text = esc_html__('No, Maybe Later', 'magical-posts-display');

		printf('<div style="padding:10px" class="notice notice-warning mgp-pronotice"><strong><span style="font-weight:700;color:#17A15C">%1$s</span></strong><p>%2$s </p><a target="_blank" href="%3$s" class="button button-primary">%4$s </a><a href="#" style="margin-left:10px" class="mghideme">%5$s</a></div>', $message_head, $message_body, $btn_link, $btn_text, $btn2_text);
	}
	public function mgfree_notice_hide_options()
	{
		if (isset($_GET['mgfnotice']) && $_GET['mgfnotice'] == 1) {
			delete_option('mgpnpro5');
			update_option('mgpnpro_hide_date', current_time('mysql'));
		}
		if (isset($_GET['mgrecnot']) && $_GET['mgrecnot'] == 1) {
			update_option('mgmain_hide_tinfo', 1);
		}
	}


	public function admin_notice_missing_magic_plugin()
	{
		$mgmain_hide_tinfo = get_option('mgmain_hide_tinfo');
		if ($mgmain_hide_tinfo || (class_exists('Magical_Addons_Elementor'))) {
			return;
		}
		if (isset($_GET['activate'])) unset($_GET['activate']);
		if (class_exists('Magical_Addons_Elementor')) {
			return;
		}
		$hide_text = __('Dismiss', 'magical-addons-for-elementor');
		if (file_exists(WP_PLUGIN_DIR . '/magical-addons-for-elementor/magical-addons-for-elementor.php')) {
			$magial_eactive_url = wp_nonce_url('plugins.php?action=activate&plugin=magical-addons-for-elementor/magical-addons-for-elementor.php&plugin_status=all&paged=1', 'activate-plugin_magical-addons-for-elementor/magical-addons-for-elementor.php');
			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
				esc_html__('%1$s Recommended plugin for you. Your WordPress life will be easier, which is currently Not Active  %2$s', 'magical-posts-display'),
				'<strong>' . esc_html__('Magical Addons For Elementor', 'magical-posts-display') . '</strong>',
				'<a class="button button-primary" style="margin-left:20px" href="' . $magial_eactive_url . '">' . __('Activate Magical Addons', 'magical-posts-display') . '</a>'


			);
		} else {
			$magial_einstall_url =  wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=magical-addons-for-elementor'), 'install-plugin_magical-addons-for-elementor');
			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
				esc_html__('%1$s Recommended plugin for you. Your WordPress life will be easier, which is currently NOT RUNNING  %2$s', 'magical-posts-display'),
				'<strong>' . esc_html__('Magical Addons For Elementor', 'magical-posts-display') . '</strong>',
				'<a class="button button-primary" style="margin-left:20px" href="' . $magial_einstall_url . '">' . __('Install Magical Addons', 'magical-posts-display') . '</a>'

			);
		}



		printf('<div class="notice notice-warning mgpd-notice"><p style="padding: 13px 0">%1$s <button class="button mgade-notice-hide" style="float:right">%2$s</button></p></div>', $message, $hide_text);
	}
}

new mgpFreeNotice();
