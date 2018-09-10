<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\MutableAttributeInterface;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class AttributeTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var Attribute 
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
   * @return MutableAttributeInterface
   */
  public function createAttr(string $name = 'data-attr'): MutableAttributeInterface {
    return new Attribute($name);
  }

  /**
   * @return array[]
   */
  public function settingData(): array {
    return [[['', ' ', true, 'value1', ' value2 ', 0, -0, -1, 1, 0.01]]];
  }

  /**
   * @dataProvider settingData
   * @param scalar $values
   * @param scalar $expected
   * @param boolean $visibility
   */
  public function testSetting(array $values) {
    $attr = new Attribute('attr');
    foreach ($values as $value) {
      $attr->set($value);
      $this->assertEquals($attr->getValue(), $value);
      $this->assertTrue($attr->isVisible());
      $this->assertSame($attr->isBoolean(), is_bool($value));
    }
    $attr->set(false);
    $this->assertEquals($attr->getValue(), false);
    $this->assertFalse($attr->isVisible());
    $this->assertTrue($attr->isBoolean());
    $attr->set(null);
    $this->assertSame($attr->getValue(), null);
    $this->assertFalse($attr->isVisible());
    $this->assertFalse($attr->isBoolean());
    $this->expectException(InvalidAttributeException::class);
    $attr->set(new \stdClass());
    //$this->assertFalse($this->attr->isProtected());
    //$this->assertFalse($this->attr->isProtected($value));
    //$this->assertFalse($this->attr->isDemanded());
    //$this->assertEquals($this->attr->isVisible(), $value !== false);
  }

  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->attr->set(false);
    $this->attr->clear();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName() . "");
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
    $this->expectException(ImmutableAttributeException::class);
    $attr->set('foo');
  }

}
