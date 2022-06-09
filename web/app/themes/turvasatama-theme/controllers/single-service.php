<?php
use Pixels\Theme\Controllers\PostController;

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'single/single-service/single-service.twig' );

// Get flexible fields.
$sections = get_field( 'sectioned_fields', get_the_id() );
$controller->add_context( 'sections', $sections );

// Render the twig.
$controller->render();
