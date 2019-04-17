<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests;

use PHPUnit\Framework\TestCase;

abstract class AbstractArrayAccessIteratorCountableTest extends TestCase {

  abstract public function arrayData(): array;

  abstract public function createCollection(): \ArrayAccess;

  public function testArrayIterator() {
    $collection = $this->createCollection();
    $data = $this->arrayData();
    foreach ($data as $key => $value) {
      $this->assertFalse(isset($collection[$key]));
      $collection[$key] = $value;
      $this->assertTrue(isset($collection[$key]));
      $this->assertSame($value, $collection[$key]);
    }
    $length = count($data);
    if ($collection instanceof \Countable) {
      $this->assertCount($length, $collection);
    }
    if ($collection instanceof \Traversable) {
      for ($n = 0; $n < 2; ++$n) {
        $i = 0;
        reset($data);
        foreach ($collection as $key => $val) {
          if ($i >= $length) {
            $this->fail("Iterator overflow! at index $key");
          }
          $this->assertEquals(key($data), $key);
          $this->assertEquals(current($data), $val);
          next($data);
          ++$i;
        }
        $this->assertEquals($length, $i);
      }
    } 
    foreach ($data as $key => $value) {
      $this->assertTrue(isset($collection[$key]));
      unset($collection[$key]);
      $this->assertFalse(isset($collection[$key]));
    }
  }

}
