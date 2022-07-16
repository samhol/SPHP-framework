<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\MbString;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException;

class MbStringTest extends TestCase {

  /**
   * @dataProvider stringsData
   * 
   * @param  string $string
   * @param  string $charset
   * @return void
   */
  public function testConstructor(string $string, string $charset): void {
    $obj = new MbString($string, $charset);
    $strLen = \mb_strlen($string, $charset);
    $this->assertSame($strLen, $obj->count());
    $this->assertSame($charset, $obj->getEncoding());
  }

  /**
   * @dataProvider stringsData
   * 
   * @param  string $string
   * @param  string $charset
   * @return void
   */
  public function testIterating(string $string, string $charset): void {
    $obj = MbString::create($string, $charset);
    $strLen = \mb_strlen($string, $charset);
    $this->assertSame($strLen, $obj->count());
    foreach ($obj as $key => $char) {
      //echo "char$key:'$char'\n";
      //echo "charAt($key):'" . $obj->charAt($key) . "'\n";
      //echo "string[$key]:'" . $string[$key] . "'\n";

      $this->assertEquals($obj->charAt($key), $char);
    }
    $this->assertfalse(isset($obj[$strLen]));
    $this->expectException(OutOfBoundsException::class);
    $obj[$strLen];
  }

  public function testOffseSet() {
    $obj = MbString::create('foo');
    $obj[] = '!';
    $this->assertSame('foo!', "$obj");
    $this->expectException(OutOfBoundsException::class);
    $obj[$obj->count() + 1] = 'a';
  }

  public function testOffsetsetWithNoChars() {
    $obj = MbString::create('foo');
    $this->expectException(InvalidArgumentException::class);
    $obj[0] = '';
  }

  public function testOffsetsetWithMultipleChars() {
    $obj = MbString::create('foo');
    $this->expectException(InvalidArgumentException::class);
    $obj[0] = 'ab';
  }

  public function testOffsetsetWithInvalidOffsetType() {
    $obj = MbString::create('foo');
    $this->expectException(OutOfBoundsException::class);
    $obj['foo'] = 'a';
  }

  public function testOffsetsetWithTooBigOffset() {
    $obj = MbString::create('foo');
    $this->expectException(OutOfBoundsException::class);
    $obj[4] = 'a';
  }

  public function tes2tOffsetGet() {
    $obj = MbString::create('foo');
    $char = $obj[2];
    $this->assertSame('o', $char);
    $this->expectException(OutOfBoundsException::class);
    $foo = $obj[-1];
  }

  public function tes2tOffsetExists() {
    $obj = MbString::create('foo');
    $this->assertFalse(isset($obj[-1]));
    foreach ($obj as $offset => $char) {
      $this->assertTrue(isset($obj[$offset]));
      $this->assertEquals($char, $obj[$offset]);
    }
    $this->assertFalse(isset($obj[$offset + 1]));
  }

  public function testOffsetUnset() {
    $obj = MbString::create('foo');
    unset($obj[2]);
    $this->assertSame('fo', "$obj");
    $this->expectException(OutOfBoundsException::class);
    unset($obj[2]);
  }

  public function stringsData(): iterable {
    yield ['Τάχινός', 'UTF-8'];
    yield ["\n\t ", 'UTF-8'];
    yield [' ä ', 'UTF-8'];
    yield ["\n", 'UTF-8'];
  }

  /**
   * @dataProvider stringsData
   * 
   * @param string $str
   * @param string $encoding
   * @return void
   */
  public function testArrayAccessIterationAndToArray(string $str, string|null $encoding): void {
    $length = mb_strlen($str, $encoding);
    $arr = mb_str_split($str, 1, $encoding);
    $obj = new MbString($str, $encoding);
    $this->assertCount($length, $obj);
    $this->assertSame($arr, $obj->toArray());
    for ($i = 0; $i < $length; $i++) {
      $this->assertTrue(isset($obj[$i]));
      $this->assertSame($arr[$i], $obj[$i], "String at index ($i) = {$arr[$i]}");
      $obj[$i] = 'ä';
      $this->assertSame('ä', $obj[$i], "Changed string at index ($i)");
    }

    $this->assertFalse(isset($obj[-1]));
    $this->expectException(OutOfBoundsException::class);
    $obj[$length];
  }

