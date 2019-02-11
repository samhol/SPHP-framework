<?php

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\MultiValueParser;

class MultiValueAttributeTest extends AbstractAttributeObjectTest {

  /**
   * @var MultiValueAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->attr = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    $this->attr = null;
  }

  /**
   * @param  string $name
   * @param  MultiValueParser $opts
   * @return Attribute
   */
  public function createAttr(string $name = 'class', MultiValueParser $opts = null): Attribute {
    return new MultiValueAttribute($name, $opts);
  }

  public function basicInvalidValues(): array {
    return [
        [new \stdClass()],
        [['', 1, new \stdClass()]],
    ];
  }

  public function basicValidValues(): array {
    return [
        [1, '1'],
        ['a', 'a'],
        ['a b c', 'a b c']
    ];
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        [null],
        [false],
    ];
  }

  /**
   * 
   * @covers \Sphp\Html\Attributes\MultiValueAttribute::setValue()
   * @dataProvider emptyData
   * @param mixed $value
   * @param array $props
   */
  public function testEmptySetting($value,  $props = ' ') {
    //$this->expectException(\Sphp\Exceptions\InvalidArgumentException::class);
    $attribute = $this->createAttr('data-multi-value', (new MultiValueParser())->setDelimeter($props));
    $attribute->setValue($value);
    //var_dump($attribute->getValue());
    $this->assertNull($attribute->getValue());
    $this->assertFalse($attribute->isProtected());
    $this->assertSame('', "$attribute");
  }

  /**
   * 
   * @return string[]
   */
  public function _scalarData(): array {
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
  public function _settingData(): array {
    return [
        range('a', 'd'),
        ['_-'],
        range('a', 'd')
    ];
  }

  /**
   * @dataProvider settingData
   */
  public function _testSetting($value) {
    $this->attr->setValue($value);
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
  public function _lockingData(): array {
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
  public function _testLocking($value) {
    $this->attr->protectValue($value);
    $this->assertTrue($this->attr->isProtected($value));
    $this->assertTrue($this->attr->isProtected());
    $this->assertTrue($this->attr->contains($value));
  }

  /**
   * 
   * @return string[]
   */
  public function _addingData(): array {
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
  public function _testAdding($value) {
    $this->attr->add($value);
    $this->assertTrue($this->attr->contains($value));
    $this->assertCount(count($value), $this->attr);
    $this->attr->clear();
    $this->assertCount(0, $this->attr);
  }

  protected function _attrContains(MultiValueAttribute $attr, $values) {
    foreach (is_array($values) ? $values : [$values] as $value) {
      $this->assertTrue($attr->contains($value));
    }
  }

  /**
   * 
   * @return scalar[]
   */
  public function _clearingData(): array {
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
  public function _testClearing($add, $lock, $count) {
    $this->attr->add($add);
    $this->assertTrue($this->attr->isProtected() === false);
    $this->attr->protectValue($lock);
    $this->assertTrue(!$this->attr->isProtected($add));
    $this->assertTrue($this->attr->isProtected($lock));
    $this->attr->clear();
    $this->assertTrue($this->attr->count() === $count);
  }

  /**
   * 
   * @return scalar[]
   */
  public function _removingData(): array {
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
  public function _testRemoving() {
    $this->attr->add("foo", "bar");
    //echo "\n$this->attr\n";
    $this->assertTrue($this->attr->contains("foo", 'bar'));
    $this->attr->remove("bar");
    //echo "\n$this->attr\n";
    $this->assertTrue($this->attr->contains("foo"));
    $this->assertFalse($this->attr->contains("bar"));
    $this->attr->protectValue("bar");
    //$this->expectException(ImmutableAttributeException::class);
    //$this->attrs->remove("bar");
  }

  public function _lockMethodData(): array {
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
  public function _testLockMethod($value) {
    $attr = $this->createAttr();
    $this->assertFalse($attr->isProtected());
    $attr->protectValue($value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), $value);
  }

  /**
   * @covers AbstractAttribute::isDemanded()
   */
  public function _testDemanding() {

    $this->attr->forceVisibility();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
