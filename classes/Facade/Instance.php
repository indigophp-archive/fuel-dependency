<?php

/*
 * This file is part of the Indigo Core package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Core\Facade;

/**
 * Facade Instance helper
 *
 * Return forged class if instance is not found
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Instance
{
	/**
	 * Default instance name
	 *
	 * @var string
	 */
	protected static $_instance;

	/**
	 * {@inheritdoc}
	 */
	public static function instance($instance = null)
	{
		// Try to get a default instance name
		if ($instance === null)
		{
			$instance = static::$_instance;
		}

		// Try to get an existing instance
		$return = parent::instance($instance);

		// Fallback to forging one
		if ($return === false)
		{
			$return = static::forge($instance);
		}

		return $return;
	}

	/**
	 * Returns the default instance name
	 *
	 * @return string
	 */
	public static function getDefaultInstance()
	{
		return static::$_instance;
	}
}
