<?php

/**
 * Class for Header Options Page.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Admin\OptionsPages;

/**
 * Register options page for Header
 */
class Header {


	/**
	 * Class constructor
	 */
	public function __construct() {
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Header Settings',
				'menu_title'  => 'Header Settings',
				'parent_slug' => 'acf-options-layouts-settings',
			)
		);
	}
}
