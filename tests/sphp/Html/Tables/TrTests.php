<?php

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Tr;
use Sphp\Html\Tables\Td;
use Sphp\Html\Tables\Th;
use Sphp\Html\Tables\Cell;

class TrTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var Tr
   */
  protected $row;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->row = new Tr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->row);
  }

  /**
   * @return array
   */
  public function cells(): array {
    return [
        ['string'],
        [''],
        [0],
    ];
  }

  /**
   * @dataProvider cells
   */
  public function testAppend($data) {
    $obj = $this->row->appendTd($data);
    $this->assertSame($data, $obj->offsetGet(0));
  }

  /**
   * @dataProvider cells
   */
  public function testPrepend($data) {
    $this->row->appendTd('foo');
    $obj = $this->row->prepend(new Td($data));
    $this->assertSame($data, $obj->offsetGet(0));
  }

}
