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

  public function binData(): iterable {
    yield [0b1, '1'];
    yield [0x0, '0'];
    yield [0x101, '101'];
    yield [0x101, '0b101'];
  }

  public function hexData(): iterable {
    yield [0xfa1, 'fa1'];
    yield [0xf1, '#f1'];
    yield [0xf, '0xf'];
  }

  /**
   * @dataProvider hexData
   * 
   * @param int $bits
   * @param string $hex
   * @return void
   */
  public function testFromHex(int $bits, string $hex): void {
    $mask = new BitMask($bits);
    $from = BitMask::from($hex);
    $fromHex = BitMask::fromHex($hex);
    $this->assertEquals($mask, $from);
    $this->assertEquals($mask, $fromHex);
  }

  public function invalidFromData(): iterable {
    yield [''];
    yield ['foo'];
    yield ['# 0'];
  }

  /**
   * @dataProvider invalidFromData
   * 
   * @param  string $hex 
   * @return void
   */
  public function testFromInvalidHex(string $hex): void {
    $this->expectException(InvalidArgumentException::class);
    BitMask::fromHex($hex);
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
   * 
   * @param  int $bits
   * @return void
   */
  public function testIterating(int $bits): void {
    $mask = new BitMask($bits);
    foreach ($mask as $key => $bit) {
      $this->assertSame($bit, $mask->getBit($key));
    }
  }

  public function arithmeticsData(): iterable {
    yield [1, '0b10'];
    yield ['0o0', -1];
    yield [PHP_INT_MAX, -1];
  }

  /**
   * @dataProvider arithmeticsData
   * 
   * @param  int|string $first
   * @param  int|string $second
   * @return void
   */
  public function testAND(int|string $first, int|string $second): void {
    $m1 = BitMask::from($first);
    $m2 = BitMask::from($second);
    $and = BitMask::parseInt($first) & BitMask::parseInt($second);
    $this->assertNotSame($m1, $maskAnd = $m1->binAND($m2));
    $this->assertSame($and, $maskAnd->toInt());
    $this->assertEquals($maskAnd, $m1->binAND($second));
    $this->assertEquals($maskAnd, $m2->binAND($first));
    $this->assertEquals($maskAnd, $m2->binAND($m1));
  }

  /**
   * @dataProvider arithmeticsData
   * 
   * @param  int|string $first
   * @param  int|string $second
   * @return void
   */
  public function testOR(int|string $first, int|string $second): void {
    $m1 = BitMask::from($first);
    $m2 = BitMask::from($second);
    $or = BitMask::parseInt($first) | BitMask::parseInt($second);
    $this->assertNotSame($m1, $maskOr = $m1->binOR($m2));
    $this->assertSame($or, $maskOr->toInt());
    $this->assertEquals($maskOr, $m1->binOR($second));
    $this->assertEquals($maskOr, $m2->binOR($first));
    $this->assertEquals($maskOr, $m2->binOR($m1));
  }

  /**
   * @dataProvider arithmeticsData
   * 
   * @param  int|string $first
   * @param  int|string $second
   * @return void
   */
  public function testXOR(int|string $first, int|string $second): void {
    $m1 = BitMask::from($first);
    $m2 = BitMask::from($second);
    $xor = BitMask::parseInt($first) ^ BitMask::parseInt($second);
    $this->assertNotSame($m1, $maskXOR = $m1->binXOR($m2));
    $this->assertSame($xor, $maskXOR->toInt());
    $this->assertEquals($maskXOR, $m1->binXOR($second));
    $this->assertEquals($maskXOR, $m2->binXOR($first));
    $this->assertEquals($maskXOR, $m2->binXOR($m1));
  }

  /**
   * @dataProvider arithmeticsData
   * 
   * @param  int|string $first
   * @param  int|string $second
   * @return void
   */
  public function testContains(int|string $first, int|string $second): void {
    $m1 = BitMask::from($first);
    $m2 = BitMask::from($second);
    $int1 = BitMask::parseInt($first);
    $int2 = BitMask::parseInt($second);
    $l = ($int1 & $int2) === $int2;
    $r = ($int1 & $int2) === $int1;
    $this->assertSame($r, $m2->contains($m1));
    $this->assertSame($l, $m1->contains($m2));
  }

  public function equalPairs(): iterable {
    yield [0, '0'];
    yield [4, '4'];
    yield [octdec('070'), '070'];
    yield [1, '0x1'];
    yield [0x1f, '#1f'];
    yield [1, '001'];
    yield [octdec('0o12'), '0o12'];
    yield [1, '1'];
  }

  /**
   * @dataProvider equalPairs
   * 
   * @param  int $a
   * @param  mixed $b
   * @return void
   */
  public function testEquals(int $a, mixed $b): void {
    $maskA = new BitMask($a);
    $this->assertEquals($maskA, $mb = BitMask::from($b));
    $this->assertTrue($maskA->equals($b));
    $this->assertTrue($maskA->equals($mb));
    $this->assertTrue($mb->equals($maskA));
  }

  public function nonEqualPairs(): iterable {
    yield [PHP_INT_MAX, PHP_INT_MAX - 1];
    yield [1, 'foo'];
  }

  /**
   * @dataProvider nonEqualPairs
   * 
   * @param  int $a
   * @param  mixed $b
   * @return void
   */
  public function testNotEquals(int $a, int|string|Bitmask $b): void {
    $maskA = new BitMask($a);
    $this->assertFalse($maskA->equals($b));
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
    BitMask::from('foo');
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
    yield ['101', true];
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
      $this->assertEquals(new Bitmask($dec), BitMask::fromBinary($a),
              "value: $a cannot be converted to a Bitmask");
    } else {
      $this->expectException(InvalidArgumentException::class);
      BitMask::fromBinary($a);
    }
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

  public function parseIntData(): iterable {
    yield [0, '0o0'];
    yield [0, '0x0'];
    yield [0, '#0'];
    yield [0, '0'];
    yield [783, '783'];
    yield [1, '0x1'];
    yield [0xf, '#f'];
  }

  /**
   * @dataProvider parseIntData
   *  
   * @param  int $expected
   * @param  string $str
   * @return void
   */
  public function testParseInt(int $expected, string $str): void {
    $this->assertSame($expected, BitMask::parseInt($str));
  }

}
