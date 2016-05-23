<?php

namespace Sphp\Util;

class ConfigTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Config
	 */
	protected $config;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
    $this->config = Config::instance();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	/**
	 */
	public function testStatic() {
    Config::set("string", "string");
		$this->assertTrue(Config::get("string") === "string");
	}

}
