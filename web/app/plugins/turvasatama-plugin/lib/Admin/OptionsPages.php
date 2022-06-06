<?php

/**
 * Class for Options pages
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Admin;

use Pixels\TurvaSatama\Admin\OptionsPages\Header;
use Pixels\TurvaSatama\Admin\OptionsPages\Author;
use Pixels\TurvaSatama\Admin\OptionsPages\LayoutsSettings;

/**
 * Instantiates individual options pages
 */
class OptionsPages
{

	/**
	 * Options page.
	 *
	 * @var LayoutsSettings
	 */
	private $layoutsSettings;

	/**
	 * Options page.
	 *
	 * @var Header
	 */
	private $header;

	/**
	 * Options page.
	 *
	 * @var Author
	 */
	private $author;

	/**
	 * Options page.
	 *
	 * @var CompanyInfo
	 */
	private $companyInfo;

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
		$this->companyInfo = new OptionsPages\CompanyInfo();
		$this->layoutsSettings = new OptionsPages\LayoutsSettings();
		$this->author = new OptionsPages\Author();
	}
}
