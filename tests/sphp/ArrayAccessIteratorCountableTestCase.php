<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests;

abstract class ArrayAccessIteratorCountableTestCase extends \PHPUnit\Framework\TestCase {

  protected function tearDown(): void {
    parent::tearDown();
    \Mockery::close();
  }

  protected function mockArrayIterator(\Mockery\MockInterface $mock, array $items) {
    if ($mock instanceof \ArrayAccess) {
      foreach ($items as $key => $val) {
        $mock->shouldReceive('offsetGet')
                ->with($key)
                ->andReturn($val);
        $mock->shouldReceive('offsetExists')
                ->with($key)
                ->andReturn(TRUE);
      }
      $mock->shouldReceive('offsetExists')
              ->andReturn(FALSE);
    }
    if ($mock instanceof \Iterator) {
      $counter = 0;
      $mock->shouldReceive('rewind')
              ->andReturnUsing(function () use (& $counter) {
                $counter = 0;
              });
      $vals = array_values($items);
      $keys = array_values(array_keys($items));
      $mock->shouldReceive('valid')
              ->andReturnUsing(function () use (& $counter, $vals) {
                return isset($vals[$counter]);
              });
      $mock->shouldReceive('current')
              ->andReturnUsing(function () use (& $counter, $vals) {
                return $vals[$counter];
              });
      $mock->shouldReceive('key')
              ->andReturnUsing(function () use (& $counter, $keys) {
                return $keys[$counter];
              });
      $mock->shouldReceive('next')
              ->andReturnUsing(function () use (& $counter) {
                ++$counter;
              });
    }
    if ($mock instanceof \Countable) {
      $mock->shouldReceive('count')
              ->andReturn(count($items));
    }
  }

}
