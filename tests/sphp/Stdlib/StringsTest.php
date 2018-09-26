<?php

namespace Sphp\Stdlib;

class StringsTest extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function emptyStrings() {
    return [
        [""]
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Strings::isEmpty
   * @dataProvider emptyStrings
   */
  public function testEmpty($empty) {
    $this->assertTrue(Strings::isEmpty($empty));
    $this->assertEquals(Strings::length($empty), 0);
  }

  /**
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
   * @covers \Sphp\Stdlib\Strings::isEmpty
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
   * @covers \Sphp\Stdlib\Strings::isJson
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


}
