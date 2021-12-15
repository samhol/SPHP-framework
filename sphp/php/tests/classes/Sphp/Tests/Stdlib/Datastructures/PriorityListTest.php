<?php

declare(strict_types=1);

namespace Sphp\Tests\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Datastructures\PriorityList;

class PriorityListTest extends TestCase {

  public function testConstructor(): void {
    $list = new PriorityList();
    $this->assertTrue($list->isLIFO());
    $this->assertCount(0, $list);
    $this->assertCount(0, $list->toArray());
    $this->assertEmpty($list);
    $this->assertEmpty($list->toArray());
  }

  public function testLifo(): void {
    $list = new PriorityList();
    $this->assertTrue($list->isLIFO());
    $list->insert('c', 'c', 1);
    $list->insert('b', 'b', 1);
    $list->insert('a', 'a', 2);
    $this->assertSame('a', $list->current());
    $list->next();
    $this->assertSame('b', $list->current());
    $list->next();
    $this->assertSame('c', $list->current());
    $this->assertTrue($list->valid());
    $list->next();
    $this->assertFalse($list->valid());
    $list->rewind();
    $this->assertTrue($list->valid());
    $this->assertSame('a', $list->current());
  }

  public function testFifo(): void {

    $list = new PriorityList(false);

    $this->assertFalse($list->isLIFO());
    $list->insert('a', 'a', 2);
    $list->insert('b', 'b', 1);
    $list->insert('c', 'c', 1);
    $this->assertSame('a', $list->current());
    $list->next();
    $this->assertSame('b', $list->current());
    $list->next();
    $this->assertSame('c', $list->current());
    $this->assertTrue($list->valid());
    $list->next();
    $this->assertFalse($list->valid());
    $list->rewind();
  }

  public function testSetPriority() {
    $list = new PriorityList();
    $list->insert('b', 'b', 2);
    $list->insert('c', 'c', 1);
    $list->insert('a', 'a', 3);
    $this->assertSame('abc', implode('', $list->toArray()));
    $list->setPriority('a', 1);
    $this->assertSame('bac', implode('', $list->toArray()));
  }

  public function testToArray(): void {
    $list = new PriorityList();
    $list->insert('b', 'b', 2);
    $list->insert('c', 'c', 1);
    $list->insert('a', 'a', 3);
    $this->assertEquals(['a' => 'a', 'b' => 'b', 'c' => 'c'], $list->toArray());
    $this->assertEquals(['a' => 3, 'b' => 2, 'c' => 1], $list->toArray(PriorityList::EXTR_PRIORITY));
  }

  public function testSimple(): void {
    $list = new PriorityList();
    $list->insert('b', 'bb', 1);
    $list->insert('c', 'cc', 1);
    $list->insert('a', 'aa', 2);
    $this->assertCount(3, $list);
    $this->assertContains('aa', $list);
    $this->assertSame('aa', $list->get('a'));
    $list->remove('a');
    $this->assertFalse($list->contains('a'));
    $this->assertCount(2, $list);
    $list->clear();
    $this->assertFalse($list->contains('b'));
    $this->assertFalse($list->contains('c'));
    $this->assertEmpty($list);
    $this->assertCount(0, $list);
  }

  public function priorityData(): array {
    $seq = [];
    $seq['a'] = 10;
    $seq['b'] = 10;
    $seq['c'] = 0;
    $data = [];
    $data[] = [$seq];
    return $data;
  }

  /**
   * @param array $sequence
   * @return void
   */
  public function testPrioritySequence(): void {
    $list = new PriorityList();
    $list->insert('3', 3, 1);
    $list->insert('1', 1, 10);
    $list->insert('2', 2, 10);
    $array = $list->toArray();
    $this->assertCount(3, $list);
    foreach ($list as $key => $value) {
      $this->assertSame($value, $array[$key]);
    }
  }

}
