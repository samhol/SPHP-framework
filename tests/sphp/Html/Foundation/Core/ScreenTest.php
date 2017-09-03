<?php

namespace Sphp\Html\Foundation\Sites\Core;

class ScreenTest extends \PHPUnit\Framework\TestCase {

  public function testGetPreviousSize() {
    $this->assertSame(Screen::getPreviousSize("small"), false);
    $this->assertSame(Screen::getPreviousSize("medium"), "small");
    $this->assertSame(Screen::getPreviousSize("large"), "medium");
    $this->assertSame(Screen::getPreviousSize("xlarge"), "large");
    $this->assertSame(Screen::getPreviousSize("xxlarge"), "xlarge");
  }

  public function testGetNextSize() {
    $this->assertSame(Screen::getNextSize("small"), "medium");
    $this->assertSame(Screen::getNextSize("medium"), "large");
    $this->assertSame(Screen::getNextSize("large"), "xlarge");
    $this->assertSame(Screen::getNextSize("xlarge"), "xxlarge");
    $this->assertSame(Screen::getNextSize("xxlarge"), false);
  }

  /**
   * 
   * @return string[]
   */
  public function sizeExistsData() {
    return [
        ["foo", false],
        ["", false],
        [null, false],
        ["small", true],
        ["medium", true],
        ["large", true],
        ["xlarge", true],
        ["xxlarge", true],
    ];
  }

  /**
   *
   * @param string $needle
   * @param boolean $result
   * @dataProvider sizeExistsData
   */
  public function testSizeExists($needle, $result) {
    $this->assertSame(Screen::sizeExists($needle), $result);
  }

}
