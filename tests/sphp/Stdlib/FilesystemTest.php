<?php

namespace Sphp\Stdlib;

class FilesystemTest extends \PHPUnit\Framework\TestCase {

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
        ['./tests/sphp/Stdlib/files/test.ini']
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

}
