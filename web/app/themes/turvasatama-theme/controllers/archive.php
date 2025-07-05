<?php
/**
 * The template for displaying Archive pages.
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\ArchiveController;
use Pixels\TurvaSatama\App;

// Services
$archiveService = App::$container->get('archive');

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
if ( is_home() || is_tag() ) {
	$templates = $controller->get_templates();
	array_unshift( $templates, 'home/home.twig' );
	$controller->set_templates( $templates );

	$archiveTitle = $archiveService->getTitle();
	if ($archiveTitle) {
		$controller->add_context('title', $archiveTitle);
	}

	$archiveUrl = $archiveService->getUrl();
	if ($archiveUrl) {
		$controller->add_context('url', $archiveUrl);
	}

	$archiveTags = $archiveService->getTags();
	if ($archiveTags && !empty($archiveTags)) {
		$controller->add_context('tags', $archiveTags);
	}

	if(is_home()) {
		$controller->add_context('home', is_home());
	} else {
		$controller->add_context('current_tag', get_queried_object());
	}
}

// Render the twig.
$controller->render();
