<?php
/**
 * Breadcrumb data element
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs;

use Pixels\Theme\Breadcrumbs\Contracts\BreadcrumbInterface;

/**
 * Breadcrumb interface
 */
class Breadcrumb implements BreadcrumbInterface {

	/**
	 * Breadcrumb label.
	 *
	 * @var string.
	 */
	public $label;

	/**
	 * Breadcrumb url.
	 *
	 * @var string.
	 */
	public $url;

	/**
	 * Set breadcrumb label
	 *
	 * @param string $label of breadcrumb.
	 */
	public function set_label( string $label ) {
		$this->label = $label;
	}

	/**
	 * Get breadcrumb label
	 *
	 * @return string $label of breadcrumb.
	 */
	public function get_label() : string {
		return $this->label;
	}

	/**
	 * Set breadcrumb url
	 *
	 * @param string $url of breadcrumb.
	 */
	public function set_url( string $url ) {
		$this->url = $url;
	}

	/**
	 * Get breadcrumb url
	 *
	 * @return string $url of breadcrumb.
	 */
	public function get_url() : string {
		return $this->url;
	}
}
