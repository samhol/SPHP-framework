<?php

namespace Sphp\Html;

class ContainerTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var ContainerInterface
   */
  protected $container;

  /**
   * @return Container
   */
  public function createContainer() {
    return new Container();
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->container = $this->createContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->container);
  }

  /**
   * 
   * @return type
   */
  public function appendData() {
    return [
        [null],
        ["a"],
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
    $this->assertEquals($this->container[1], $val);
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
    $this->assertEquals($this->container[0], $val);
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function testOffsetSet($val) {
    $this->container->append("foo");
    $this->container[] = $val;
    $this->container["a"] = $val;
    $this->assertTrue($this->container->offsetExists(0));
    $this->assertTrue($this->container->offsetExists(1));
    $this->assertTrue($this->container->offsetExists("a"));
    $this->assertEquals($this->container->count(), 3);
    $this->assertEquals($this->container[1], $val);
    $this->assertEquals($this->container["a"], $val);
  }

  /**
   * 
   * @return mixed[]
   */
  public function arrayData() {
    return [
        [range("a", "e")],
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
   * @dataProvider appendData
   * @param mixed $val
   */
  public function testExists($val) {
    $this->container->append($val);
    $this->assertTrue($this->container->exists($val));
    $this->assertFalse($this->container->exists("foo"));
    $this->container->clear()->append((new Container())->append($val));
    $this->assertTrue($this->container->exists($val));
    $this->assertFalse($this->container->exists("foo"));
   
  }

  /**
   * 
   */
  public function testClone() {
    $this->container->append(new Container("a"));
    $clone = clone $this->container;
    $this->container[0][0] = "b";
    //$this->container->clear();
    $this->assertEquals($clone->count(), 1);
    $this->assertEquals($clone[0][0], "a");
    
    $this->assertEquals($this->container[0][0], "b");
  }

}
