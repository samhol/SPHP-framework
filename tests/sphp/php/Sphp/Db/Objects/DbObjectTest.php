<?php

namespace Sphp\Db;

class DbObjectTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Db
   */
  protected $db;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->db = new Db();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->db;
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



}
