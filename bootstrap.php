<?php

/*
 * This file is part of the Fuel Dependency package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Indigo\Fuel\Dependency\Container;

$container = new Fuel\Dependency\Container;

Config::load('dependency', true);

// Registers ServiceProviders
foreach (Config::get('dependency.services', array()) as $service)
{
	$service = new $service;

	$container->registerService($service);
}

// Registers resources
foreach (Config::get('dependency.resources', array()) as $identifier => $resource)
{
	$container->register($identifier, $resource);
}

// Registers singleton resources
foreach (Config::get('dependency.singletons', array()) as $identifier => $singleton)
{
	$container->registerSingleton($identifier, $singleton);
}

Container::initialize($container);
