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
use Sphp\Exceptions\InvalidArgumentException;

class YamlTest extends AbstractParserTest {

  /**
   * @var Yaml
   */
  protected $parser;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->parser = new Yaml();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->parser);
  }

  /**
   * @return array
   */
  public function filepathMap(): array {
    $map = [
        ['./tests/files/test.Yaml', ['foo' => 'bar']],
    ];
    return $map;
  }

  public function testDecode() {
    $raw = Filesystem::toString('./sphp/php/tests/files/test.yaml');
    $fromFile = $this->parser->fileToArray('./sphp/php/tests/files/test.yaml');
    $fromString = $this->parser->stringToArray($raw);
    $this->assertSame($fromFile, $fromString);
  }

  public function testEncode() {
    $string = $this->parser->toString(['foo' => 'bar']);
    $this->assertTrue(is_string($string));
  }

  public function testConverInvalidFile() {
    $this->expectException(FileSystemException::class);
    $this->parser->fileToArray('foo.bar', false);
  }

  public function buildWriter(): ArrayParser {
    return new Yaml();
  }

  public function invalidWritingPairs(): array {
    $data[] = [new \stdClass(), InvalidArgumentException::class];
    return $data;
  }

  public function validWritingPairs(): array {
    $map = [
        [['foo' => 'bar'], "foo: bar\n"],
    ];
    return $map;
  }

}
