<?php
/**
 * Class for Service Post Type.
 *
 * @package Tulk4You.
 */

namespace Pixels\TurvaSatama\Model\PostTypes;

// Contracts.
use Pixels\TurvaSatama\Model\PostTypes\Contracts\AbstractPostType;
use Pixels\TurvaSatama\Model\PostTypes\Contracts\PostTypeInterface;

/**
 * Register Service class
 * Extends AbstractPostType
 */
class Service extends AbstractPostType implements PostTypeInterface {


	/**
	 * Constant do define if post labels should be translatable
	 * --> If true, define labels as translatable strings
	 * --> If false, autocreate labels from one word
	 */
	const TRANSLATE_LABELS = false;

	/**
	 * Class constructor
	 */
	public function __construct() {
		// Set up post type slug.
		$this->set_name( 'service' );

		// Hook up Service cpt.
		add_action( 'init', array( $this, 'register_post_type' ), 0 );
	}

	/**
	 * A separate function to delay CPT registration.
	 *
	 * @NOTE we need this to fix the notice with translations from 6.7.
	 */
	public function register_post_type() {
		// Set labels.
		$this->prepare_labels();

		// Define args.
		$this->set_args( $this->define_args() );

		// Register the post type
		add_action( 'init', array( $this, 'create' ) );
	}

	/**
	 * Prepare base labels to props.
	 * Behavior depends on TRANSLATE_LABELS const.
	 */
	public function prepare_labels() {

		if ( self::TRANSLATE_LABELS ) :
			// If you need to translate labels.
			$singular = __( 'Service', 'turvasatama-plugin' );
			$plural   = __( 'Services', 'turvasatama-plugin' );

			$this->set_manual_labels( $singular, $plural );
		else :
			// Automatically generate labels from one word.
			$this->set_automatic_labels( 'Service' );
		endif;
	}

	/**
	 * Get arguments array for registration
	 *
	 * @return array $args of post.
	 */
	public function define_args() {

		// Check if we're using manual or automatic labels.
		if ( null === $this->post_label_singular && null === $this->post_label_plural ) :
			$labels = $this->define_labels();
		else :
			$labels = $this->get_labels();
		endif;

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-clipboard', // see list at https://developer.wordpress.org/resource/dashicons/
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
		);

		return $args;
	}

	/**
	 * OPTIONAL: Set labels manually for registration
	 * If you need to set everything manually, comment out the IF block in constructor
	 *
	 * @return array $labels of post.
	 */
	public function define_labels() {

		$labels = array(
			'name'               => _x( 'Services', 'post type general name', 'turvasatama-plugin' ),
			'singular_name'      => _x( 'Service', 'post type singular name', 'turvasatama-plugin' ),
			'menu_name'          => _x( 'Services', 'admin menu', 'turvasatama-plugin' ),
			'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'turvasatama-plugin' ),
			'add_new'            => _x( 'Add New', 'add new item', 'turvasatama-plugin' ),
			'add_new_item'       => __( 'Add New Service', 'turvasatama-plugin' ),
			'new_item'           => __( 'New Service', 'turvasatama-plugin' ),
			'edit_item'          => __( 'Edit Service', 'turvasatama-plugin' ),
			'view_item'          => __( 'View Service', 'turvasatama-plugin' ),
			'all_items'          => __( 'All Services', 'turvasatama-plugin' ),
			'search_items'       => __( 'Search Services', 'turvasatama-plugin' ),
			'parent_item_colon'  => __( 'Parent Services:', 'turvasatama-plugin' ),
			'not_found'          => __( 'No Services found.', 'turvasatama-plugin' ),
			'not_found_in_trash' => __( 'No Services found in Trash.', 'turvasatama-plugin' ),
		);

		return $labels;
	}
}
