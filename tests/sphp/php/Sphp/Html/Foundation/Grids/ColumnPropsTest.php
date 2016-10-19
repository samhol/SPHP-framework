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
    $this->c1 = new Column(1, 2, 3);
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
    if ($m === false) {
      var_dump($col->getWidth("medium"));
      $this->assertSame($col->getWidth("medium"), $s);
    }
  }

}
