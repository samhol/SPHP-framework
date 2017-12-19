<?php

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\LiInterface;
use Sphp\Html\Lists\Li;

class UlTests extends StandardListTests {

  /**
   * @var Ul
   */
  protected $list;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->list = new Ul();
  }

}
