<?php

/**
 * Class for Test Service
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Tests\Fixtures;

// Contracts.
use Pixels\TurvaSatama\Services\Contracts\ServiceInterface;

use \WP_Post;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Test service for unit tests.
 */
class DummyService implements ServiceInterface
{
}
