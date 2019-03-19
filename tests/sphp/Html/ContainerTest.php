<?php

namespace Sphp\Html;

use Sphp\Tests\AbstractArrayAccessIteratorCountableTest;

class ContainerTest extends AbstractArrayAccessIteratorCountableTest {

  /**
   * @var Container
   */
  protected $container;

  /**
   * @return PlainContainer
   */
  public function createContainer(): Container {
    return new PlainContainer();
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->container = $this->createContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->container);
    parent::tearDown();
  }

  protected function arrayAccessTest(\ArrayAccess $component, array $data) {
    foreach ($data as $key => $value) {
      $component[$key] = $value;
      $this->assertTrue(isset($component[$key]));
      $this->assertSame($value, $component[$key]);
      unset($component[$key]);
      $this->assertFalse(isset($component[$key]));
    }
  }

  protected function traversableTest(\Traversable $component, array $data) {
    foreach ($data as $key => $value) {
      $component[$key] = $value;
      $this->assertTrue(isset($component[$key]));
      $this->assertSame($value, $component[$key]);
      unset($component[$key]);
      $this->assertFalse(isset($component[$key]));
    }
  }

  public function testInserting(): Container {
    $c = $this->createContainer();
    $c->append('b');
    $c->append('c');
    $c->prepend('a');
    $this->assertTrue($c->exists('a'));
    $this->assertTrue($c->exists('b'));
    $this->assertTrue($c->exists('c'));
    $this->assertFalse($c->exists('d'));
    $c->resetContent('foobar');
    $this->assertFalse($c->exists('a'));
    $this->assertTrue($c->exists('foobar'));
    return $c;
  }

  /**
   * @depends testInserting
   * @param \Sphp\Html\Container $c
   */
  public function testCountable(Container $c) {
    $c->clear();
    $this->assertCount(0, $c);
    $c->append('b', 'c', 'd');
    $array = $c->toArray();
    $this->assertCount(count($array), $c);
  }

  /**
   * @deprends testCountable
   * @param \Sphp\Html\Container $c
   */
  public function testGetHtml() {
    $c = $this->createContainer();
    $this->assertSame('', $c->getHtml());
    $c->append('b');
    $c->append('c');
    $c->append('d');
    $c->prepend('a');
    $this->assertSame('abcd', $c->getHtml());
    $c2 = $this->createContainer();
    $c->append($c2);
    $this->assertSame('abcd', $c->getHtml());
    $c2->append(' is foo');
    $c->append([' and ', 'bar', ['!']]);
    $this->assertSame('abcd is foo and bar!', $c->getHtml());
    $this->expectException(\Exception::class);
    $c->append(new \ArrayObject([' Shell', ' is', ' not!']));
    $this->assertSame('abc is foo and bar! Shell is not!', $c->getHtml());
    $c->append(new \stdClass());
    //var_dump($c);
    $c->getHtml();
  }

  public function testToArray() {
    $this->container->append('b');
    $this->container->append('c');
    $this->container->append('d');
    $this->container->prepend('a');
    $this->assertCount(4, $this->container);
  }

  public function testFoo() {
    $component = $this->createContainer();
    if ($component instanceof \ArrayAccess) {
      $this->arrayAccessTest($component, array(
          'zero' => 3,
          'one' => FALSE,
          'two' => 'good job',
          'three' => new \stdClass(),
          'four' => array(),
      ));
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
        [new PlainContainer('bar')],
        [0]
    ];
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function testAppend($val) {
    $this->container->append('foo');
    $this->assertSame($this->container[0], 'foo');
    $this->assertTrue($this->container->offsetExists(0));
    $this->assertFalse($this->container->offsetExists(1));
    $this->container->append($val);
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
    $this->container->append('foo');
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
  public function arrayData(): array {
    return [
        [range("a", "e")],
        [array_fill(0, 10, new PlainContainer())],
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
    $this->container->clear()->append((new PlainContainer())->append($val));
    $this->assertTrue($this->container->exists($val));
    $this->assertFalse($this->container->exists("foo"));
  }

  /**
   * 
   */
  public function testClone() {
    $this->container->append(new PlainContainer("a"));
    $clone = clone $this->container;
    $this->container[0][0] = "b";
    //$this->container->clear();
    $this->assertEquals($clone->count(), 1);
    $this->assertEquals($clone[0][0], "a");

    $this->assertEquals($this->container[0][0], "b");
  }

  public function createCollection(): \ArrayAccess {
    return new PlainContainer();
  }

}
