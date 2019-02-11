<?php

namespace Sphp\Stdlib;

use Sphp\Config\PHP;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException;

class BitMaskTest extends \PHPUnit\Framework\TestCase {

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
   * @covers \Sphp\Stdlib\BitMask::fromHex
   * @dataProvider hexData
   * @param int $bits
   * @param string $hex
   */
  public function testFromHex(int $bits, string $hex) {
    $mask = new BitMask($bits);
    $fromHex = BitMask::fromHex($hex);
    $this->assertEquals($mask, $fromHex);
    $this->assertEquals($mask->toInt(), $fromHex->toInt());
    $this->assertTrue($mask == $fromHex);
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::setBit
   * @covers \Sphp\Stdlib\BitMask::getBit
   * @covers \Sphp\Stdlib\BitMask::unsetBit
   * @param string $haystack
   * @param string $needle
   */
  public function testSingleBitManipulation() {
    $b = new BitMask();
    for ($i = 0; $i < PHP::getBitVersion(); $i++) {
      $b->setBit($i);
      $this->assertSame(1, $b->getBit($i), "Failed asserting that 1 is identical to {$b->getBit($i)} at position '$i'");
      $b->unsetBit($i);
      $this->assertSame(0, $b->getBit($i), "Failed asserting that 0 is identical to {$b->getBit($i)} at position '$i'");
    }
  }

  public function testInvalidGetBit() {
    $b = new BitMask();
    $this->expectException(OutOfBoundsException::class);
    $b->getBit($b->length());
  }

  public function testInvalidSetBit() {
    $b = new BitMask();
    $this->expectException(OutOfBoundsException::class);
    $b->setBit($b->length());
  }
  
  public function testInvalidUnsetBit() {
    $b = new BitMask();
    $this->expectException(OutOfBoundsException::class);
    $b->unsetBit($b->length());
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::invert
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
      $this->assertSame($bit, $mask->getBit($key));
    }
  }

  /**
   * @return array
   */
  public function containingPairs(): array {
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
   * @covers \Sphp\Stdlib\BitMask::binAND
   * @dataProvider containingPairs
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
   * @covers \Sphp\Stdlib\BitMask::binOR
   * @dataProvider containingPairs
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
   * @covers \Sphp\Stdlib\BitMask::binXOR
   * @dataProvider containingPairs
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
   * @covers \Sphp\Stdlib\BitMask::contains
   * @dataProvider containingPairs
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
        [1, '1'],
        [1, new BitMask(1)],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::from
   * @covers \Sphp\Stdlib\BitMask::parseInt
   * @dataProvider equalPairs
   * @param int $a
   * @param mixed $b
   */
  public function testFrom(int $a, $b) {
    $this->assertEquals(new Bitmask($a), BitMask::from($b), "b: '$b' cannot be converted to $a");
  }

  public function testFromInvalid() {
    $this->expectException(InvalidArgumentException::class);
    BitMask::from(new \stdClass());
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::equals
   * @dataProvider equalPairs
   * @param int $a
   * @param mixed $b
   */
  public function testEquals(int $a, $b) {
    $maskA = new BitMask($a);
    $this->assertEquals($maskA, BitMask::from($b));
    $this->assertTrue($maskA->equals($b));
  }

  /**
   * @return array
   */
  public function nonEqualPairs(): array {
    return [
        [1, false],
        [0, true],
        [PHP_INT_MAX, PHP_INT_MAX - 1],
        [1, new \stdClass()]
    ];
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::equals
   * @dataProvider nonEqualPairs
   * @param int $a
   * @param mixed $b
   */
  public function testNotEquals(int $a, $b) {
    $maskA = new BitMask($a);
    $this->assertFalse($maskA->equals($b));
    //$this->assertNotEquals($maskA, BitMask::from($b));
  }

  /**
   * @return array
   */
  public function intData(): array {
    return [
        [0],
        [PHP_INT_MAX],
        [1],
        [127],
    ];
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::toInt
   * @dataProvider intData
   * @param $a
   */
  public function testToInt(int $a) {
    $mask = new BitMask($a);
    $this->assertSame($a, $mask->toInt());
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::toInt
   * @covers \Sphp\Stdlib\BitMask::toHex
   * @covers \Sphp\Stdlib\BitMask::tobin
   * @covers \Sphp\Stdlib\BitMask::toOct
   * @covers \Sphp\Stdlib\BitMask::__toString
   * @covers \Sphp\Stdlib\BitMask::binaryRepresentation
   * @dataProvider intData
   * @param int $a
   */
  public function testToScalarOutput(int $a) {
    $mask = new BitMask($a);
    $this->assertSame($a, $mask->toInt());
    $this->assertSame(decoct($a), $mask->toOct());
    $this->assertSame(dechex($a), $mask->toHex());
    $this->assertSame(decbin($a), $mask->toBin());
    $this->assertSame(decbin($a), "$mask");
    $this->assertSame(str_pad("$mask", $mask->length(), '0', STR_PAD_LEFT), $mask->binaryRepresentation());
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::toArray
   * @dataProvider intData
   * @param int $a
   */
  public function testToArrayOutput(int $a) {
    $mask = new BitMask($a);
    $array = $mask->toArray();
    $string = decbin($a);
    $this->assertCount(PHP::getBitVersion(), $array);
    foreach ($array as $index => $bin) {
      $this->assertTrue($bin === 0 || $bin === 1);
      $this->assertSame($mask->getBit($index), $bin);
    }
    $this->assertTrue(Strings::endsWith(Strings::reverse(implode($array)), $string));
  }

}
