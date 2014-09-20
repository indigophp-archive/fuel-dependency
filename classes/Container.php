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

use Fuel\Dependency\Container as DiC;
use RuntimeException;
use BadMethodCallException;

/**
 * Backports v2 Dependency Container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Container
{
	/**
	 * Whether or not the container is initialized
	 */
	protected static $initialized = false;

	/**
	 * Dependency Injection Container
	 *
	 * @var DiC
	 */
	protected static $dic;

	/**
	 * Initialization
	 *
	 * @throws LogicException If container is already initialized
	 */
	protected static function initialize()
	{
		if (static::$initialized)
		{
			throw new RuntimeException('Container can only be initialized once');
		}

		// get the Dependency Container instance
		$dic = static::getDic();

		\Config::load('dependency', true);

		// setup the autoloader if none was set yet
		try
		{
			$loader = $dic->resolve('autoloader');
		}
		catch (ResolveException $e)
		{
			// Check whether there is a VENDORPATH
			if (defined('VENDORPATH'))
			{
				throw new RuntimeException('Container must be initialized in Fuel context');
			}

			// fetch the composer autoloader instance
			$loader = require VENDORPATH.'autoload.php';

			// allow the framework to access the composer autoloader
			$dic->inject('autoloader', $loader);
		}

		// get all defined namespaces
		$prefixes = array_merge($loader->getPrefixes(), $loader->getPrefixesPsr4());

		// scan all composer packages loaded for the presence of FuelServiceProviders
		foreach ($prefixes as $namespace => $paths)
		{
			// does this package define a service provider
			if (class_exists($class = trim($namespace,'\\').'\\Providers\\FuelServiceProvider'))
			{
				// register it with the DiC
				$dic->registerService(new $class);
			}
		}

		// register service providers defined in config
		foreach (\Config::get('dependency.services', []) as $service)
		{
			$service = new $service;

			$container->registerService($service);
		}

		// register resources defined in config
		foreach (\Config::get('dependency.resources', []) as $identifier => $resource)
		{
			$container->register($identifier, $resource);
		}

		// register singleton resources defined in config
		foreach (\Config::get('dependency.singletons', []) as $identifier => $singleton)
		{
			$container->registerSingleton($identifier, $singleton);
		}

		// mark we're initialized
		static::$initialized = true;
	}

	/**
	 * Sets the DiC
	 *
	 * @param DiC $dic
	 *
	 * @return DiC
	 */
	public static function setDic(DiC $dic = null)
	{
		// if a custom DiC is passed, use that
		if ($dic)
		{
			static::$dic = $dic;
		}

		// else set one up if not done yet
		elseif ( ! static::$dic)
		{
			// get us a Dependency Container instance
			static::$dic = new DiC;

			// register the DiC on classname so it can be auto-resolved
			static::$dic->registerSingleton('Fuel\\Dependency\\Container', function($container)
			{
				return $container;
			});
		}

		// register the dic for manual resolving
		static::$dic->registerSingleton('dic', function($container)
		{
			return $container;
		});

		return static::$dic;
	}

	/**
	 * Returns the DiC
	 *
	 * @return Dic
	 */
	public static function getDic()
	{
		return static::$dic ?: static::setDic();
	}

	/**
	 * Magic methods
	 */
	public static function __callStatic($method, $arguments)
	{
		$dic = static::getDic();

		if ( ! method_exists($dic, $method))
		{
			throw new BadMethodCallException('Method ' . $method . ' does not exists');
		}

		return call_user_func_array([$dic, $method], $arguments);
	}
}
