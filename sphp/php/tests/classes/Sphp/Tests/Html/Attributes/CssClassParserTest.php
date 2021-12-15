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
use Sphp\Html\Attributes\CssClassParser;
use Sphp\Html\Attributes\Exceptions\AttributeException;

class CssClassParserTest extends TestCase {

  public function basicInvalidValues(): iterable {
    yield [new \stdClass];
    yield [1];
    yield [null];
  }

  /**
   * @dataProvider basicInvalidValues
   * 
   * @param  mixed $value
   * @return void
   */
  public function testInvalidValues($value): void {
    $parser = new CssClassParser();
    $this->expectException(AttributeException::class);
    $parser->parse($value);
  }

  public function classNameValidationData(): iterable {
    yield ['a', true];
    yield ["\0", false];
    yield [' a', false];
    yield ['a ', false];
  }

  /**
   * @dataProvider classNameValidationData
   * 
   * @param  string $className
   * @param  bool $isValid
   * @return void
   */
  public function testClassNameValidation(string $className, bool $isValid): void {
    $parser = new CssClassParser();
    $this->assertSame($isValid, $parser->isValidClassName($className));
  }

  public function classNameCollectionValidationData(): iterable {
    yield [['a'], true];
    yield [['a', 'b', 'a'], true];
    yield [["\0"], false];
    yield [['a', ['b']], false];
    yield [['a', ['b']], false];
  }

  /**
   * @dataProvider classNameCollectionValidationData
   * 
   * @param  string $collection
   * @param  bool $isValid
   * @return void
   */
  public function testClassNameCollectionValidation(array $collection, bool $isValid): void {
    $parser = new CssClassParser();
    $this->assertSame($isValid, $parser->isValidClassNameCollection($collection));
  }

  public function mixedSets(): iterable {
    return [
        [['a', 'b', 'c'], 'b c a'],
        [['a', 'b', 'c'], 'b c a c'],
        [['a', 'b', 'c'], ['a b', 'c']],
        [['a', 'b', 'c'], ['a b', 'c c']],
        [['a', 'b', 'c'], [['a b'], 'c']],
        [['a', 'b', 'c'], new \ArrayIterator(['a', 'b', 'c'])],
        [['a', 'b', 'c'], new \Sphp\Stdlib\MbString('a b c')],
    ];
  }

  /**
   * @dataProvider mixedSets
   * @param array $expected
   * @param string|array $mixedSet
   * @return void
   */
  public function testMixedSets(array $expected, $mixedSet): void {
    $parser = new CssClassParser();
    $tested = $parser->parse($mixedSet);
    sort($tested);
    $this->assertEquals($expected, $tested);
    $this->assertContainsOnly('string', $tested);
  }

  public function emptyValues(): iterable {
    return [
        [''],
        [' '],
        [" \n\t\r"],
        ["\t"],
        [['', "\n", "\t", ' ']],
    ];
  }

  /**
   * @dataProvider emptyValues
   * 
   * @param  mixed $emptyData
   * @return void
   */
  public function testEmptySets($emptyData): void {
    $parser = new CssClassParser();
    $this->assertEmpty($parser->parse($emptyData));
  }

  /**
   * @covers \Sphp\Html\Attributes\CssClassParser::singelton
   * @return void
   */
  public function testSingelton(): void {
    $parser1 = CssClassParser::singelton();
    $parser2 = CssClassParser::singelton();
    $this->assertSame($parser2, $parser1);
  }

}
