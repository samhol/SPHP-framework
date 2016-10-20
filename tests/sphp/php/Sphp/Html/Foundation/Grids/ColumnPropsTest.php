<?php

namespace Sphp\Html\Foundation\F6\Grids;

class ColumnPropsTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Column
   */
  protected $row;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->c1 = new Column();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->c1);
  }

  /**
   * 
   * @return string[]
   */
  public function constructorData() {
    return [
        [null, 2, false, false, false, false],
        [null, 2, false, 2, false, 2],
        [null, 1, 2, 3, 4, 5],
    ];
  }

  /**
   *
   * @param string $name
   * @param string $value
   * @dataProvider constructorData
   */
  public function testColumnCostructor($content, $s, $m, $l, $xl, $xxl) {
    $col = new Column($content, $s, $m, $l, $xl, $xxl);
    $this->assertSame($col->getWidth("small"), $s);
    if ($m !== false) {
      $this->assertSame($col->getWidth("medium"), $m);
    }
    if ($l !== false) {
      $this->assertSame($col->getWidth("large"), $l);
    }
    if ($xl !== false) {
      $this->assertSame($col->getWidth("xlarge"), $xl);
    }
    if ($xxl !== false) {
      $this->assertSame($col->getWidth("xxlarge"), $xxl);
    }
  }

  /**
   * 
   * @return string[]
   */
  public function widthSettingData() {
    return [
        ["small", 2],
        ["medium", 2],
        ["large", 2],
        ["xlarge", 2],
        ["xxlarge", 2],
    ];
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   * @dataProvider widthSettingData
   */
  public function testSetWidth($type, $size) {
    $this->c1->setWidth($size, $type);
    $this->assertSame($this->c1->getWidth($type), $size);
    if ($type !== "small") {
      $this->c1->setWidthInherited($type);
    }
    $this->assertSame($this->c1->getWidth($type), $this->c1->getWidth("small"));
  }

  /**
   * 
   * @return string[]
   */
  public function offsetSettingData() {
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
  public function testsetGridOffset($type, $size, $offset) {
    $this->c1->setGridOffset($offset, $type);
    $this->assertSame($this->c1->getGridOffset($type), $offset);
    $this->c1->setWidth($size, $type);
    $this->assertSame($this->c1->getWidth($type), $size);
    $this->assertSame($this->c1->countUsedSpace($type), $size + $offset);
    if ($type !== "small") {
      $this->c1->setWidthInherited($type);
    }
    $this->assertSame($this->c1->getWidth($type), $this->c1->getWidth("small"));
    $this->assertSame($this->c1->countUsedSpace($type), $this->c1->getWidth("small") + $offset);
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
  public function testsetCentering($type) {
    $this->c1->centerize($type);
    $this->assertTrue($this->c1->hasCssClass("$type-centered"));
    $this->assertFalse($this->c1->hasCssClass("$type-uncentered"));
    $this->c1->uncenterize($type);
    $this->assertTrue($this->c1->hasCssClass("$type-uncentered"));
    $this->assertFalse($this->c1->hasCssClass("$type-centered"));
    $this->c1->unsetCenterizing($type);
    $this->assertFalse($this->c1->hasCssClass("$type-uncentered"));
    $this->assertFalse($this->c1->hasCssClass("$type-centered"));
  }

}
