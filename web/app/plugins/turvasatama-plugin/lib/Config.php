<?php

/**
 * Class for common config.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama;

use Pixels\TurvaSatama\Config\ACF;

/**
 * Config class
 *
 * --> Create instances that edit set general configurations.
 */
class Config {

	/**
	 * ACF instance
	 *
	 * @var ACF
	 */
	private $acf;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Hook uo options pages.
		$this->acf = new ACF();
	}
}
