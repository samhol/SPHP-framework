<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\RuntimeException;

/**
 * Description of JsonTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class JsonTest extends AbstractParserTest {

  /**
   * @var Json
   */
  protected $parser;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->parser = new Json();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->parser);
  }

  public function testDecode() {
    $raw = Filesystem::toString('./sphp/php/tests/files/test.json');
    $fromFile = $this->parser->fileToArray('./sphp/php/tests/files/test.json');
    $fromString = $this->parser->stringToArray($raw);
    $this->assertSame($fromFile, $fromString);
  }

  public function testEncode() {
    $string = $this->parser->toString(['foo' => 'bar']);
    $this->assertTrue(\Sphp\Stdlib\Strings::isJson($string));
  }

  public function testInvalidEncode() {
    $this->expectException(RuntimeException::class);
    $string = $this->parser->toString(["f'ff" => "\xB1\x31"]);
    echo $string;
    $this->assertTrue(\Sphp\Stdlib\Strings::isJson($string));
  }

  public function testConverInvalidFile() {
    $this->expectException(FileSystemException::class);
    $this->parser->fileToArray('foo.bar', false);
  }

  public function buildWriter(): ArrayParser {
    return new Json();
  }

  public function invalidWritingPairs(): array {
    $data = [];
    $data[] = [["fail" => "\xB1\x31"], RuntimeException::class];
    return $data;
  }

  public function validWritingPairs(): array {
    $data = [];
    $data[] = [
        ['foo', 'bar', 'baz', 'blong'],
        '{"0":"foo","1":"bar","2":"baz","3":"blong"}'
    ];
    return $data;
  }

}
