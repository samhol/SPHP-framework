<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Cell;
use Sphp\Html\Tables\AbstractCell;

class AbstractCellTest extends CellTest {

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

  public function createCell($value = null): Cell {
    return $this->getMockForAbstractClass(AbstractCell::class, ['td', $value]);
  }

  /**
   * @dataProvider spanData
   * 
   * @param  int $colSpan
   * @param  int $rowSpan
   * @return void
   */
  public function testCorrectSpan(int $colSpan, int $rowSpan): void {
    $cell = $this->createCell();
    $this->assertSame(1, $cell->getColspan());
    $this->assertSame(1, $cell->getRowspan());
    $cell->setColspan($colSpan);
    $this->assertSame($colSpan, $cell->getColspan());
    $this->assertSame(1, $cell->getRowspan());
    $cell->setRowspan($rowSpan);
    $this->assertSame($colSpan, $cell->getColspan());
    $this->assertSame($rowSpan, $cell->getRowspan());
    $cell->setColspan(null);
    $cell->setRowspan(null);
    $this->assertSame(1, $cell->getColspan());
    $this->assertSame(1, $cell->getRowspan());
  }

}
