<?php

use Sphp\Html\Attributes\AttributeInterface;

abstract class AttributeObjectTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   * @var AttributeInterface 
   */
  protected $attrs;
  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    echo "\nsetUp:\n";
    $this->attrs = $this->createAttr();
  }
  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    echo "\ntearDown:\n";
    $this->attrs = null;
  }

  /**
   * @return AttributeInterface
   */
  abstract public function createAttr($name = "data-attr");

  /**
   * 
   * @return string[]
   */
  public function scalarData() {
    return [
        ["", false, false],
        [" ", false, false],
        [true, true, true],
        [false, false, false],
        ["value1", "value1", true],
        [" value2 ", "value2", true],
        [0, 0, true],
        [-1, -1, true],
        [1, 1, true],
        [0b100, 0b100, true]
    ];
  }

  /**
   * 
   * @covers AttributeInterface::set()
   * @dataProvider scalarData
   * @param scalar $value
   * @param scalar $expected
   * @param boolean $visibility
   */
  public function testScalarSetting($value, $expected, $visibility) {
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->isVisible(), $visibility);
    $this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   */
  public function testDemanding() {
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->attrs->set(false);
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName() . "");
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData() {
    return [
        ["c1"],
        [["c1 c2"]],
        [["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider lockingData
   */
  public function testScalarLocking($value) {
    $attr = $this->createAttr();
    $attr->lock($value);
    $this->assertTrue($attr->isLocked($value));
    $this->assertTrue($attr->isLocked());
    $this->assertTrue($attr->contains($value));
  }

}
