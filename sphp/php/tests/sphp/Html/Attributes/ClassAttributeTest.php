<?php

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\ClassAttribute;

class ClassAttributeTest extends AbstractAttributeObjectTest {

  public function createAttr(string $name = 'attr'): Attribute {
    return new ClassAttribute($name);
  }

  public function basicInvalidValues(): array {
    return [
        [new \stdClass],
    ];
  }

  public function basicValidValues(): array {
    return [
        ['a', 'a'],
        ['a b c', 'a b c'],
        [['a', 'b', 'c'], 'a b c']
    ];
  }

  /**
   * @return string[]
   */
  public function identicalSets(): array {
    return [
        [['a', 'b', 'c'], 'b c a'],
        [['a', 'b', 'c'], ['a b', 'c']],
        [['a', 'b', 'c'], [['a b'], 'c']],
    ];
  }

  /**
   * @dataProvider identicalSets
   * @param array $setA
   * @param string|array $setB
   */
  public function testIdenticalSets(array $setA, $setB) {
    $a = new ClassAttribute('a');
    $a->setValue($setA);
    $b = new ClassAttribute('b');
    $b->setValue($setB);
    $this->assertTrue($a->contains($setA));
    $this->assertTrue($b->contains($setA));
    $this->assertTrue($a->contains($setB));
    $this->assertTrue($b->contains($setB));
    foreach ($setA as $item) {
      $this->assertTrue($a->contains($item));
      $this->assertTrue($b->contains($item));
    }
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
   * @return string[]
   */
  public function scalarData(): array {
    return [
        ['', false, false],
        [' ', false, false],
        ['foo', 'foo', true],
        ['bar', 'bar', true],
        ['value1', 'value1', true],
        [' value2 ', 'value2', true],
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
   * @return string[]
   */
  public function lockingData(): array {
    return [
        ['c1'],
        [["c1", 'c2']],
        [['c1', 'c2', 'c3']]
    ];
  }

  /**
   * @dataProvider lockingData
   */
  public function testProtectMethod($value) {
    $attribute = new ClassAttribute();
    $attribute->protectValue($value);
    $this->assertTrue($attribute->isProtected($value));
    $this->assertTrue($attribute->isProtected());
    $this->assertTrue($attribute->contains($value));
  }

  /**
   * @return string[]
   */
  public function addingData(): array {
    return [
        [["c1", 'a_1']],
        [range('a', 'e')],
        [range('a', 'e')]
    ];
  }
  /**
   * 
   * @dataProvider addingData
   */
  public function testSelfContaining(array $values) {
    $attribute = new ClassAttribute();
    $attribute->add($values);
    $this->assertTrue($attribute->contains($values));
    $this->assertEquals($values, $attribute->toArray());
    $this->assertTrue($attribute->contains($attribute->toArray()));
    $itArray = iterator_to_array($attribute);
    $this->assertEquals($values, $itArray);
  }

  /**
   * 
   * @param string $value numeric value
   * @param int $num
   * @dataProvider addingData
   */
  public function testAddMethod($value) {
    $attribute = new ClassAttribute();
    $attribute->add($value);
    $this->assertTrue($attribute->contains($value));
    $this->assertCount(count($value), $attribute);
    $attribute->clear();
    $this->assertCount(0, $attribute);
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
   */
  public function testClearMethod() {
    $attribute = new ClassAttribute();
    $attribute->add('a', 'b');
    $this->assertTrue($attribute->contains('a', 'b'));
    $attribute->clear();
    $this->assertFalse($attribute->contains('a', 'b'));
    $this->assertFalse($attribute->contains('a'));
    $this->assertFalse($attribute->contains('b'));
    $attribute->protectValue('a');
    $attribute->clear();
    $this->assertTrue($attribute->contains('a'));
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
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testRemoving() {
    $attribute = new ClassAttribute();
    $attribute->add("foo", "bar");
    $this->assertTrue($attribute->contains("foo", 'bar'));
    $attribute->remove("bar");
    $this->assertTrue($attribute->contains("foo"));
    $this->assertFalse($attribute->contains("bar"));
    $attribute->protectValue("bar");
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
   * @param  scalar $value
   */
  public function testValueProtecting() {
    $attribute = new ClassAttribute();
    $this->assertFalse($attribute->isProtected());
    $attribute->protectValue('a b');
    $attribute->protectValue('c', ['d']);
    $attribute->protectValue([['e', ['f']]]);
    $attribute->clear();
    $this->assertCount(6, $attribute);
    $this->assertTrue($attribute->isProtected());
    $this->assertTrue($attribute->isProtected('a'));
    $this->assertTrue($attribute->isProtected('b'));
    $this->assertTrue($attribute->isProtected('c', 'a'));
    $this->assertTrue($attribute->isProtected(['a', 'c']));
    $this->assertTrue($attribute->isProtected('a b c e '));
    $this->assertFalse($attribute->isProtected('a b c e foo'));
    $this->assertFalse($attribute->isProtected('foo'));
    $this->assertFalse($attribute->isProtected(''));
  }

  /**
   */
  public function testDemanding() {
    $attribute = new ClassAttribute();
    $attribute->forceVisibility();
    $this->assertTrue($attribute->isDemanded());
    $this->assertEquals("$attribute", $attribute->getName());
    $attribute->setValue('a');
    $this->assertEquals("$attribute", 'class="a"');
    $attribute->clear();
    $this->assertTrue($attribute->isDemanded());
    $this->assertEquals("$attribute", $attribute->getName());
  }

}
