<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\AttributeException;

include_once 'AbstractAttributeObjectTest.php';

class ClassAttributeTests extends AbstractAttributeObjectTest {

  /**
   * @var ClassAttribute 
   */
  protected $attr;

  public function createAttr(string $name = 'class'): AttributeInterface {
    return new ClassAttribute($name);
  }

  /**
   * @return string[]
   */
  public function invalidValues(): array {
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
    // $this->expectException(AttributeException::class);
    $this->attr->set($value);
    $this->assertFalse($this->attr->isProtected($value));
    $this->assertFalse($this->attr->contains($value));
    $this->assertFalse($this->attr->isProtected());
    $this->assertFalse($this->attr->isDemanded());
    $this->assertEquals($this->attr->getValue(), false);
    $this->assertEquals($this->attr->count(), 0);
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
        ['a b c']
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider settingData
   */
  public function testSetting($value) {
    $this->attr->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($this->attr->isProtected());
    $this->assertFalse($this->attr->isProtected($value));
    $this->assertFalse($this->attr->isDemanded());
    $this->assertFalse($this->attr->isEmpty());
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
    $this->attr->protect($value);
    $this->assertTrue($this->attr->isProtected($value));
    $this->assertTrue($this->attr->isProtected());
    $this->assertTrue($this->attr->contains($value));
  }

  /**
   * 
   * @return string[]
   */
  public function addingData(): array {
    return [
        ["c1", 'a_1'],
        range('a', 'e'),
        [range('a', 'e')]
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
    $this->attr->add($value);
    $this->assertTrue($this->attr->contains($value));
    $this->assertCount(count($value), $this->attr);
    $this->attr->clear();
    $this->assertCount(0, $this->attr);
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
   */
  public function testClearing() {
    $this->attr->add('a', 'b');
    $this->assertTrue($this->attr->contains('a'));
    $this->attr->clear();
    $this->assertFalse($this->attr->contains('a', 'b'));
    $this->attr->protect('a');
    $this->attr->clear();
    $this->assertTrue($this->attr->contains('a'));
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
    $this->attr->add("foo", "bar");
    $this->assertTrue($this->attr->contains("foo", 'bar'));
    $this->attr->remove("bar");
    $this->assertTrue($this->attr->contains("foo"));
    $this->assertFalse($this->attr->contains("bar"));
    $this->attr->protect("bar");
    //$this->expectException(ImmutableAttributeException::class);
    //$this->attrs->remove("bar");
  }

  public function protectedData(): array {
    return [
        ["a"],
        ["a b c"],
        [['a', 'b', 'c']]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AbstractAttribute::lock()
   * @param  scalar $value
   */
  public function testValueProtecting() {
    $this->assertFalse($this->attr->isProtected());
    $this->attr->protect('a b');
    $this->attr->protect('c', ['d']);
    $this->attr->protect([['e', ['f']]]);
    $this->attr->clear();
    $this->assertCount(6, $this->attr);
    $this->assertTrue($this->attr->isProtected());
    $this->assertTrue($this->attr->isProtected('a'));
    $this->assertTrue($this->attr->isProtected('b'));
    $this->assertTrue($this->attr->isProtected('c', 'a'));
    $this->assertTrue($this->attr->isProtected(['a', 'c']));
    $this->assertTrue($this->attr->isProtected('a b c e '));
    $this->assertFalse($this->attr->isProtected('a b c e foo'));
    $this->assertFalse($this->attr->isProtected('foo'));
    $this->assertFalse($this->attr->isProtected(''));
  }

  /**
   * @covers AbstractAttribute::isDemanded()
   */
  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
    $this->attr->set('a');
    $this->assertEquals("$this->attr", 'class="a"');    
    $this->attr->clear();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
