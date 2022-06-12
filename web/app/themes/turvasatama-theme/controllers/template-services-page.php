<?php
/**
 * Template Name: Services Page
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\PostController;
use Pixels\TurvaSatama\App;

// Services
$serviceService = App::$container->get('service');

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'template/template-services-page/template-services-page.twig' );

// Get fields.
$servicesPageFields = get_field('services_page_fields', get_the_id());
if ($servicesPageFields) {
  $controller->add_context('services_page_fields', $servicesPageFields);
}

// Get services
$services = $serviceService->getLatestServices();
if (!empty($services) && $services) {
  $controller->add_context('services', $services);
}

// Get flexible fields.
$sections = get_field( 'sectioned_fields', get_the_id() );
$controller->add_context( 'sections', $sections );

// Render the twig.
$controller->render();
