<?php
/**
 * Theme image handling.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

use Pixels\Components\Images\Factory as ImageFactory;

/**
 * Theme image sizes
 *
 * Register image sizes
 * Do custom image handling
 */
class Images {

	/**
	 * Image sizes array
	 * Pattern:
	 *
	 * NAME, WIDTH, HEIGHT, CROP, RETINA TRUE/FALSE
	 *
	 * @var array
	 */
	const SIZES = array(
		'page-hero'        => array( 1100, 500, true, true ),
		'page-hero-mobile' => array( 375, 500, true, true ),
		'cta'              => array( 640, 245, true, true ),
		'portrait'				 => array( 365, 520, true, true ),
		'featured'				 => array( 795, 400, true, true ),
		'thumbnail'				 => array( 490, 340, true, true ),
		'thumbnail-mini'	 => array( 290, 224, true, true )
	);

	/**
	 * Breakpoint for switching from mobile img to dekstop image
	 * Will be used in <sources> and inline styles.
	 *
	 * @var string.
	 */
	const BREAKPOINT = '576px';

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_action( 'init', array( $this, 'add_img_sizes' ) );
	}

	/**
	 * Register theme image sizes to Factory.
	 *
	 * @since 1.0
	 */
	public function add_img_sizes() {
		ImageFactory::add_image_sizes( self::SIZES );
		ImageFactory::add_breakpoint( self::BREAKPOINT );
	}
}
