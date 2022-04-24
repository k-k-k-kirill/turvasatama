<?php

/**
 * Class for Options pages
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Admin;

use Pixels\TurvaSatama\Admin\OptionsPages\Header;

/**
 * Instantiates individual options pages
 */
class OptionsPages
{

	/**
	 * Options page.
	 *
	 * @var Header
	 */
	private $header;

	/**
	 * Class constructor
	 */
	public function __construct()
	{

		// Load ACF options pages.
		add_filter('acf/init', array($this, 'load_acf_options_pages'));
	}

	/**
	 * Load individual options pages
	 *
	 * @since 1.0
	 */
	public function load_acf_options_pages()
	{

		// Load options pages.
		$this->header = new OptionsPages\Header();
	}
}
