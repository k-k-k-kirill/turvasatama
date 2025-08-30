<?php

/**
 * Class for User Profile Post Type.
 *
 * @package Tulk4You.
 */

namespace Pixels\TurvaSatama\Model\PostTypes;

// Contracts.
use Pixels\TurvaSatama\Model\PostTypes\Contracts\AbstractPostType;
use Pixels\TurvaSatama\Model\PostTypes\Contracts\PostTypeInterface;

/**
 * Register User Profile class
 * Extends AbstractPostType
 */
class UserProfile extends AbstractPostType implements PostTypeInterface {


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
		$this->set_name( 'user_profile' );

		// Hook up User Profile cpt.
		add_action( 'init', array( $this, 'register_post_type' ), 0 );

		// Simple filtering - show only own posts for non-editors
		add_filter( 'pre_get_posts', array( $this, 'filter_user_profiles_by_author' ) );
	}

	/**
	 * Filter user profiles to show only user's own profiles for non-editors
	 */
	public function filter_user_profiles_by_author( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		global $pagenow, $typenow;

		// Only apply to user_profile post type in admin list
		if ( $pagenow == 'edit.php' && $typenow == 'user_profile' ) {
			// Authors can only see their own posts, Editors+ can see all
			if ( ! current_user_can( 'edit_others_posts' ) ) {
				$query->set( 'author', get_current_user_id() );
			}
		}
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
			$singular = __( 'User Profile', 'turvasatama-plugin' );
			$plural   = __( 'User Profiles', 'turvasatama-plugin' );

			$this->set_manual_labels( $singular, $plural );
		else :
			// Automatically generate labels from one word.
			$this->set_automatic_labels( 'User Profile' );
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
			'menu_icon'          => 'dashicons-id', // see list at https://developer.wordpress.org/resource/dashicons/
			'supports'           => array( 'title', 'editor', 'thumbnail', 'author' ),
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
			'name'               => _x( 'User Profiles', 'post type general name', 'turvasatama-plugin' ),
			'singular_name'      => _x( 'User Profile', 'post type singular name', 'turvasatama-plugin' ),
			'menu_name'          => _x( 'User Profiles', 'admin menu', 'turvasatama-plugin' ),
			'name_admin_bar'     => _x( 'User Profile', 'add new on admin bar', 'turvasatama-plugin' ),
			'add_new'            => _x( 'Add New', 'add new item', 'turvasatama-plugin' ),
			'add_new_item'       => __( 'Add New User Profile', 'turvasatama-plugin' ),
			'new_item'           => __( 'New User Profile', 'turvasatama-plugin' ),
			'edit_item'          => __( 'Edit User Profile', 'turvasatama-plugin' ),
			'view_item'          => __( 'View User Profile', 'turvasatama-plugin' ),
			'all_items'          => __( 'All User Profiles', 'turvasatama-plugin' ),
			'search_items'       => __( 'Search User Profiles', 'turvasatama-plugin' ),
			'parent_item_colon'  => __( 'Parent User Profiles:', 'turvasatama-plugin' ),
			'not_found'          => __( 'No User Profiles found.', 'turvasatama-plugin' ),
			'not_found_in_trash' => __( 'No User Profiles found in Trash.', 'turvasatama-plugin' ),
		);

		return $labels;
	}
}