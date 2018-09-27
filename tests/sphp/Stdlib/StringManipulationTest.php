<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\OutOfBoundsException;

class StringManipulationTest extends TestCase {

  public function testGetEncoding() {
    $this->assertEquals('UTF-8', MbString::create('')->getEncoding());
  }

  /**
   * @param string $string
   * @param MbString $strObj
   */
  public function compareToString(string $string, MbString $strObj) {
    $this->assertSame($string, "$strObj");
  }

  /**
   * @return array
   */
  public function mixedData(): array {
    return [
        ['', 'UTF-8'],
        [null, 'UTF-8'],
        [true, 'UTF-8'],
        [false, 'UTF-8'],
        [0, 'UTF-8'],
        [new \Sphp\Html\Span(), 'UTF-8']
    ];
  }

  /**
   * @covers \Sphp\Stdlib\MbString::isEmpty
   * @dataProvider mixedData
   * 
   */
  public function testIsEmpty($empty, string $encoding) {
    $plain = "$empty";
    //var_dump($plain);
    $count = \mb_strlen($plain, $encoding);
    $this->assertSame(Strings::isEmpty($plain, $encoding), ($count === 0));
    $string = MbString::create($empty);
    $this->assertSame($string->isEmpty(), ($count === 0));
    $this->assertEquals($count, $string->length());
    $this->assertEquals($count, $string->count());
    $this->assertSame($count, Strings::length($plain, $encoding));
  }

