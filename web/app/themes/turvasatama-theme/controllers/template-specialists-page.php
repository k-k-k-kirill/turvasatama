<?php
/**
 * Template Name: Specialists Page
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\PostController;
use Pixels\TurvaSatama\App;

// Services
$userService = App::$container->get('user');

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'template/template-specialists-page/template-specialists-page.twig' );

// Get fields.
$specialistsPageFields = get_field('specialists_page_fields', get_the_id());
if ($specialistsPageFields) {
  $controller->add_context('specialists_fields', $specialistsPageFields);
}

// Get authors
$specialists = $userService->getAuthors();
if (!empty($specialists) && $specialists) {
  $controller->add_context('specialists', $specialists);
}

// Render the twig.
$controller->render();
