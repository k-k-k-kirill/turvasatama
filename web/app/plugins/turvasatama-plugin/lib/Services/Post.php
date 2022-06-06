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

use \WP_Post;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Serve post related data
 */
class Post implements ServiceInterface
{

	/**
	 * Examples Repository.
	 *
	 * @param PostRepository
	 */
	protected $posts_repository;

	/**
	 * Class constructor.
	 *
	 * @param PostRepository $examples instance.
	 */
	public function __construct(PostRepository $posts)
	{
		$this->posts_repository = $posts;
	}

  public function getTimberTags(int $postId)
  {
    $tags = $this->posts_repository->getTags($postId);

    if ($tags && !empty($tags)) {
      foreach ($tags as $key => $tag) {
        $tags[$key] = new \Timber\Term($tag->term_id);
      }
    }

    return $tags;
  }

	public function getRelatedPostsByTags(int $postId)
	{
		$tags = $this->posts_repository->getTags($postId);
		$tagIds = [];
		$relatedPosts = [];

		if (!empty($tags)) {
			foreach ($tags as $tag) {
				$tagIds[] = $tag->term_id;
			}
	
			$relatedPosts = $this->posts_repository->getRelatedByTags($tagIds, $postId);
		}

		return $relatedPosts;
	}

	public function getRandomRelatedPosts(int $postId)
	{
		$relatedPosts = $this->posts_repository->getRandomRelated($postId);

		return $relatedPosts;
	}

	public function getRelatedPosts(int $postId)
	{
		$relatedPosts = [];
		$relatedPosts = $this->getRelatedPostsByTags($postId);

		if (!$relatedPosts || empty($relatedPosts)) {
			$relatedPosts = $this->getRandomRelatedPosts($postId);
		}

		return $relatedPosts;
	}

	public function getPostsForAuthor(int $authorId)
	{
		$authorPosts = $this->posts_repository->getForAuthor($authorId);
		return $authorPosts;
	}
}
