<?php

/**
 * Class for Post Repository
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Repositories;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use \WP_Post;
use WP_Term;

/**
 * Repository for accessing Post related data.
 */
class Post
{

	/**
	 * Content type this Repository deals with.
	 *
	 * @var string.
	 */
	const POST_TYPE = 'post';

	/**
	 * Get all posts.
	 */
	public function get_all(): array
	{
		$args = array(
			'post_type'      => self::POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		);

		$posts = get_posts($args);

		return $posts;
	}

	public function get_latest($postsPerPage = 3)
	{
		$args = [
			'post_type' => self::POST_TYPE,
			'post_status' => 'publish',
			'posts_per_page' => $postsPerPage,
			'orderby' => 'DESC'
		];

		$posts = get_posts($args);

		return $posts;
	}

	/**
	 * Get Post by id.
	 */
	public function get(int $id): ?WP_Post
	{
		return get_post($id);
	}

  /**
	 * Get post tags by post id.
	 */
	public function getTags(int $id)
	{
		return get_the_tags($id);
	}

	/**
	 * Get related posts for given post id by its tags.
	 */
	public function getRelatedByTags( $tagIds, $postId)
	{
		$args = [
			'tag__in' => $tagIds,
			'order' => 'DESC',
			'post__not_in' => [$postId],
			'posts_per_page' => 2,
		];

		return get_posts($args);
	}

	public function getRandomRelated($postId)
	{
		$args = [
			'order' => 'DESC',
			'post__not_in' => [$postId],
			'posts_per_page' => 2,
		];

		return get_posts($args);
	}

	public function getForAuthor($authorId)
	{
		$args = [
			'order' => 'DESC',
			'author' => $authorId,
			'posts_per_page' => 3
		];

		return get_posts($args);
	}
}
