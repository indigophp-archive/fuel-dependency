<?php

/*
 * This file is part of the Indigo Core package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Fuel\Dependency;

use Codeception\TestCase\Test;

/**
 * Tests for Dependency
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Fuel\Dependency\Container
 * @group              Dependency
 */
class ContainerTest extends Test
{
	public function _before()
	{
		Container::_init();
	}

	/**
	 * @covers ::getContainer
	 */
	public function testContainer()
	{
		$this->assertInstanceOf('Fuel\\Dependency\\Container', Container::getContainer());
	}
}
