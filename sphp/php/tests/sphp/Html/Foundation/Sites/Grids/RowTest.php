<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use PHPUnit\Framework\TestCase;

class RowTest extends TestCase {

  /**
   * @var BasicRow
   */
  protected $row;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->row = new BasicRow();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->row);
  }

  /**
   * 
   * @return string[]
   */
  public function arrayData() {
    return [
        [[1]],
        [range(1, 2)],
        [range(1, 3)],
        [range(1, 4)],
        [range(1, 6)],
        [range(1, 12)],
    ];
  }

  /**
   *
   * @param mixed $data
   * @dataProvider arrayData
   */
  public function testConstructor(iterable $data) {
    $numCols = count($data);
    $row = new BasicRow($data);
    $this->assertCount($numCols, $row);
    foreach ($row as $col) {
      $this->assertTrue($col instanceof Cell);
      $this->assertTrue($col->hasCssClass('auto'));
    }
    $this->checkTypes($row);
  }

  /**
   *
   * @param mixed[] $data
   * @dataProvider arrayData
   */
  public function testAppend(iterable $data) {
    $numCols = count($data);
    foreach ($data as $key => $val) {
      $this->row->appendCell($val);
    }
    $this->assertCount($numCols, $this->row);
    foreach ($this->row as $col) {
      $this->assertTrue($col instanceof Cell);
      $this->assertTrue($col->hasCssClass('auto'));
    }
    $this->checkTypes($this->row);
  }

  /**
   *
   * @param mixed[] $data
   * @dataProvider arrayData
   */
  public function testPrepend($data) {
    $numCols = count($data);
    foreach ($data as $v) {
      $this->row->prepend(new ContainerCell($v));
    }
    $this->assertCount($numCols, $this->row);
    $this->checkTypes($this->row);
  }

  /**
   * 
   * @param Row $row
   */
  protected function checkTypes(Row $row) {
    foreach ($row as $col) {
      $this->assertTrue($col instanceof Cell);
    }
  }

}
