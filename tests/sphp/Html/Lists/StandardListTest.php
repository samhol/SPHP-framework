<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Lists;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Lists\StandardList;
use Sphp\Html\Lists\StandardListItem;
use Sphp\Html\Lists\Li;

abstract class StandardListTest extends TestCase {

  /**
   * @var StandardList
   */
  protected $list;

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
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
    $this->assertInstanceOf(StandardListItem::class, $obj);
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
    $this->assertInstanceOf(StandardListItem::class, $item);
    $this->assertSame($data, $item->offsetGet(0));
  }

}
