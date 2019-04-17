<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests;

use ArrayAccess;
use Sphp\Stdlib\Datastructures\Arrayable;
use Traversable;

trait ArrayAccessTraversableCountableTestTrait {

  abstract public function arrayData(): array;

  abstract public function createCollection(): \ArrayAccess;

  public function testArrayIterator() {
    $collection = $this->createCollection();
    $this->runArrayAccessAddingTest($collection);
    $data = $this->arrayData();
    if ($collection instanceof \Countable) {
      $length = count($data);
      $this->assertCount($length, $collection);
    }
    if ($collection instanceof Arrayable) {
      $this->arrayableTests($collection);
    }

    if ($collection instanceof Traversable) {
      $this->runTraversableTests($collection);
    }
    foreach ($data as $key => $value) {
      $this->assertTrue(isset($collection[$key]));
      unset($collection[$key]);
      $this->assertFalse(isset($collection[$key]));
    }
  }

  protected function runArrayAccessAddingTest(ArrayAccess $collection) {
    $data = $this->arrayData();
    foreach ($data as $key => $value) {
      $this->assertFalse(isset($collection[$key]));
      $collection[$key] = $value;
      $this->assertTrue(isset($collection[$key]));
      $this->assertSame($value, $collection[$key]);
    }
  }

  protected function runTraversableTests(Arrayable $collection) {
    $data = $this->arrayData();
    $length = count($data);
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

  protected function arrayableTests(Arrayable $collection) {
    $array = $collection->toArray();
    $this->assertEquals($this->arrayData(), $array);
  }

}
