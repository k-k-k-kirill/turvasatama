<?php
use Pixels\Theme\Controllers\PostController;
use Pixels\TurvaSatama\App;

// Services
$userService = App::$container->get('user');

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'single/single-service/single-service.twig' );

// Get flexible fields.
$sections = get_field( 'sectioned_fields', get_the_id() );
$controller->add_context( 'sections', $sections );

$specialists = $userService->getAuthorsByService(get_the_id());

if ($specialists && !empty($specialists)) {
  $controller->add_context('specialists', $specialists);
}

// Render the twig.
$controller->render();
