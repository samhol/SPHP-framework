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

class MarkdownTest extends TestCase {

  /**
   * @var Markdown
   */
  protected $md;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->md = new Markdown();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->md);
  }

  /**
   * @return array
   */
  public function filepathMap(): array {
    $map = [
        [ './tests/files/test.md', '<h1 foo="bar">test</h1>'],
        ['./tests/files/test.yaml', ['foo' => 'bar']],
        ['./tests/files/test.json', ['foo' => 'bar']],
        ['./tests/files/test.ini', ['foo' => 'bar']],
    ];
    return $map;
  }

  public function testInline() {
    $raw = Filesystem::toString('./tests/files/test.md');
    $fromFile = $this->md->convertFile('./tests/files/test.md', true);
    $fromString = $this->md->convertString($raw, true);
    $this->assertSame($fromFile, $fromString);
  }

  public function testBlock() {
    $raw = Filesystem::toString('./tests/files/test.md');
    $fromFile = $this->md->convertFile('./tests/files/test.md', false);
    $fromString = $this->md->convertString($raw, false);
    $this->assertSame($fromFile, $fromString);
  }

  /**
   * @expectedException \Sphp\Exceptions\FileSystemException
   */
  public function testConverInvalidFile() {
    $this->md->convertFile('foo.bar', false);
  }

}
