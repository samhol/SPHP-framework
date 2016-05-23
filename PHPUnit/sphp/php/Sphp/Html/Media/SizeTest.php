<?php

namespace Sphp\Html\Media;

class SizeTest extends \PHPUnit_Framework_TestCase {

  /**
   * 
   * @return Size
   */
  public function createStack() {
    $stack = new Size();
    return $stack;
  }

  /**
   */
  public function testEmpty() {
    $size = new Size();
    $this->assertFalse($size->getHeight());
    $this->assertFalse($size->getWidth());
    $this->assertFalse($size->hasHeight());
    $this->assertFalse($size->hasWidth());
  }

  public function sizeProvider() {
    return array(
        array(0, 0),
        array(-1, 0),
        array(-1, 3.1415),
        array(0, false),
        array(false, false),
        array(false, 0),
        array("a", "0"),
        array("a", null),
        array(null, null),
        array(null, false)
    );
  }

  /**
   * @dataProvider sizeProvider
   */
  public function testConstruct($w, $h) {
    $size = new Size($w, $h);
    $this->testSize($size, $w, $h);
  }

  protected function testSize(Size $s, $w, $h) {
    if ($w !== false) {
      $this->assertTrue($s->getWidth() === (int) $w);
      $this->assertTrue($s->hasWidth() === true);
    } else {
      $this->assertTrue($s->getWidth() === false);
      $this->assertTrue($s->hasWidth() === false);
    }
    if ($h !== false) {
      $this->assertTrue($s->getHeight() === (int) $h);
      $this->assertTrue($s->hasHeight() === true);
    } else {
      $this->assertTrue($s->getHeight() === false);
      $this->assertTrue($s->hasHeight() === false);
    }
  }

}
