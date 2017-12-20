<?php

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\Ol;

class OlTests extends StandardListTests {

  /**
   * @var Ol
   */
  protected $list;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->list = new Ol();
  }

  /**
   * @return array
   */
  public function items(): array {
    return [
        ['1'],
        ['a'],
        ['A'],
        ['i'],
        ['I'],
    ];
  }

  /**
   * @dataProvider typess
   * 
   * @param mixed $data
   */
  public function testSetListType($data) {
    $obj = $this->list->setListType($data);
    $this->assertInstanceOf(LiInterface::class, $obj);
    $this->assertSame($data, $obj->offsetGet(0));
  }

}
