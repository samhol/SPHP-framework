<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;

/**
 * Description of JsonTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IniTest extends TestCase {

  /**
   * @var Ini
   */
  protected $parser;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->parser = new Ini();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->parser);
  }

  /**
   * @return array
   */
  public function filepathMap(): array {
    $map = [
        ['./tests/files/test.ini', ['foo' => 'bar']],
    ];
    return $map;
  }

  public function testDecode() {
    $raw = Filesystem::toString('./tests/files/test.ini');
    $fromFile = $this->parser->readFromFile('./tests/files/test.ini');
    $fromString = $this->parser->readFromString($raw);
    $this->assertSame($fromFile, $fromString);
  }

  public function testEncode() {
    $string = $this->parser->write(['foo' => 'bar']);
    $this->assertEquals("foo = \"bar\"\n", $string);
  }


  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   */
  public function testEncodeInvalidData() {
    var_dump($this->parser->write('foo'));
  }
  
  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   */
  public function testReadInvalidString() {
    var_dump($this->parser->readFromString('?{}|&~!()^ = bar', false));
  }

  /**
   * @expectedException \Sphp\Exceptions\FileSystemException
   */
  public function testConverInvalidFile() {
    $this->parser->readFromFile('foo.bar', false);
  }
}
