<?php

namespace Sphp\Stdlib;

/**
 */
class MbStringTest extends \PHPUnit\Framework\TestCase {

  /**
   * 
   * @param string $string
   * @param MbString $strObj
   */
  public function compareToString(string $string, MbString $strObj) {
    $this->assertSame($string, "$strObj");
  }

  /**
   * 
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
  public function startsWith(): array {
    return [
        ['', ''],
        ['foo', ''],
        ["\n", "\n"],
        ["\t", "\t"],
        ["0", "0"],
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
   * @param string $haystack
   * @param string $needle
   */
  public function testStartsWith(string $haystack, string $needle) {
    $string = MbString::create($haystack);
    $this->assertTrue($string->startsWith($needle));
  }

  /**
   * @return array
   */
  public function endsWith(): array {
    return [
        ["", ""],
        ["\n", "\n"],
        ["\t", "\t"],
        ["\n\t", "\n\t"],
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
   * @param string $haystack
   * @param string $needle
   */
  public function testEndsWith(string $haystack, string $needle) {
    $string = MbString::create($haystack);
    $this->assertTrue($string->endsWith($needle));
  }

  /**
   * @return array
   */
  public function endsNotWith(): array {
    return [
        ["", " "],
        ["\n", "\t"],
        ["\t", "\n"],
        ["\n\t", "\t\n"],
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
   * @param string $haystack
   * @param string $needle
   */
  public function testNotEndsWith(string $haystack, string $needle) {
    $string = MbString::create($haystack);
    $this->assertFalse($string->endsWith($needle));
  }

  /**
   * 
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
   * 
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
   * 
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
   * 
   * @return array
   */
  public function isJsonData(): array {
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
  public function testIsJson(string $string, bool $expected) {
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
    \mb_internal_encoding('UTF-8');
    \mb_regex_encoding('UTF-8');
    $this->assertEquals(Strings::match($string, $pattern), $result);
  }

  /**
   * 
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

  /**
   * 
   * @return array
   */
  public function iterationTestData() {
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

}
