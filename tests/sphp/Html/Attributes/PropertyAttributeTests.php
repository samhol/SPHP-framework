<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

include_once 'AbstractAttributeObjectTest.php';

class PropertyAttributeTests extends AbstractAttributeObjectTest {

  /**
   * @var PropertyAttribute 
   */
  protected $attr;

  public function createAttr(string $name = 'style'): AttributeInterface {
    return new PropertyAttribute($name);
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
   * 
   */
  public function testCloning() {
    //echo "\ntestCloning()\n";
    $this->attr->setProperty("p", "v");
    $this->propEqualsTest($this->attr, "p", "v");
    $cloned = clone $this->attr;
    $this->propEqualsTest($cloned, "p", "v");
    $cloned->setProperty("p", "v1");
    $cloned->setProperty("p1", "v2");
    $this->propEqualsTest($cloned, "p1", "v2");
    $this->propEqualsTest($this->attr, "p", "v");
    $this->notHavingPropTest($this->attr, "p1");
    $this->attr->unsetProperty("p");
    $this->notHavingPropTest($this->attr, "p");
    $this->propEqualsTest($cloned, "p", "v1");
  }

  /**
   * 
   * @param PropertyAttribute $attr
   * @param string $prop
   * @param scalar $val
   */
  public function propEqualsTest(PropertyAttribute $attr, $prop, $val) {
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
    echo "testSetting\n\n";
    $this->attr->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

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
    echo "testLockPropertiesMethod\n";
    var_dump($props);
    $this->attr->lockProperties($props);
    $this->assertTrue($this->attr->isProtected());
    $this->attr->clear();
    foreach ($props as $p => $v) {
      $this->assertTrue($this->attr->isProtected($p));
      $this->propEqualsTest($this->attr, $p, $v);
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
    $this->expectException(Exceptions\InvalidAttributeException::class);
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
  

  /**
   * @covers PropertyAttribute::unsetProperty()
   */
  public function testOutputs() {
    $this->attr->setProperty('a', '1 2 3');
    $this->attr->setProperty('b', 'foo');
    $this->assertSame($this->attr->hasProperty('foo'));
    $this->assertTrue($this->attr->hasProperty('foo'));
    $this->attr->unsetProperty('foo');
    $this->assertFalse($this->attr->hasProperty('foo'));
    $this->attr->lockProperty('foo', 'bar');
    $this->assertTrue($this->attr->hasProperty('foo'));
    $this->expectException(ImmutableAttributeException::class);
    $this->attr->unsetProperty('foo');
  }

}
