<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Datastructures\ObjectStorage;
/**
 * Implementation of ObjectStorageTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ObjectStorageTest extends TestCase {

  public function testConstructor() {
    $storage = new ObjectStorage();
    $this->assertCount(0, $storage);
    $this->assertTrue($storage->toQueue()->isEmpty());
    $this->assertTrue($storage->toStack()->isEmpty());
    return $storage;
  }

  /**
   * @depends testConstructor
   * @param ObjectStorage $storage
   */
  public function testAttach(ObjectStorage $storage) {
    $obj1 = new \stdClass();
    $obj2 = new \stdClass();
    $hash1 = $storage->attach($obj1);
    $this->assertTrue($storage->containsObject($obj1));
    $this->assertFalse($storage->remove($obj2));
    $this->assertTrue($storage->containsHash($hash1));
    $this->assertSame($obj1, $storage->getObject($hash1));
    $this->assertNotSame($obj2, $storage->getObject($hash1));
    $hash2 = $storage->attach($obj2);
    $this->assertCount(2, $storage);
    $this->assertTrue($storage->remove($obj2));
    $this->assertCount(1, $storage);
    $this->assertFalse($storage->containsObject($obj2));
    $this->assertFalse($storage->containsHash($hash2));
  }

  public function testToOtherTypes(): void {
    $storage = new ObjectStorage();
    $obj1 = new \stdClass();
    $hash1 = $storage->attach($obj1);
    $obj2 = new \stdClass();
    $hash2 = $storage->attach($obj2);
    $obj3 = new \stdClass();
    $hash3 = $storage->attach($obj3);
    $iterator = $storage->getIterator();
    $array = $storage->toArray();
    $queue = $storage->toQueue();
    $stack = $storage->toStack();
    $this->assertCount(3, $iterator);
    $this->assertCount(3, $array);
    //$this->assertCount(3, $queue);
    //$this->assertCount(3, $stack);
    foreach ($iterator as $object) {
      $this->assertContains($object, $array);
    }
    while (!$queue->isEmpty()) {
      $object = $queue->dequeue();
      $this->assertContains($object, $array);
    }
    while (!$stack->isEmpty()) {
      $object = $stack->pop();
      $this->assertContains($object, $array);
    }
  }

}
