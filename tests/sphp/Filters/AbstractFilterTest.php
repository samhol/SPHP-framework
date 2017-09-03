<?php

namespace Sphp\Filters;

abstract class AbstractFilterTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @var AnythingToIntegerFilter
	 */
	protected $filter;
	
	public function __construct(FilterInterface $filter) {
		$this->filter = $filter;
		parent::__construct();
	}

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		//$this->filter = new AnythingToIntegerFilter();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}
	
	protected function valueNotFiltered($value) {
		$this->testEqualsValue($value, $value);
	}
	
	protected function testFilteredEquals($value, $result) {
		$this->assertEquals($this->filter->filter($value), $result);
	}
}

