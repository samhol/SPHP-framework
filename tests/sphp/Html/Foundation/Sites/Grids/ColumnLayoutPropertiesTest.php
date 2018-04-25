<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Div;

class ColumnLayoutPropertiesTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var ColumnLayoutManager
   */
  protected $c;

  /**
   * @var Div
   */
  protected $col;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->col = new Div('column content');
    $this->c = new ColumnLayoutManager($this->col);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->c);
  }


  public function testSetWidths() {
    $this->c->setWidths('small-12', 'small-1');
    $this->assertTrue($this->col->hasCssClass('small-1'));
    $this->c->setWidths(['large-12', 'large-1', 'large-3']);
    $this->assertFalse($this->col->hasCssClass('small-1', 'large-3'));
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
    $this->c->setOffsets('small-offset-12', 'small-offset-1');
    $this->assertTrue($this->col->hasCssClass('small-offset-1'));
    $this->c->setOffsets(['large-offset-12', 'large-offset-1', 'large-offset-3']);
    $this->assertTrue($this->col->hasCssClass('small-offset-1', 'large-offset-3'));
  }



}
