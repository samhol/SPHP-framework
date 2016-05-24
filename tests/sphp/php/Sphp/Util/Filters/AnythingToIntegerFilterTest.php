<?php

namespace Sphp\Util\Filters;

require_once 'AbstractFilterTest.php';

class AnythingToIntegerFilterTest extends AbstractFilterTest {

	public function __construct() {
		parent::__construct(new AnythingToIntegerFilter());
	}

	/**
	 *
	 * @covers AnythingToIntegerFilter::filter
	 */
	public function testZeroConversions() {
		$this->assertEquals($this->filter->filter("0"), 0);
		$this->assertEquals($this->filter->filter("0000"), 0);
		$this->assertEquals($this->filter->filter("0b00"), 0);
		$this->valueNotFiltered(0);
		$this->assertEquals($this->filter->filter(new \stdClass), 0);
		$this->assertEquals($this->filter->filter(0b0), 0);
		$this->assertEquals($this->filter->filter(FALSE), 0);
		$this->assertEquals($this->filter->filter("a"), 0);
	}

	protected function testEqualsZero($value) {
		$this->testEqualsValue($value, 0);
	}

	protected function testEqualsSelf($value) {
		$this->testEqualsValue($value, $value);
	}

	protected function testEqualsValue($value, $result) {
		$this->assertEquals($this->filter->filter($value), $result);
	}

	/**
	 *
	 * @covers AnythingToIntegerFilter::filter
	 */
	public function testValidStrings() {
		$this->assertEquals($this->filter->filter("-1"), -1);
		$this->assertEquals($this->filter->filter("1"), 1);
		$this->assertEquals($this->filter->filter("5"), 5);
		$this->assertEquals($this->filter->filter("123"), 123);
	}

	/**
	 *
	 * @covers AnythingToIntegerFilter::filter
	 */
	public function testValidInts() {
		$this->valueNotFiltered(-1);
		$this->valueNotFiltered(1);
		$this->valueNotFiltered(100);
	}

	/**
	 *
	 * @covers AnythingToIntegerFilter::filter
	 */
	public function testInvalidStrings() {
		$this->testEqualsZero("abc");
		$this->testEqualsZero("001");
		$this->testEqualsZero("word");
	}

	/**
	 *
	 * @covers IntegerToRomanFilter::filter
	 */
	public function testMixedValues() {
		$this->testEqualsZero(new \stdClass());
		$this->testEqualsValue(true, 1);
		$this->testEqualsValue(false, 0);
		$this->testEqualsValue([], 0);
	}

}
