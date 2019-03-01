<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\BadMethodCallException;

class CellLayoutTest extends TestCase {

  /**
   * @var ContainerCell
   */
  protected $col;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->col = new ContainerCell();
  }

  /**
   * @return Cell
   */
  public function createLayout(): Cell {
    return new ContainerCell();
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
   * @return array
   */
  public function sizeNames(): array {
    return [
        ['small'],
        ['medium'],
        ['large'],
        ['xlarge'],
        ['xxlarge'],
    ];
  }

  public function sizeSettings(): array {
    $widths = range(1, 12);
    $widths[] = 'auto';
    $widths[] = 'shrink';
    return $widths;
  }

  /**
   * @dataProvider sizeNames
   */
  public function testMagicSizeSetting(string $screen) {
    $layout = $this->createLayout();
    foreach ($this->sizeSettings() as $size) {
      $layout->$screen($size);
      $this->assertContainsCssClass($layout, "$screen-$size");
    }
  }

  public function offsets(): array {
    return range(1, 12);
  }

  /**
   * @dataProvider sizeNames
   */
  public function testMagicOffsetSetting(string $screen) {
    $layout = $this->createLayout();
    foreach ($this->offsets() as $value) {
      $layout->{$screen . 'Offset'}($value);
      $this->assertContainsCssClass($layout, "$screen-offset-$value");
    }
    $this->expectException(BadMethodCallException::class);
    $layout->{$screen . 'Offset'}('foo');
  }

  protected function assertNotContainsCssClass( $layout, string... $className) {
    $this->assertFalse($layout->cssClasses()->contains($className));
  }

  protected function assertContainsCssClass( $layout, string... $className) {
    $this->assertTrue($layout->cssClasses()->contains($className));
  }

  public function t2() {

    $layout->small(1);
    $this->assertContainsCssClass($layout, 'small-1');
    $layout->smallOffset(1);
    $this->assertContainsCssClass($layout, 'small-offset-1');
    $layout->small('hide');
    $this->assertContainsCssClass($layout, 'hide-for-small-only');
    $this->assertNotContainsCssClass($layout, 'show-for-small-only');
    $layout->small('show');
    $this->assertContainsCssClass($layout, 'show-for-small-only');
    $this->assertNotContainsCssClass($layout, 'hide-for-small-only');
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

}
