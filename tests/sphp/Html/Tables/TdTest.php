<?php

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

}
