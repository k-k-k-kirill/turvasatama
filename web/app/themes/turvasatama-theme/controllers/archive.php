<?php
/**
 * The template for displaying Archive pages.
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\ArchiveController;

global $post;

// Set up Controller instance.
$controller = new ArchiveController();

// Set post type.
$current_post_type = get_post_type();

// Set templates.
$controller->set_templates( array( 'archive/archive-' . $current_post_type . '.twig', 'archive/archive.twig', 'index/index.twig' ) );

// Set post type.
$controller->add_context( 'post_type', $current_post_type );

// If home add the home twig template to the front of the array.
if ( is_home() ) {
	$templates = $controller->get_templates();
	array_unshift( $templates, 'home/home.twig' );
	$controller->set_templates( $templates );
}

// Render the twig.
$controller->render();
