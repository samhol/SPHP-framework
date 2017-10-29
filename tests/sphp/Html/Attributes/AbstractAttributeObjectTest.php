<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\AttributeInterface;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

abstract class AbstractAttributeObjectTest extends \PHPUnit\Framework\TestCase {

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
  abstract public function createAttr(string $name = 'data-attr'): AttributeInterface;

  /**
   * @return scalar[]
   */
  public function settingData(): array {
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
   * @dataProvider settingData
   * @param scalar $value
   * @param scalar $expected
   * @param boolean $visibility
   */
  public function testSetting($value) {
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isProtected());
    $this->assertFalse($this->attrs->isProtected($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->isVisible(), $value !== false);
    $this->assertEquals($this->attrs->getValue(), $value);
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
   * @covers AbstractAttribute::lock()
   * @dataProvider lockMethodData
   * @param  scalar $value
   */
  public function testLockMethod($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protect($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), $value);
    $this->expectException(ImmutableAttributeException::class);
    $attr->clear();
  }

}
