<?php

/*
 * This file is part of the Indigo Core package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Fuel\Facade;

use Codeception\TestCase\Test;

/**
 * Tests for Facade Instance
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Core\Facade\Instance
 * @group              Core
 * @group              Facade
 */
class InstanceTest extends Test
{
	/**
	 * @covers ::instance
	 */
	public function testInstance()
	{
		$this->assertInstanceOf('stdClass', \AdvancedDummyFacade::instance('test'));
	}

	/**
	 * @covers ::instance
	 * @covers ::getDefaultInstance
	 */
	public function testDefaultInstance()
	{
		$this->assertInstanceOf('stdClass', \AdvancedDummyFacade::instance());
		$this->assertNull(\AdvancedDummyFacade::getDefaultInstance());
	}
}
