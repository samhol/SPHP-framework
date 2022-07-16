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

  use AttributeOutputChecker;

  public function testEmptyConstructor(): void {
    $empty = new ClassAttribute();
    $this->assertSame('class', $empty->getName());
    $this->assertSame(null, $empty->getValue());
    $this->assertFalse($empty->isVisible());
    $this->assertFalse($empty->isAlwaysVisible());
    $this->assertTrue($empty->isEmpty());
    $this->assertCount(0, $empty);
    $this->assertSame('', "$empty");
    $this->assertSame([], $empty->toArray());
  }

  public function testConstructorWithClassNames(): void {
    $atomicValues = range('a', 'c');
    $attrValue = implode(' ', $atomicValues);
    $attr1 = new ClassAttribute($attrName = 'data-class', $attrValue);
    $attr2 = new ClassAttribute($attrName);
    $attr2->setValue($attrValue);
    $this->assertEquals($attr1, $attr2);
    $this->assertSame($attrName, $attr1->getName());
    $this->assertSame($attrValue, $attr1->getValue());
    $this->assertTrue($attr1->isVisible());
    $this->assertFalse($attr1->isAlwaysVisible());
    $this->assertFalse($attr1->isEmpty());
    $this->assertCount(3, $attr1);
    $this->assertEqualsCanonicalizing($atomicValues, $attr1->toArray());
    $this->assertEqualsCanonicalizing($atomicValues, iterator_to_array($attr1));
    $this->assertSame("$attrName=\"$attrValue\"", "$attr1");
  }

  public function validSetValueData(): iterable {
    yield ['-a -b -c_', '-a -b -c_'];
    yield ['', null];
  }

  /**
   * @dataProvider validSetValueData
   *  
   * @param  string|null $data
   * @param  string|null $expected
   * @return void
   */
  public function testConstructorAndOutput(?string $data, ?string $expected): void {
    $attr = new ClassAttribute('class', $data);
    $this->assertSame('class', $attr->getName());
    $this->assertSame($expected, $attr->getValue());

    $this->validateAttributeOutput($attr);
  }

  /**
   * @dataProvider validSetValueData
   *  
   * @param  string|null $data
   * @param  string|null $expected
   * @return void
   */
  public function testSetValueAndOutput(?string $data, ?string $expected): void {
    $attr = new ClassAttribute('class', 'nope');
    $this->assertSame($attr, $attr->setValue($data));
    $this->assertSame($expected, $attr->getValue());

    $this->validateAttributeOutput($attr);
  }

  public function validSets(): iterable {
    yield [["\na  b c"], 'b c a'];
  }

  public function testManipulatingValidValues() {
    $attr = new ClassAttribute('class', 'x');
    $this->assertSame($attr, $attr->add('a'));
    $this->assertEqualsCanonicalizing(['a', 'x'], $attr->toArray());
  }
  protected function validates(): void {
    
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
  public function t1estIdenticalSets(array $setA, string $setB): void {
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
  public function t1estSelfContaining(array $values) {
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
  public function t1estContains(): void {
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
  public function t1estAddMethod(array $value): void {
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
  public function t1estClearMethod(): void {
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
    $attribute = new ClassAttribute();
    $attribute->add('a', 'b');
    $this->assertTrue($attribute->contains('a', 'b'));
    $attribute->remove('a c');
    $this->assertTrue($attribute->contains('b'));
    $this->assertFalse($attribute->contains('a'));
    $attribute->protectValue('b');
    $attribute->add('a' );
    $this->expectException(ImmutableAttributeException::class);
    $attribute->remove('a b');
  }

  /**
   * @return void
   */
  public function testProtectValue(): void {
    $attribute = new ClassAttribute();
    $this->assertFalse($attribute->isProtected());
    $this->assertSame($attribute, $attribute->protectValue('a b'));
    $attribute->clear();
    $this->assertCount(2, $attribute);
    $this->assertTrue($attribute->isProtected());
    $this->assertTrue($attribute->isProtected('a'));
    $this->assertTrue($attribute->isProtected('a b')); 
    $this->assertFalse($attribute->isProtected('a b c'));
    $this->assertFalse($attribute->isProtected('c'));
    $this->assertFalse($attribute->isProtected(''));
  }

  public function testVisibility() {
    $attribute = new ClassAttribute();
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
  public function t1estContainsPattern(): void {
    $attr = new ClassAttribute();
    $attr->setValue('a b c d');
    $attr->protectValue('e');
    $this->assertTrue($attr->contaisPattern("/^(a|b|c|d|e)$/"));
    $this->assertFalse($attr->contaisPattern("/(ab)/"));
  }

  /**
   * @return void
   */
  public function t1estRemovePattern(): void {
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
  public function t1estFilter(): void {
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
