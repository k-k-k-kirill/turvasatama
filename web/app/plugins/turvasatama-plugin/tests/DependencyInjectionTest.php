<?php

/**
 * DI container unit tests.
 *
 * @package TurvaSatama.
 */

use PHPUnit\Framework\TestCase;

// Contracts.
use Pixels\TurvaSatama\Services\Contracts\ServiceInteface;

// SUT classes.
use Pixels\TurvaSatama\DependencyInjection as DependencyInjectionContainer;

// Fixtures.
use Pixels\TurvaSatama\Tests\Fixtures\DummyService;

// Exceptions
use Pixels\TurvaSatama\DependencyInjection\Exceptions\ServiceNotFoundException;

/**
 * DI container class unit tests.
 */
final class DependencyInjectionContainerTest extends TestCase
{

	/**
	 * Include doubles for wp functions & constants
	 */
	public static function setUpBeforeClass(): void
	{
		require_once __DIR__ . '/TestDoubles/constants.php';
	}

	/**
	 * Instance can be created.
	 */
	public function testCanCreateInstance()
	{

		$this->assertInstanceOf(
			DependencyInjectionContainer::class,
			new DependencyInjectionContainer(),
		);
	}

	/**
	 * Throws exception if service is not found.
	 */
	public function testThrowsExceptionOnMissingService()
	{
		$this->expectException(ServiceNotFoundException::class);

		$container = new DependencyInjectionContainer();

		$container->get('random_service');
	}

	/**
	 * Can set & get service from container.
	 */
	public function testCanGetAndSetInstance()
	{
		$container = new DependencyInjectionContainer();
		$dummy     = new DummyService();

		$container->set('dummy', $dummy);

		$this->assertInstanceOf(
			DummyService::class,
			$container->get('dummy'),
		);

		$this->assertEquals(
			$dummy,
			$container->get('dummy'),
		);
	}
}
