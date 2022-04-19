<?php
/**
 * Timber Context setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Twig;

// Utilities.
use Pixels\Theme\Utils\Common;

// Timber deps.
use Timber\Menu as TimberMenu;


/**
 * Context class
 *
 * Add custom Timber context variables
 */
class Context {

	/**
	 * Navigations instance of theme.
	 *
	 * @var Navigations.
	 */
	public $navigations;

	/**
	 * Class constructor
	 *
	 * @param Navigations $navigations of theme.
	 */
	public function __construct( $navigations ) {

		$this->navigations = $navigations;

		// Actions.
		add_filter( 'timber_context', array( $this, 'add_general_context' ) );
		add_filter( 'timber_context', array( $this, 'add_menus_context' ) );

		// Uncomment to automatically add all archive links to context.
		// add_filter( 'timber_context', array( $this, 'add_archive_links_context' ) );.

		// Language actions.
		add_filter( 'timber_context', array( $this, 'add_site_languages_context' ) );

		// Key Pages
		add_filter( 'timber_context', array( $this, 'add_key_pages_context' ) );
	}

	/**
	 * Sets up general site settings in the Timber global context.
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_general_context( $context ) {

		/**
		 * Site-wide information.
		 *
		 * @var [type]
		 */
		$context['site']                      = $this;
		$context['site']->site_url            = get_site_url(); // Since timber only returns home URL as 'link'.
		$context['site']->language_attributes = get_language_attributes();

		return $context;
	}

	/**
	 * Set up all theme menus in context
	 * --> If menu has item, return items of Timber\Menu
	 * --> If not, return empty array
	 * Removes schenarios where WP defaults to wrong menus.
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_menus_context( $context ) {

		// Registered menus from Navigations class.
		$menus = $this->navigations->get_menus();

		/**
		 * Loop menus to context.
		 */
		foreach ( $menus as $menu => $title ) :

			// Append items to context array.
			$context['menu'][ $menu ] = new TimberMenu( $menu );
		endforeach;

		return $context;
	}

	/**
	 * Sets archive links to context.
	 * Loops through post types to get archive links
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_archive_links_context( $context ) {

		$types = Common::get_post_types();

		if ( ! empty( $types ) ) :
			foreach ( $types as $type ) :
				$context['links'][ $type->name ] = get_post_type_archive_link( $type->name );
			endforeach;

		endif;

		return $context;
	}

	/**
	 * Sets up the site languages Timber global context.
	 *
	 * Note we do this in a plugin agnostic way, so other plugins
	 * could be swapped in if needed.
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_site_languages_context( $context ) {

		if ( function_exists( 'pll_the_languages' ) ) :
			$site_languages = array(
				'home'      => pll_home_url(),
				'current'   => pll_current_language( 'slug' ),
				'languages' => pll_the_languages( array( 'raw' => 1 ) ),
			);

			$context['site']->multilingual = $site_languages;
		endif;

		return $context;
	}

	/**
	 * Sets up the key pages Timber global context.
	 *
	 * Pages can be added here as needed, to be easily referenced later on.
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_key_pages_context( $context ) {
		$key_pages = array();

		/**
		 * Privacy policy page, if it exists.
		 */
		if ( function_exists( 'get_privacy_policy_url' ) ) {
			$key_pages['privacy_policy'] = get_privacy_policy_url();
		}

		$context['site']->key_pages = $key_pages;

		return $context;
	}
}
