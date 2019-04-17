<?php

namespace Sphp\Tests\Html\Tables;

use Sphp\Html\Tables\Tr;
use Sphp\Html\Tables\Td;
use Sphp\Html\Tables\Th;

class TrTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var Tr
   */
  protected $row;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->row = new Tr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
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
   * 
   * @param mixed $data
   */
  public function testAppendTd($data) {
    $obj = $this->row->appendTd($data);
    $this->assertInstanceOf(Td::class, $obj);
    $this->assertSame($data, $obj->offsetGet(0));
  }

  /**
   * @dataProvider cells
   * 
   * @param mixed $data
   */
  public function testAppendTh($data) {
    $obj = $this->row->appendTh($data);
    $this->assertInstanceOf(Th::class, $obj);
    $this->assertSame($data, $obj->offsetGet(0));
  }

  /**
   * @dataProvider cells
   * 
   * @param mixed $data
   */
  public function testPrepend($data) {
    $td = $this->row->prepend(new Td($data));
    $this->assertSame($data, $td->offsetGet(0));
    $th = $this->row->prepend(new Th($data));
    $this->assertInstanceOf(Th::class, $th);
    $this->assertSame($data, $th->offsetGet(0));
  }

}
