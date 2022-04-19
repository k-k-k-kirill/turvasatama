<?php

/**
 * Class for Model
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama;

// Contracts.
use Pixels\TurvaSatama\Model\PostTypes\Contracts\PostTypeInterface;
use Pixels\TurvaSatama\Model\Taxonomies\Contracts\TaxonomyInterface;

use Pixels\TurvaSatama\Model\Meta\ACF as ACFSetup;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * TurvaSatama Model class
 * --> Handle custom post types
 * --> Handle taxonomies
 * --> Handle meta fields
 *
 * @since 1.0
 * @author Pixels
 */
class Model
{

	/**
	 * Post types.
	 *
	 * @var array.
	 */
	private $post_types = array();

	/**
	 * Taxonomies
	 *
	 * @var array.
	 */
	private $taxonomies = array();

	/**
	 * Meta fields.
	 */
	private $meta_example;

	/**
	 * Common ACF.
	 *
	 * @var ACFSetup
	 */
	private $acf;

	/**
	 * Class constructor
	 */
	public function __construct()
	{

		// Taxonomies. (Load first to allow easier use in post type permalinks).
		$this->add_taxonomy('example_taxonomy', new Model\Taxonomies\ExampleTaxonomy());

		// Custom post types.
		$this->add_post_type('example', new Model\PostTypes\Example());

		// Fields.
		$this->meta_example = new Model\Meta\Fields\Example();

		// Misc.
		$this->acf = new ACFSetup();
	}

	/**
	 * Add Post Type.
	 *
	 * @param string $name
	 * @param PostTypeInterface $post_type
	 */
	public function add_post_type(string $name, PostTypeInterface $post_type)
	{
		$this->post_types[$name] = $post_type;
	}

	/**
	 * Add Post Type.
	 *
	 * @param string $name
	 * @param TaxonomyInterface $taxonomy
	 */
	public function add_taxonomy(string $name, TaxonomyInterface $taxonomy)
	{
		$this->taxonomies[$name] = $taxonomy;
	}
}
