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

use Codeception\TestCase\Test;

/**
 * Tests for Facade
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Core\Facade
 * @group              Core
 * @group              Facade
 */
class FacadeTest extends Test
{
	public function _before()
	{
		DummyFacade::forge();
	}

	/**
	 * @covers ::forge
	 */
	public function testForge()
	{
		$class = DummyFacade::forge('test');

		$this->assertInstanceOf('stdClass', $class);
	}

	/**
	 * @covers ::newInstance
	 */
	public function testNewInstance()
	{
		$class = DummyFacade::newInstance('new', new \stdClass);

		$this->assertInstanceOf('stdClass', $class);
		$this->assertTrue(DummyFacade::exists('new'));
	}

	/**
	 * @covers ::exists
	 */
	public function testExists()
	{
		$this->assertTrue(DummyFacade::exists('default'));
		$this->assertFalse(DummyFacade::exists('fake'));
	}

	/**
	 * @covers ::instance
	 */
	public function testInstance()
	{
		$this->assertInstanceOf('stdClass', DummyFacade::instance('default'));
		$this->assertFalse(DummyFacade::instance('fake'));
	}

	/**
	 * @covers ::delete
	 */
	public function testDelete()
	{
		$this->assertTrue(DummyFacade::delete('default'));
		$this->assertFalse(DummyFacade::exists('default'));
		$this->assertFalse(DummyFacade::delete('fake'));

		DummyFacade::forge('test');
		$this->assertTrue(DummyFacade::delete(true));
		$this->assertFalse(DummyFacade::exists('test'));
	}
}