  /**
   * @dataProvider stringsData
   * 
   * @param string $str
   * @param string $encoding
   * @return void
   */
  public function testCharAtToArrayAndIteration(string $str, string|null $encoding) {
    $obj = new MbString($str);
    $arr = mb_str_split($str, 1, $encoding);
    //print_r($arr);
    $this->assertSame($arr, $obj->toArray());
    $this->assertSame($arr, iterator_to_array($obj));
    foreach ($arr as $index => $char) {
      $this->assertSame($char, $obj->charAt($index));
      $this->assertSame($char, $obj[$index]);
      $this->assertTrue(isset($obj[$index]));
    }
  }

  public function testNegativeCharAt(): void {
    $str = new MbString('åäö');
    $this->expectException(OutOfBoundsException::class);
    $str->charAt(-1);
  }

  public function testCharAtOverflow(): void {
    $str = new MbString('åäö');
    $this->expectException(OutOfBoundsException::class);
    $str->charAt(3);
  }

  /**
   * @dataProvider stringsData
   * @param string $string
   * @param string $charset
   */
  public function testCountAndIsEmpty(string $string, string $charset) {
    $obj = MbString::create($string, $charset);
    $strLen = \mb_strlen($string, $charset);
    $this->assertSame($strLen, $obj->count());
    $this->assertSame($strLen === 0, $obj->isEmpty());
  }

  public function testEregReplace(): void {
    $string = 'a-b';
    $strObj = MbString::create($string);
    $this->assertNotSame($strObj, $new = $strObj->eregReplace('[A-Za-z0-9]', ''));
    $this->assertSame('-', (string) $new);
  }

  public function testReplace(): void {
    $strObj = new MbString('a-c');
    $this->assertNotSame($strObj, $new = $strObj->replace('-', 'b'));
    $this->assertSame('abc', (string) $new);
    $this->assertNotSame($strObj, $new1 = $new->replace(['a', 'b', 'c'], 'x'));
    $this->assertSame('xxx', (string) $new1);
  }

  public function testPregReplace() {
    $obj = new MbString('foo');
    $this->assertSame('Boo', (string) $obj->pregReplace('/f/', 'B'));
    $this->assertSame('faa', (string) $obj->pregReplace('/o/', 'a'));
  }

  public function convertCaseData(): iterable {
    yield ["Τάχι κυνός", 'UTF-8'];
    yield ["Ä", 'UTF-8'];
    yield ["Å R E", 'UTF-8'];
    yield ['', 'UTF-8'];
    yield ['- * 1234567890', 'UTF-8'];
  }

  /**
   * @dataProvider convertCaseData
   *  
   * @param  string $string
   * @param  string $enc
   * @return void
   */
  public function testConvertCase(string $string, string $enc): void {
    $lower = \mb_convert_case($string, \MB_CASE_LOWER, $enc);
    $upper = \mb_convert_case($string, \MB_CASE_UPPER, $enc);
    $title = \mb_convert_case($string, \MB_CASE_TITLE, $enc);

    $this->assertEquals($lower, $lowerObj = (new MbString($string, $enc))->convertCase(MB_CASE_LOWER));
    $this->assertTrue($lowerObj->is(MB_CASE_LOWER));
    $this->assertEquals($upper, $upperObj = (new MbString($string, $enc))->convertCase(MB_CASE_UPPER));
    $this->assertTrue($upperObj->is(MB_CASE_UPPER,));
    $this->assertEquals($title, $titleObj = (new MbString($string, $enc))->convertCase(MB_CASE_TITLE));
    $this->assertTrue($titleObj->is(MB_CASE_TITLE));
  }

  public function typeCheckData(): iterable {
    yield ['abcdef1234567890', Strings::TYPE_HEX, Strings::TYPE_ALPHANUM];
    yield ['101001', Strings::TYPE_BINARY, Strings::TYPE_ALPHANUM];
    yield ['0b101001', Strings::TYPE_BINARY, Strings::TYPE_ALPHANUM];
    yield ['abc', Strings::TYPE_ALPHANUM];
    yield [" \n\t", Strings::TYPE_BLANK];
  }

  /**
   * @dataProvider typeCheckData
   *  
   * @param  string $string
   * @param  string|int $type
   * @return void
   */
  public function testTypeIs(string $string, string|int ... $type): void {
    $obj = new Mbstring($string);
    //var_dump($type);
    foreach ($type as $t) {
      $this->assertTrue($obj->is($t));
    }
  }

