<?php

/**
 * DI Interface
 *
 * @package TurvaSatama
 */

namespace Pixels\TurvaSatama\DependencyInjection\Contracts;

use Pixels\TurvaSatama\Services\Contracts\ServiceInterface;

/**
 * DI interface
 */
interface DependencyInjectionInterface {


	public function get( string $key );
	public function set( string $key, ServiceInterface $service );
}
