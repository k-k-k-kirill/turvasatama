<?php

/**
 * Class for Layouts Settings Options Page.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Admin\OptionsPages;

/**
 * Register options page for Layouts Settings
 */
class LayoutsSettings
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		acf_add_options_page(
			array(
				'page_title'  => 'Layouts Settings',
				'menu_title'  => 'Layouts Settings',
			)
		);
	}
}
