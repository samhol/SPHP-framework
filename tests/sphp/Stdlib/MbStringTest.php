<?php

namespace Sphp\Stdlib;

class MbStringTest extends \PHPUnit\Framework\TestCase {

  /**
   * @param string $string
   * @param MbString $strObj
   */
  public function compareToString(string $string, MbString $strObj) {
    $this->assertSame($string, "$strObj");
  }

  /**
   * @param MbString $obj1
   * @param MbString $obj2
   */
  public function identical(MbString $obj1, MbString $obj2) {
    $this->assertTrue($obj1 == $obj2);
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
   * @covers Sphp\Stdlib\MbString::isEmpty
   * @dataProvider mixedData
   * 
   */
  public function testIsEmpty($empty, string $encoding) {
    $plain = "$empty";
    $count = mb_strlen($plain, $encoding);
    $string = MbString::create($empty);
    echo "obj:'$string', raw:'$plain'\n";

    var_dump($string->isEmpty($empty), $count);
    $this->assertSame($string->isEmpty($empty), ($count === 0));
    $this->assertEquals($string->length($empty), $count);
  }

  /**
   * @return array
   */
  public function startsWithData(): array {
    return [
        ['', '', true],
        ['foo', '', true],
        ['foo', 'f', true],
        ['foo', 'fo', true],
        ['foo', 'foo', true],
        ['foo', 'fooo', false],
        ['foo', 'F', false],
        ['Foo', 'F', true],
        ["\n", "\n", true],
        ["\t", "\t", true],
        ["0", "0", true],
        ["åäö", "å", true],
        ["åäö", "åä", true],
        ["åäö", "åäö", true],
        ["ÄÅÖ", "åäö", false],
        ["ÄÅÖ", "ÄÅÖ", true]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::startsWith
   * @dataProvider startsWithData
   * @param string $haystack
   * @param string $needle
   */
  public function testStartsWith(string $haystack, string $needle, bool $startsWith) {
    $string = MbString::create($haystack);
    $this->assertSame($startsWith, $string->startsWith($needle));
  }

  /**
   * @return array
   */
  public function endsWith(): array {
    return [
        0 => ["", "", true],
        1 => ["\n", "\n", true],
        1 => ["\t", "\t", true],
        ["\n\t", "\n\t", true],
        ["0", "0", true],
        ["abc", "c", true],
        ["abc", "bc", true],
        ["abc", "abc", true],
        ["abc", "", true],
        ["åäö", "ö", true],
        ["åäö", "äö", true],
        ["åäö", "åäö", true],
        ["", " ", false],
        ["\n", "\t", false],
        ["\t", "\n", false],
        ["\n\t", "\t\n", false],
        ["abc", "abC", false],
        ["abc", "b", false],
        ["abc", "a", false],
        ["åäö", "ä", false],
        19 => ["åäö", "å", false],
        20 => ["åäö", "Ö", false]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::endsWith
   * @dataProvider endsWith
   * @param string $haystack
   * @param string $needle
   */
  public function testEndsWith(string $haystack, string $needle, bool $endsWith) {
    $string = MbString::create($haystack);
    if ($endsWith) {
      $this->assertTrue($string->endsWith($needle));
    } else {
      $this->assertFalse($string->endsWith($needle));
    }
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
   * @covers Sphp\Stdlib\Strings::trim
   * @dataProvider trimData
   * @param string $string
   * @param string $charsToTrim
   */
  public function testTrim(string $string, $charsToTrim, string $expected) {
    $obj = MbString::create($string);
    $this->compareToString($expected, $obj->trim($charsToTrim));
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
   * @covers Sphp\Stdlib\Strings::trimLeft
   * @dataProvider trimLeftData
   * @param string $string
   * @param string $charsToTrim
   */
  public function testLeftTrim(string $string, $charsToTrim, string $expected) {
    $obj = MbString::create($string);
    $this->assertEquals("{$obj->trimLeft($charsToTrim)}", $expected);
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
   * @covers Sphp\Stdlib\Strings::trimRight
   * @dataProvider trimRightData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testRightTrim(string $string, $charsToTrim, string $expected) {
    $obj = MbString::create($string);
    //$this->assertEquals("{$obj->trimRight($charsToTrim)}", $expected);
    $this->compareToString($expected, $obj->trimRight($charsToTrim));
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
   * 
   * @dataProvider matchData
   * @param string $string
   * @param string $pattern
   * @param boolean $result
   */
  public function testMatch($string, $pattern, $result) {
    $obj = MbString::create($string);
    $this->assertSame($obj->match($pattern), $result);
  }

  /**
   * @return array
   */
  public function uppecaseTestData(): array {
    return [
        ["\n", 'UTF-8'],
        ["\t", 'UTF-8'],
        ["\n\t", 'UTF-8'],
        ["", 'UTF-8'],
        [" ", 'UTF-8'],
        ["0", 'UTF-8'],
        ["Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός", 'UTF-8'],
        ["Ä", 'UTF-8'],
        ["Ö", 'UTF-8'],
        ["Å", 'UTF-8'],
        ["Ä R E", 'UTF-8'],
        ["A", 'UTF-8'],
        ["Ę", 'UTF-8'],
        ["Ą", 'UTF-8'],
        ["Ś", 'UTF-8'],
        ["Ć", 'UTF-8'],
        ["a", 'UTF-8'],
        ["ö", 'UTF-8'],
        ["å", 'UTF-8'],
        ["ä", 'UTF-8'],
    ];
  }

  /**
   * @dataProvider uppecaseTestData
   * @param string $string
   * @param string $enc
   */
  public function testConvertCase(string $string, string $enc) {
    $lower = \mb_convert_case($string, \MB_CASE_LOWER, $enc);
    $upper = \mb_convert_case($string, \MB_CASE_UPPER, $enc);
    $title = \mb_convert_case($string, \MB_CASE_TITLE, $enc);
    $obj = new MbString($string, $enc);
    $objLower = new MbString($lower, $enc);
    $objUpper = new MbString($upper, $enc);
    $objTitle = new MbString($title, $enc);
    $this->compareToString($lower, $obj->toLowerCase());
    $this->compareToString($upper, $obj->toUpperCase());
    $this->compareToString($title, $obj->toTitleCase());
    $this->identical($objLower, $obj->toLowerCase());
    $this->identical($objUpper, $obj->toUpperCase());
    $this->identical($objTitle, $obj->toTitleCase());
    $this->compareToString($string, $obj);
  }

  /**
   * @return array
   */
  public function iterationTestData(): array {
    return [
        ['foobar', 'UTF-8'],
        ["\t", 'UTF-8'],
        ["\n\t", 'UTF-8'],
        ['', 'UTF-8'],
        [' ', 'UTF-8'],
        ['       ', 'UTF-8'],
        [' ä ', 'UTF-8'],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::vsprintf
   * @dataProvider iterationTestData
   * @param string $string
   * @param array $args
   * @param string $expected
   */
  public function testIterating($string, $charset) {
    $obj = MbString::create($string, $charset);
    $this->assertSame(\mb_strlen($string, $charset), $obj->count());
    foreach ($obj as $key => $char) {
      //echo "char$key:'$char'\n";
      //echo "charAt($key):'" . $obj->charAt($key) . "'\n";
      //echo "string[$key]:'" . $string[$key] . "'\n";
      $this->assertEquals($obj->charAt($key), $char);
    }
  }

  /**
   * @return array
   */
  public function blankTestData() {
    return [
        ['foobar', false],
        ["\t", true],
        ["\n\t", true],
        ['', false],
        [' ', true],
        ["    \t   ", true],
        [' foobar ä ', false],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::isBlank
   * @dataProvider blankTestData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testBlank(string $string, bool $expected) {
    $obj = MbString::create($string);
    $this->assertSame($expected, $obj->isBlank());
  }

  /**
   * @return array
   */
  public function hexTestData(): array {
    return [
        ['#', false],
        ['#12a', true],
        ['0x', false],
        ['0123456789ABCDEF', true],
        ['ABCDEF', true],
        ['abcdef', true],
        ['000000', true],
        ['0123456789abcdef', true],
        ['0x123456789abcdef', true],
        ['#0123456789abcdef', true],
        ['fg', false],
        ['f,', false],
        ["\t", false],
        ["\n\t", false],
        ['', false],
        [' ', false],
        ['foo', false],
        [' ä ', false],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::trimRight
   * @dataProvider hexTestData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testHex(string $string, bool $expected) {
    $obj = MbString::create($string);
    //$this->assertEquals("{$obj->trimRight($charsToTrim)}", $expected);
    $this->assertSame($expected, $obj->isHexadecimal());
  }

  /**
   * @return array
   */
  public function binaryTestData(): array {
    return [
        ['0', true],
        ['1', true],
        ['101010101', true],
        ['10a1010101', false],
        ["\t", false],
        ["\n\t", false],
        ['', false],
        [' ', false],
        ['       ', false],
        [' ä ', false],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::isBinary
   * @dataProvider binaryTestData
   * @param string $string
   * @param string|null $charsToTrim
   * @param string $expected
   */
  public function testBinary(string $string, bool $expected) {
    $obj = MbString::create($string);
    //$this->assertEquals("{$obj->trimRight($charsToTrim)}", $expected);
    $this->assertSame($expected, $obj->isBinary());
  }

}
