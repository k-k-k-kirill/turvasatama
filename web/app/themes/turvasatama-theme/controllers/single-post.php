<?php
use Pixels\Theme\Controllers\PostController;
use Pixels\TurvaSatama\App;

// Services
$postService = App::$container->get('post');

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( 'single/single-post/single-post.twig' );
$postId = $controller->get_id();

// Get fields.
$additionalImages = get_field( 'additional_images', $postId );
$controller->add_context( 'additional_images', $additionalImages );
$postAuthorId = get_the_author_meta('ID');

if($postAuthorId) {
  $authorInfo = get_field('specialist_info', "user_$postAuthorId");

  $postAuthorName = get_the_author();
  if($postAuthorName) {
    $authorInfo['name'] = $postAuthorName;
  }

  $postAuthorPostsUrl = get_author_posts_url($postAuthorId);
  if($postAuthorPostsUrl) {
    $authorInfo['url'] = $postAuthorPostsUrl;
  }

  $controller->add_context('author', $authorInfo);
}

// Get tags
$tags = $postService->getTimberTags($postId);

if ($tags && !empty($tags)) {
  $controller->add_context('tags', $tags);
}

$relatedPosts = $postService->getRelatedPosts($postId);

if ($relatedPosts && !empty($relatedPosts)) {
  $controller->add_context('related_posts', $relatedPosts);
}

// Render the twig.
$controller->render();