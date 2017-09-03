<?php

namespace Sphp\Stdlib;

/**
 */
class StringsTest extends \PHPUnit\Framework\TestCase {

  /**
   * 
   * @return array
   */
  public function emptyStrings() {
    return [
        [""]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::isEmpty
   * @dataProvider emptyStrings
   */
  public function testEmpty($empty) {
    $this->assertTrue(Strings::isEmpty($empty));
    $this->assertEquals(Strings::length($empty), 0);
  }

  /**
   * 
   * @return array
   */
  public function nonEmptyStrings() {
    return [
        [" "],
        ["\t"],
        [true],
        ["\n"],
        ["0"],
        [0],
        [0.0]];
  }

  /**
   * @covers Sphp\Stdlib\Strings::isEmpty
   * @dataProvider nonEmptyStrings
   */
  public function testNonEmpty($nonEmpty) {
    $this->assertFalse(Strings::isEmpty($nonEmpty));
    $this->assertEquals(Strings::length($nonEmpty), 1);
  }

  /**
   * 
   * @return array
   */
  public function startsWith() {
    return [
        [false, ""],
        [true, "1"],
        [true, 1],
        [null, ""],
        ["\n", "\n"],
        ["\t", "\t"],
        [0, "0"],
        ["0", 0],
        ["0", "0"],
        [0, 0],
        ["abc", "a"],
        ["abc", "ab"],
        ["abc", "abc"],
        ["åäö", "å"],
        ["åäö", "åä"],
        ["åäö", "åäö"]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::startsWith
   * @dataProvider startsWith
   */
  public function testStartsWith($haystack, $needle) {
    $this->assertTrue(Strings::startsWith($haystack, $needle));
  }

  /**
   * 
   * @return array
   */
  public function endsWith() {
    return [
        [false, ""],
        [true, "1"],
        [null, ""],
        ["", ""],
        ["\n", "\n"],
        ["\t", "\t"],
        ["\n\t", "\n\t"],
        [0, "0"],
        ["0", "0"],
        ["abc", "c"],
        ["abc", "bc"],
        ["abc", "abc"],
        ["abc", ""],
        ["åäö", "ö"],
        ["åäö", "äö"],
        ["åäö", "åäö"]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::startsWith
   * @dataProvider endsWith
   */
  public function testEndsWith($haystack, $needle) {
    $this->assertTrue(Strings::endsWith($haystack, $needle));
  }

  /**
   * 
   * @return array
   */
  public function endsNotWith() {
    return [
        [false, false],
        [true, true],
        [null, null],
        ["", null],
        ["", " "],
        ["\n", "\t"],
        ["\t", "\n"],
        ["\n\t", "\t\n"],
        [0, 0],
        ["0", 0],
        ["abc", "abC"],
        ["abc", "b"],
        ["abc", "a"],
        ["åäö", "ä"],
        ["åäö", "å"],
        ["åäö", "Ö"]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::startsWith
   * @dataProvider endsNotWith
   */
  public function testNotEndsWith($haystack, $needle) {
    $this->assertFalse(Strings::endsWith($haystack, $needle));
  }

  /**
   * 
   * @return array
   */
  public function trimData() {
    return [
        ["", null, ""],
        [" ", null, ""],
        ["  ", " ", ""],
        ["   ", null, ""],
        [" a aa a ", null, "a aa a"],
        [" a abba a ", " a", "bb"],
        ["\n\tstring\t\n", "\n", "\tstring\t"],
        [121, 1, 2],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::trim
   * @dataProvider trimData
   * @param string $string
   * @param string $charsToTrim
   */
  public function testTrim($string, $charsToTrim, $expected) {
    $this->assertEquals(Strings::trim($string, $charsToTrim), $expected);
  }

  /**
   * 
   * @return array
   */
  public function trimLeftData() {
    return [
        ["", null, ""],
        [" ", null, ""],
        ["  ", " ", ""],
        ["   ", null, ""],
        [" a aa a ", null, "a aa a "],
        [" a abba a ", " a", "bba a "],
        ["\n\tstring\t\n", "\n", "\tstring\t\n"],
        [121, 1, 21],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::trimLeft
   * @dataProvider trimLeftData
   * @param string $string
   * @param string $charsToTrim
   */
  public function testLeftTrim($string, $charsToTrim, $expected) {
    $this->assertEquals(Strings::trimLeft($string, $charsToTrim), $expected);
  }

  /**
   * 
   * @return array
   */
  public function trimRightData() {
    return [
        ["", null, ""],
        [" ", null, ""],
        ["  ", " ", ""],
        ["   ", null, ""],
        [" a aa a ", null, " a aa a"],
        [" a abba a ", "a ", " a abb"],
        ["\n\tstring\t\n", "\n", "\n\tstring\t"],
        [121, 1, 12],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::trimRight
   * @dataProvider trimRightData
   * @param string $string
   * @param string $charsToTrim
   * @param string $expected
   */
  public function testRightTrim($string, $charsToTrim, $expected) {
    $this->assertEquals(Strings::trimRight($string, $charsToTrim), $expected);
  }

  /**
   * 
   * @return array
   */
  public function isJsonData() {
    return [
        ['["a", "b"]', true],
        ['["a", "b"3]', false],
        ['{
    "glossary": {
        "title": "example glossary",
		"GlossDiv": {
            "title": "S",
			"GlossList": {
                "GlossEntry": {
                    "ID": "SGML",
					"SortAs": "SGML",
					"GlossTerm": "Standard Generalized Markup Language",
					"Acronym": "SGML",
					"Abbrev": "ISO 8879:1986",
					"GlossDef": {
                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
						"GlossSeeAlso": ["GML", "XML"]
                    },
					"GlossSee": "markup"
                }
            }
        }
    }
}', true]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::trimRight
   * @dataProvider isJsonData
   * @param string $string
   * @param string $expected
   */
  public function testIsJson($string, $expected) {
    $this->assertEquals(Strings::isJson($string), $expected);
  }

  /**
   * 
   * @return array
   */
  public function matchData() {
    // print_r(mb_);

    $attrName = "/^[a-zA-Z][\w:.-]*$/";
    $tagName = "/^([a-z]+[1-6]{0,1})$/";
    return [
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
    \mb_internal_encoding("utf-8");
    \mb_regex_encoding("utf-8");
    $this->assertEquals(Strings::match($string, $pattern), $result);
  }

  /**
   * 
   * @return array
   */
  public function uppecaseTestData() {
    return [
        ["\n", "utf-8", true],
        ["\t", "utf-8", true],
        ["\n\t", "utf-8", true],
        ["", "utf-8", true],
        [" ", "utf-8", true],
        ["0", "utf-8", true],
        ["-", "utf-8", true],
        ["Ä", "utf-8", true],
        ["Ö", "utf-8", true],
        ["Å", "utf-8", true],
        ["Ä R E", "utf-8", true],
        ["A", "utf-8", true],
        ["Ę", "utf-8", true],
        ["Ą", "utf-8", true],
        ["Ś", "utf-8", true],
        ["Ć", "utf-8", true],
        ["a", "utf-8", false],
        ["ö", "utf-8", false],
        ["å", "utf-8", false],
        ["ä", "utf-8", false],
    ];
  }

  /**
   * 
   * @dataProvider uppecaseTestData
   * @param string $string
   * @param string $enc
   * @param boolean $result
   */
  public function testUppercase($string, $enc, $result) {
    $this->assertEquals(Strings::isUpperCase($string, $enc), $result);
  }

  /**
   * 
   * @return array
   */
  public function lowercaseTestData() {
    return [
        ["", "utf-8", true],
        ["0", "utf-8", true],
        ["-", "utf-8", true],
        ["A-b", "utf-8", false],
        ["a-b", "utf-8", true],
    ];
  }

  /**
   * 
   * @dataProvider lowercaseTestData
   * @param string $string
   * @param string $enc
   * @param boolean $result
   */
  public function testLowercase($string, $enc, $result) {
    $this->assertEquals(Strings::isLowerCase($string, $enc), $result);
  }

  /**
   * 
   * @return array
   */
  public function testReverseData() {
    return [
        ["SaippuakAuppias", "saippuAkauppiaS"],
        ["a aa a ", " a aa a"],
        ["\n\t", "\t\n"],
        [121, "121"],
        [120, "021"],
        ["äöå#A", "A#åöä"],
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::reverse
   * @dataProvider testReverseData
   * @param string $string
   * @param string $charsToTrim
   * @param string $expected
   */
  public function testReverse($string, $expected) {
    $this->assertEquals(Strings::reverse($string), $expected);
  }

  /**
   * 
   * @return array
   */
  public function testHexadecimalData() {
    return [
        ["0f0", true],
        [5, true],
        ["", true],
        [" fff ", false]
    ];
  }

  /**
   * @covers Sphp\Stdlib\Strings::isHexadecimal
   * @dataProvider testHexadecimalData
   * @param string $string
   * @param string $charsToTrim
   * @param string $expected
   */
  public function testHexadecimal($string, $expected) {
    $this->assertEquals(Strings::isHexadecimal($string), $expected);
  }

  /**
   * 
   * @return array
   */
  public function vsprintfData() {
    $args = ['am' => 'olen', 'lname' => 'Holck', 'fname' => 'Sami', 'zero' => 0, 'I' => 'minä'];
    return [
        ["%zero\$d.%zero\$d degrees", $args, '0.0 degrees'],
        ["%zero\$s degrees", $args, '0 degrees'],
        ["0%f%a", ['f' => '', 'a' => '0'], '00'],
        ["%zero\$s123", $args, '0123'],
        ["test %val\$s ", ['val' => 'x'], 'test x '],
        ["a%a\$s", ['a' => 'b'], 'ab'],
        ["I am %fname\$s %lname\$s", $args, 'I am Sami Holck'],
        ["%I\$s %am\$s %fname\$s, %fname\$s %lname\$s", $args, 'minä olen Sami, Sami Holck']
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::vsprintf
   * @dataProvider vsprintfData
   * @param string $string
   * @param array $args
   * @param string $expected
   */
  public function testVsprintf($string, array $args, $expected) {
    $this->assertEquals(Strings::vsprintf($string, $args), $expected);
  }

}
