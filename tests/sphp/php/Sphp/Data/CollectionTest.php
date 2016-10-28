<?php

namespace Sphp\Data;

require_once 'StackTestTrait.php';

class CollectionTest extends \PHPUnit_Framework_TestCase {

  use StackTestTrait;

  /**
   * @var Collection
   */
  protected $datastructure;

  protected function setUp() {
    $this->datastructure = new Collection();
  }

  protected function tearDown() {
    unset($this->datastructure);
  }

  public function testNullSetting() {
    $this->datastructure->set("null", NULL);
    $this->assertTrue(!$this->datastructure->isEmpty());
    $this->assertEquals($this->datastructure->count(), 1);
    $this->assertTrue($this->datastructure->get("null") === NULL);
    $this->assertTrue($this->datastructure->contains(NULL));
    $this->assertTrue($this->datastructure->pull("null") === NULL);
    $this->assertTrue($this->datastructure->isEmpty());
  }

  public function testObjectSetting() {
    $obj = new \stdClass();
    $this->datastructure->set("obj", $obj);
    $this->assertTrue(!$this->datastructure->isEmpty());
    $this->assertEquals($this->datastructure->count(), 1);
    $this->assertTrue($this->datastructure->get("obj") === $obj);
    $this->assertTrue($this->datastructure->contains($obj));
    $this->assertTrue($this->datastructure->pull("obj") === $obj);
    $this->assertTrue($this->datastructure->isEmpty());
  }

  public function testSetting() {
    $this->assertTrue(!$this->datastructure->set("offset", "value")->isEmpty());
    $this->assertTrue($this->datastructure->get("offset") === "value");
    $this->assertTrue($this->datastructure->push("pushed1")->contains("pushed1"));
    $this->assertTrue($this->datastructure->push("pushed2")->contains("pushed1"));
    $this->assertEquals($this->datastructure->pull("offset"), "value");
  }

  public function testEach() {
    $this->assertTrue(!$this->datastructure->merge(range("a", "z"))->isEmpty());
    $c = $this->datastructure->map(function($string) {
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
