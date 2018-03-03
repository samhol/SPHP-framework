<?php

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\StandardList;
use Sphp\Html\Lists\LiInterface;
use Sphp\Html\Lists\Li;

abstract class StandardListTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var StandardList
   */
  protected $list;


  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->list);
  }

  /**
   * @return array
   */
  public function items(): array {
    return [
        ['string'],
        [''],
        [0],
    ];
  }

  /**
   * @dataProvider items
   * 
   * @param mixed $data
   */
  public function testAppend($data) {
    $obj = $this->list->append($data);
    $this->assertInstanceOf(LiInterface::class, $obj);
    $this->assertSame($data, $obj->offsetGet(0));
  }

  /**
   * @dataProvider items
   * 
   * @param mixed $data
   */
  public function testPrepend($data) {
    $this->list->prepend(new Li('foo'));
    $item = $this->list->prepend(new Li($data));
    $this->assertInstanceOf(LiInterface::class, $item);
    $this->assertSame($data, $item->offsetGet(0));
  }

}
