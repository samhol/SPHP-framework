<?php

namespace Sphp\Db;

class CollectionTest extends \PHPUnit_Framework_TestCase {

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

  public function testInsert() {
    Db::insert("users", new Sphp\Objects\User);
  }



}
