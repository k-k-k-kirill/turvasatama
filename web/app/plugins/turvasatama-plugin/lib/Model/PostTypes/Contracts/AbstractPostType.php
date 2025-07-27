<?php

/**
 * Class for AbstractPostType
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Model\PostTypes\Contracts;

// Inflector for default singular / plural labels.
use Symfony\Component\String\Inflector\EnglishInflector;

/**
 * Abstract PostType class
 * Inherited by all post types we create
 * Offers basic structure for creation & utility functions
 */
abstract class AbstractPostType {


	/**
	 * Name of post type
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Post label singular
	 *
	 * @var string
	 */
	protected $post_label_singular;

	/**
	 * Post label plural
	 *
	 * @var string
	 */
	protected $post_label_plural;

	/**
	 * Labels / Strings of post
	 *
	 * @var array
	 */
	protected $labels;

	/**
	 * Post type args / options
	 *
	 * @var array
	 */
	protected $args;

	/**
	 * Create the post type
	 */
	public function create() {
		register_post_type( $this->get_name(), $this->get_args() );
	}

	/**
	 * Set post type name
	 *
	 * @param string $post_type name of post.
	 */
	protected function set_name( $post_type ) {
		$this->post_type = $post_type;
	}

	/**
	 * Set post name label
	 * --> Alternative to manually setting all labels
	 * --> Will populate label string with singular & plural forms
	 *
	 * @param string $label of post type, eg. "Example".
	 */
	protected function set_automatic_labels( $label ) {
		$english_inflector = new EnglishInflector();

		$this->set_post_label_singular( $label );
		$this->set_post_label_plural( $english_inflector->pluralize( $label )[0] );
		$this->set_labels();
	}

	/**
	 * Set singular / plural labels with manually given labels
	 *
	 * @param string $singular label of post type, eg. "Category".
	 * @param string $plural label of post type, eg. "Categories".
	 */
	protected function set_manual_labels( $singular, $plural ) {
		$this->set_post_label_singular( $singular );
		$this->set_post_label_plural( $plural );
		$this->set_labels();
	}

	/**
	 * Set post singular label
	 *
	 * @param string $label label of post type.
	 */
	protected function set_post_label_singular( $label ) {
		$this->post_label_singular = $label;
	}

	/**
	 * Set post singular label
	 *
	 * @param string $label plural label of post type.
	 */
	protected function set_post_label_plural( $label ) {
		$this->post_label_plural = $label;
	}

	/**
	 * Get post type property name
	 *
	 * @return string $post_type name of post.
	 */
	protected function get_name() {
		return $this->post_type;
	}

	/**
	 * Set post type args
	 *
	 * @param array $args of post type.
	 */
	protected function set_args( array $args ) {
		$this->args = $args;
	}

	/**
	 * Get post type args
	 *
	 * @return array $args of post.
	 */
	protected function get_args() {
		return $this->args;
	}

	/**
	 * Set labels array using prop labels
	 */
	public function set_labels() {

		$labels = array(
			'name'               => sprintf(
				_x( '%s', 'post type general name', 'turvasatama-plugin' ),
				$this->post_label_plural
			),
			'singular_name'      => sprintf( _x( '%s', 'post type singular name', 'turvasatama-plugin' ), $this->post_label_singular ),
			'menu_name'          => sprintf( _x( '%s', 'admin menu', 'turvasatama-plugin' ), $this->post_label_plural ),
			'name_admin_bar'     => sprintf( _x( '%s', 'add new on admin bar', 'turvasatama-plugin' ), $this->post_label_singular ),
			'add_new'            => sprintf( _x( 'Add New', 'add new item', 'turvasatama-plugin' ), $this->post_label_singular ),
			'add_new_item'       => sprintf( __( 'Add New %s', 'turvasatama-plugin' ), $this->post_label_singular ),
			'new_item'           => sprintf( __( 'New %s', 'turvasatama-plugin' ), $this->post_label_singular ),
			'edit_item'          => sprintf( __( 'Edit %s', 'turvasatama-plugin' ), $this->post_label_singular ),
			'view_item'          => sprintf( __( 'View %s', 'turvasatama-plugin' ), $this->post_label_plural ),
			'all_items'          => sprintf( __( 'All %s', 'turvasatama-plugin' ), $this->post_label_plural ),
			'search_items'       => sprintf( __( 'Search %s', 'turvasatama-plugin' ), $this->post_label_plural ),
			'parent_item_colon'  => sprintf( __( 'Parent %s:', 'turvasatama-plugin' ), $this->post_label_plural ),
			'not_found'          => sprintf( __( 'No %s found.', 'turvasatama-plugin' ), $this->post_label_plural ),
			'not_found_in_trash' => sprintf( __( 'No %s found in Trash.', 'turvasatama-plugin' ), $this->post_label_plural ),
		);

		$this->labels = $labels;
	}

	/**
	 * Return labels array
	 *
	 * @return array $labels of post.
	 */
	public function get_labels() {
		return $this->labels;
	}
}
