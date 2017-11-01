<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

include_once 'AbstractAttributeObjectTest.php';

class PropertyAttributeTest extends AbstractAttributeObjectTest {

  /**
   * @var PropertyAttribute 
   */
  protected $attrs;

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
    $this->attrs->setProperty("p", "v");
    $this->propEqualsTest($this->attrs, "p", "v");
    $cloned = clone $this->attrs;
    $this->propEqualsTest($cloned, "p", "v");
    $cloned->setProperty("p", "v1");
    $cloned->setProperty("p1", "v2");
    $this->propEqualsTest($cloned, "p1", "v2");
    $this->propEqualsTest($this->attrs, "p", "v");
    $this->notHavingPropTest($this->attrs, "p1");
    $this->attrs->unsetProperty("p");
    $this->notHavingPropTest($this->attrs, "p");
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
    $this->attrs->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($this->attrs->isProtected());
    $this->assertFalse($this->attrs->isProtected($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->getValue(), $expected);
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
    $this->attrs->set(false);
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName() . "");
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
    $this->attrs->lockProperties($props);
    $this->assertTrue($this->attrs->isProtected());
    $this->attrs->clear();
    foreach ($props as $p => $v) {
      $this->assertTrue($this->attrs->isProtected($p));
      $this->propEqualsTest($this->attrs, $p, $v);
    }
  }

  /**
   * 
   * @return array
   */
  public function validPropertyData(): array {
    return [
        [0, "val"],
        [1, "val"],
        ["prop", 0],
        ["prop", 0.1],
        ["prop", 2],
        ["prop", -2],
        ["prop", true],
        ["prop", false],
        ["1", "val"],
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider validPropertyData
   * @param int|string $propName numeric value
   * @param scalar $propValue
   */
  public function testSetProperty($propName, $propValue) {
    $this->attrs->setProperty($propName, $propValue);
    $this->assertTrue($this->attrs->hasProperty($propName));
    $this->assertTrue($this->attrs->count() === 1);
    //var_dump($this->attrs->count());
    //var_dump($this->attrs->toArray());
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\PropertyAttribute::add()
   * @param int $count
   */
  public function testClearing() {
    $this->attrs->setProperty('foo', 'bar');
    $this->assertTrue($this->attrs->hasProperty('foo'));
    $this->attrs->clear();
    $this->assertFalse($this->attrs->hasProperty('foo'));
    $this->attrs->lockProperty('foo', 'bar');
    $this->assertTrue($this->attrs->hasProperty('foo'));
    $this->attrs->clear();
    $this->assertTrue($this->attrs->hasProperty('foo'));
  }

  /**
   * @covers PropertyAttribute::unsetProperty()
   */
  public function testUnsetPropertyMethod() {
    $this->attrs->setProperty('foo', 'bar');
    $this->assertTrue($this->attrs->hasProperty('foo'));
    $this->attrs->unsetProperty('foo');
    $this->assertFalse($this->attrs->hasProperty('foo'));
    $this->attrs->lockProperty('foo', 'bar');
    $this->assertTrue($this->attrs->hasProperty('foo'));
    $this->expectException(ImmutableAttributeException::class);
    $this->attrs->unsetProperty('foo');
  }

}
