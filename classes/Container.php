<?php

/*
 * This file is part of the Fuel Dependency package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Fuel\Dependency;

use BadMethodCallException;

/**
 * Backports v2 dependency container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Container
{
	/**
	 * Dependency container
	 *
	 * @var Fuel\Dependency\Container
	 */
	protected static $container;

	/**
	 * Initialization
	 *
	 * @codeCoverageIgnore
	 */
	public static function _init()
	{
		$container = new \Fuel\Dependency\Container;

		\Config::load('dependency', true);

		// Registers ServiceProviders
		foreach (\Config::get('dependency.services', array()) as $service)
		{
			$service = new $service;

			$container->registerService($service);
		}

		// Registers resources
		foreach (\Config::get('dependency.resources', array()) as $identifier => $resource)
		{
			$container->register($identifier, $resource);
		}

		// Registers singleton resources
		foreach (\Config::get('dependency.singletons', array()) as $identifier => $singleton)
		{
			$container->registerSingleton($identifier, $singleton);
		}

		static::$container = $container;
	}

	/**
	 * Returns the dependency container
	 *
	 * @return Container
	 */
	public static function getContainer()
	{
		return static::$container;
	}

	/**
	 * Magic methods
	 */

	/**
	 * @codeCoverageIgnore
	 */
	public static function __callStatic($method, $arguments)
	{
		if ( ! method_exists(static::$container, $method))
		{
			throw new BadMethodCallException('Method ' . $method . ' does not exists');
		}

		return call_user_func_array(array(static::$container, $method), $arguments);
	}
}
