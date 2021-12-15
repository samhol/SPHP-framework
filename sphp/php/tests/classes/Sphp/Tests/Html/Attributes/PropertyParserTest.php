<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
  public function cssToArrayMap(): iterable {
    yield ['a:url(ftp://a.b);c:#777;', ['a' => 'url(ftp://a.b)', 'c' => '#777']];
    yield ['c:#777;a:url(ftp://a.b);', ['c' => '#777', 'a' => 'url(ftp://a.b)']];
    yield ['c:#777;a: url(ftp://a.b);', ['c' => '#777', 'a' => 'url(ftp://a.b)']];
  }

  /**
   * @dataProvider cssToArrayMap
   * 
   * @param  string $css
   * @param  array $props
   * @return void
   */
  public function testInlineCSSToCases(string $css, array $props): void {
    $parser = new PropertyParser(':', ';');
    $this->assertSame($props, $parser->parse($css));
    $this->assertSame($props, $parser->parseStringToProperties($css));
  }

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

  public function invalidStrings(): iterable {
    yield ['a;b'];
    yield ['a'];
    yield [':a'];
    yield ['a:'];
    yield ['a:;;b'];
    yield [':;'];
    yield [':'];
    yield [';'];
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
    $out = $parser->parseStringToProperties($value);
    print_r($out);
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

  public function validValues(): iterable {
    yield [['a' => 'b', 'c' => 'd']];
    yield ['a:b;c:d;'];
    yield ['a:b;c:d;'];
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

  public function invalidValues(): iterable {
    yield [['a' => '', '' => 'd']];
    yield ['a:;:d;'];
    yield [';ab;'];
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
  public function alwaysInvalidValues(): iterable {
    yield [new \stdClass()];
    yield [true];
    yield [false];
    yield [1];
    yield [1.2];
  }

  /**
   * @dataProvider alwaysInvalidValues
   * 
   * @param  scalar $value
   * @return void
   */
  public function testAlwaysInvalidParsing($value): void {
    $parser = new PropertyParser();
    $this->expectException(AttributeException::class);
    $parser->parse($value);
  }
  public function testSingeltons() {
    $p1 = PropertyParser::singelton();
    $this->assertSame($p1, PropertyParser::singelton());
    $p2 = PropertyParser::singelton('a', 'b');
    $this->assertSame($p2, PropertyParser::singelton('a', 'b'));
  }
}
