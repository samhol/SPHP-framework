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
  public function testListType(string $data) {
    $this->assertSame(null, $this->list->getAttribute('type'));
    $this->assertSame('1', $this->list->getListType());
    $this->list->setListType($data);
    $this->assertSame($data, $this->list->getAttribute('type'));
    $this->assertSame($data, $this->list->getListType());
  }
  
  public function testStart() {
    $this->assertSame(1, $this->list->getStart());
    $this->list ->setStart(10);
    $this->assertSame(10, $this->list->getStart());
  }

}
