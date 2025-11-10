<?php
/**
 * Theme navigations
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Navigations class
 *
 * Register theme navigations
 * Do any custom navigation handling
 */
class Navigations {

	/**
	 * Stores registered menus
	 *
	 * @var array
	 */
	public $menus;

	/**
	 * Class constructor
	 */
	public function __construct() {
		// Actions.
		add_action( 'init', array( $this, 'setup_menus' ) );
	}

	/**
	 * Setup array of menus in theme
	 * --> Used to register menus
	 * --> Used to automatically add menus to Context
	 */
	public function setup_menus() {
		$this->menus = array(
			'desktop' => __( 'Primary Menu', 'turvasatama-theme-v2' ),
			'mobile'  => __( 'Mobile Menu', 'turvasatama-theme-v2' ),
			'footer'  => __( 'Footer Menu', 'turvasatama-theme-v2' ),
		);

		// Register menus immediately after setting them up
		$this->register_theme_navigations();
	}

	/**
	 * Return array of menus for external use.
	 *
	 * @return array $this->menus of theme.
	 */
	public function get_menus() {
		return $this->menus;
	}

	/**
	 * Register navigation menus.
	 *
	 * @since 1.0
	 */
	public function register_theme_navigations() {
		register_nav_menus(
			$this->get_menus()
		);
	}
}
