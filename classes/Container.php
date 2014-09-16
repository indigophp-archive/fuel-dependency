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

use Fuel\Dependency\Container as DC;
use LogicException;
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
	 * @var DC
	 */
	protected static $container;

	/**
	 * Checks if container is initialized
	 *
	 * @var boolean
	 */
	protected static $initialized = false;

	/**
	 * Initialization
	 *
	 * @throws LogicException If container is already initialized
	 *
	 * @codeCoverageIgnore
	 */
	public static function initialize(DC $container = null)
	{
		if (static::$initialized)
		{
			throw new LogicException('Dependency container is already initialized');
		}

		if (is_null($container))
		{
			$container = new DC;
		}

		static::$container = $container;

		static::$initialized = true;
	}

	/**
	 * Returns the dependency container
	 *
	 * @return DC
	 */
	public static function getContainer()
	{
		return static::$container;
	}

	/**
	 * Checks if container is already initialized
	 *
	 * @return boolean
	 */
	public static function isInitialized()
	{
		return static::$initialized;
	}

	/**
	 * Magic methods
	 */

	/**
	 * @codeCoverageIgnore
	 */
	public static function __callStatic($method, $arguments)
	{
		if ( ! static::$initialized)
		{
			throw new LogicException('Container must be initialized first');
		}

		if ( ! method_exists(static::$container, $method))
		{
			throw new BadMethodCallException('Method ' . $method . ' does not exists');
		}

		return call_user_func_array(array(static::$container, $method), $arguments);
	}
}
