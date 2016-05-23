<?php

namespace Sphp\Util;

class StringObjectTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Strings
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		//$this->object = new String("string");
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * Generated from @assert ("abc", "a") == true.
	 *
	 * @covers Sphp\Tools\String::startsWith
	 */
	public function testStartsWith() {
		$this->assertTrue(Strings::startsWith("string", "string"));
		$this->assertTrue(Strings::startsWith("string", ""));
		$this->assertTrue(Strings::startsWith("string", "s"));
		$this->assertFalse(Strings::startsWith("string", "i"));
	}

}

