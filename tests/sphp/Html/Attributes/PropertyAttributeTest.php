<?php

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\PropertyAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class PropertyAttributeTest extends TestCase {

  /**
   * @var PropertyAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attr = new PropertyAttribute('prop');
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attr = null;
  }

  /**
   * @return array[]
   */
  public function mixedProperties(): array {
    return [
        [['p1' => 'v1', 'p2' => 'v2']],
        ["p1:v1;p2:v2;"],
        ["p2:v2;p1:v1;"],
    ];
  }

  /**
   * @dataProvider mixedProperties
   * @param string|array $props
   */
  public function testMixedSetting($props) {
    $this->attr->set($props);
    $this->assertFalse($this->attr->isProtected());
    $this->containsProperty($this->attr, "p1", "v1");
    $this->containsProperty($this->attr, "p2", "v2");
  }

  /**
   * @return array[]
   */
  public function lockMethodData(): array {
    return [
        ["p:v;"],
        ["p1:v1;p2:v2;"]
    ];
  }

  /**
   * @return array[]
   */
  public function scalarData(): array {
    return [
        ["", false, false],
        [" ", false, false],
        [true, false, false],
        [false, false, false],
        ["p1:v1; p2:v2;", "p1:v1;p2:v2;", true],
        [" value2 ", false, false],
        [0, false, false],
        [-1, false, false],
        [1, false, false],
        [0b100, false, false]
    ];
  }

  /**
   * @return PropertyAttribute
   */
  public function testDemanding(): PropertyAttribute {
    //echo "\ntestCloning()\n";
    $propAttr = new PropertyAttribute('prop');

    $this->assertFalse($propAttr->isDemanded());

    $propAttr->demand();
    $this->assertTrue($propAttr->isDemanded());
    $propAttr->set(false);

    $this->assertTrue($propAttr->isDemanded());
    return $propAttr;
  }

  /**
   * @depends testDemanding
   * @return PropertyAttribute
   */
  public function testSetting(PropertyAttribute $propAttr): PropertyAttribute {
    //echo "\ntestCloning()\n";
    //$propAttr = new PropertyAttribute('prop');
    $propAttr->setProperty('a', 'b');
    $this->containsProperty($propAttr, 'a', 'b');
    $this->notHavingPropTest($propAttr, 'b');
    $propAttr->setProperty('b', 'c');
    $propAttr->unsetProperty('b');
    $this->notHavingPropTest($propAttr, 'b');
    return $propAttr;
  }

  /**
   * @depends testSetting
   * @param PropertyAttribute $attr
   */
  public function testCloning(PropertyAttribute $attr) {
    //echo "\ntestCloning()\n";
    $attr->lockProperty('foo', 'bar');
    $cloned = clone $attr;
    $this->containsProperty($cloned, 'a', 'b');
    $this->containsProperty($cloned, 'foo', 'bar');
    $cloned->setProperty('foobar', 'bar of foo');
    $cloned->lockProperty('protected1', 'foo');
    $this->containsProperty($cloned, 'foobar', 'bar of foo');
    $this->notHavingPropTest($attr, 'foobar');

    $attr->setProperty('bar', 'bar of foo');
    $this->containsProperty($attr, 'bar', 'bar of foo');
    $this->notHavingPropTest($cloned, 'bar');
  }

  /**
   * @param PropertyAttribute $attr
   * @param string $prop
   * @param scalar $val
   */
  public function containsProperty(PropertyAttribute $attr, $prop, $val) {
    //echo "\npropEqualsTest\n";
    $this->assertTrue($attr->hasProperty($prop));
    $this->assertEquals($attr->getProperty($prop), $val);
  }

  /**
   * 
   * @param PropertyAttribute $attr
   * @param string $prop
   */
  public function notHavingPropTest(PropertyAttribute $attr, $prop) {
    //echo "\nnotHavingPropTest\n";
    $this->assertFalse($attr->hasProperty($prop));
    $this->assertEquals($attr->getProperty($prop), null);
  }

  /**
   * @return array[]
   */
  public function settMethodData(): array {
    return [
        ["", false],
        [false, false],
        ["p", false],
        ["p:  v;", "p:v;"],
        ["p: v;p1: v1;  ", "p:v;p1:v1;"]
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider settMethodData
   */
  public function testSetMethod($value, $expected) {
    $this->attr->set($value);
    $this->assertFalse($this->attr->isProtected());
    $this->assertFalse($this->attr->isProtected($value));
    $this->assertFalse($this->attr->isDemanded());
    $this->assertEquals($this->attr->getValue(), $expected);
  }

  /**
   * @return array[]
   */
  public function demandData(): array {
    return [
        ["c1"],
        [["c1 c2"]],
        [["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   */
  public function testDemandMethod() {
    $this->attr->set(false);
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName() . "");
  }

  /**
   * 
   * @return string[]
   */
  public function lockPropertiesMethodData() {
    return [
        [["p" => "v"]],
        [array_combine(range("a", "e"), range("a", "e")), array_combine(range("b", "d"), range("b", "d"))]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider lockPropertiesMethodData
   * 
   * @param scalar $props
   */
  public function testLockPropertiesMethod($props) {
    $this->attr->lockProperties($props);
    $this->assertTrue($this->attr->isProtected());
    $this->attr->clear();
    foreach ($props as $p => $v) {
      $this->assertTrue($this->attr->isProtected($p));
      $this->containsProperty($this->attr, $p, $v);
    }
  }

  /**
   * 
   * @return array
   */
  public function validPropertyData(): array {
    return [
        ['a', 'b'],
        ['a', 1],
        ['a', 'true'],
        ['a', 'false'],
        ['a', "a b"],
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider validPropertyData
   * @param int|string $propName numeric value
   * @param scalar $propValue
   */
  public function testSetProperty($propName, $propValue) {
    $this->attr->setProperty($propName, $propValue);
    $this->assertTrue($this->attr->hasProperty($propName));
    $this->assertTrue($this->attr->count() === 1);
  }

  /**
   * @return array
   */
  public function invalidPropertyData(): array {
    return [
        ['', 'b'],
        ['a', ''],
        ["\n", 'b'],
        ['a', false],
        ['a', null],
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider invalidPropertyData
   * @param int|string $propName numeric value
   * @param scalar $propValue
   */
  public function testSetPropertyFail($propName, $propValue) {
    $this->expectException(InvalidAttributeException::class);
    $this->attr->setProperty($propName, $propValue);
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\PropertyAttribute::add()
   * @param int $count
   */
  public function testClearing() {
    $this->attr->setProperty('foo', 'bar');
    $this->assertTrue($this->attr->hasProperty('foo'));
    $this->attr->clear();
    $this->assertFalse($this->attr->hasProperty('foo'));
    $this->attr->lockProperty('foo', 'bar');
    $this->assertTrue($this->attr->hasProperty('foo'));
    $this->attr->clear();
    $this->assertTrue($this->attr->hasProperty('foo'));
  }

  /**
   * @covers PropertyAttribute::unsetProperty()
   */
  public function testUnsetPropertyMethod() {
    $this->attr->setProperty('foo', 'bar');
    $this->assertTrue($this->attr->hasProperty('foo'));
    $this->attr->unsetProperty('foo');
    $this->assertFalse($this->attr->hasProperty('foo'));
    $this->attr->lockProperty('foo', 'bar');
    $this->assertTrue($this->attr->hasProperty('foo'));
    $this->expectException(ImmutableAttributeException::class);
    $this->attr->unsetProperty('foo');
  }

}
