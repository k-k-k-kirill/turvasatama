<?php

/**
 * Theme Filters & Actions.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Hooks class
 *
 * Add custom filters
 * Add custom actions
 */
class Hooks {


	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.

		// Filters.
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
		add_filter( 'acf/load_field', array( $this, 'force_acf_translations_to_be_ignored' ) );
		add_filter( 'pll_translation_url', array( $this, 'custom_pll_translation_url' ), 10, 2 );
	}

	public function force_acf_translations_to_be_ignored( $field ) {
		if ( isset( $field['translations'] ) ) {
			if ( $field['translations'] === 'sync' || $field['translations'] === 'translate' ) {
				$field['translations'] = 'ignore';
			}
		}

		return $field;
	}

	/**
	 * Add <body> classes.
	 *
	 * @param array $classes list of <body> classes.
	 */
	public function add_body_classes( array $classes ) {
		/** Add page slug if it doesn't exist */
		if ( is_single() || is_page() && ! is_front_page() ) {
			if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
				$classes[] = basename( get_permalink() );
			}
		}

		return array_filter( $classes );
	}

	function custom_pll_translation_url( $url, $lang ) {
		global $wp_query;

		if ( is_author() && isset( $wp_query->query_vars['author'] ) ) {
			$author_id = $wp_query->query_vars['author'];
			$author    = new \WP_User( $author_id );

			// Check if the author has a user profile in the given language
			$specialist_profile = get_field( 'specialist_profile', "user_$author->ID" );

			if ( $specialist_profile ) {
				$translated_profile_id = pll_get_post( $specialist_profile->ID, $lang );
				if ( $translated_profile_id ) {
					// Build the translated author URL
					$translated_author_url = home_url( "/$lang/author/{$author->user_nicename}/" );
					return $translated_author_url;
				}
			}
		}

		return $url;
	}
}
