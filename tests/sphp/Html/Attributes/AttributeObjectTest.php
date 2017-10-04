<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\AttributeInterface;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class AttributeObjectTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var AttributeInterface 
   */
  protected $attrs;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attrs = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attrs = null;
  }

  /**
   * @return AttributeInterface
   */
  public function createAttr(string $name = 'data-attr'): AttributeInterface {
    return new Attribute($name);
  }

  /**
   * @return scalar[]
   */
  public function scalarData(): array {
    return [
        ['', '', true],
        [' ', ' ', true],
        [true, true, true],
        [false, false, false],
        ['value1', 'value1', true],
        [' value2 ', ' value2 ', true],
        [0, 0, true],
        [-1, -1, true],
        [1, 1, true],
        [0b100, 0b100, true]
    ];
  }

  /**
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
   * @covers AbstractAttribute::isDemanded()
   */
  public function testDemanding() {
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->attrs->set(false);
    $this->attrs->clear();
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName() . "");
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [1],
        ['a'],
        [' ä ']
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AbstractAttribute::lock()
   * @dataProvider lockMethodData
   * @param  scalar $value
   */
  public function testLockMethod($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isLocked());
    $attr->lock($value);
    $this->assertTrue($attr->isLocked());
    $this->assertEquals($attr->getValue(), $value);
    $this->expectException(ImmutableAttributeException::class);
    $attr->clear();
  }

}
