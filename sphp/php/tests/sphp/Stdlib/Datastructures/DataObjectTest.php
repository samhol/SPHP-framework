<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;

class DataObjectTest extends TestCase {

  public function testArrayAccessAndIterator() {
    $mock = new DataObject();
    $items = array(
        'zero' => 0,
        'one' => FALSE,
        'two' => 'good job',
        'three' => new \stdClass(),
        'four' => array(),
    );
    $totalCount = count($items);
    foreach ($items as $key => $value) {
      $this->assertFalse(isset($mock[$key]));
      $mock[$key] = $value;
      $this->assertSame($items[$key], $mock[$key]);
      $this->assertTrue(isset($mock[$key]));
    }
    $this->assertCount($totalCount, $mock);

    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($items);
      foreach ($mock as $key => $val) {
        if ($i >= $totalCount) {
          $this->fail("Iterator " . DataObject::class . " overflow!");
        }
        $this->assertEquals(key($items), $key);
        $this->assertEquals(current($items), $val, "Value at position '$key' is not what was expected!");
        next($items);
        ++$i;
      }
      $this->assertEquals($totalCount, $i);
    }
  }

}
