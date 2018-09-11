<?php

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class MultiValueAttributeTests extends TestCase {

  /**
   * @var MultiValueAttribute 
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
   * 
   * @param string $name
   * @return Attribute
   */
  public function createAttr(string $name = 'class'): Attribute {
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
    $this->expectException(InvalidAttributeException::class);
    $this->attr->set($value);
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
    $this->attr->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($this->attr->isProtected());
    $this->assertFalse($this->attr->isProtected($value));
    $this->assertFalse($this->attr->isDemanded());
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
   * @covers \Sphp\Html\Attributes\MultiValueAttribute::lock()
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
        [range('a', 'e'), [range('d', 'f')]]
    ];
  }

  /**
   * @covers \Sphp\Html\Attributes\MultiValueAttribute::add()
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
   * @covers \Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider clearingData
   *
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testClearing($add, $lock, $count) {
    $this->attr->add($add);
    $this->assertTrue($this->attr->isProtected() === false);
    $this->attr->protect($lock);
    $this->assertTrue(!$this->attr->isProtected($add));
    $this->assertTrue($this->attr->isProtected($lock));
    $this->attr->clear();
    $this->assertTrue($this->attr->count() === $count);
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
   * @covers \Sphp\Html\Attributes\MultiValueAttribute::add()
   *
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testRemoving() {
    $this->attr->add("foo", "bar");
    //echo "\n$this->attr\n";
    $this->assertTrue($this->attr->contains("foo", 'bar'));
    $this->attr->remove("bar");
    //echo "\n$this->attr\n";
    $this->assertTrue($this->attr->contains("foo"));
    $this->assertFalse($this->attr->contains("bar"));
    $this->attr->protect("bar");
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
   * @covers \Sphp\Html\Attributes\AbstractAttribute::lock()
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
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
