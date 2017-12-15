<?php

namespace Sphp\Stdlib;

use Sphp\Config\PHP;

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
    for ($i = 0; $i < PHP::getBitVersion(); $i++) {
      $b->set($i);
      $this->assertSame(1, $b->get($i), "Failed asserting that 1 is identical to {$b->get($i)} at position '$i'");
      $b->unsetBit($i);
      $this->assertSame(0, $b->get($i), "Failed asserting that 0 is identical to {$b->get($i)} at position '$i'");
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
    $this->assertCount(PHP::getBitVersion(), $arr);
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

  /**
   * @return array
   */
  public function pairs(): array {
    return [
        [0, 0],
        [0, 1],
        [1, 1],
        [0, PHP_INT_MAX],
        [1, PHP_INT_MAX],
        [PHP_INT_MAX, PHP_INT_MAX],
        [0b010, 0b101],
        [-1, 0],
        [-1, 1],
        [-1, -1],
    ];
  }

  /**
   * @covers Sphp\Stdlib\BitMask::binAND
   * @dataProvider pairs
   * @param int $first
   * @param int $second
   */
  public function testAND(int $first, int $second) {
    $m1 = new BitMask($first);
    $m2 = new BitMask($second);
    $and = $first & $second;
    $m1ANDm2 = $m1->binAND($m2);
    $m2ANDm1 = $m2->binAND($m1);
    $m1ANDsecond = $m1->binAND($second);
    $m2ANDfirst = $m2->binAND($first);
    $this->assertSame($and, $m1ANDm2->toInt());
    $this->assertSame($and, $m2ANDm1->toInt());
    $this->assertSame($and, $m1ANDsecond->toInt());
    $this->assertSame($and, $m2ANDfirst->toInt());
  }

  /**
   * @covers Sphp\Stdlib\BitMask::binOR
   * @dataProvider pairs
   * @param int $first
   * @param int $second
   */
  public function testOR(int $first, int $second) {
    $m1 = new BitMask($first);
    $m2 = new BitMask($second);
    $or = $first | $second;
    $m1ORm2 = $m1->binOR($m2);
    $m2ORm1 = $m2->binOR($m1);
    $m1ORsecond = $m1->binOR($second);
    $m2ORfirst = $m2->binOR($first);
    $this->assertSame($or, $m1ORm2->toInt());
    $this->assertSame($or, $m2ORm1->toInt());
    $this->assertSame($or, $m1ORsecond->toInt());
    $this->assertSame($or, $m2ORfirst->toInt());
  }

  /**
   * @covers Sphp\Stdlib\BitMask::binXOR
   * @dataProvider pairs
   * @param int $first
   * @param int $second
   */
  public function testXOR(int $first, int $second) {
    $m1 = new BitMask($first);
    $m2 = new BitMask($second);
    $xor = $first ^ $second;
    $m1XORm2 = $m1->binXOR($m2);
    $m2XORm1 = $m2->binXOR($m1);
    $m1XORsecond = $m1->binXOR($second);
    $m2XORfirst = $m2->binXOR($first);
    $this->assertSame($xor, $m1XORm2->toInt());
    $this->assertSame($xor, $m2XORm1->toInt());
    $this->assertSame($xor, $m1XORsecond->toInt());
    $this->assertSame($xor, $m2XORfirst->toInt());
  }

  /**
   * @covers Sphp\Stdlib\BitMask::binXOR
   * @dataProvider pairs
   * @param int $first
   * @param int $second
   */
  public function testContains(int $first, int $second) {
    $m1 = new BitMask($first);
    $m2 = new BitMask($second);
    $l = ($first & $second) === $second;
    $r = ($first & $second) === $first;
    $this->assertSame($r, $m2->contains($m1));
    $this->assertSame($l, $m1->contains($m2));
  }

  /**
   * @return array
   */
  public function equalPairs(): array {
    echo 'intval of true: ' . intval(true);
    return [
        [0, false],
        [1, true],
        [4, 4.2],
        [0, '0b0'],
        [42, '042'],
        [42, '+42'],
        [0, '0x0'],
        [1, '0x1'],
        [0xf, '0xf'],
        [0x1f, '#1f'],
        [1, '0001'],
        [-1, '-1'],
        [2147483647, '420000000000000000000'],
        [-1, new BitMask(-1)],
    ];
  }

  /**
   * @covers Sphp\Stdlib\BitMask::parseInt
   * @dataProvider equalPairs
   * @param int $a
   * @param mixed $b
   */
  public function testparseInt(int $a, $b) {
    $this->assertSame($a, BitMask::parseInt($b), "b: '$b' cannot be converted to $a");
  }

  /**
   * @covers Sphp\Stdlib\BitMask::binXOR
   * @dataProvider equalPairs
   * @param int $a
   * @param mixed $b
   */
  public function testEquals(int $a, $b) {
    $this->equals(new BitMask($a), BitMask::from($b));
  }

}
