<?php
/**
 * Template Name: Sectioned Page
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\PostController;
use Pixels\TurvaSatama\App;

// Services
$postService = App::$container->get('post');

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'template/template-sectioned.twig' );

// Get flexible fields.
$sections = get_field( 'sectioned_fields', get_the_id() );
$sections = $postService->injectFeedData($sections);
$controller->add_context( 'sections', $sections );

// Render the twig.
$controller->render();
