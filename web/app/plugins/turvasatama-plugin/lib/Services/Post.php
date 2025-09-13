<?php

/**
 * Class for Post Service
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Services;

// Contracts.
use Pixels\TurvaSatama\Services\Contracts\ServiceInterface;

// Repositories.
use Pixels\TurvaSatama\Repositories\Post as PostRepository;

// App container  
use Pixels\TurvaSatama\App;

use WP_Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Serve post related data
 */
class Post implements ServiceInterface {


	/**
	 * Posts Repository.
	 *
	 * @param PostRepository
	 */
	protected $posts_repository;

	/**
	 * Class constructor.
	 *
	 * @param PostRepository $examples instance.
	 */
	public function __construct( PostRepository $posts ) {
		$this->posts_repository = $posts;
	}

	public function getTimberTags( int $postId ) {
		$tags = $this->posts_repository->getTags( $postId );

		if ( $tags && ! empty( $tags ) ) {
			foreach ( $tags as $key => $tag ) {
				$tags[ $key ] = \Timber\Timber::get_term( $tag->term_id );
			}
		}

		return $tags;
	}

	public function getRelatedPostsByTags( int $postId ) {
		$tags         = $this->posts_repository->getTags( $postId );
		$tagIds       = array();
		$relatedPosts = array();

		if ( ! empty( $tags ) ) {
			foreach ( $tags as $tag ) {
				$tagIds[] = $tag->term_id;
			}

			$relatedPosts = $this->posts_repository->getRelatedByTags( $tagIds, $postId );
		}

		return $relatedPosts;
	}

	public function getRandomRelatedPosts( int $postId ) {
		$relatedPosts = $this->posts_repository->getRandomRelated( $postId );

		return $relatedPosts;
	}

	public function getRelatedPosts( int $postId ) {
		$relatedPosts = array();
		$relatedPosts = $this->getRelatedPostsByTags( $postId );

		if ( ! $relatedPosts || empty( $relatedPosts ) ) {
			$relatedPosts = $this->getRandomRelatedPosts( $postId );
		}

		return $relatedPosts;
	}

	public function getPostsForAuthor( int $authorId ) {
		$authorPosts = $this->posts_repository->getForAuthor( $authorId );
		return $authorPosts;
	}

	public function injectFeedData( $sections ) {
		// Check if sections is actually an array
		if ( ! is_array( $sections ) || empty( $sections ) ) {
			return $sections;
		}

		// Get user service for specialists injection
		$userService = App::$container->get( 'user' );

		foreach ( $sections as $key => $section ) {
			// Ensure $section is an array before accessing its elements
			if ( ! is_array( $section ) ) {
				continue;
			}

			// Check if the required key exists before accessing it
			if ( isset( $section['acf_fc_layout'] ) && $section['acf_fc_layout'] === 'feed' ) {
				// Ensure post_count exists and is valid
				$post_count = isset( $section['post_count'] ) ? intval( $section['post_count'] ) : 10;

				$section['posts']       = $this->posts_repository->get_latest( $post_count );
				$section['archive_url'] = get_permalink( get_option( 'page_for_posts' ) );
				$sections[ $key ]       = $section;
			}

			// Handle specialists section with ACF description logic:
			// "display all specialists which provide the service (if used on service template) 
			//  or all specialists if used elsewhere"
			if ( isset( $section['acf_fc_layout'] ) && $section['acf_fc_layout'] === 'specialists' ) {
				$currentPostId = get_the_id();
				$postType = get_post_type( $currentPostId );
				
				if ( $postType === 'service' ) {
					// Service template: use filtered specialists
					$specialists = $userService->getAuthorsByService( $currentPostId );
				} else {
					// Elsewhere: use all specialists
					$specialists = $userService->getAuthors();
				}
				
				if ( ! empty( $specialists ) && $specialists ) {
					$sections[ $key ]['specialists_data'] = $specialists;
				}
			}
		}

		return $sections;
	}
}
