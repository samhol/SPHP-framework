<?php

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\ContainerCell;

abstract class ContainerCellTests extends AbstractCellTests {

  /**
   * @var ContainerCell
   */
  protected $cell;

  /**
   * @return array
   */
  public function cellData(): array {
    return [
        ['string'],
        [''],
        [0],
    ];
  }

  /**
   * @dataProvider cellData
   */
  public function testAppend($data) {
    $this->cell->append($data);
    $this->assertSame($data, $this->cell->offsetGet(0));
  }

  /**
   * @dataProvider cellData
   */
  public function testPrepend($data) {
    $this->cell->append('foo');
    $this->cell->prepend($data);
    $this->assertSame($data, $this->cell->offsetGet(0));
  }

}
