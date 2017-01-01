<?php

namespace Sphp\Core;

class PathTest extends \PHPUnit_Framework_TestCase {

  public function pathData() {
    return [
        ["manual/pages", true],
        ["manual/pages/Sphp.Manual.php", true],
        ["manual/pages/foo", false],
    ];
  }

  /**
   * @dataProvider pathData
   *
   * @param string $path
   * @param mixed $exists
   */
  public function testVariableSetting($path, $exists) {
    print_r($_SERVER);
    $this->assertTrue(Path::get()->isPathFromRoot($path) === $exists);
  }

}