  /**
   * @return array
   */
  public function startsWithData(): array {
    return [
        ['', '', true],
        ['foo', '', true],
        ['foo', 'oo', false],
        ['foo', 'F', false],
        ["\n", "\n", true],
        ["\t", "\t", true],
        ["0", "0", true],
        ["åäö", "å", true],
        ["åäö", "åäö", true],
        ["ÄÅÖ", "åäö", false],
        ["ÄÅÖ", "ÄÅÖ", true]
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::startsWith
   * @dataProvider startsWithData
   * @param string $haystack
   * @param string $needle
   */
  public function testStartsWith(string $haystack, string $needle, bool $startsWith) {
    $this->assertSame($startsWith, Strings::startsWith($haystack, $needle));
    $this->assertSame($startsWith, MbString::create($haystack)->startsWith($needle));
  }

  /**
   * @return array
   */
  public function endsWith(): array {
    return [
        ["", "", true],
        ["\n\t", "\n\t", true],
        ["åäö", "", true],
        ["åäö", "ö", true],
        ["åäö", "äö", true],
        ["åäö", "åäö", true],
        ["", " ", false],
        ["\n", "\t", false],
        ["\t", "\n", false],
        ["\n\t", "\t\n", false],
        ["åäö", "ä", false],
        ["åäö", "å", false],
        ["åäö", "Ö", false]
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::endsWith
   * @dataProvider endsWith
   * @param string $haystack
   * @param string $needle
   */
  public function testEndsWith(string $haystack, string $needle, bool $endsWith) {
    $this->assertSame($endsWith, MbString::create($haystack)->endsWith($needle));
    $this->assertSame($endsWith, Strings::endsWith($haystack, $needle));
  }

  /**
   * @return array
   */
  public function trimData(): array {
    return [
        ["", null, ""],
        [" ", null, ""],
        ["  ", " ", ""],
        ["   ", null, ""],
        [" a aa a ", null, "a aa a"],
        [" a abba a ", " a", "bb"],
        ["\n\tstring\t\n", "\n", "\tstring\t"]
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::trim
   * @dataProvider trimData
   * @param string $string
   * @param string $charsToTrim
   */
  public function testTrim(string $string, $charsToTrim, string $expected) {
    $obj = MbString::create($string);
    $trimmed = $obj->trim($charsToTrim);
    $this->assertEquals($expected, Strings::trim($string, $charsToTrim));
    $this->assertEquals($expected, "$trimmed");
    $this->assertFalse($obj === $trimmed);
  }

  /**
   * @return array
   */
  public function trimLeftData(): array {
    return [
        ['', null, ''],
        [' ', null, ''],
        ['  ', " ", ''],
        ['   ', null, ''],
        [' a aa a ', null, 'a aa a '],
        [' a abba a ', ' a', "bba a "],
        ["\n\tstring\t\n", "\n", "\tstring\t\n"],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::trimLeft
   * @dataProvider trimLeftData
   * @param string $string
   * @param string $charsToTrim
   */
  public function testLeftTrim(string $string, $charsToTrim, string $expected) {
    $obj = MbString::create($string);
    $trimmed = $obj->trimLeft($charsToTrim);
    $this->assertEquals($expected, Strings::trimLeft($string, $charsToTrim));
    $this->assertEquals($expected, "$trimmed");
    $this->assertFalse($obj === $trimmed);
  }

  /**
   * @return array
   */
  public function trimRightData(): array {
    return [
        ["", null, ""],
        [" ", null, ""],
        ["  ", " ", ""],
        ["   ", null, ""],
        [" a aa a ", null, " a aa a"],
        [" a abba a ", "a ", " a abb"],
        ["\n\tstring\t\n", "\n", "\n\tstring\t"],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::trimRight
   * @dataProvider trimRightData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testRightTrim(string $string, $charsToTrim, string $expected) {
    $obj = MbString::create($string);
    $trimmed = $obj->trimRight($charsToTrim);
    $this->assertEquals($expected, Strings::trimRight($string, $charsToTrim));
    $this->assertEquals($expected, "$trimmed");
    $this->assertFalse($obj === $trimmed);
  }

  /**
   * @return array
   */
  public function matchData(): array {
    $nordicAlpha = "/^[a-zA-ZåäöÅÄÖ]{1,}$/";
    $attrName = "/^[a-zA-Z][\w:.-]*$/";
    $tagName = "/^([a-z]+[1-6]{0,1})$/";
    return [
        ["AaÄäÅåÖö", $nordicAlpha, true],
        ["AaÄäÅåÖö ", $nordicAlpha, false],
        ["aria-hidden", $attrName, true],
        ["data-hidden", $attrName, true],
        ["id", $attrName, true],
        ["_2*", $attrName, false],
        ["*", $attrName, false],
        ["h1", $tagName, true],
        ["h_1", $tagName, false],
    ];
  }

  /**
   * @dataProvider matchData
   * @param string $string
   * @param string $pattern
   * @param boolean $result
   */
  public function testMatch(string $string, string $pattern, bool $result) {
    $obj = MbString::create($string);
    $this->assertSame($obj->match($pattern), $result);
  }

  /**
   * @return array
   */
  public function convertCaseData(): array {
    return [
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ  κυνός", 'UTF-8'],
        ["Ä", 'UTF-8'],
        ["Ö", 'UTF-8'],
        ["Å R E", 'UTF-8'],
        ['', 'UTF-8'],
        ['- * 1234567890', 'UTF-8'],
    ];
  }

  /**
   * @dataProvider convertCaseData
   * @param string $string
   * @param string $enc
   */
  public function testConvertCase(string $string, string $enc) {
    $lower = \mb_convert_case($string, \MB_CASE_LOWER, $enc);
    $upper = \mb_convert_case($string, \MB_CASE_UPPER, $enc);
    $title = \mb_convert_case($string, \MB_CASE_TITLE, $enc);

    $strObject = MbString::create($string, $enc);
    $this->assertEquals($lower, Strings::convertCase($string, MB_CASE_LOWER, $enc));
    $this->compareToString($lower, $strObject->convertCase(MB_CASE_LOWER));
    $this->assertEquals($upper, Strings::convertCase($string, MB_CASE_UPPER, $enc));
    $this->compareToString($upper, $strObject->convertCase(MB_CASE_UPPER));
    $this->assertEquals($title, Strings::convertCase($string, MB_CASE_TITLE, $enc));
    $this->compareToString($title, $strObject->convertCase(MB_CASE_TITLE));

    $this->assertTrue(Strings::caseIs($lower, MB_CASE_LOWER, $enc));
    $this->assertTrue(Strings::caseIs($upper, MB_CASE_UPPER, $enc));
    $this->assertTrue(Strings::caseIs($title, MB_CASE_TITLE, $enc));
    $this->assertTrue(MbString::create($lower, $enc)->caseIs(MB_CASE_LOWER));
    $this->assertTrue(MbString::create($upper, $enc)->caseIs(MB_CASE_UPPER));
    $this->assertTrue(MbString::create($title, $enc)->caseIs(MB_CASE_TITLE));
  }

  /**
   * @return array
   */
  public function iterationTestData(): array {
    return [
        ['fo obär ', 'UTF-8'],
        ["\n\t", 'UTF-8'],
        ['       ', 'UTF-8'],
        [' ä ', 'UTF-8'],
    ];
  }

  /**
   * @dataProvider iterationTestData
   * @param string $string
   * @param string $charset
   */
  public function testCharAt(string $string, string $charset) {
    $obj = MbString::create($string, $charset);
    $strLen = \mb_strlen($string, $charset);
    for ($i = 0; $i < $strLen; $i++) {
      $char = mb_substr($string, $i, 1, $charset);
      $this->assertTrue(isset($obj[$i]));
      $this->assertEquals($obj->charAt($i), $char);
      $this->assertEquals(Strings::charAt($string, $i, $charset), $char);
    }
  }

  /**
   * @param string $string
   * @param string $charset
   */
  public function testInvalidCharAt() {
    $this->expectException(OutOfBoundsException::class);
    Strings::charAt('', 0);
  }

  /**
   * @return array
   */
  public function blankTestData() {
    return [
        ['foobar', false],
        ["\n\t ", true],
        ['', false],
        [' ä ', false],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::isBlank
   * @dataProvider blankTestData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testBlank(string $string, bool $expected) {
    $this->assertSame($expected, Strings::isBlank($string));
    $obj = MbString::create($string);
    $this->assertSame($expected, $obj->isBlank());
  }

  /**
   * @return array
   */
  public function hexTestData(): array {
    return [
        ['#', false],
        ['0x', false],
        ['0123456789ABCDEF', true],
        ['0123456789abcdefABCDEF', true],
        ['0x123456789abcdefABCDEF', true],
        ['#0123456789abcdefABCDEF', true],
        ['f,', false],
        ["\n\t", false],
        ['', false],
        [' ', false],
        ['foo', false],
        [' ä ', false],
    ];
  }

  /**
   * @dataProvider hexTestData
   * @param string $string
   * @param string $expected
   */
  public function testHex(string $string, bool $expected) {
    $this->assertSame($expected, Strings::isHexadecimal($string));
    $obj = MbString::create($string);
    $this->assertSame($expected, $obj->isHexadecimal());
  }

  /**
   * @return array
   */
  public function binaryTestData(): array {
    return [
        ['0', true],
        ['1', true],
        ['101010', true],
        ['10a101', false],
        ["\n\t", false],
        ['', false],
        [' ', false],
        ['ä', false],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::isBinary
   * @dataProvider binaryTestData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testBinary(string $string, bool $expected) {
    $this->assertSame($expected, Strings::isBinary($string));
    $obj = MbString::create($string);
    $this->assertSame($expected, $obj->isBinary());
  }

  /**
   * @covers \Sphp\Stdlib\Strings::containsAll
   * @covers \Sphp\Stdlib\Strings::containsAny
   */
  public function testContains() {
    $seed = "a b c d e f\n\tcdf";
    $obj = MbString::create($seed);
    $this->assertTrue($obj->containsAny(range('c', 'o')));
    $this->assertTrue(Strings::containsAny($seed, range('c', 'o')));

    $this->asserttrue($obj->containsAll(range('a', 'f')));
    $this->asserttrue(Strings::containsAll($seed, range('a', 'f')));

    $this->assertFalse($obj->containsAll(range('a', 'o')));
    $this->assertFalse(Strings::containsAll($seed, range('a', 'o')));

    $this->assertFalse($obj->containsAny(range('s', 'u')));
    $this->assertFalse(Strings::containsAny($seed, range('s', 'u')));

    $this->assertFalse($obj->containsAny([]));
    $this->assertFalse(Strings::containsAny($seed, []));

    $this->assertFalse($obj->containsAll([]));
    $this->assertFalse(Strings::containsAll($seed, []));
  }

  /**
   * @return array
   */
  public function charArrays(): array {
    return [
        [['0'], 'UTF-8'],
        [range('a', 'f'), 'UTF-8'],
        [['ä', 'å', 'ö', 'ψ', 'η', 'μ', 'έ', 'ν', 'η', 'γ', 'η'], 'UTF-8'],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::toArray
   * @dataProvider charArrays
   * @param array $chars
   * @param string $encoding
   */
  public function testToArray(array $chars, string $encoding) {
    $string = implode($chars);
    $obj = MbString::create($string);
    $this->assertSame($chars, $obj->toArray());
    $this->assertSame($chars, Strings::toArray($string, $encoding));
    $this->assertSame([], MbString::create('')->toArray());
  }

  public function testReplacing() {
    $string = 'a-b';
    $strObj = MbString::create($string);

    $this->compareToString('-', $strObj->regexReplace('[A-Za-z0-9]', ''));
    $this->compareToString('-b', $strObj->replace('a', ''));

    $this->assertEquals('-', Strings::regexReplace($string, '[A-Za-z0-9]', ''));
    $this->assertEquals('-b', Strings::replace($string, 'a', ''));
  }

  /**
   * 
   * @return array
   */
  public function reverseData() {
    return [
        ["SaippuakAuppias", "saippuAkauppiaS"],
        ["a aa a ", " a aa a"],
        ["\n\t", "\t\n"],
        ['121', "121"],
        ["äöå#A", "A#åöä"],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::reverse
   * @dataProvider reverseData
   * @param string $string
   * @param string $expected
   */
  public function testReverse($string, string $expected) {
    $this->assertEquals(Strings::reverse($string), $expected);
    $strObj = MbString::create($string);
    $reversed = $strObj->reverse();
    $this->assertTrue($strObj !== $reversed);
    $this->compareToString($expected, $reversed);
  }

  /**
   * @return array
   */
  public function collapseWhitespaceData() {
    return [
        ["\n  \t", ''],
        [" äa \n\t ", "äa"],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::collapseWhitespace
   * @dataProvider collapseWhitespaceData
   * @param string $string
   * @param string $expected
   */
  public function testCollapseWhitespace($string, string $expected) {
    $this->assertEquals($expected, Strings::collapseWhitespace($string));
    $strObj = MbString::create($string);
    $collapsed = $strObj->collapseWhitespace();
    $this->assertTrue($strObj !== $collapsed);
    $this->compareToString($expected, $collapsed);
  }

  /**
   * @return array
   */
  public function htmlData() {
    return [
        ["A 'quote' is <b>bold</b>", "A 'quote' is &lt;b&gt;bold&lt;/b&gt;"],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::htmlEncode
   * @covers \Sphp\Stdlib\Strings::htmlDecode
   * @dataProvider htmlData
   *
   * @param string $html
   * @param string $plain
   */
  public function testHtmlCoding(string $html, string $plain) {
    $this->assertEquals($plain, Strings::htmlEncode($html));
    $htmlObj = MbString::create($html);
    $plainObj = $htmlObj->htmlEncode();
    $this->assertTrue($htmlObj !== $plainObj);
    $this->compareToString($plain, $plainObj);


    $this->assertEquals($html, Strings::htmlDecode($plain));
    $plainObj1 = MbString::create($plain);
    $htmlObj1 = $htmlObj->htmlDecode();
    $this->assertTrue($htmlObj1 !== $plainObj1);
    $this->compareToString($html, $htmlObj1);
  }

}
