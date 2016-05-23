<?php

namespace Sphp\Data;

class CollectionTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Collection
   */
  protected $stack;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->coll = new Collection();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->coll->clear();
  }

  public function testNullSetting() {
    $this->coll->set("null", NULL);
    $this->assertTrue(!$this->coll->isEmpty());
    $this->assertEquals($this->coll->count(), 1);
    $this->assertTrue($this->coll->get("null") === NULL);
    $this->assertTrue($this->coll->contains(NULL));
    $this->assertTrue($this->coll->pull("null") === NULL);
    $this->assertTrue($this->coll->isEmpty());
  }

  public function testObjectSetting() {
    $obj = new \stdClass();
    $this->coll->set("obj", $obj);
    $this->assertTrue(!$this->coll->isEmpty());
    $this->assertEquals($this->coll->count(), 1);
    $this->assertTrue($this->coll->get("obj") === $obj);
    $this->assertTrue($this->coll->contains($obj));
    $this->assertTrue($this->coll->pull("obj") === $obj);
    $this->assertTrue($this->coll->isEmpty());
  }

  public function testSetting() {
    $this->assertTrue(!$this->coll->set("offset", "value")->isEmpty());
    $this->assertTrue($this->coll->get("offset") === "value");
    $this->assertTrue($this->coll->push("pushed1")->contains("pushed1"));
    $this->assertTrue($this->coll->push("pushed2")->contains("pushed1"));
    $this->assertEquals($this->coll->pull("offset"), "value");
  }

  public function testEach() {
    $this->assertTrue(!$this->coll->merge(range("a", "z"))->isEmpty());
    $c = $this->coll->map(function($string) {
      return strtoupper($string);
    });
    $upper = range("A", "Z");
    foreach ($upper as $key => $val) {
      //echo "ARR:$key:$val\n";
      //echo "COL:$key:" . $c[$key] . "\n";
      $this->assertTrue($c->contains($val));
      $this->assertTrue($c[$key] === $val);
    }
    $this->assertEquals($c->count(), count($upper));
  }

}
