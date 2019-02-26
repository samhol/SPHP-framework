<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Div;

class ColumnPropsTest extends TestCase {

  /**
   * @var BasicCellLayoutAdapter
   */
  protected $col;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->col = new BasicCellLayoutAdapter(new Div());
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->col);
  }

  /**
   *
   */
  public function testConstructor() {
    $this->assertTrue($this->col->cssClasses()->contains('cell'));
  }

  /**
   * @return scalar[]
   */
  public function widthValues(): array {
    $widths = range(1, 12);
    $widths[] = 'auto';
    $widths[] = 'shrink';
    return $widths;
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testSetWidths() {
    foreach ($this->widthValues() as $i) {
      $this->col->setWidth("small", $i);
      $this->assertTrue($this->col->cssClasses()->contains("small-$i"));
    }
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testResetWidths() {
    $this->col->setLayouts('small-3', 'large-3');
    $this->assertTrue($this->col->cssClasses()->contains('small-3', 'large-3'));
    $this->col->unsetWidths();
    $this->assertFalse($this->col->cssClasses()->contains('small-3'));
    $this->assertFalse($this->col->cssClasses()->contains('large-3'));
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testUnsetAllWidths() {
    $this->col->setLayouts('small-3', 'large-3');
    $this->assertTrue($this->col->cssClasses()->contains('small-3', 'large-3'));
    $this->col->unsetWidths();
    $this->assertFalse($this->col->cssClasses()->contains('small-3'));
    $this->assertFalse($this->col->cssClasses()->contains('large-3'));
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testAutoWidth() {
    $this->col->setLayouts('small-12', 'medium-3', 'large-11', 'xxlarge-3');
    //echo $this->col->cssClasses();
    $this->assertTrue($this->col->cssClasses()->contains('auto'));
    $this->assertTrue($this->col->cssClasses()->contains('xxlarge-3'));
    $this->assertTrue($this->col->cssClasses()->contains('medium-3'));
    $this->assertTrue($this->col->cssClasses()->contains('small-12'));
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

}
