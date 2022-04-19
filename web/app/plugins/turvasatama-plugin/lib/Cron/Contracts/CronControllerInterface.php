<?php

/**
 * Cron Controller Interface
 *
 * @package TurvaSatama
 */

namespace Pixels\TurvaSatama\Cron\Contracts;

/**
 * Cron Controller interface
 */
interface CronControllerInterface
{

	public function register_crons();

	public function clear_crons();
}
