<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

class PropertyParserTest extends TestCase {

  /**
   * @var PropertyParser
   */
  protected $parser;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->parser = new PropertyParser();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    $this->parser = null;
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
   * @param string|array $value
   */
  public function testValidParsing($value) {
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
   * @param scalar $value
   */
  public function testInvalidParsing($value) {
    $parser = new PropertyParser();
    $this->expectException(InvalidArgumentException::class);
    $parser->parse($value);
  }

  /**
   * @return string[]
   */
  public function lockMethodData(): array {
    return [
        [true],
        ['a'],
        [' ä ']
    ];
  }

}
