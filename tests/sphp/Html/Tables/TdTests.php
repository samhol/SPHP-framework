<?php

namespace Sphp\Tests\Html\Tables;

class TdTests extends ContainerCellTests {

  /**
   * @var Td
   */
  protected $cell;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->cell = new Td();
  }

}
