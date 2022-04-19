<?php
/**
 * Common theme Configs.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Common theme configs.
 */
class Config {

	/**
	 * Instance of admin settings
	 *
	 * @var Admin\Config
	 */
	private $admin_config;

	/**
	 * Constructs the initial class.
	 */
	public function __construct() {

		// Actions.
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );
		add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ), 100 );

		// Only load admin settings in WP Admin.
		if ( is_admin() ) {
			$this->admin_config = new Admin\Config();
		}
	}

	/**
	 * Declare theme supports
	 */
	public function add_theme_supports() {

		/**
		 * Enable features from Soil.
		 *
		 * @link https://github.com/roots/soil
		 */
		add_theme_support(
			'soil',
			array(
				'clean-up',
				'disable-asset-versioning',
				'disable-trackbacks',
				'google-analytics' => array(
					'should_load'         => ( defined( 'WP_ENV' ) && WP_ENV === 'production' ),
					'google_analytics_id' => null,
					'optimize_id'         => null,
					'anonymize_ip',
				),
				'js-to-footer',
				'nav-walker',
				'nice-search',
			)
		);

		/**
		 * Enable plugins to manage the document title.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable HTML5 markup support
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		/**
		 * Enable selective refresh for widgets in customizer.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
	}

	/**
	 * Load translation for the theme.
	 */
	public function load_theme_textdomain() {
		load_theme_textdomain( 'pixels-text-domain', get_template_directory() . '/assets/languages' );
	}
}
