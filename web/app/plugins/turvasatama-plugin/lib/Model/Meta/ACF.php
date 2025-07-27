<?php

/**
 * Class for ACF mods.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Model\Meta;

/**
 * ACF class
 * --> Handle ACF related settings
 * --> Add custom meta save point
 * --> Add custom meta load point
 */
class ACF {


	/**
	 * Class constructor
	 */
	public function __construct() {
		add_filter( 'acf/settings/load_json', array( $this, 'add_acf_json_load_point' ), 99 );
		add_filter( 'acf/settings/save_json', array( $this, 'add_acf_json_save_point' ), 99 );

		// Add actions.
		add_action( 'acf/init', array( $this, 'add_acf_google_api_key' ) );
	}

	/**
	 * Register custom load point for ACF meta
	 *
	 * @param array $paths of json load points.
	 */
	public function add_acf_json_load_point( $paths ) {
		$paths[] = __DIR__ . '/Migrations/';
		return $paths;
	}

	/**
	 * Register custom save oint for ACF meta
	 *
	 * @param string $path of json save point.
	 */
	public function add_acf_json_save_point( $path ) {
		$path = __DIR__ . '/Migrations/';
		return $path;
	}

	/**
	 * Register ACF API Key for ACF.
	 */
	public function add_acf_google_api_key() {
		$api_key = '';

		if ( ! empty( $api_key ) ) {
			acf_update_setting( 'google_api_key', $api_key );
		}
	}
}
