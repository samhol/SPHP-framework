<?php

namespace Sphp\Core\Filters;

class IntegerFilterTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var IntegerFilter
   */
  protected $filter;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->filter = new IntegerFilter();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   */
  public function testCast() {
    $f = new IntegerFilter();
    $f->setDefault(0);
    $this->assertEquals($f(null), 0);
    $this->assertEquals($f('foo'), 0);
    $this->assertEquals($f(new \stdClass), 0);
  }

  /**
   */
  public function testDefault() {
    $f = new IntegerFilter();
    $f->setDefault(0)->setMin(-6)->setMax(6);
    $this->assertEquals(0, $f(-10));
    $this->assertEquals($f(0), 0);
    $this->assertEquals($f('-1'), -1);
  }

}
