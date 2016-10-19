<?php

namespace Sphp\Html\Foundation\F6\Grids;

class ColumnPropsTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Column
   */
  protected $c1;

  /**
   * @var Column
   */
  protected $c2;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->c1 = new Column();
    $this->c2 = new Column();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->c1, $this->c2);
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

}
