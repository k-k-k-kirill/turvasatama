<?php

/**
 * Class for Author Options Page.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Admin\OptionsPages;

/**
 * Register options page for Author
 */
class Author {


	/**
	 * Class constructor
	 */
	public function __construct() {
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Single Author',
				'menu_title'  => 'Single Author',
				'parent_slug' => 'acf-options-layouts-settings',
			)
		);
	}
}
