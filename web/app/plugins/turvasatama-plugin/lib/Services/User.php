<?php

/**
 * Class for User Service
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Services;

// Contracts.
use Pixels\TurvaSatama\Services\Contracts\ServiceInterface;

// Repositories.
use Pixels\TurvaSatama\Repositories\User as UserRepository;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Serve user related data
 */
class User implements ServiceInterface
{

	/**
	 * User Repository.
	 *
	 * @param PostRepository
	 */
	protected $user_repository;

	/**
	 * Class constructor.
	 *
	 * @param UserRepository $examples instance.
	 */
	public function __construct(UserRepository $posts)
	{
		$this->user_repository = $posts;
	}

  public function getAuthors()
  {
    $authors = $this->user_repository->getAllAuthors();

    return $this->injectAuthorsInfo($authors);
  }

	public function getAuthorsByService($serviceId)
	{
		$authors = $this->user_repository->getAuthorsByService($serviceId);

		if(empty($authors) || !$authors) {
			$authors = $this->user_repository->getAllAuthors();
		}

		return $this->injectAuthorsInfo($authors);
	}

	public function injectAuthorsInfo($authors)
	{
		if(!empty($authors) && $authors) {
      foreach ($authors as $author) {
        $author->info = get_field('specialist_info', "user_$author->ID");
        $author->link = get_author_posts_url($author->ID);
      }
    }

		return $authors;
	}
}
