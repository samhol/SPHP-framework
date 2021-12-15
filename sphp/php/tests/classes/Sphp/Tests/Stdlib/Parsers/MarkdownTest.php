<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Parsers\Markdown;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;

class MarkdownTest extends TestCase {

  /**
   * @var Markdown
   */
  protected Markdown $md;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->md = new Markdown();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->md);
  }

  public function testInline(): void {
    $raw = Filesystem::toString('./sphp/php/tests/files/valid.md');
    $fromFile = $this->md->parseFile('./sphp/php/tests/files/valid.md', true);
    $fromString = $this->md->parseString($raw, true);
    $this->assertSame($fromFile, $fromString);
  }

  public function testBlock(): void {
    $raw = Filesystem::toString('./sphp/php/tests/files/valid.md');
    $fromFile = $this->md->parseFile('./sphp/php/tests/files/valid.md', false);
    $fromString = $this->md->parseString($raw, false);
    $this->assertSame($fromFile, $fromString);
  }

  public function testConverInvalidFile(): void {
    $this->expectException(FileSystemException::class);
    $this->md->parseFile('foo.bar', false);
  }

}
