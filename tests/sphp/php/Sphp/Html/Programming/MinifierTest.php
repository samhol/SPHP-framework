<?php

namespace Sphp\Html\Attributes;

class MinifierTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var AttributeManager
	 */
	protected $scripts;

	/**
	 * @var \Closure
	 */
	protected $listener;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function __construct() {
		$this->attrs = new AttributeManager();
		$this->listener = function($event, $attrName) {
			echo "\n '$attrName' changed: $attrName\n";
		};
		$this->attrs->attachIdentityObserver($this->listener);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		echo "\ntearDown:\n";
		$this->attrs = NULL;
	}

	/**
	 *
	 * @covers Sphp\Html\Attributes\AttributeManagerTest::set()
	 */
	public function testSetting() {
		$this->attrs->set("empty");
		$this->assertEquals("$this->attrs", "empty");
		$this->assertTrue($this->attrs->exists("empty"));
		$this->assertFalse($this->attrs->exists("foo"));
		$this->attrs->set("null", NULL);
		$this->assertTrue($this->attrs->exists("null"));
		$this->assertTrue($this->attrs->exists("empty"));
	}

	/**
	 *
	 * @covers Sphp\Html\Attributes\AttributeManagerTest::set()
	 */
	public function testSettingBool() {
		$this->attrs->set("true", TRUE);
		$this->assertEquals("$this->attrs", "true");
		$this->assertTrue($this->attrs->exists("true"));
		$this->assertTrue($this->attrs->getValue("true") === TRUE);

		$this->attrs->set("false", FALSE);
		$this->assertFalse($this->attrs->exists("false"));
		$this->assertEquals("$this->attrs", "true");

		$this->attrs->set("true", FALSE);
		$this->assertFalse($this->attrs->exists("true"));
	}

	/**
	 *
	 * @covers Sphp\Html\Attributes\SimpleAttributeManager::set()
	 */
	public function testSettingValues() {
		$this->attrs
				->set("neg", -1)
				->set("zero", 0)
				->set("one", 1);
		echo "\nattrs:$this->attrs\n";
		$this->assertEquals("$this->attrs", 'neg="-1" zero="0" one="1"');
		$this->assertTrue($this->attrs->getValue("neg") === -1);
		$this->assertTrue($this->attrs->getValue("zero") === 0);
		$this->assertTrue($this->attrs->getValue("one") === 1);
	}

	/**
	 *
	 * @covers Sphp\Html\Attributes\SimpleAttributeManager::set()
	 */
	public function testRequiringValues() {
		$this->attrs
				->demand("r1")
				->set("r2", "value")
				->demand("r2");
		echo "\nattrs:$this->attrs\n";
		$this->assertEquals("$this->attrs", 'r1 r2="value"');
	}

	/**
	 *
	 * @covers Sphp\Html\Attributes\SimpleAttributeManager::set()
	 */
	public function testStyle() {
		$this->attrs["style"]["border"] = "solid 2px black";
		$this->assertEquals($this->attrs["style"]["border"], "solid 2px black");
	}

}