  public function startsWithData(): iterable {
    yield ['', '', true];
    yield ["åäö", '', true];
    yield ["\nä", "\n", true];
    yield ["åäö", "å", true];
  }

  /**
   * @dataProvider startsWithData
   * 
   * @param  string $haystack
   * @param  string $needle
   * @param  bool $startsWith
   * @return void
   */
  public function testStartsWith(string $haystack, string $needle, bool $startsWith): void {
    $this->assertSame($startsWith, (new MbString($haystack))->startsWith($needle));
  }

  public function endsWithData(): iterable {
    yield ['', '', true];
    yield ["åäö", '', true];
    yield ["ä\n", "\n", true];
    yield ["åäö", "ö", true];
  }

  /**
   * @dataProvider endsWithData
   * 
   * @param  string $haystack
   * @param  string $needle
   * @param  bool $endsWith
   * @return void
   */
  public function testEndsWith(string $haystack, string $needle, bool $endsWith): void {
    $this->assertSame($endsWith, (new MbString($haystack))->endsWith($needle));
  }

  public function testCountSubstr(): void {
    $strObj = new MbString('This IS a test');
    $this->assertEquals(1, $strObj->countSubstr('is'));
    $this->assertEquals(2, $strObj->countSubstr('is', false));
  }

  public function collapseWhitespaceData(): iterable {
    yield ["\n  \t", ''];
    yield [" äa \n\t ", "äa"];
  }

  /**
   * @dataProvider collapseWhitespaceData
   * 
   * @param string $string
   * @param string $expected
   * @return void
   */
  public function testCollapseWhitespace($string, string $expected): void {
    $strObj = new MbString($string);
    $collapsed = $strObj->collapseWhitespace();
    $this->assertNotSame($collapsed, $strObj);
    $this->assertSame($expected, "$collapsed");
  }

  public function testStrpos(): void {
    $str = 'foobar is foo and bar';
    $strObj = MbString::create($str);
    $this->assertEquals(7, $strObj->strpos('is'));
    $this->assertEquals(0, $strObj->strpos('foo'));
    $this->assertEquals(10, $strObj->strpos('foo', 1));
    $this->assertNull($strObj->strpos('x'));
  }

  public function testContains(): void {
    $seed = "όςa b c d e f\n\tcdf";
    $obj = MbString::create($seed);
    $this->assertTrue($obj->containsAny('c', 'o'));
    $contained = range('a', 'f');
    $contained[] = 'ός';
    $this->assertTrue($obj->containsAll(...$contained));
    foreach ($contained as $str) {
      $this->assertTrue($obj->contains($str));
      $this->assertTrue($obj->containsAll($str));
      $this->assertTrue($obj->containsAny($str));
    }
    $this->assertTrue($obj->containsAll(...$contained));
    $this->assertTrue($obj->containsAny(...$contained));

    $this->assertFalse($obj->containsAll('a', 'o'));

    $this->assertFalse($obj->containsAny('s', 'u'));

    $this->assertFalse($obj->contains('u'));
    $this->assertTrue($obj->containsAny());

    $this->assertTrue($obj->containsAll());
  }

  /**
   * @return void
   */
  public function testTrim(): void {
    $untrimmed = new MbString("\n\ta a a\t\n");
    $this->assertEquals($untrimmed, $untrimmed->trimLeft('a'));
    $this->assertEquals($untrimmed, $untrimmed->trimRight('a'));
    $this->assertEquals($untrimmed, $untrimmed->trim('a'));
    $this->assertEquals("a a a\t\n", (string) $untrimmed->trimLeft("\n\t"));
    $this->assertEquals("\n\ta a a", (string) $untrimmed->trimRight("\n\t"));
    $this->assertEquals("a a a", (string) $untrimmed->trim("\n\t"));
    $this->assertEquals(
            $untrimmed->trimLeft("\n\t")->trimRight("\n\t"),
            $untrimmed->trim("\n\t"));
  }

  public function reverseData(): iterable {
    yield ["SaippuakAuppias", "saippuAkauppiaS"];
    yield ["\n\täöå#A", "A#åöä\t\n"];
  }

  /**
   * @dataProvider reverseData
   * @param string $string
   * @param string $expected
   */
  public function testReverse($string, string $expected) {
    $strObj = MbString::create($string);
    $this->assertNotSame($strObj, $reversed = $strObj->reverse());
    $this->assertSame($expected, (string) $reversed);
  }

}
