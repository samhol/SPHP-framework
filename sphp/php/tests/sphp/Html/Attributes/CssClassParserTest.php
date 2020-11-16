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
use Sphp\Html\Attributes\CssClassParser;

class CssClassParserTest extends TestCase {

  public function basicInvalidValues(): array {
    return [
        [new \stdClass],
        ["\n"],
    ];
  }

  /**
   * @return string[]
   */
  public function classNameValidationData(): array {
    return [
        ['a', true],
        ["\0", false],
    ];
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

  /**
   * @return array
   */
  public function classNameCollectionValidationData(): array {
    return [
        [['a'], true],
        [["\0"], false],
        [['a', ['b']], false],
        [['a', ['b']], false],
    ];
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
    $this->assertSame($isValid, $parser->isValidCollection($collection));
  }

  /**
   * @return string[]
   */
  public function mixedSets(): array {
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

  /**
   * @return string[]
   */
  public function emptyValues(): array {
    return [
        [''],
        [' '],
        [" \n\t\r"],
        ["\t"],
        [['', '']],
    ];
  }

  /**
   * @dataProvider emptyValues
   * @param array $emptyData
   * @return void
   */
  public function testEmptySets($emptyData): void {
    $parser = new CssClassParser();
    $this->assertEmpty($parser->parse($emptyData));
  }

  /**
   * @return void
   */
  public function testStaticFactory(): void {
    $parser1 = CssClassParser::instance();
    $parser2 = CssClassParser::instance();
    $this->assertSame($parser2, $parser1);
  }

}
