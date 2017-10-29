<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\AttributeInterface;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class BooleanAttributeTests extends \PHPUnit\Framework\TestCase {

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
    return new BooleanAttribute($name);
  }

  /**
   * @return scalar[]
   */
  public function trueValues(): array {
    return [
        ['yes'],
        ['on'],
        [true],
        ['true'],
        [1],
        ['1'],
    ];
  }

  /**
   * @covers AttributeInterface::set()
   * @dataProvider trueValues
   * @param scalar $value
   */
  public function testTrueSetting($value) {
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertTrue($this->attrs->isVisible());
    $this->assertEquals($this->attrs->getValue(), true);
    $this->assertSame("$this->attrs", $this->attrs->getName());
  }

  /**
   * @return scalar[]
   */
  public function falseValues(): array {
    return [
        //['off'],
        //['false'],
        [false],
        [0],
        ['0'],
    ];
  }

  /**
   * @covers AttributeInterface::set()
   * @dataProvider falseValues
   * @param scalar $value
   */
  public function testFalseSetting($value) {
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertFalse($this->attrs->isVisible());
    $this->assertEquals($this->attrs->getValue(), false);
    $this->assertSame("$this->attrs", '');
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
    $this->assertEquals("$this->attrs", $this->attrs->getName());
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [true],
        ['a'],
        [' ä ']
    ];
  }

  /**
   * @covers AbstractAttribute::lock()
   * @dataProvider trueValues
   * @param  scalar $value
   */
  public function testLockTrueValues($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isLocked());
    $attr->lock($value);
    $this->assertTrue($attr->isLocked());
    $this->assertEquals($attr->getValue(), true);
    $this->assertSame("$attr", $attr->getName());
    $this->expectException(ImmutableAttributeException::class);
    $attr->clear();
  }

  /**
   * @covers AbstractAttribute::lock()
   * @dataProvider falseValues
   * @param  scalar $value
   */
  public function testLockFalseValues($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isLocked());
    $attr->lock($value);
    $this->assertTrue($attr->isLocked());
    $this->assertEquals($attr->getValue(), false);
    $this->expectException(ImmutableAttributeException::class);
    $attr->clear();
  }

}
