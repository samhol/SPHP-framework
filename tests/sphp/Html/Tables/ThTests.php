<?php

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Th;

class ThTests extends ContainerCellTests {

  /**
   * @var Th
   */
  protected $cell;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
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
   * @dataProvider spanData
   */
  public function testScope(string $scope = null) {
    $this->cell->setScope($scope);    
    $this->assertSame($scope, $this->cell->getScope());
    $this->assertSame('<th scope="'.$scope.'">', $this->cell->getOpeningTag());
  }

}
