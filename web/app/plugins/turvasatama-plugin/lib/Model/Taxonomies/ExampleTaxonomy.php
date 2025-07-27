<?php

/**
 * Class for ExampleTaxonomy
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Model\Taxonomies;

// Contracts.
use Pixels\TurvaSatama\Model\Taxonomies\Contracts\AbstractTaxonomy;
use Pixels\TurvaSatama\Model\Taxonomies\Contracts\TaxonomyInterface;

/**
 * Registers ExampleTaxonomy tax
 */
class ExampleTaxonomy extends AbstractTaxonomy implements TaxonomyInterface {


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

		// Set up tax.
		$this->set_name( 'example_category' );
		$this->set_post_type( 'example' );

		// Set labels.
		$this->prepare_labels();

		$this->set_args( $this->define_args() );

		// Hook up example taxonomy.
		add_action( 'init', array( $this, 'create' ) );
	}

	/**
	 * Prepare base labels to props.
	 * Behavior depends on TRANSLATE_LABELS const.
	 */
	public function prepare_labels() {

		if ( self::TRANSLATE_LABELS ) :
			// If you need to translate labels.
			$singular = __( 'Example Category', 'turvasatama-plugin' );
			$plural   = __( 'Example Categories', 'turvasatama-plugin' );

			$this->set_manual_labels( $singular, $plural );
		else :
			// Automatically generate labels from one word.
			$this->set_automatic_labels( 'Example Category' );
		endif;
	}

	/**
	 * Get arguments for tax registration
	 *
	 * @return array $labels
	 */
	public function define_args() {

		// Check if we're using manual or automatic labels.
		if ( null === $this->tax_label_singular && null === $this->tax_label_plural ) :
			$labels = $this->define_labels();
		else :
			$labels = $this->get_labels();
		endif;

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'has_archive'       => true,
			'rewrite'           => array(
				'slug'       => 'examples',
				'with_front' => false,
			),
		);

		return $args;
	}

	/**
	 * OPTIONAL: Set labels manually for registration
	 * If you need to set everything manually,
	 * comment out the prepare_labels() in constructor
	 *
	 * @return array $labels
	 */
	public function define_labels() {

		$labels = array(
			'name'              => _x( 'Example Tax', 'taxonomy general name', 'turvasatama-plugin' ),
			'singular_name'     => _x( 'Example Tax', 'taxonomy singular name', 'turvasatama-plugin' ),
			'search_items'      => __( 'Search Example ', 'turvasatama-plugin' ),
			'all_items'         => __( 'All Examples', 'turvasatama-plugin' ),
			'parent_item'       => __( 'Parent Examples', 'turvasatama-plugin' ),
			'parent_item_colon' => __( 'Parent Example:', 'turvasatama-plugin' ),
			'edit_item'         => __( 'Edit Example', 'turvasatama-plugin' ),
			'update_item'       => __( 'Update Example', 'turvasatama-plugin' ),
			'add_new_item'      => __( 'Add New Example', 'turvasatama-plugin' ),
			'delete_item'       => __( 'Delete item', 'turvasatama-plugin' ),
			'new_item_name'     => __( 'New Example', 'turvasatama-plugin' ),
		);

		return $labels;
	}
}
