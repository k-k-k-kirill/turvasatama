<?php

/**
 * Class for User Repository
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Repositories;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use \WP_Post;

/**
 * Repository for accessing User related data.
 */
class User
{

	/**
	 * Content type this Repository deals with.
	 *
	 * @var string.
	 */
	const POST_TYPE = 'user';

	/**
	 * Get all users with status 'author'.
	 */
	public function getAllAuthors()
  {
    return get_users( array(
      'role__in'     => array('author'),
    ));
  }

	public function getAuthorsByService($serviceId)
	{
		$filteredAuthors = [];
		$authors = $this->getAllAuthors();

		if (!empty($authors) && $authors) {
			foreach ($authors as $author) {
				$services = get_field('services', "user_$author->ID");

				if ($services && in_array($serviceId, $services)) {
					$filteredAuthors[] = $author;
				}
			}
		}

		return $filteredAuthors;
	}
}
