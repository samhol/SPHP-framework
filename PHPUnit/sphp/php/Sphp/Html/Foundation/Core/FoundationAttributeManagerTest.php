<?php

namespace Sphp\Html\Foundation\Core;

class FoundationAttributeManagerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var FoundationAttributeManager
	 */
	protected $instance;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->instance = new FoundationAttributeManager();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}


	public function testDataOptionSetting() {
    $op = $this->instance->dataOptions();
			$this->assertNotNull($op);
    //$op->setProperty("a", "false");
		//	$this->assertEquals($op->getPropertyValue("a"), "false");
	}

}
