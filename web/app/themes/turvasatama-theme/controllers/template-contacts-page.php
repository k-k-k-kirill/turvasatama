<?php
/**
 * Template Name: Contacts Page
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\PostController;
use Pixels\TurvaSatama\App;

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'template/template-contacts-page/template-contacts-page.twig' );

// Get fields.
$specialistsPageFields = get_field('contacts_page_fields', get_the_id());
if ($specialistsPageFields) {
  $controller->add_context('contacts_page_fields', $specialistsPageFields);
}

// Render the twig.
$controller->render();
