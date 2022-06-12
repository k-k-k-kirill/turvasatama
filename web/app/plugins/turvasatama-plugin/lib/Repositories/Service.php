<?php

/**
 * Class for Service Repository
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Repositories;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use \WP_Post;

/**
 * Repository for accessing Service related data.
 */
class Service
{

	/**
	 * Content type this Repository deals with.
	 *
	 * @var string.
	 */
	const POST_TYPE = 'service';

	/**
	 * Get all services.
	 */
  public function getAll()
  {
    $args = [
      'post_type' => self::POST_TYPE,
      'posts_per_page' => -1,
      'orderby' => 'DESC'
    ];

    return get_posts($args);
  }
}
