<?php

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\Ul;

class UlTest extends StandardListTest {

  /**
   * @var Ul
   */
  protected $list;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->list = new Ul();
  }

}
