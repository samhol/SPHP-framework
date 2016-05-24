<?php

namespace Sphp\Util\Filters;

class IntegerToRomanFilterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var IntegerToRomanFilter
	 */
	protected $filter;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->filter = new IntegerToRomanFilter();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 *
	 * @covers IntegerToRomanFilter::filter
	 */
	public function testIntegers() {
		$this->assertEquals($this->filter->filter(-1), -1);
		$this->assertEquals($this->filter->filter(0), 0);
		$this->assertEquals($this->filter->filter(1), "I");
		$this->assertEquals($this->filter->filter(4), "IV");
		$this->assertEquals($this->filter->filter(5), "V");
		$this->assertEquals($this->filter->filter(123), "CXXIII");
	}

	/**
	 *
	 * @covers IntegerToRomanFilter::filter
	 */
	public function testValidStrings() {
		$this->assertEquals($this->filter->filter("1"), "I");
		$this->assertEquals($this->filter->filter("4"), "IV");
		$this->assertEquals($this->filter->filter("5"), "V");
		$this->assertEquals($this->filter->filter("123"), "CXXIII");
	}
	
	/**
	 *
	 * @covers IntegerToRomanFilter::filter
	 */
	public function testInvalidStrings() {
		$this->assertEquals($this->filter->filter("-1"), "-1");
		$this->assertEquals($this->filter->filter("0"), "0");
		$this->assertEquals($this->filter->filter("001"), "001");
	}
	
	/**
	 *
	 * @covers IntegerToRomanFilter::filter
	 */
	public function testMixedValues() {
		$obj = new \stdClass();
		$this->assertEquals($this->filter->filter($obj), $obj);
		$this->assertEquals($this->filter->filter(true), true);
		$this->assertEquals($this->filter->filter(false), false);
	}
}

