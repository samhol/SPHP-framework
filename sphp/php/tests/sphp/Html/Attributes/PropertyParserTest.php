<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\PropertyParser;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

class PropertyParserTest extends TestCase {

  /**
   * @return scalar[]
   */
  public function constructorParameters(): array {
    return [
        ['=', ','],
        [':', ';'],
    ];
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  string $delim
   * @param  string $sep
   * @return void
   */
  public function testConstructorWithParams(string $delim, string $sep): void {
    $value = 'a' . $delim . 'b' . $sep . 'c' . $delim . 'd';
    $parser = new PropertyParser($delim, $sep);
    $this->assertEquals(['a' => 'b', 'c' => 'd'], $parser->parseStringToProperties($value));
  }

  /**
   * @return scalar[]
   */
  public function invalidConstructorParameters(): array {
    return [
        [' ', ' '],
        ['', ';'],
        [':', ''],
    ];
  }

  /**
   * @dataProvider invalidConstructorParameters
   * 
   * @param  string $delim
   * @param  string $sep
   * @return void
   */
  public function testConstructorWithInvalidParams(string $delim, string $sep): void {
    $this->expectException(InvalidArgumentException::class);
    new PropertyParser($delim, $sep);
  }

  /**
   * @return void
   */
  public function testConstructorRecall(): void {
    $parser = new PropertyParser();
    $this->expectException(BadMethodCallException::class);
    $parser->__construct();
  }

  /**
   * @return array
   */
  public function validStrings(): array {
    return [
        [['a' => 'b', 'c' => 'd'], 'a:b;c:d;'],
        [['a' => 'b', 'c' => 'd'], ';a:b;c:d;'],
        [['a' => 'b'], 'a:b'],
        [['a' => 'b'], 'a:b;'],
    ];
  }

  /**
   * @dataProvider validStrings
   * 
   * @param  array  $expected
   * @param  string $value
   * @return void
   */
  public function testParseStringToProperties(array $expected, string $value): void {
    $parser = new PropertyParser();
    $this->assertEquals($expected, $parser->parseStringToProperties($value));
  }

  /**
   * @return array
   */
  public function invalidStrings(): array {
    return [
        ['a;b'],
        ['a'],
        ['a:b:'],
        [':a'],
        ['a:'],
        [':;'],
        [':'],
        [';'],
    ];
  }

  /**
   * @dataProvider invalidStrings
   * 
   * @param  array  $expected
   * @param  string $value
   * @return void
   */
  public function testParseInvalidStringToProperties(string $value): void {
    $parser = new PropertyParser();
    $this->expectException(AttributeException::class);
    $parser->parseStringToProperties($value);
  }

  /**
   * @return array
   */
  public function invalidArrays(): array {
    return [
        [['arr' => []]],
        [[0 => '0']],
        [[0 => new \stdClass()]],
    ];
  }

  /**
   * @dataProvider invalidArrays
   * 
   * @param  array  $expected
   * @param  string $value
   * @return void
   */
  public function testParseInvalidArrayToProperties(array $value): void {
    $parser = new PropertyParser();
    $this->expectException(AttributeException::class);
    $parser->parse($value);
  }

  /**
   * @return scalar[]
   */
  public function validValues(): array {
    return [
        [['a' => 'b', 'c' => 'd']],
        ['a:b;c:d;'],
        [';a:b;c:d;'],
    ];
  }

  /**
   * @dataProvider validValues
   * 
   * @param  string|array $value
   * @return void
   */
  public function testValidParsing($value): void {
    $parser = new PropertyParser();
    $this->assertEquals($parser->parse($value), ['a' => 'b', 'c' => 'd']);
  }

  /**
   * @return array
   */
  public function invalidValues(): array {
    return [
        [['a' => '', '' => 'd']],
        ['a:;:d;'],
        [';ab;'],
    ];
  }

  /**
   * @dataProvider invalidValues
   * 
   * @param  scalar $value
   * @return void
   */
  public function testInvalidParsing($value): void {
    $parser = new PropertyParser();
    $this->expectException(AttributeException::class);
    $parser->parse($value);
  }

}
