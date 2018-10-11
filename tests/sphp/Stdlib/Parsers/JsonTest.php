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
class JsonTest extends TestCase {

  /**
   * @var Json
   */
  protected $parser;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->parser = new Json();
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
        ['./tests/files/test.json', ['foo' => 'bar']],
    ];
    return $map;
  }

  public function testDecode() {
    $raw = Filesystem::toString('./tests/files/test.json');
    $fromFile = $this->parser->arrayFromFile('./tests/files/test.json');
    $fromString = $this->parser->arrayFromString($raw);
    $this->assertSame($fromFile, $fromString);
  }

  public function testEncode() {
    $string = $this->parser->encodeData(['foo' => 'bar']);
    $this->assertTrue(\Sphp\Stdlib\Strings::isJson($string));
  }


  /**
   * @expectedException \Sphp\Exceptions\RuntimeException
   */
  public function testEncodeInvallidData() {
    $this->parser->encodeData([new \stdClass()]);
  }
  
  /**
   * @expectedException \Sphp\Exceptions\FileSystemException
   */
  public function testConverInvalidFile() {
    $this->parser->arrayFromFile('foo.bar', false);
  }

}
