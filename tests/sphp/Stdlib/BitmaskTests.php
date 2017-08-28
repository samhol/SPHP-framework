<?php

namespace Sphp\Stdlib;

use Sphp\Config\PHPConfig;

class BitMaskTest extends \PHPUnit\Framework\TestCase {

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
  public function binData(): array {
    return [
        [0b1, '1'],
        [0x0, '0'],
        [0x101, '101'],
        [0x101, '0b101']
    ];
  }

  /**
   * @covers Sphp\Stdlib\BitMask::fromHex
   * @dataProvider hexData
   * @param int $bits
   * @param string $hex
   */
  public function testFromHex(int $bits, string $hex) {
    $mask = new BitMask($bits);
    $fromHex = BitMask::fromHex($hex);
    $this->assertEquals($mask, $fromHex);
    $this->assertEquals($mask->toInt(), $fromHex->toInt());
    $this->assertTrue($mask->equals($fromHex));
    $this->assertTrue($fromHex->equals($mask));
  }

  /**
   * @covers Sphp\Stdlib\Strings::startsWith
   * @param string $haystack
   * @param string $needle
   */
  public function testBitSetting() {
    $b = new BitMask();
    for ($i = 0; $i < PHPConfig::getBitVersion(); $i++) {
      $b->set($i);
      $this->assertSame(1, $b->get($i), "Failed asserting that 0 is identical to 1 at position '$i'");
      echo "$b\n";
      $b->unset($i);
      $this->assertSame(0, $b->get($i), "Failed asserting that 0 is identical to 1 at position '$i'");
      echo "$b\n";
    }
  }

  /**
   * @covers Sphp\Stdlib\BitMask::toArray
   * @dataProvider bits
   * @param int $bits
   */
  public function testToArray(int $bits) {
    $mask = new BitMask($bits);
    $arr = $mask->toArray();
    $this->assertCount(PHPConfig::getBitVersion(), $arr);
    foreach ($arr as $index => $bit) {
      $this->assertSame($mask->get($index), $bit);
    }
  }

  /**
   * @covers Sphp\Stdlib\BitMask::invert
   * @dataProvider bits
   * @param string $haystack
   * @param string $needle
   */
  public function testInverting(int $haystack) {
    $mask = new BitMask($haystack);
    $inverse = new BitMask(~$haystack);
    $this->assertEquals($inverse, $mask->invert());
    $this->assertEquals($inverse->invert(), $mask);
  }

  /**
   * @dataProvider bits
   * @param int $bits
   */
  public function testIterating(int $bits) {
    $mask = new BitMask($bits);
    foreach ($mask as $key => $bit) {
      $this->assertSame($bit, $mask->get($key));
    }
  }

}
