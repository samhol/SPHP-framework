<?php

namespace Sphp\Data;

require_once 'QueueInterfaceTest.php';

class QueueTest extends QueueInterfaceTest {

  /**
   * @return  Queue
   */
  public function createQueue() {
    return new Queue();
  }

}
