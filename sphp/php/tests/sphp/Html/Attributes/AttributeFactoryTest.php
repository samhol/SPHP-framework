<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Test\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\AttributeFactory;
use Sphp\Html\Attributes\ImmutableAttribute;
use Sphp\Html\Attributes\IdAttribute;

class AttributeFactoryTest extends TestCase {

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
   * @return array
   */
  public function basicData(): array {
    return [
        ['class', null],
        ['style'],
        ['id', 'foo'],
    ];
  }

  /**
   * @dataProvider basicData
   * 
   * @param string $name
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
    $attr2 = $gen->createImmutableAttribute('class', 'foo');
    $this->assertInstanceof(\Sphp\Html\Attributes\ClassAttribute::class, $attr2);
  }

}
