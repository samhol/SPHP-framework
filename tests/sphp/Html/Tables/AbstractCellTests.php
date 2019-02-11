<?php

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Cell;

abstract class AbstractCellTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var Cell
   */
  protected $cell;

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->cell);
  }

  /**
   * @return array
   */
  public function spanData(): array {
    return [
        [1, 1],
        [1, 2],
        [2, 1],
        [2, 2],
    ];
  }

  /**
   * @dataProvider spanData
   * @param int $colSpan
   * @param int $rowSpan
   */
  public function testCorrectSpan(int $colSpan, int $rowSpan) {
    $this->assertSame(1, $this->cell->getColspan());
    $this->assertSame(1, $this->cell->getRowspan());
    $this->cell->setColspan($colSpan);
    $this->assertSame($colSpan, $this->cell->getColspan());
    $this->assertSame(1, $this->cell->getRowspan());
    $this->cell->setRowspan($rowSpan);
    $this->assertSame($colSpan, $this->cell->getColspan());
    $this->assertSame($rowSpan, $this->cell->getRowspan());
    $this->cell->setColspan(null);
    $this->cell->setRowspan(null);
    $this->assertSame(1, $this->cell->getColspan());
    $this->assertSame(1, $this->cell->getRowspan());
  }

}
