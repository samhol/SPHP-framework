<?php

namespace Sphp\Html\Attributes;

class StyleAttributeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var PropertyAttribute
	 */
	protected $styles;

	/**
	 * @var \Closure
	 */
	protected $listener;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function __construct() {
		$this->styles = new PropertyAttribute("style");
		$this->observer = function($obj, $attrName) {
			echo "\nAn event occured: $event\n";
		};
		$this->styles->attachAttributeChangeObserver($this->observer);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		echo "\ntearDown:\n";
		$this->styles = NULL;
	}

	/**
	 */
	public function testSetting() {
		$this->styles->set("border: 1px; color: #fff;");
		echo $this->styles;
		$this->assertEquals($this->styles->getValue(), "border:1px;color:#fff;");
		$this->assertTrue($this->styles->contains("border"));
	}

	/**
	 */
	public function testLocking() {
		$this->styles->set("border: 1px; color: #fff;");
		$this->styles->lock("border: 2px;");
		$this->assertEquals($this->styles->getPropertyValue("border"), "2px");
		$this->assertTrue($this->styles->contains("border"));
		try {
			$this->styles->remove("border");
		} catch (Exception $ex) {
			$this->assertTrue($this->styles->contains("border"));
		}
		$this->assertTrue($this->styles->contains("border"));
	}

}
