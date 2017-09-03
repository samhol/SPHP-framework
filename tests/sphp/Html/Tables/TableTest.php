<?php

namespace Sphp\Html\Tables;

class TableTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var Table
   */
  protected $table;

  /**
   * @return Container
   */
  public function createContainer() {
    return new Table();
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->table = new Table();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->table);
  }

  /**
   * 
   * @return array
   */
  public function bodytData() {
    return [
        [
            [
                ["rose", 1.25, 15],
                ["daisy", 0.75, 25],
                ["orchid", 1.15, 7]
            ]
        ]
    ];
  }

  /**
   * 
   * @dataProvider bodytData
   * @param mixed $val
   */
  public function testInsertBody($val) {
    $this->table->tbody()->fromArray($val);
    //$this->assertTrue($this->table->tbody()->offsetExists(0));
    //$this->assertTrue($this->table->offsetExists(1));
    $this->assertEquals($this->table->count('tr'), 3);
    $this->assertEquals($this->table->count('td'), 9);
    $this->table->thead()->fromArray($val);
    // $this->assertEquals($this->table->count(Table::COUNT_ROWS), 6);
    // $this->assertEquals($this->table->count(Table::COUNT_CELLS), 18);
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function tesstPrepend($val) {
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
  public function tesstOffsetSet($val) {
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
  public function tesstClear(array $data) {
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
  public function tesstIterator(array $data) {
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
  public function tesstExists($val) {
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
  public function tesstClone() {
    $this->container->append(new Container("a"));
    $clone = clone $this->container;
    $this->container[0][0] = "b";
    //$this->container->clear();
    $this->assertEquals($clone->count(), 1);
    $this->assertEquals($clone[0][0], "a");

    $this->assertEquals($this->container[0][0], "b");
  }

}
