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

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Html\Attributes\Exceptions\AttributeException;

abstract class AbstractScalarAttributeTest extends TestCase {

  /**
   * @return MutableAttribute
   */
  abstract public function createAttr(string $name = 'attr'): MutableAttribute;

  public function testConstructorWithOnlyAttributeName() {
    $attribute = $this->createAttr('attr');
    $this->assertFalse($attribute->isProtected());
    //var_dump($attribute->getValue());
    $this->hasNoValues($attribute);
    $this->assertTrue($attribute->getValue() === false || $attribute->getValue() === null);
    $this->assertFalse($attribute->isVisible());
    $this->expectException(BadMethodCallException::class);
    $attribute->__construct('foo');
  }

  public function testLogicAndConstaints(): void {
    $attribute = $this->createAttr('attr');
    $this->assertFalse($attribute->isProtected());
    if ($attribute->isVisible()) {
      if ($attribute->isEmpty()) {
        $this->assertSame($attribute->getName(), (string) $attribute);
      }
    } else {
      $this->assertSame('', (string) $attribute);
    }
  }

  /**
   * @return string[]
   */
  public function invalidAttributeNames(): array {
    return [
        [' '],
        [' a'],
        ['ä'],
        ['-'],
        ['1']
    ];
  }

  /**
   * @dataProvider invalidAttributeNames
   * @param string $name
   */
  public function testConstructorWithInvalidAttributeName(string $name): void {
    $this->expectException(AttributeException::class);
    $this->createAttr($name);
  }

  /**
   * @param MutableAttribute $attribute
   */
  public function hasNoValues(MutableAttribute $attribute): void {
    $this->assertTrue($attribute->isEmpty());
    $this->assertFalse($attribute->isProtected());
    $valueType = gettype($attribute->getValue());
    $errorMessage = sprintf('Empty attribute object %s has type(%s) as its value', get_class($attribute), $valueType);
    $this->assertTrue($attribute->getValue() === false || $attribute->getValue() === null, $errorMessage);
    if ($attribute instanceof \Countable) {
      $this->assertCount(0, $attribute);
    }
  }

  /**
   * @return array
   */
  abstract public function basicValidValues(): array;

  /**
   * @dataProvider basicValidValues
   * 
   * @param  mixed $inputValue
   * @param  mixed $outputValue
   * @return void
   */
  public function testBasicValidValue($inputValue, $outputValue): void {
    $attribute = $this->createAttr();
    $attribute->setValue($inputValue);
    $this->assertFalse($attribute->isProtected());
    $this->assertSame($outputValue, $attribute->getValue());
  }

  /**
   * @return array
   */
  abstract public function basicInvalidValues(): array;

  /**
   * @dataProvider basicInvalidValues
   * 
   * @param  mixed $inputValue
   * @return void
   */
  public function testBasicInvalidValue($inputValue): void {
    $attribute = $this->createAttr();
    $this->expectException(AttributeException::class);
    $attribute->setValue($inputValue);
  }

}
