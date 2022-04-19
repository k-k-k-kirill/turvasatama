<?php

/**
 * Class for Test Cron Controller
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Tests\Fixtures;

// Contracts.
use Pixels\TurvaSatama\Cron\Contracts\CronControllerInterface;

use \WP_Post;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Test controller for unit tests.
 */
class DummyCronController implements CronControllerInterface
{

	public $is_cleared = false;

	public function register_crons()
	{
	}

	public function clear_crons()
	{
		$this->is_cleared = true;
	}
}
