<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\AttributeException;

include_once 'AttributeObjectTest.php';

class MultiValueAttributeTests extends AttributeObjectTest {

  /**
   * @var MultiValueAttribute 
   */
  protected $attrs;

  public function createAttr(string $name = 'class'): AttributeInterface {
    return new MultiValueAttribute($name);
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        [""],
        [" "],
        ["  "],
        ["\n"],
        ["\n\t\r"],
        ["\t"],
        [" \r \n \t "],
        [[""]],
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider emptyData
   */
  public function testEmptySetting($value) {
    $this->expectException(AttributeException::class);
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isProtected($value));
    $this->assertFalse($this->attrs->contains($value));
    $this->assertFalse($this->attrs->isProtected());
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->getValue(), false);
    $this->assertEquals($this->attrs->count(), 0);
  }

  /**
   * 
   * @return string[]
   */
  public function scalarData(): array {
    return [
        ["", false, false],
        [" ", false, false],
        ['foo', 'foo', true],
        ['bar', 'bar', true],
        ["value1", "value1", true],
        [" value2 ", "value2", true],
        [0, 0, true],
        [-1, -1, true],
        [1, 1, true],
        [0b100, 0b100, true]
    ];
  }

  /**
   * @return string[]
   */
  public function settingData(): array {
    return [
        range('a', 'd'),
        ['_-'],
        range('a', 'd')
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider settingData
   */
  public function testSetting($value) {
    $this->attrs->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($this->attrs->isProtected());
    $this->assertFalse($this->attrs->isProtected($value));
    $this->assertFalse($this->attrs->isDemanded());
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData(): array {
    return [
        ["c1"],
        [["c1", "c2"]],
        [["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider lockingData
   */
  public function testLocking($value) {
    $this->attrs->protect($value);
    $this->assertTrue($this->attrs->isProtected($value));
    $this->assertTrue($this->attrs->isProtected());
    $this->assertTrue($this->attrs->contains($value));
  }

  /**
   * 
   * @return string[]
   */
  public function addingData(): array {
    return [
        ["c1", 'a_1'],
        range('a', 'e'),
        [range('a', 'e')[range('d', 'f')]]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * 
   * @param string $value numeric value
   * @param int $num
   * @dataProvider addingData
   */
  public function testAdding($value) {
    $this->attrs->add($value);
    $this->assertTrue($this->attrs->contains($value));
    $this->assertCount(count($value), $this->attrs);
    $this->attrs->clear();
    $this->assertCount(0, $this->attrs);
  }

  protected function attrContains(MultiValueAttribute $attr, $values) {
    foreach (is_array($values) ? $values : [$values] as $value) {
      $this->assertTrue($attr->contains($value));
    }
  }

  /**
   * 
   * @return scalar[]
   */
  public function clearingData(): array {
    return [
        ["c1", "l1", 1],
        ["c1 c2 c2", "li l2", 2],
        [["c1", "c2", "c3", "c3"], ["l1", "l2", "l3", "l3"], 3]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider clearingData
   *
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testClearing($add, $lock, $count) {
    $this->attrs->add($add);
    $this->assertTrue($this->attrs->isProtected() === false);
    $this->attrs->protect($lock);
    $this->assertTrue(!$this->attrs->isProtected($add));
    $this->assertTrue($this->attrs->isProtected($lock));
    $this->attrs->clear();
    $this->assertTrue($this->attrs->count() === $count);
  }

  /**
   * 
   * @return scalar[]
   */
  public function removingData(): array {
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
    $this->attrs->add("foo", "bar");
    $this->assertTrue($this->attrs->contains("foo", 'bar'));
    $this->attrs->remove("bar");
    $this->assertTrue($this->attrs->contains("foo"));
    $this->assertFalse($this->attrs->contains("bar"));
    $this->attrs->protect("bar");
    //$this->expectException(ImmutableAttributeException::class);
    //$this->attrs->remove("bar");
  }

  public function lockMethodData(): array {
    return [
        [1],
        ["a"],
        ["a b c"]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AbstractAttribute::lock()
   * @dataProvider lockMethodData
   * @param  scalar $value
   */
  public function testLockMethod($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protect($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), $value);
  }

  /**
   * @covers AbstractAttribute::isDemanded()
   */
  public function testDemanding() {
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName());
  }

}
