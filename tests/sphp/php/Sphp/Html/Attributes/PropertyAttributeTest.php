<?php

namespace Sphp\Html\Attributes;

class PropertyAttributeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		echo "\ntearDown:\n";
	}

	/**
	 */
	public function testSetting() {
    $attr = new PropertyAttribute("style");
		$attr->set("border: 1px; color: #fff;");
		echo $attr;
		$this->assertEquals($attr->getValue(), "border:1px;color:#fff;");
		$this->assertTrue($attr->contains("border"));
	}

	/**
	 */
	public function testLocking() {
    $attr = new PropertyAttribute("style");
		$attr->set("border: 1px; color: #fff;");
		$attr->lock("border: 2px;");
		$this->assertEquals($attr->getPropertyValue("border"), "2px");
		$this->assertTrue($attr->contains("border"));
		try {
			$attr->remove("border");
		} catch (\Exception $ex) {
			$this->assertTrue($attr->contains("border"));
		}
		$this->assertTrue($attr->contains("border"));
	}

}
