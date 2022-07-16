<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Filesystem;
use Sphp\Stdlib\Exceptions\FileSystemException;

class FilesystemTest extends TestCase {

  public function validationTestSet(): iterable {
    yield [__FILE__, true, true];
    yield [__DIR__, false, false];
    yield ['./sphp/php/tests/files/test.php', true, true];
    yield ['./sphp/php/tests/files/foobar', false, false];
    yield ['./sphp/php/tests/files/valid.ini', true, true];
    yield ['./sphp/php/tests/files/sample.bin', false, true];
    yield ['./sphp/php/tests/files/image.gif', false, true];
  }

  /**
   * @dataProvider validationTestSet 
   * 
   * @param  string $path
   * @param  bool $isAscii
   * @return void
   */
  public function testIsFileAndAsciiFile(string $path, bool $isAscii, bool $isFile): void {
    if (is_file($path)) {
      $finfo = new \finfo(\FILEINFO_MIME);
      $mime = $finfo->file($path);
      //echo "\n$path: $mime\n";
      //var_dump(str_contains($mime, 'charset=utf-8'));
    }
    $this->assertSame($isFile, Filesystem::isFile($path));
    $this->assertSame($isAscii, Filesystem::isAsciiFile($path));
  }

  public function testMkdir(): void {
    $spl = Filesystem::mkdir('./sphp/php/tests/foo');
    $this->assertTrue($spl->isDir());
  }

  /**
   * @depends testMkdir
   */
  public function testMkfileAndRmfile(): void {
    $spl = Filesystem::mkFile('./sphp/php/tests/foo/bar.txt');
    $this->assertTrue($spl->isFile());
    $this->assertFalse(Filesystem::rmFile('./sphp/php/tests/foo/bar.txt')->isFile());
    $this->expectException(FileSystemException::class);
    Filesystem::mkFile('$gaR £');
  }

  /**
   * @depends testMkfileAndRmfile
   */
  public function testRmdir() {
    $this->assertFalse(Filesystem::rmDir('./sphp/php/tests/foo')->isDir());
  }

  public function testGetTextFileRows() {
    $rows = Filesystem::getTextFileRows('./sphp/php/tests/files/test.php');
    $this->assertCount(2, $rows);
    $this->expectException(FileSystemException::class);
    Filesystem::getTextFileRows('foo.bar');
  }

  public function phpFiles(): iterable {
    yield ['./sphp/php/tests/files/md.php'];
    yield ['./sphp/php/tests/files/ob-buffer-skit.php'];
  }

  /**
   * @dataProvider phpFiles
   * 
   * @param string $path
   * @return void
   */
  public function testPhpFileExecution(string $path): void {
    $start_level = ob_get_level();
    $string = Filesystem::executePhpToString($path);
    $this->assertSame($start_level, ob_get_level());
  }

  /**
   * @return void
   */
  public function testPhpFileExecution1(): void {
    $string = Filesystem::executePhpToString('./sphp/php/tests/files/md.php');
    $this->assertEquals('#test{foo=bar}', $string);
  }

  /**
   * @return void
   */
  public function testPhpFileExecutionForNotAFile(): void {
    $this->expectException(FileSystemException::class);
    Filesystem::executePhpToString('foo.php');
  }

  public function testToStringExecution() {
    $string = Filesystem::toString('./sphp/php/tests/files/valid.ini');
    $this->assertEquals("foo = bar", trim($string));
    $this->expectException(FileSystemException::class);
    Filesystem::toString('zap/daa/foo.php');
  }

}
