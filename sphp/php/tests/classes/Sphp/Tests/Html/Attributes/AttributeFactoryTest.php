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
use Sphp\Html\Attributes\AttributeFactory;
use Sphp\Html\Attributes\ImmutableAttribute;
use Sphp\Html\Attributes\IdAttribute;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

class AttributeFactoryTest extends TestCase {

  public function predefinedAttributeTypes(): iterable {
    yield ['class'];
    yield ['style'];
    yield ['id'];
  }

  public function testDefaultConstructorAndSingeltonInstance(): void {
    $singelton = AttributeFactory::singelton();
    $this->assertSame($singelton, AttributeFactory::singelton());
  }

  public function testCreatePatternAttribute(): void {
    $gen = new AttributeFactory();
    $attr = $gen->createPatternAttribute('data-pattern', '/^(foo)$/', 'foo');
    $this->assertSame('foo', $attr->getValue());
  }

  /**
   * @dataProvider predefinedAttributeTypes
   * 
   * @param  string $name
   * @return void
   */
  public function testCreateNonAllowedPatternAttribute(string $name): void {
    $gen = new AttributeFactory();
    $this->expectException(AttributeException::class);
    $gen->createPatternAttribute($name, '/^(foo)$/', 'foo');
  }

  public function testCreatePatternAttributeWithInvalidValue() {
    $gen = new AttributeFactory();
    $this->expectException(InvalidAttributeValueException::class);
    $gen->createPatternAttribute('data-pattern', '/^(foo)$/', 'fo');
  }

  public function basicData(): iterable {
    yield ['class', null];
    yield ['style'];
    yield ['id', 'foo'];
  }

  /**
   * @dataProvider basicData
   * 
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function testTypeMapping(string $name, $value = null) {
    $gen = new AttributeFactory();
    $attr1 = $gen->createObject($name, $value);
    $attr2 = $gen->createObject($name, $value);
    $this->assertEquals($attr1, $attr2);
    $this->assertNotSame($attr1, $attr2);
  }

  /**
   * @return void
   */
  public function testCreateIdAttribute(): void {
    $gen = new AttributeFactory();
    $attr = $gen->createObject('id');
    $this->assertInstanceof(IdAttribute::class, $attr);
    $attr1 = $gen->createObject('id', 'foo');
    $this->assertInstanceof(IdAttribute::class, $attr);
    $this->assertEquals('id', $attr1->getName());
    $this->assertEquals('foo', $attr1->getValue());
    $id3 = $gen->createIdAttribute('foo', 'bar');
    $this->assertEquals('foo', $id3->getName());
    $this->assertEquals('bar', $id3->getValue());
  }

  /**
   * @return void
   */
  public function testAny(): void {
    $gen = new AttributeFactory();
    $attr1 = $gen->createImmutableAttribute('immutable', true);
    $attr2 = $gen->createImmutableAttribute('immutable', true);
    $this->assertInstanceOf(ImmutableAttribute::class, $attr1);
    $this->assertInstanceOf(ImmutableAttribute::class, $attr2);
    $this->assertNotSame($attr1, $attr2);
    $this->assertEquals('immutable', $attr1->getName());
    $this->assertEquals($attr1->getName(), $attr2->getName());
  }

  /**
   * @return void
   */
  public function testImmutableAttributeGeneration(): void {
    $gen = new AttributeFactory();
    $attr1 = $gen->createImmutableAttribute('immutable', true);
    $this->assertInstanceof(ImmutableAttribute::class, $attr1);
    $this->expectException(AttributeException::class);
    $attr2 = $gen->createImmutableAttribute('class', 'foo');
    $this->assertInstanceof(\Sphp\Html\Attributes\ClassAttribute::class, $attr2);
  }

}
