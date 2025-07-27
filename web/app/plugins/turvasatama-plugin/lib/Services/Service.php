<?php

/**
 * Class for Service post type Service
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Services;

// Contracts.
use Pixels\TurvaSatama\Services\Contracts\ServiceInterface;

use WP_Post;

use Pixels\TurvaSatama\Repositories\Service as ServiceRepository;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Serve post archive related data
 */
class Service implements ServiceInterface {


	/**
		* Servicess Repository.
		*
		* @param PostRepository
		*/
	protected $services_repository;

	/**
	 * Class constructor.
	 *
	 * @param PostRepository $examples instance.
	 */
	public function __construct( ServiceRepository $services ) {
		$this->services_repository = $services;
	}

	public function getLatestServices() {
		return $this->services_repository->getAll();
	}
}
