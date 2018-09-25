<?php

namespace Sphp\Stdlib;

use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use Sphp\Exceptions\FileSystemException;

class FilesystemTest extends \PHPUnit\Framework\TestCase {

  public function setUp() {
    vfsStreamWrapper::register();
    vfsStreamWrapper::setRoot(new vfsStreamDirectory('exampleDir'));
  }

  /**
   * @param BitMask $m1
   * @param BitMask $m2
   */
  public function equals(BitMask $m1, BitMask $m2) {
    $this->assertEquals($m1, $m2);
    $this->assertEquals($m1->toInt(), $m2->toInt());
    $this->assertTrue($m1->equals($m2));
    $this->assertTrue($m2->equals($m1));
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
  }

  public function testGetTextFileRows() {
    $rows = Filesystem::getTextFileRows('./tests/files/test.php');
    $this->assertCount(2, $rows);
    $this->expectException(FileSystemException::class);
    Filesystem::getTextFileRows('foo.bar');
  }

}
