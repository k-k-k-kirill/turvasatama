<?php

/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

global $wp_query;

use Pixels\Theme\Controllers\ArchiveController;
use Pixels\TurvaSatama\App;
use Timber\Timber;

// Services
$postService    = App::$container->get( 'post' );
$archiveService = App::$container->get( 'archive' );

// Set up Controller instance.
$controller = new ArchiveController();

// Templates.
$controller->set_templates( array( 'author/author.twig', 'index/index.twig' ) );

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = Timber::get_user( $wp_query->query_vars['author'] );

	// Get the user_profile post object for the author
	$specialist_profile = get_field( 'specialist_profile', "user_$author->ID" );

	// Check if the user_profile exists
	if ( $specialist_profile ) {
		$author_info         = get_field( 'specialist_info', $specialist_profile->ID );
		$author_info['name'] = $specialist_profile->post_title;
		$controller->add_context( 'author_info', $author_info );
	}

	$controller->add_context( 'author', $author );
	$controller->add_context( 'title', 'Author Archives: ' . $author->name() );

	$authorPosts = $postService->getPostsForAuthor( $author->ID );

	if ( $authorPosts && ! empty( $authorPosts ) ) {
		$controller->add_context( 'posts', $authorPosts );
	}

	$archiveUrl = $archiveService->getUrl();
	if ( $archiveUrl ) {
		$controller->add_context( 'archive_url', $archiveUrl );
	}

	$singleAuthorFields = get_field( 'single_author_fields', 'option' );
	if ( $singleAuthorFields ) {
		$controller->add_context( 'single_author_fields', $singleAuthorFields );
	}
}

// Render the twig.
$controller->render();
