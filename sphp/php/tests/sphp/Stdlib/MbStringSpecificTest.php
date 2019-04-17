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
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException;

class MbStringSpecificTest extends TestCase {

  /**
   * @return array
   */
  public function iterationTestData(): array {
    return [
        ['Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ  κυνός', 'UTF-8'],
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
  public function testIterating(string $string, string $charset) {
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
    $err = $obj[$strLen];
  }

  public function testOffseSet() {
    $obj = MbString::create('foo');
    $obj[] = '!';
    $this->assertSame('foo!', "$obj");
    $this->expectException(OutOfBoundsException::class);
    $obj[$obj->count() + 1] = 'a';
  }

  public function testOffsetsetWithMultipleChars() {
    $obj = MbString::create('foo');
    $this->expectException(InvalidArgumentException::class);
    $obj[0] = 'ab';
  }

  public function testOffsetsetWithInvalidOffsetType() {
    $obj = MbString::create('foo');
    $this->expectException(OutOfBoundsException::class);
    $obj[(string) '1'] = 'a';
  }

  public function testOffsetsetWithTooBigOffset() {
    $obj = MbString::create('foo');
    $this->expectException(OutOfBoundsException::class);
    $obj[4] = 'a';
  }

  public function testOffsetGet() {
    $obj = MbString::create('foo');
    $char = $obj[2];
    $this->assertSame('o', $char);
    $this->expectException(OutOfBoundsException::class);
    $foo = $obj[-1];
  }

  public function testOffsetExists() {
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

  /**
   * @dataProvider iterationTestData
   * @param string $string
   * @param string $charset
   */
  public function testCount(string $string, string $charset) {
    $obj = MbString::create($string, $charset);
    $strLen = \mb_strlen($string, $charset);
    $this->assertSame($strLen, $obj->count());
  }

  public function testNonExistentMethodCall() {
    $obj = MbString::create('foo');
    $this->expectException(BadMethodCallException::class);
    $obj->bar();
  }

}
