<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class IntegerAttributeTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var IntegerAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attr = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attr = null;
  }

  /**
   * @return Attribute
   */
  public function createAttr(int $min = null, int $max = null): Attribute {
    return new IntegerAttribute('int', $min, $max);
  }

  /**
   * @return scalar[]
   */
  public function settingData(): array {
    return [
        ['0'],
        [0],
        [true],
        [false],
        [0],
        [-0],
        [0.0],
        [-1],
        [1],
        ['1'],
        [1],
        [null],
    ];
  }

  /**
   * @dataProvider settingData
   * @param scalar $value
   * @param scalar $expected
   * @param boolean $visibility
   */
  public function testSetting($value) {
    $this->attr->setValue($value);
    $this->assertFalse($this->attr->isProtected());
    $this->assertFalse($this->attr->isProtected($value));
    $this->assertFalse($this->attr->isDemanded());
    $this->assertEquals($this->attr->isVisible(), ($value !== null || $value !== false));
    $this->assertEquals($this->attr->getValue(), $value);
  }

  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->attr->setValue(false);
    $this->attr->clear();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName() . "");
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [-1],
        ['0'],
        [4]
    ];
  }

  /**
   * @dataProvider lockMethodData
   * @param  scalar $value
   */
  public function testProtectMethod($value) {
    $this->assertFalse($this->attr->isProtected());
    $this->attr->protect($value);
    $this->assertTrue($this->attr->isProtected());
    $this->assertEquals($this->attr->getValue(), $value);
    $this->expectException(ImmutableAttributeException::class);
    $this->attr->setValue($value +1);
    $this->attr->clear();
  }

}
