<?php

/*
 * This file is part of the Indigo Core package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Fuel;

use LogicException;

/**
 * Abstract Facade class to implement Forge-model
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Facade
{
	/**
	 * Namespace used for prefixing instances in DC
	 *
	 * @var string
	 */
	protected $_namespace;

	/**
	 * Config name to autoload
	 *
	 * Set this variable to autoload a config with the same name
	 *
	 * @var string
	 */
	protected static $_config;

	/**
	 * Initialize class
	 *
	 * @codeCoverageIgnore
	 */
	public static function _init()
	{
		if (isset(static::$_config))
		{
			\Config::load(static::$_config, true);
		}
	}

	/**
	 * Forge and return new instance
	 *
	 * Must be implemented by child classes.
	 *
	 * @return mixed
	 *
	 * @codeCoverageIgnore
	 */
	public static function forge()
	{
		throw new LogicException(get_called_class().' must define a ::forge function.');
	}

	/**
	 * Return an instance or false
	 *
	 * @param  string $instance
	 * @return mixed
	 */
	public static function instance($instance = null)
	{
		$class = get_called_class();

		if (static::exists($instance))
		{
			$instance = static::$_instances[$class][$instance];
		}
		else
		{
			$instance = false;
		}

		return $instance;
	}

	/**
	 * Deletes an instance if exists
	 *
	 * @param mixed $instance
	 *
	 * @return boolean
	 */
	public static function delete($instance)
	{
		$exists = \Dependency::isInstance($instance);

		\Dependency::remove($instance);

		return $exists;
	}

	/**
	 * Properly save a new instance
	 *
	 * @param string $name
	 * @param mixed  $instance Anything you can call an instance
	 *
	 * @return mixed Instance
	 */
	public static function newInstance($name, $instance)
	{
		\Dependency::inject($name, $instance);

		return $instance;
	}

	/**
	 * Check whether an instance exists
	 *
	 * @param string  $instance
	 *
	 * @return boolean
	 */
	public static function exists($instance)
	{
		$class = get_called_class();

		return isset(static::$_instances[$class][$instance]);
	}

	/**
	 * Don't let this class to be instantiated
	 *
	 * @codeCoverageIgnore
	 */
	private function __construct() {}
}
