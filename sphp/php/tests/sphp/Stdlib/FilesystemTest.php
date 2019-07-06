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
use Sphp\Exceptions\FileSystemException;

class FilesystemTest extends TestCase {

  /**
   * @return array
   */
  public function bits(): array {
    return [
        [0],
        [PHP_INT_MAX],
        [0xf],
        [1],
        [0b101010100],
        [-1],
    ];
  }

  /**
   * @return array
   */
  public function hexData(): array {
    return [
        [0xf, 'f'],
        [0xf, '#f'],
        [0xf, '0xf']
    ];
  }

  /**
   * @return array
   */
  public function validFiles(): array {
    return [
        [__FILE__],
        ['./sphp/php/tests/files/test.php']
    ];
  }

  /**
   * @covers \Sphp\Stdlib\Filesystem::isFile
   * @dataProvider validFiles
   * @param string $path
   */
  public function testIsFile(string $path) {
    $this->assertTrue(Filesystem::isFile($path));
  }

  public function testMkdir() {
    $spl = Filesystem::mkdir('./sphp/php/tests/foo');
    $this->assertTrue($spl->isDir());
  }

  /**
   * @depends testMkdir
   */
  public function testMkfileAndRmfile() {
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

  public function testPhpFileExecution() {
    $string = Filesystem::executePhpToString('./sphp/php/tests/files/md.php');
    $this->assertEquals('#test{foo=bar}', $string);
    $this->expectException(FileSystemException::class);
    Filesystem::executePhpToString('foo.php');
  }

  public function testToStringExecution() {
    $string = Filesystem::toString('./sphp/php/tests/files/test.ini');
    $this->assertEquals("foo = bar", trim($string));
    $this->expectException(FileSystemException::class);
    Filesystem::toString('foo.php');
  }

}
