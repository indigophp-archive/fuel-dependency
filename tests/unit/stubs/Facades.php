<?php

/*
 * This file is part of the Indigo Core package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Core;

/**
 * Dummy Facade
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class DummyFacade extends \Facade
{
	public static function forge($instance = 'default')
	{
		return static::newInstance($instance, new \stdClass);
	}
}

/**
 * Advanced Dummy Facade
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class AdvancedDummyFacade extends DummyFacade
{
	use \Indigo\Core\Facade\Instance;
}
