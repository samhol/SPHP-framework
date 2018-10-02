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
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use Sphp\Exceptions\FileSystemException;

class FilesystemTest extends TestCase {

  public function setUp() {
    vfsStreamWrapper::register();
    vfsStreamWrapper::setRoot(new vfsStreamDirectory('exampleDir'));
  }

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
        ['./tests/files/test.php']
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

  public function testMkdirAndRmdir() {
    $spl = Filesystem::mkdir('foo');
    $this->assertTrue($spl->isDir());
    $this->assertFalse(Filesystem::rmDir('foo')->isDir());
  }

  public function testMkfileAndRmfile() {
    $spl = Filesystem::mkFile('foo/bar.txt');
    $this->assertTrue($spl->isFile());
    $this->assertFalse(Filesystem::rmFile('foo/bar.txt')->isFile());
    $this->expectException(FileSystemException::class);
    Filesystem::mkFile('$gaR £');
  }

  public function testGetTextFileRows() {
    $rows = Filesystem::getTextFileRows('./tests/files/test.php');
    $this->assertCount(2, $rows);
    $this->expectException(FileSystemException::class);
    Filesystem::getTextFileRows('foo.bar');
  }

}
