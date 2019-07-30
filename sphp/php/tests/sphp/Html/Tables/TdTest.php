<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Td;

class TdTest extends ContainerCellTests {

  /**
   * @var Td
   */
  protected $cell;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->cell = new Td();
  }

  public function tdData(): array {
    $data = [];
    $data[] = ['foo', 1, 2];
    $data[] = ['foo', 2, 3];
    return $data;
  }

  /**
   * @dataProvider tdData
   * @param mixed $data
   * @param int $colspan
   * @param int $rowspan
   */
  public function testOutput($data, int $colspan, int $rowspan) {
    $td = new Td($data, $colspan, $rowspan);
    $this->assertSame("<td {$td->attributes()}>{$data}</td>", (string) $td);
  }

}
