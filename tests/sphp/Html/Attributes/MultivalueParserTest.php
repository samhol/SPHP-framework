<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\MultiValueParser;
use Sphp\Exceptions\InvalidArgumentException;

class MultivalueParserTest extends TestCase {

  /**
   * @param string|array $value
   */
  public function testValidParsing() {
    $parser = new MultiValueParser();
    $this->assertEquals($parser->filter(" a  b \t  c\n "), ['a', 'b', 'c']);
    $this->assertEquals([], $parser->filter(null));
    $this->assertEquals([], $parser->filter(false));
    $this->assertEquals([1], $parser->filter(true));
    $parser->setRange(1, 2);
    $this->assertEquals($parser->filter(" a  b \t "), ['a', 'b']);
    $this->expectException(InvalidArgumentException::class);
    $parser->filter(" a  b \t  c\n ");
  }

  public function invalidNumberOfAtomicValues(): array {
    return [
        ["a b c d", 5, 5],
        ["a b c d", 5, 6],
        ["", 1, 2],
        [range(1, 4), 5, 6],
    ];
  }

  /**
   * @dataProvider invalidNumberOfAtomicValues
   * 
   * @param mixed $raw
   * @param int $min
   * @param int $max
   */
  public function testStringParsingWithInvalidNumberOfAtomicValues($raw, int $min, int $max) {
    $parser = new MultiValueParser();
    $parser->setRange($min, $max);
    $this->expectException(InvalidArgumentException::class);
    $parser->filter($raw);
  }

  public function arrayOfRawValues(): array {
    return [
        [range('a', 'd')],
        [range(1, 4)],
    ];
  }

  /**
   * @dataProvider arrayOfRawValues
   * 
   * @param array $raw
   */
  public function testArrayParsingWithInvalidNumberOfAtomicValues(array $raw) {
    $count = count($raw);
    $parser = new MultiValueParser();
    $parser->setRange($count, $count);
    $parser->filter($raw);
    $this->assertEquals($raw, $parser->filter($raw));
    $this->assertEquals($raw, $parser->filter(implode("\n  ", $raw)));
    $parser->setDelimeter(',');
    $this->assertEquals($raw, $parser->filter(implode("\n  , \t", $raw)));
  }

  /**
   * 
   * @param array $raw
   */
  public function testAtomicTypeForcing() {
    $parser = new MultiValueParser();
    $this->assertEquals(range(-1, 4), $parser->filter(range(-1, 4)));
    $this->assertEquals(range('a', 'b'), $parser->filter(range('a', 'b')));
  }

  public function arrayOfInvalidRawTypes(): array {
    return [
        [[new \stdClass()]],
        [new \stdClass()],
    ];
  }

  /**
   * @dataProvider arrayOfInvalidRawTypes
   * 
   * @param array $raw
   */
  public function testInvalidRawType($raw) {
    $parser = new MultiValueParser();
    $this->expectException(InvalidArgumentException::class);
    $parser->filter($raw);
  }


  /**
   * 
   * @param array $raw
   */
  public function testPatterns() {
    $parser = new MultiValueParser();
    $parser->setAtomicValidator(new \Sphp\Validators\Regex('/^(\#[\d]+)$/'));
    $this->expectException(InvalidArgumentException::class);
    $parser->filter('_#2');
    //$parser->filter(['_#a', '#4', '#_4-4']);
  }
}
