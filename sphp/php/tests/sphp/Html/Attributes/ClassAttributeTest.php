<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class ClassAttributeTest extends AbstractScalarAttributeTest {

  public function createAttr(string $name = 'attr'): MutableAttribute {
    return new ClassAttribute($name);
  }

  public function basicInvalidValues(): array {
    return [
        //  [new \stdClass],
        [new \stdClass],
    ];
  }

  public function basicValidValues(): array {
    return [
        ['a', 'a'],
        ['a a', 'a'],
        ['a b c a b c', 'a b c'],
    ];
  }

  /**
   * @return string[]
   */
  public function identicalSets(): array {
    return [
        [['a', 'b', 'c'], 'b c a'],
        [['a', 'b', 'c'], 'a b c '],
    ];
  }

  /**
   * @dataProvider identicalSets
   * @param array $setA
   * @param string|array $setB
   */
  public function testIdenticalSets(array $setA, string $setB): void {
    $attr = new ClassAttribute('a');
    $attr->setValue(...$setA);
    $b = new ClassAttribute('b');
    $b->setValue($setB);
    $this->assertTrue($attr->contains(...$setA));
    $this->assertTrue($b->contains(...$setA));
    $this->assertTrue($attr->contains($setB));
    $this->assertTrue($b->contains($setB));
    foreach ($setA as $item) {
      $this->assertTrue($attr->contains($item));
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

  public function testProtectMethod(): void {
    $attr = new ClassAttribute('class');
    $this->assertFalse($attr->isProtected());
    $attr->setValue('a b c');
    $attr->protectValue('a b', 'e');
    $this->assertTrue($attr->isProtected('a', 'b e'));
    $this->assertTrue($attr->isProtected());
    $attr->clear($attr->isProtected('a', 'b e'));
    $this->assertTrue($attr->isProtected());
    $this->assertFalse($attr->contains('c'));
    $this->expectException(ImmutableAttributeException::class);
    $attr->remove('a b c');
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
    $attribute = new ClassAttribute('class');
    $attribute->add(...$values);
    $this->assertTrue($attribute->contains(...$values));
    $this->assertEquals($values, $attribute->toArray());
    $this->assertTrue($attribute->contains(...$attribute->toArray()));
    $itArray = iterator_to_array($attribute);
    $this->assertEquals($values, $itArray);
  }

  /**
   * 
   * @return void
   */
  public function testContains(): void {
    $attribute = new ClassAttribute();
    $this->assertFalse($attribute->contains('a b'));
    $attribute->add('a b');
    $this->assertFalse($attribute->contains('a b c'));
    $this->assertTrue($attribute->contains('a b'));
  }

  /**
   * 
   * @param array $value numeric value
   * @param int $num
   * @dataProvider addingData
   */
  public function testAddMethod(array $value) {
    $attribute = new ClassAttribute('class');
    $attribute->add(...$value);
    $this->assertTrue($attribute->contains(...$value));
    $this->assertCount(count($value), $attribute);
    $attribute->clear();
    $this->assertCount(0, $attribute);
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
    $attribute = new ClassAttribute('class');
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
    $attribute = new ClassAttribute('class');
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
    $attribute = new ClassAttribute('class');
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
    $attribute = new ClassAttribute('class');
    $attribute->forceVisibility();
    $this->assertTrue($attribute->isDemanded());
    $this->assertEquals($attribute->getName() . '=""', "$attribute");
    $attribute->setValue('a');
    $this->assertEquals("$attribute", 'class="a"');
    $attribute->clear();
    $this->assertTrue($attribute->isDemanded());
    $this->assertEquals($attribute->getName() . '=""', "$attribute");
  }

  /**
   * 
   * @return void
   */
  public function testRemovePattern(): void {
    $attr = new ClassAttribute();
    $attr->setValue(range('a', 'd'));
    $attr->protectValue('b e abce');
    $attr->removePattern("/^(a|b|c|e)$/");
    $this->assertFalse($attr->contains('a c d'));
    $this->assertTrue($attr->contains('b e abce'));
  }

}
