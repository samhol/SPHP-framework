<?php

namespace Sphp\Html;

class WrappingContainerTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Collection
   */
  protected $container;
  protected $wrapper;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->wrapper = function ($c) {
      return "wrapped: (" . $c . ")";
    };
    $this->container = new WrappingContainer($this->wrapper);
  }

  public function wrap($value) {
    $w = $this->wrapper;
    return $w($value);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->container);
  }

  public function testNullSetting() {
    $this->container->append(NULL);
    $this->assertTrue($this->container->count() === 1);
    $this->assertEquals($this->container->count(), 1);
    $this->assertEquals($this->container->offsetGet(0), "wrapped: ()");
  }

  public function testStringSetting() {
    $obj = "text";
    $this->container->offsetSet("text", $obj);
    $this->assertTrue($this->container->count() == 1);
    $this->assertEquals($this->container->count(), 1);
    $this->assertTrue($this->container->offsetGet("text") === "wrapped: ($obj)");
  }

  public function testTraversing() {
    $arr = range("a", "h");
    foreach ($arr as $v) {
      $this->container->append($v);
    }
    foreach ($this->container as $key => $val) {
      $this->assertEquals($this->wrap($arr[$key]), $val);
    }
  }

  /**
   * 
   * @return type
   */
  public function appendData() {
    return [
        [null],
        ['a'],
        [new Container()],
        [0]
    ];
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function testAppend($val) {
    $this->container->append("foo");
    $this->container->append($val);
    $this->assertTrue($this->container->offsetExists(0));
    $this->assertTrue($this->container->offsetExists(1));
    $this->assertEquals($this->container->count(), 2);
    $this->assertEquals($this->container[1], $this->wrap($val));
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function testPrepend($val) {
    $this->container->append("foo");
    $this->container->prepend($val);
    $this->assertTrue($this->container->offsetExists(0));
    $this->assertTrue($this->container->offsetExists(1));
    $this->assertEquals($this->container->count(), 2);
    $this->assertEquals($this->container[0], $this->wrap($val));
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function testOffsetSet($val) {
    $this->container->append("foo");
    $this->container[] = $val;
    $this->container['a'] = $val;
    $this->assertTrue($this->container->offsetExists(0));
    $this->assertFalse($this->container->offsetExists(''));
    $this->assertTrue($this->container->offsetExists('a'));
    $this->assertEquals($this->container->count(), 3);
    //$this->assertEquals($this->container[""], $this->wrap($val));
    $this->assertEquals($this->container["a"], $this->wrap($val));
  }

  /**
   * 
   * @return mixed[]
   */
  public function arrayData() {
    return [
        [range('a', 'e')],
        [array_fill(0, 10, new Container())],
        [range(1, 100)]
    ];
  }

  /**
   * 
   * @dataProvider arrayData
   * @param mixed[] $data
   */
  public function testClear(array $data) {
    foreach ($data as $val) {
      $this->container->append($val);
    }
    $this->assertEquals($this->container->count(), count($data));
    $this->container->clear();
    $this->assertEquals($this->container->count(), 0);
  }

  /**
   * 
   * @dataProvider arrayData
   * @param mixed[] $data
   */
  public function testIterator(array $data) {
    foreach ($data as $val) {
      $this->container->append($val);
    }
    $it = $this->container->getIterator();
    foreach ($it as $key => $val) {
      $this->assertEquals($this->container[$key], $val);
    }
  }

  /**
   * 
   */
  public function testClone() {
    $this->container->append(new Container("a"));
    $clone = clone $this->container;
    $this->container[0] = "b";
    //$this->container->clear();
    $this->assertEquals($clone->count(), 1);
    $this->assertEquals($clone[0], $this->wrap("a"));

    $this->assertEquals($this->container[0], $this->wrap("b"));
  }

}
