<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\ContentIterator; 

/**
 * Class IteratorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContentIteratorTest extends TestCase {

  use TraversableContentTestTrait;

  /**
   * @return array
   */
  public function iteratorData(): array {
    $range = range('a', 'c');
    $data = [];
    $data[] = [$range];
    $data[] = [[]];
    $data[] = [[new \Sphp\Html\Span('foo')]];
    $data[] = [new \ArrayIterator($range)];
    return $data;
  }

  /**
   * @dataProvider iteratorData
   * 
   * @param  iterable $data
   * @return void
   */
  public function testConstructor(iterable $data): void {
    $it = new ContentIterator($data);
    //$this->assertTrue($it->valid());
    $this->assertCount(count($data), $it);
    $it->rewind();
    if (!is_array($data)) {
      $data = iterator_to_array($data);
    }
    foreach ($data as $key => $value) {
      $this->assertSame($value, $it->current());
      $this->assertSame($key, $it->key());
      $this->assertTrue($it->valid());
      $it->next();
    }
    $toArray = $it->toArray();
    $this->assertEquals($toArray, $data);
    $it->rewind();
    foreach ($toArray as $key => $value) {
      $this->assertSame($value, $it->current());
      $this->assertSame($key, $it->key());
      $this->assertTrue($it->valid());
      $it->next();
    }
    $this->assertFalse($it->valid());
    foreach ($it as $key => $value) {
      $this->assertSame($value, $data[$key]);
      $this->assertTrue($it->valid());
      $it->next();
    }
    foreach ($it as $key => $value) {
      $this->assertSame($value, $data[$key]);
      $this->assertTrue($it->valid());
      $it->next();
    }
    $this->assertSame(implode('', $data), $it->getHtml());
    $this->assertSame(implode('', $it->toArray()), $it->getHtml());
  }

  /**
   * @dataProvider iteratorData
   * 
   * @param  iterable $data
   * @return void
   */
  public function testClone(iterable $data): void {
    $it = new ContentIterator($data);
    $clone = clone $it;
    //$this->assertTrue($it->valid());
    $this->assertCount(count($data), $it);
    $this->assertCount(count($data), $clone);
    $clone->rewind();
    foreach ($it as $key => $value) {
      $this->assertEquals($value, $clone->current());
      $this->assertEquals($key, $clone->key());
      $this->assertTrue($clone->valid());
      if (is_object($value)) {
        $this->assertNotSame($value, $clone->current());
      }
      $clone->next();
    }
    $this->assertSame($clone->getHtml(), $it->getHtml());
  }

  public function create(iterable $content): \Sphp\Html\TraversableContent {
    return new ContentIterator($content);
  }

}
