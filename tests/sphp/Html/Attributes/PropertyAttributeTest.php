<?php

namespace Sphp\Html\Attributes;

include_once 'AttributeObjectTest.php';

class PropertyAttributeTest extends \AttributeObjectTest {

  /**
   *
   * @var PropertyAttribute 
   */
  protected $attrs;

  /**
   * 
   * @param  string $name
   * @return PropertyAttribute
   */
  public function createAttr($name = "style") {
    echo phpversion();
    return new PropertyAttribute($name);
  }

  /**
   * 
   * @return string[]
   */
  public function lockMethodData() {
    return [
        ["p:v;"],
        ["p1:v1;p2:v2;"]
    ];
  }

  /**
   * 
   * @return string[]
   */
  public function scalarData() {
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
   * @return string[]
   */
  public function parsingData() {
    return [
        ["", []],
        [" ", []],
        [":;", []],
        [" p ", []],
        ["p: v;", ["p" => "v"]],
        [
            "p: v;p1:v1;p2:v2;p:value;err:e:r:r:;;",
            [
                "p" => "value",
                "p1" => "v1",
                "p2" => "v2",
                "p2" => "v2",
                "err" => "e:r:r:"
            ]
        ]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::parse()
   * @dataProvider parsingData
   */
  public function testParsing($value, $expected) {
    $this->assertEquals(PropertyAttribute::parse($value), $expected);
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
   * 
   * @return string[]
   */
  public function settMethodData() {
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

    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function demandData() {
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
    $this->assertTrue($this->attrs->isLocked());
    $this->attrs->clear();
    foreach ($props as $p => $v) {
      $this->assertTrue($this->attrs->isLocked($p));
      $this->propEqualsTest($this->attrs, $p, $v);
    }
  }

  /**
   * 
   * @return string[]
   */
  public function setPropertyData() {
    return [
        [0, "val"],
        [1, "val"],
        ["prop", 0],
        ["prop", 2],
        ["prop", -2],
        ["prop", "val"],
        ["1", "val"],
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * 
   * @param int|string $propName numeric value
   * @param scalar $propValue
   * @dataProvider setPropertyData
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
   * @return scalar[]
   */
  public function clearingData() {
    return [
        ["c1: v1;", "l1: v1;"],
        ["c1: v1;", "l1: v1;"],
        ["c1: v1; c2: v2; c3: v3;", "li: v1; l2:v2;"]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\PropertyAttribute::add()
   * @dataProvider clearingData
   *
   * @param scalar|scalar[] $setProps
   * @param scalar|scalar[] $lock
   * @param int $count
   */
  public function testClearing($setProps, $lock) {
    $addedProps = array_keys(PropertyAttribute::parse($setProps));
    $lockedProps = array_keys(PropertyAttribute::parse($lock));
    $this->attrs->set($setProps);
    $this->assertTrue($this->attrs->isLocked() === false);
    $this->assertEquals($this->attrs->count(), count($addedProps));
    $this->attrs->lock($lock);
    $this->assertTrue($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($addedProps));
    $this->assertTrue($this->attrs->isLocked($lockedProps));
    $this->attrs->clear();
    $this->assertTrue($this->attrs->count() === count($lockedProps));
  }

  /**
   * 
   * @return scalar[]
   */
  public function removeMethodData() {
    return [
        [["p" => "v"], []],
        [array_combine(range("a", "e"), range("a", "e")), array_combine(range("b", "d"), range("b", "d"))]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\PropertyAttribute::add()
   *
   * @dataProvider removeMethodData
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testRemoveMethod(array $props, array $locked) {
    $this->attrs->setProperties($props);
    var_dump($props);
    $this->assertEquals($this->attrs->count(), count($props));
    foreach ($props as $p => $v) {
      $this->propEqualsTest($this->attrs, $p, $v);
      $this->attrs->unsetProperty($p);
      $this->notHavingPropTest($this->attrs, $p);
    }
    $this->attrs->setProperties($props);
    $this->attrs->lockProperties($locked);
    foreach ($props as $p => $v) {
      try {
        $this->attrs->unsetProperty($p);
      } catch (\Throwable $ex) {
        $this->assertTrue($ex instanceof RuntimeException);
      }
    }
  }

}
