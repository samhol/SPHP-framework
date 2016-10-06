<?php

namespace Sphp\Html\Attributes;

include_once 'AttributeObjectTest.php';

class PropertyAttributeTest extends \AttributeObjectTest {

  /**
   *
   * @var PropertyAttribute 
   */
  protected $attrs;

  public function createAttr($name = "style") {
    return new PropertyAttribute($name);
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
        [" c1 ", []],
        ["prop: val;", ["prop" => "val"]]
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
   * @return string[]
   */
  public function settingData() {
    return [
        ["", false],
        [false, false],
        ["prop", false],
        ["prop: val;", "prop:val;"]
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider settingData
   */
  public function testSetting($value, $expected) {
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
  public function testDemanding() {
    $this->attrs->set(false);
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName() . "");
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData() {
    return [
        ["prop: val;"]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider lockingData
   */
  public function testLocking($value) {
    $this->attrs->lock($value);
    $parsed = PropertyAttribute::parse($value);
    $this->assertTrue($this->attrs->isLocked(key($parsed)));
    $this->assertTrue($this->attrs->isLocked());
    $this->assertTrue($this->attrs->contains(key($parsed)));
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
    $this->assertTrue($this->attrs->contains($propName));
    $this->assertTrue($this->attrs->count() === 1);
    var_dump($this->attrs->count());
    var_dump($this->attrs->toArray());
  }

  /**
   * 
   * @return scalar[]
   */
  public function clearingData() {
    return [
        ["c1: v1;", "l1: v1;", 1],
        ["c1: v1; c2: v2; c3: v3;", "li: v1; l2:v2;", 2]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider clearingData
   *
   * @param scalar|scalar[] $add
   * @param scalar|scalar[] $lock
   * @param int $count
   */
  public function testClearing($add, $lock, $count) {
    $addedProps = array_keys(PropertyAttribute::parse($add));
    $lockedProps = array_keys(PropertyAttribute::parse($lock));
    $this->attrs->set($add);
    $this->assertTrue($this->attrs->isLocked() === false);
    $this->attrs->lock($lock);
    $this->assertTrue($this->attrs->isLocked());
    $this->assertTrue(!$this->attrs->isLocked($addedProps));
    $this->assertTrue($this->attrs->isLocked($lockedProps));
    $this->attrs->clear();
    $this->assertTrue($this->attrs->count() === $count);
  }

  /**
   * 
   * @return scalar[]
   */
  public function removingData() {
    return [
        ["c1", "", 0],
        ["c1", "l1", 1],
        ["c1 c2 c2", "li l2", 2],
        [["c1", "c2", "c3", "c3"], ["l1", "l2", "l3", "l3"], 3]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   *
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testRemoving() {
    $attr = new MultiValueAttribute("class");
    $attr->add("a b c d");
    $attr->remove("a c");
    $this->assertTrue($attr->contains("b d"));
    $attr->lock("a c");
    try {
      $attr->remove("a c");
    } catch (\Exception $ex) {
      $this->assertTrue($ex instanceof UnmodifiableAttributeException);
      $this->assertTrue($attr->contains("a b c d"));
    }
  }

}
