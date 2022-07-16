<?php

declare(strict_types=1);
/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\LogicException;
use Sphp\Exceptions\OutOfBoundsException;

class StringsTest extends TestCase {

  public function testContains(): void {
    $seed = "a b c d e f\n\tcdf";
    $this->assertTrue(Strings::containsAny($seed, range('c', 'o')));
    $contained = range('a', 'f');
    $this->assertTrue(Strings::containsAll($seed, $contained));
    $this->assertFalse(Strings::containsAll($seed, range('a', 'o')));
    $this->assertFalse(Strings::containsAny($seed, range('s', 'u')));
    $this->assertFalse(Strings::containsAny($seed, []));
    $this->assertFalse(Strings::containsAll($seed, []));
  }

  public function collapseWhitespaceData(): iterable {
    yield ["\n  \t", ''];
    yield [" äa \n\t ", 'äa'];
  }

  /**
   * @dataProvider collapseWhitespaceData
   * 
   * @param  string $string
   * @param  string $expected
   * @return void
   */
  public function testCollapseWhitespace($string, string $expected): void {
    $this->assertEquals($expected, Strings::collapseWhitespace($string));
  }

  /**
   * @return void
   */
  public function testTrim(): void {
    $untrimmed = "\n\ta a a\t\n";
    $this->assertEquals($untrimmed, Strings::trimLeft($untrimmed, 'a'));
    $this->assertEquals($untrimmed, Strings::trimRight($untrimmed, 'a'));
    $this->assertEquals($untrimmed, Strings::trim($untrimmed, 'a'));
    $this->assertEquals("a a a\t\n", Strings::trimLeft($untrimmed, "\n\t"));
    $this->assertEquals("\n\ta a a", Strings::trimRight($untrimmed, "\n\t"));
    $this->assertEquals("a a a", Strings::trim($untrimmed, "\n\t"));
    $this->assertEquals(
            Strings::trimLeft(Strings::trimRight($untrimmed, "\n\t"), "\n\t"),
            Strings::trim($untrimmed, "\n\t"));
  }

  public function testRegexReplace(): void {
    $string = '1a-b2';
    $this->assertEquals('-', Strings::regexReplace($string, '[A-Za-z0-9]', ''));
    //$this->assertEquals('-b', Strings::replace($string, 'a', ''));
  }

  public function typeCheckData(): iterable {
    yield ['AFabcdef1234567890', Strings::TYPE_HEX, Strings::TYPE_ALPHANUM];
    yield ['101001', Strings::TYPE_BINARY, Strings::TYPE_ALPHANUM];
    yield ['0b101001', Strings::TYPE_BINARY, Strings::TYPE_ALPHANUM];
    yield ['axAX10', Strings::TYPE_ALPHANUM];
    yield [" \n\t", Strings::TYPE_BLANK];
    yield ['AZ', Strings::TYPE_ALPHA, Strings::CASE_UPPER];
    yield ['az', Strings::TYPE_ALPHA, Strings::CASE_LOWER];
    yield ['AÄ', Strings::CASE_UPPER];
    yield ['aä', Strings::CASE_LOWER];
  }

  /**
   * @dataProvider typeCheckData
   *  
   * @param  string $string
   * @param  string|int $type
   * @return void
   */
  public function testTypeIs(string $string, string|int ... $type): void {
    //var_dump($type);
    foreach ($type as $t) {
      $this->assertTrue(Strings::typeIs($string, $t));
    }
  }

  public function testRandomize(): void {
    $string = 'ABCDEEFGHIJKLMNOPQRSTUVWXY1234567890';
    $strLen = mb_strlen($string);
    $rand1 = Strings::randomize($string, $strLen);
    $this->assertEquals($strLen, mb_strlen($rand1));
    $this->expectException(\Exception::class);
    Strings::randomize($string, 0);
  }

  public function testRandomizeFail(): void {
    $this->expectException(LogicException::class);
    Strings::randomize('a', 0);
  }

  public function iterationTestData(): iterable {
    yield ['fo obär ', 'UTF-8'];
    yield ["\n\t ", 'UTF-8'];
    yield ['  ', 'UTF-8'];
  }

  /**
   * @dataProvider iterationTestData
   * 
   * @param string $string
   * @param string $charset
   */
  public function testCharAt(string $string, string $charset) {
    $strLen = \mb_strlen($string, $charset);
    for ($i = 0; $i < $strLen; $i++) {
      $char = mb_substr($string, $i, 1, $charset);
      $this->assertEquals(Strings::charAt($string, $i, $charset), $char);
    }

    $this->expectException(OutOfBoundsException::class);
    Strings::charAt($string, -1, $charset);
  }

}
