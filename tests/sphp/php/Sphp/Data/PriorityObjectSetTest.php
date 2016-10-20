<?php

namespace Sphp\Data;

use Sphp\Core\Types\StringObject;

class PriorityObjectSetTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var PrioritizedObjectStorage
   */
  protected $set;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->set = new PrioritizedObjectStorage();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   */
  public function testBasics() {
    $string[0] = new StringObject("a");
    $string[2] = new StringObject("b");
    $string[1] = new StringObject("b");
    $this->set->insert($string[0], 100, "data a");
    $this->set->insert($string[2], 1, "data b");
    $this->set->insert($string[1], 10, "data c");
    foreach ($this->set as $key => $obj) {
      $this->assertCount(3, $this->set);
      $this->assertTrue($string[$key] === $obj);
    }
    $this->assertCount(3, $this->set);
    $this->assertTrue($this->set->contains($string[0]));
    $this->assertEquals($this->set->extract(), $string[0]);
    $this->assertCount(2, $this->set);
    $this->assertTrue($this->set->extract() === $string[1]);
    $this->assertCount(1, $this->set);
    $this->assertEquals($this->set->extract(), $string[2]);
    $this->assertCount(0, $this->set);
  }

}
