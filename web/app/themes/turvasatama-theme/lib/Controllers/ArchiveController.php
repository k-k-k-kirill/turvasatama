<?php
/**
 * Archive controller
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

// Add this use statement
use Timber\Timber;

/**
 * Archive Controller class
 *
 * Contains methods for handling archive page rendering
 */
class ArchiveController extends Controller {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Do base setup from parent.
		parent::__construct();

		// Add post from default query to context.
		$posts = Timber::get_posts();
		$this->set_posts( $posts );

		// Add pagination.
		$this->set_pagination( $posts->pagination() );
	}

	/**
	 * Shorthand for setting up posts context data
	 *
	 * @param mixed $posts PostQuery or array of posts to be displayed in archive.
	 */
	public function set_posts( $posts ) {
		$this->add_context( 'posts', $posts );
	}

	/**
	 * Shorthand for setting up pagination context data
	 *
	 * @param mixed $pagination of posts in archive.
	 */
	public function set_pagination( $pagination ) {
		$this->add_context( 'pagination', $pagination );
	}
}
