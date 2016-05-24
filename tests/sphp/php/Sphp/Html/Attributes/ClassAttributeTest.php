<?php

namespace Sphp\Html\Attributes;

class ClassAttributeTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var ClassAttribute
	 */
	protected $css;

	/**
	 * @var \Closure
	 */
	protected $listener;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function __construct() {
		$this->css = new MultiValueAttribute("class");
		$this->listener = function($event) {
			echo "\nAn event occured: $event\n";
		};
		$this->css->addListener($this->listener);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		echo "\ntearDown:\n";
		$this->css = NULL;
	}

	/**
	 * 
	 * @covers Sphp\Html\Attributes\CssClassAttribute::add()
	 */
	public function testAdding() {
		$this->css->add("c1");
		echo $this->css;
		$this->assertTrue($this->css->contains("c1"));
		$this->assertEquals($this->css->__toString(), 'class="c1"');
		$this->assertFalse($this->css->contains("c1 c2"));
		$this->assertFalse($this->css->contains("c2"));
		$this->css->add("c2 c3");
		$this->assertTrue($this->css->contains("c3 c2 c1"));
	}

	/**
	 * 
	 * @covers Sphp\Html\Attributes\CssClassAttribute::add()
	 */
	public function testLocking1() {
		$this->css->lock("l1");
		$this->assertTrue($this->css->isLocked("l1"));
		$this->assertTrue($this->css->isLocked());
		$this->assertFalse($this->css->contains("l1 c2"));
		$this->assertFalse($this->css->contains("c2"));
		$this->css->add("c2");
		$this->css->lock("l3");
		$this->assertTrue($this->css->contains("l3 c2 l1"));
	}

	/**
	 * 
	 * @covers Sphp\Html\Attributes\CssClassAttribute::add()
	 */
	public function testLocking2() {
		$this->css
				->lock("l1 l2")
				->add("c1 c2");
		$this->assertTrue($this->css->contains("l1 l2 c1 c2"));
		
		$this->assertTrue($this->css->isLocked("l1 l2"));
		$this->assertTrue($this->css->isLocked());

		//$this->css->unlock("l1 c2");
		//$this->assertFalse($this->css->isLocked("l1"));
		$this->assertTrue($this->css->isLocked("l2"));
		$this->assertTrue($this->css->contains("c2"));
		$this->css->add("c2");
		$this->css->lock("l3");
		$this->assertTrue($this->css->contains("l3 c2 l1"));
	}

	/**
	 * 
	 * @covers Sphp\Html\Attributes\CssClassAttribute::add()
	 */
	public function testRemoving() {
		$this->css
				->lock("l1 l2")
				->add("c1 c2");
		$this->assertTrue($this->css->contains("l1 l2 c1 c2"));
		$this->css->remove("l1 l2 c1 c2");
		$this->assertTrue($this->css->contains("l1 l2"));
		$this->css->remove("l1 l2 c1 c2");
		//print_r($this->css->getClasses());
		$this->assertFalse($this->css
				//->unlock("l1 l2")
				->remove("l1 l2 c1 c2")
				->contains("l1 l2"));
	}

	/**
	 * 
	 * @covers Sphp\Html\Attributes\CssClassAttribute::add()
	 */
	public function testPrinting() {
		$this->assertEquals($this->css->getValue(), "");
		$this->assertEquals("$this->css", "");
		$this->css
				->lock("l1 l2")
				->add("c1 c2");
		$this->assertTrue($this->css->contains("l1 l2 c1 c2"));
		$this->css->remove("l1 l2 c1 c2");
		$this->assertTrue($this->css->contains("l1 l2"));
		$this->css->remove("l1 l2 c1 c2");
		//print_r($this->css->getClasses());
		$this->assertFalse($this->css
				//->unlock("l1 l2")
				->remove("l1 l2 c1 c2")
				->contains("l1 l2"));
	}

}
