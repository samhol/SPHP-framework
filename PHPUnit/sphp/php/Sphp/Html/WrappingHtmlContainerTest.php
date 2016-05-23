<?php

namespace Sphp\Html;

class WrappingHtmlContainerTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Collection
   */
  protected $coll;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->coll = new WrappingContainer();
    $wrapper = function ($c) {
      return "wrapped: (" . $c .  ")";
    };
    $this->coll->setWrapper($wrapper);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->coll->clear();
  }

  public function testNullSetting() {
    $this->coll->append(NULL);
    $this->assertTrue($this->coll->count() === 1);
    $this->assertEquals($this->coll->count(), 1);
    $this->assertTrue($this->coll->get(0) === "wrapped: ()");
  }

  public function testStringSetting() {
    $obj = "text";
    $this->coll->set("text", $obj);
    $this->assertTrue($this->coll->count() == 1);
    $this->assertEquals($this->coll->count(), 1);
    $this->assertTrue($this->coll->get("text") === "wrapped: ($obj)");
  }

  public function testSetting() {
  }

  public function testTraversing() {
    $this->coll->clear();
    $arr = range("a", "h");
    $this->coll->append($arr);
    foreach ($this->coll as $key => $val) {
      $this->assertEquals("wrapped: (" . $arr[$key] . ")", $val);
    }
  }

}
