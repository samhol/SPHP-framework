<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Attributes\MultiValueAttribute;

class ColumnLayoutPropertiesTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var ColumnLayoutManager
   */
  protected $c;

  /**
   * @var MultiValueAttribute
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attr = new MultiValueAttribute('class');
    $this->c = new ColumnLayoutManager($this->attr);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->c);
  }

  /**
   * 
   * @return string[]
   */
  public function setWidthsData() {
    return [
        [['small-1', 'medium-12'], [1, 12, 12, 12, 12]],
        [['small-1', 'small-12'], [12, 12, 12, 12, 12]],
    ];
  }

  /**
   *
   * @param string $widths
   * @param string $result
   * @dataProvider setWidthsData
   */
  public function testSetWidths(array $widths, array $result) {
    $this->c->setWidths($widths);
    echo $this->c;
    $sizes = \Sphp\Html\Foundation\Sites\Core\Screen::sizes();
    foreach ($result as $k => $value) {
      $this->assertSame($this->c->getWidth($sizes[$k]), $value);
    }
  }

  /**
   * 
   * @return string[]
   */
  public function widthSettingData() {
    return [
        ['small', 2],
        ['medium', 2],
        ['large', 2],
        ['xlarge', 2],
        ['xxlarge', 2],
    ];
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   * @dataProvider widthSettingData
   */
  public function testSetWidth($type, $size) {
    $this->c->setWidth($size, $type);
    $this->assertSame($this->c->getWidth($type), $size);
    if ($type !== 'small') {
      $this->c->unsetWidth($type);
    }
    $this->assertSame($this->c->getWidth($type), $this->c->getWidth('small'));
  }

  /**
   * 
   * @return string[]
   */
  public function offsetSettingData() {
    return [
        ['small', 2, 8],
        ['medium', 2, 8],
        ['large', 2, 8],
        ['xlarge', 2, 8],
        ['xxlarge', 2, 8],
    ];
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   * @param int|boolean $offset
   * @dataProvider offsetSettingData
   */
  public function testsetOffset($type, $size, $offset) {
    $this->c->setOffset($offset, $type);
    $this->assertSame($this->c->getOffset($type), $offset);
    $this->c->setWidth($size, $type);
    $this->assertSame($this->c->getWidth($type), $size);
    $this->assertSame($this->c->countUsedSpace($type), $size + $offset);
    if ($type !== 'small') {
      $this->c->unsetWidth($type);
    }
    $this->assertSame($this->c->getWidth($type), $this->c->getWidth('small'));
    $this->assertSame($this->c->countUsedSpace($type), $this->c->getWidth('small') + $offset);
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
    $this->c->centerize($type);
    $this->assertTrue($this->attr->contains("$type-centered"));
    $this->assertFalse($this->attr->contains("$type-uncentered"));
    $this->c->uncenterize($type);
    $this->assertTrue($this->attr->contains("$type-uncentered"));
    $this->assertFalse($this->attr->contains("$type-centered"));
    $this->c->unsetCenterizing($type);
    $this->assertFalse($this->attr->contains("$type-uncentered"));
    $this->assertFalse($this->attr->contains("$type-centered"));
  }

}
