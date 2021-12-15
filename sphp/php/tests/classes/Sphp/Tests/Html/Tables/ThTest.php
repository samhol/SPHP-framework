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
use Sphp\Html\Tables\Th;

class ThTest extends CellTest {

  public function createCell(): Cell {
    return new Th();
  }

  /**
   * @var Th
   */
  protected $cell;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->cell = new Th();
  }

  /**
   * @return array
   */
  public function scopeData(): array {
    return [
        ['row'],
        ['col'],
        ['rowgroup'],
        ['colgroup'],
    ];
  }

  /**
   * @dataProvider scopeData
   */
  public function testScope(string $scope = null) {
    $this->cell->setScope($scope);
    $this->assertSame($scope, $this->cell->getScope());
    $this->assertSame('<th scope="' . $scope . '">', $this->cell->getOpeningTag());
    $th = new Th('foo', 1, 1, $scope);
    $this->assertSame($scope, $th->getScope());
  }

}
