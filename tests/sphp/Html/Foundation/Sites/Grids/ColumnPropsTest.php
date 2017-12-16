<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Div;

class ColumnPropsTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var ColumnLayoutManager
   */
  protected $col;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->col = new ColumnLayoutManager(new Div());
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
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
    return $widths;
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testSetWidths() {
    foreach ($this->widthValues() as $i) {
      $this->col->setWidths("small-$i", "medium-$i", "large-$i", "xlarge-$i", "xxlarge-$i");
      $this->assertTrue($this->col->cssClasses()->contains("small-$i", "medium-$i", "large-$i", "xlarge-$i", "xxlarge-$i"));
      foreach ($this->widthValues() as $j) {
        if ($j === $i) {
          $this->assertTrue($this->col->cssClasses()->contains("small-$j", "medium-$j", "large-$j", "xlarge-$j", "xxlarge-$j"));
        } else {
          $this->assertFalse($this->col->cssClasses()->contains("small-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("medium-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("large-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("xlarge-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("xxlarge-$j"));
        }
      }
    }
  }

  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testUnsetWidth() {
    $this->col->setWidths('small-3', 'large-3');
    $this->assertTrue($this->col->cssClasses()->contains('small-3', 'large-3'));
    $this->col->unsetWidths('small');
    $this->assertFalse($this->col->cssClasses()->contains('small-3'));
    $this->assertTrue($this->col->cssClasses()->contains('large-3'));
    $this->col->unsetWidths('medium');
    $this->assertFalse($this->col->cssClasses()->contains('small-3'));
    $this->assertTrue($this->col->cssClasses()->contains('large-3'));
    $this->col->unsetWidths('xlarge');
    $this->assertFalse($this->col->cssClasses()->contains('small-3'));
    $this->assertTrue($this->col->cssClasses()->contains('large-3'));
    $this->col->unsetWidths('large');
    $this->assertFalse($this->col->cssClasses()->contains('large-3'));
  }
  /**
   *
   * @param string $type
   * @param int|boolean $size
   */
  public function testUnsetAllWidths() {
    $this->col->setWidths('small-3', 'large-3');
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
    $this->col->setWidths('small-12', 'medium-3', 'large-11', 'xxlarge-3', 'auto');
    $this->assertTrue($this->col->cssClasses()->contains('auto'));
    $this->assertFalse($this->col->cssClasses()->contains('xxlarge-3'));
    $this->assertFalse($this->col->cssClasses()->contains('medium-3'));
    $this->assertFalse($this->col->cssClasses()->contains('small-12'));
  }

  /**
   * @return int[]
   */
  public function offsetValues(): array {
    return range(1, 11);
  }

  /**
   * 
   */
  public function testsetOffsets() {
    foreach ($this->offsetValues() as $i) {
      $this->col->setOffsets("small-offset-$i", "medium-offset-$i", "large-offset-$i", "xlarge-offset-$i", "xxlarge-offset-$i");
      $this->assertTrue($this->col->cssClasses()->contains("small-offset-$i", "medium-offset-$i", "large-offset-$i", "xlarge-offset-$i", "xxlarge-offset-$i"));
      foreach ($this->offsetValues() as $j) {
        if ($j === $i) {
          $this->assertTrue($this->col->cssClasses()->contains("small-offset-$j", "medium-offset-$j", "large-offset-$j", "xlarge-offset-$j", "xxlarge-offset-$j"));
        } else {
          $this->assertFalse($this->col->cssClasses()->contains("small-offset-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("medium-offset-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("large-offset-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("xlarge-offset-$j"));
          $this->assertFalse($this->col->cssClasses()->contains("xxlarge-offset-$j"));
        }
      }
    }
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
