<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class ClassAttributeTest extends TestCase {

  public function testEmptyConstructor(): void {
    $attr = new ClassAttribute();
    $this->assertSame('class', $attr->getName());
    $this->assertSame(null, $attr->getValue());
    $this->assertFalse($attr->isVisible());
    $this->assertFalse($attr->isAlwaysVisible());
    $this->assertTrue($attr->isEmpty());
    $this->assertCount(0, $attr);
  }

  public function identicalSets(): iterable {
    yield [['a', 'b', 'c'], 'b c a'];
    yield [['a', 'b', 'c'], 'a b c '];
  }

  /**
   * @dataProvider identicalSets
   * @param array $setA
   * @param string|array $setB
   */
  public function testIdenticalSets(array $setA, string $setB): void {
    $a = new ClassAttribute();
    $a->add(...$setA);
    $b = new ClassAttribute();
    $b->setValue($setB);
    $this->assertTrue($a->contains(...$setA));
    $this->assertTrue($b->contains(...$setA));
    $this->assertTrue($a->contains($setB));
    $this->assertTrue($b->contains($setB));
    foreach ($setA as $item) {
      $this->assertTrue($a->contains($item));
      $this->assertTrue($b->contains($item));
    }
  }

  public function addingData(): iterable {
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
   * @dataProvider addingData
   * 
   * @param  array $value numeric value
   * @param  int $num
   * @return void
   */
  public function testAddMethod(array $value): void {
    $attribute = new ClassAttribute('class');
    $attribute->add(...$value);
    $this->assertTrue($attribute->contains(...$value));
    $this->assertCount(count($value), $attribute);
    $attribute->clear();
    $this->assertCount(0, $attribute);
  }

  /**
   * @return void
   */
  public function testClearMethod(): void {
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
   * @return void
   */
  public function testRemove(): void {
    $attribute = new ClassAttribute('class');
    $attribute->add("foo", "bar");
    $this->assertTrue($attribute->contains("foo", 'bar'));
    $attribute->remove("bar");
    $this->assertTrue($attribute->contains("foo"));
    $this->assertFalse($attribute->contains("bar"));
    $attribute->protectValue("bar");
    $this->expectException(ImmutableAttributeException::class);
    $attribute->remove("bar");
  }

  /**
   * @return void
   */
  public function testProtectValue(): void {
    $attribute = new ClassAttribute('class');
    $this->assertFalse($attribute->isProtected());
    $this->assertSame($attribute, $attribute->protectValue('a b', 'c', 'd e', 'f'));
    $attribute->clear();
    $this->assertCount(6, $attribute);
    $this->assertTrue($attribute->isProtected());
    $this->assertTrue($attribute->isProtected('a'));
    $this->assertTrue($attribute->isProtected('b'));
    $this->assertTrue($attribute->isProtected('c', 'a'));
    $this->assertTrue($attribute->isProtected('a', 'c'));
    $this->assertTrue($attribute->isProtected('a b c e '));
    $this->assertFalse($attribute->isProtected('a b c e foo'));
    $this->assertFalse($attribute->isProtected('foo'));
    $this->assertFalse($attribute->isProtected(''));
  }

  public function testVisibility() {
    $attribute = new ClassAttribute('class');
    $attribute->forceVisibility();
    $this->assertTrue($attribute->isAlwaysVisible());
    $this->assertEquals($attribute->getName() . '=""', "$attribute");
    $attribute->setValue('a');
    $this->assertEquals("$attribute", 'class="a"');
    $attribute->clear();
    $this->assertTrue($attribute->isAlwaysVisible());
    $this->assertEquals($attribute->getName() . '=""', "$attribute");
  }

  /**
   * @return void
   */
  public function testContainsPattern(): void {
    $attr = new ClassAttribute();
    $attr->setValue('a b c d');
    $attr->protectValue('e');
    $this->assertTrue($attr->contaisPattern("/^(a|b|c|d|e)$/"));
    $this->assertFalse($attr->contaisPattern("/(ab)/"));
  }

  /**
   * @return void
   */
  public function testRemovePattern(): void {
    $attr = new ClassAttribute();
    $attr->setValue('a b c d');
    $attr->protectValue('b e abce');
    $attr->removePattern("/^(a|b|c|e)$/");
    $this->assertFalse($attr->contains('a c d'));
    $this->assertTrue($attr->contains('b e abce'));
  }

  /**
   * @return void
   */
  public function testFilter(): void {
    $filterB = fn(string $class) => in_array($class, ['a', 'c', 'd']);
    $removeRest = fn(string $class) => $class === 'b';
    $attr = new ClassAttribute();
    $attr->setValue('a b c d');
    $this->assertSame($attr, $attr->filter($filterB));
    $this->assertSame('a c d', $attr->getValue());
    $attr->protectValue('b');
    $this->assertSame($attr, $attr->filter($removeRest));
    $this->assertFalse($attr->contains('a c d'));
  }

}
