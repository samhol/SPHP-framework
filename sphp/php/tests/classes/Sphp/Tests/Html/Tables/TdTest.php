<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Cell;
use Sphp\Html\Tables\Td;

class TdTest extends CellTest {

  public function tdData(): iterable {
    $data = [];
    $data[] = ['foo', 1, 2];
    $data[] = ['foo', 2, 3];
    return $data;
  }

  /**
   * @dataProvider tdData
   * 
   * @param  mixed $data
   * @param  int $colspan
   * @param  int $rowspan
   * @return void
   */
  public function testConstructor($data, int $colspan, int $rowspan):void {
    $td = new Td($data, $colspan, $rowspan);
    $this->assertSame('td',$td->getTagName());
    $this->assertSame("<td {$td->attributes()}>{$data}</td>", (string) $td);
  }

  public function createCell(): Cell {
    return new Td();
  }

}
