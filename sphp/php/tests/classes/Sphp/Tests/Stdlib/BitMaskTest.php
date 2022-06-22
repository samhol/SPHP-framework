<?php

declare(strict_types=1);

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\BitMask;
use Sphp\Stdlib\Strings;
use Sphp\Config\PHP;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException;

class BitMaskTest extends TestCase {

  public function bits(): iterable {
    yield [0];
    yield [PHP_INT_MAX];
    yield [1];
    yield [-1];
  }

  public function hexData(): iterable {
    yield [0xf, 'f'];
    yield [0xf, '#f'];
    yield [0xf, '0xf'];
  }

  public function binData(): iterable {
    yield [0b1, '1'];
    yield [0x0, '0'];
    yield [0x101, '101'];
    yield [0x101, '0b101'];
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::fromHex
   * @dataProvider hexData
   * @param int $bits
   * @param string $hex
   * @return void
   */
  public function testFromHex(int $bits, string $hex): void {
    $mask = new BitMask($bits);
    $fromHex = BitMask::fromHex($hex);
    $this->assertEquals($mask, $fromHex);
    $this->assertEquals($mask->toInt(), $fromHex->toInt());
    $this->assertTrue($mask == $fromHex);
  }

  /**
   * @return void
   */
  public function testSingleBitManipulation(): void {
    $b = new BitMask();
    for ($i = 0; $i < PHP::getBitVersion(); $i++) {
      $b->setBit($i);
      $this->assertSame(1, $b->getBit($i), "Failed asserting that 1 is identical to {$b->getBit($i)} at position '$i'");
      $b->unsetBit($i);
      $this->assertSame(0, $b->getBit($i), "Failed asserting that 0 is identical to {$b->getBit($i)} at position '$i'");
    }
  }

  /**
   * @return void
   */
  public function testInvalidGetBit(): void {
    $b = new BitMask();
    $this->expectException(OutOfBoundsException::class);
    $b->getBit($b->length());
  }

  /**
   * @return void
   */
  public function testInvalidSetBit(): void {
    $b = new BitMask();
    $this->expectException(OutOfBoundsException::class);
    $b->setBit($b->length());
  }

  /**
   * @return void
   */
  public function testInvalidUnsetBit(): void {
    $b = new BitMask();
    $this->expectException(OutOfBoundsException::class);
    $b->unsetBit($b->length());
  }

  /**
   * @dataProvider bits
   * 
   * @param string $haystack
   * @param string $needle
   * @return void
   */
  public function testInverting(int $haystack): void {
    $mask = new BitMask($haystack);
    $inverse = new BitMask(~$haystack);
    $this->assertEquals($inverse, $mask->invert());
    $this->assertEquals($inverse->invert(), $mask);
  }

  /**
   * @dataProvider bits
   * @param int $bits
   * @return void
   */
  public function testIterating(int $bits): void {
    $mask = new BitMask($bits);
    foreach ($mask as $key => $bit) {
      $this->assertSame($bit, $mask->getBit($key));
    }
  }

  public function containingPairs(): iterable {
    yield [0, 0];
    yield [0, 1];
    yield [1, 1];
    yield [0, PHP_INT_MAX];
    yield [1, PHP_INT_MAX];
    yield [PHP_INT_MAX, PHP_INT_MAX];
    yield [0b010, 0b101];
    yield [-1, 0];
    yield [-1, 1];
    yield [-1, -1];
  }

  /**
   * @dataProvider containingPairs
   * 
   * @param int $first
   * @param int $second
   * @return void
   */
  public function testAND(int $first, int $second): void {
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
   * @dataProvider containingPairs
   * 
   * @param int $first
   * @param int $second
   * @return void
   */
  public function testOR(int $first, int $second): void {
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
   * @dataProvider containingPairs
   * 
   * @param int $first
   * @param int $second
   * @return void
   */
  public function testXOR(int $first, int $second): void {
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
   * @dataProvider containingPairs
   * 
   * @param int $first
   * @param int $second
   * @return void
   */
  public function testContains(int $first, int $second): void {
    $m1 = new BitMask($first);
    $m2 = new BitMask($second);
    $l = ($first & $second) === $second;
    $r = ($first & $second) === $first;
    $this->assertSame($r, $m2->contains($m1));
    $this->assertSame($l, $m1->contains($m2));
  }

  public function equalPairs(): iterable {
    yield [0, false];
    yield [1, true];
    yield [4, 4.2];
    yield [42, '042'];
    yield [42, '+42'];
    yield [0, '0x0'];
    yield [1, '0x1'];
    yield [0xf, '0xf'];
    yield [0x1f, '#1f'];
    yield [1, '0001'];
    yield [1, '1'];
    yield [1, new BitMask(1)];
  }

  /**
   * @dataProvider equalPairs
   * 
   * @param  int $a
   * @param  mixed $b
   * @return void
   */
  public function testFrom(int $a, $b): void {
    $this->assertEquals(new Bitmask($a), BitMask::from($b), "b: '$b' cannot be converted to $a");
  }

  public function testFromInvalid(): void {
    $this->expectException(InvalidArgumentException::class);
    BitMask::from(new \stdClass());
  }

  public function octalData(): iterable {
    yield ['077', true];
    yield ['0', true];
    yield ['8', false];
    yield ['-3', false];
    yield ['080', false];
    yield ['19', false];
  }

  /**
   * @dataProvider octalData
   * 
   * @param  int $a 
   * @param  bool $valid
   * @return void
   */
  public function testFromOctal(string $a, bool $valid): void {
    if ($valid) {
      $dec = octdec($a);
      $this->assertEquals(new Bitmask($dec), BitMask::fromOctal($a), "value: $a cannot be converted to a Bitmask");
    } else {
      $this->expectException(InvalidArgumentException::class);
      BitMask::fromOctal($a);
    }
  }

  public function binaryData(): iterable {
    yield ['0b01', true];
    yield ['000', true];
    yield ['010', true];
    yield ['1', true];
    yield ['-0', false];
    yield ['0b2', false];
    yield ['2', false];
  }

  /**
   * @dataProvider binaryData
   * 
   * @param  int $a 
   * @param  bool $valid
   * @return void
   */
  public function testFromBinary(string $a, bool $valid): void {
    if ($valid) {
      $dec = bindec($a);
      $this->assertEquals(new Bitmask($dec), BitMask::fromBinary($a), "value: $a cannot be converted to a Bitmask");
    } else {
      $this->expectException(InvalidArgumentException::class);
      BitMask::fromBinary($a);
    }
  }

  /**
   * @dataProvider equalPairs
   * 
   * @param  int $a
   * @param  mixed $b
   * @return void
   */
  public function testEquals(int $a, $b): void {
    $maskA = new BitMask($a);
    $this->assertEquals($maskA, BitMask::from($b));
    $this->assertTrue($maskA->equals($b));
  }

  public function nonEqualPairs(): iterable {
    yield [1, false];
    yield [0, true];
    yield [PHP_INT_MAX, PHP_INT_MAX - 1];
    yield [1, new \stdClass()];
  }

  /**
   * @covers \Sphp\Stdlib\BitMask::equals
   * @dataProvider nonEqualPairs
   * @param int $a
   * @param mixed $b
   * @return void
   */
  public function testNotEquals(int $a, $b): void {
    $maskA = new BitMask($a);
    $this->assertFalse($maskA->equals($b));
    //$this->assertNotEquals($maskA, BitMask::from($b));
  }

  public function intData(): iterable {
    yield [0];
    yield [PHP_INT_MAX];
    yield [1];
    yield [127];
    yield [-3];
  }

  /**
   * @dataProvider intData
   * 
   * @param $a
   */
  public function testToInt(int $a): void {
    $mask = new BitMask($a);
    $this->assertSame($a, $mask->toInt());
  }

  /**
   * @dataProvider intData
   * 
   * @param  int $a
   * @return void
   */
  public function testToScalarOutput(int $a): void {
    $mask = new BitMask($a);
    $this->assertSame($a, $mask->toInt());
    $this->assertSame(decoct($a), $mask->toOct());
    $this->assertSame(dechex($a), $mask->toHex());
    $this->assertSame(decbin($a), $mask->toBin());
    $this->assertSame(decbin($a), "$mask");
    $this->assertSame(str_pad("$mask", $mask->length(), '0', STR_PAD_LEFT), $mask->binaryRepresentation());
  }

  /**
   * @dataProvider intData
   * 
   * @param  int $a
   * @return void
   */
  public function testToArrayOutput(int $a): void {
    $mask = new BitMask($a);
    $array = $mask->toArray();
    $string = decbin($a);
    $this->assertCount(PHP::getBitVersion(), $array);
    foreach ($array as $index => $bin) {
      $this->assertTrue($bin === 0 || $bin === 1);
      $this->assertSame($mask->getBit($index), $bin);
    }
    $this->assertTrue(str_ends_with(Strings::reverse(implode($array)), $string));
  }

}
