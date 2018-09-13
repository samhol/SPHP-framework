<?php

namespace Sphp\Stdlib\Datastructures;

class PlainIteratorTest extends \Sphp\Tests\ArrayAccessIteratorCountableTestCase {

  public function testMockArrayIterator() {
    $mock = \Mockery::mock(PlainIterator::class);
    $items = array(
        'zero' => 3,
        'one' => FALSE,
        'two' => 'good job',
        'three' => new \stdClass(),
        'four' => array(),
    );
    $this->mockArrayIterator($mock, $items);
    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($items);
      foreach ($mock as $key => $val) {
        if ($i >= 5) {
          $this->fail("Iterator overflow!");
        }
        $this->assertEquals(key($items), $key);
        $this->assertEquals(current($items), $val);
        next($items);
        ++$i;
      }
      $this->assertEquals(5, $i);
    }
  }

}
