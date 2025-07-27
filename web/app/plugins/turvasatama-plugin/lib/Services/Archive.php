<?php

/**
 * Class for Archive Service
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Services;

// Contracts.
use Pixels\TurvaSatama\Services\Contracts\ServiceInterface;

use WP_Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Serve post archive related data
 */
class Archive implements ServiceInterface {

	/**
	 * Get title of posts archive
	 */
	public function getTitle() {
		$postsPageId = get_option( 'page_for_posts' );
		return get_the_title( $postsPageId );
	}

	/**
	 * Get title of posts archive
	 */
	public function getUrl() {
		return get_permalink( get_option( 'page_for_posts' ) );
	}

	/**
	 * Get all non-empty tags with URLs
	 */
	public function getTags() {
		$tags = get_tags(
			array(
				'hide_empty' => true,
			)
		);

		foreach ( $tags as $key => $tag ) {
			$tags[ $key ] = \Timber\Timber::get_term( $tag->term_id );
		}

		return $tags;
	}
}
