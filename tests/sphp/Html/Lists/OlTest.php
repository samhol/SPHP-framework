<?php

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\Ol;

class OlTest extends StandardListTest {

  /**
   * @var Ol
   */
  protected $list;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->list = new Ol();
  }

  /**
   * @return array
   */
  public function types(): array {
    return [
        ['1'],
        ['a'],
        ['A'],
        ['i'],
        ['I'],
    ];
  }

  /**
   * @dataProvider types
   * 
   * @param mixed $data
   */
  public function testSetListType($data) {
    $this->list->setListType($data);
    $this->assertSame($this->list->getAttribute('type'), $data);
  }

}
