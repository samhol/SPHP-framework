<?php

namespace Sphp\Html\Foundation\F6\Grids;

class AbstractRowTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Column
   */
  protected $row;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->row = new Row();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
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
  public function testConstructor(array $data) {
    $numCols = count($data);
    $row = new Row($data);
    $this->assertCount($numCols, $row);
    foreach ($row as $col) {
      $this->assertTrue($col instanceof ColumnInterface);
      $this->assertEquals($col->getWidth("small"), 12 / $numCols);
    }
  }

  /**
   *
   * @param mixed[] $data
   * @dataProvider arrayData
   */
  public function testAppend($data) {
    $numCols = count($data);
    foreach ($data as $key => $val) {
      $this->row->append($val);
      $this->assertTrue($this->row->offsetExists($key));
      $this->assertTrue($this->row->offsetGet($key) instanceof ColumnInterface);
    }
    $this->assertCount($numCols, $this->row);
    foreach ($this->row as $col) {
      echo "\nsmall:";
      var_dump($col->getWidth("small"));
      echo $col->cssClasses();
      $this->assertEquals($col->getWidth("small"), 12);
    }
  }

  /**
   * 
   * @return string[]
   */
  public function aoffsetSettingData() {
    return [
        ["small", 2, 8],
        ["medium", 2, 8],
        ["large", 2, 8],
        ["xlarge", 2, 8],
        ["xxlarge", 2, 8],
    ];
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   * @param int|boolean $offset
   * @dataProvider offsetSettingData
   */
  public function atestsetGridOffset($type, $size, $offset) {
    $this->row->setGridOffset($offset, $type);
    $this->assertSame($this->row->getGridOffset($type), $offset);
    $this->row->setWidth($size, $type);
    $this->assertSame($this->row->getWidth($type), $size);
    $this->assertSame($this->row->countUsedSpace($type), $size + $offset);
    if ($type !== "small") {
      $this->row->setWidthInherited($type);
    }
    $this->assertSame($this->row->getWidth($type), $this->row->getWidth("small"));
    $this->assertSame($this->row->countUsedSpace($type), $this->row->getWidth("small") + $offset);
  }

  /**
   * 
   * @return string[]
   */
  public function sizeNames() {
    return [
        ["small"],
        ["medium"],
        ["large"],
        ["xlarge"],
        ["xxlarge"],
    ];
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   * @param int|boolean $offset
   * @dataProvider sizeNames
   */
  public function atestsetCentering($type) {
    $this->row->centerize($type);
    $this->assertTrue($this->row->hasCssClass("$type-centered"));
    $this->assertFalse($this->row->hasCssClass("$type-uncentered"));
    $this->row->uncenterize($type);
    $this->assertTrue($this->row->hasCssClass("$type-uncentered"));
    $this->assertFalse($this->row->hasCssClass("$type-centered"));
    $this->row->unsetCenterizing($type);
    $this->assertFalse($this->row->hasCssClass("$type-uncentered"));
    $this->assertFalse($this->row->hasCssClass("$type-centered"));
  }

}
