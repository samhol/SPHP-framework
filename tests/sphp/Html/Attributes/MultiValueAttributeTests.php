<?php

namespace Sphp\Html\Attributes;

include_once 'AttributeObjectTest.php';

class MultiValueAttributeTests extends AttributeObjectTest {

  /**
   * @var MultiValueAttribute 
   */
  protected $attrs;

  public function createAttr(string $name = 'class'): AttributeInterface {
    return new MultiValueAttribute($name);
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        [""],
        [" "],
        ["  "],
        ["\n"],
        ["\n\t\r"],
        ["\t"],
        [" \r \n \t "],
        [true],
        [false],
        [[]],
        [[""]],
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider emptyData
   */
  public function testEmptySetting($value) {
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->contains($value));
    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->getValue(), false);
    $this->assertEquals($this->attrs->count(), 0);
  }

  /**
   * 
   * @return string[]
   */
  public function scalarData(): array {
    return [
        ["", false, false],
        [" ", false, false],
        [true, false, false],
        [false, false, false],
        ["value1", "value1", true],
        [" value2 ", "value2", true],
        [0, 0, true],
        [-1, -1, true],
        [1, 1, true],
        [0b100, 0b100, true]
    ];
  }

  /**
   * 
   * @return string[]
   */
  public function parsingData(): array {
    return [
        ["", []],
        [" ", []],
        [" a ", ["a"]],
        ["  a  ", ["a"]],
        ["a", ["a"]],
        ["c1 c2", ["c1", "c2"]],
        [" c1 c2 ", ["c1", "c2"]],
        [range(-1, 1), range(-1, 1)],
        [range("a", "z"), range("a", "z")],
        [
            [],
            []
        ],
        [
            ["", " ", "  ", "\n\t\r"],
            []
        ],
        [[""], []],
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::parse()
   * @dataProvider parsingData
   */
  public function testParsing($value, $expected) {
    
  }

  /**
   * 
   * @return string[]
   */
  public function settingData(): array {
    return [
        [null, false],
        [false, false],
        ["c1", "c1"],
        ["c1 c2", "c1 c2"],
        [["c1", "c2", "c3"], "c1 c2 c3"]
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider settingData
   */
  public function testSetting($value, $expected) {
    $this->attrs->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData(): array {
    return [
        ["c1"],
        [["c1", "c2"]],
        [["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider lockingData
   */
  public function testLocking($value) {
    $this->attrs->lock($value);
    $this->assertTrue($this->attrs->isLocked($value));
    $this->assertTrue($this->attrs->isLocked());
    $this->assertTrue($this->attrs->contains($value));
  }

  /**
   * 
   * @return string[]
   */
  public function addingData(): array {
    return [
        ["c1", 1],
        ["c1 c2 c2", 2],
        [["c1", "c2", "c3", "c3"], 3]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * 
   * @param string $value numeric value
   * @param int $num
   * @dataProvider addingData
   */
  public function testAdding($value, $num) {
    $this->attrs->add($value);
    $this->assertTrue($this->attrs->contains($value));
    $this->assertTrue($this->attrs->count() === $num);
    $this->attrs->clear();
    $this->assertCount(0, $this->attrs);
  }

  /**
   * 
   * @return scalar[]
   */
  public function clearingData(): array {
    return [
        ["c1", "l1", 1],
        ["c1 c2 c2", "li l2", 2],
        [["c1", "c2", "c3", "c3"], ["l1", "l2", "l3", "l3"], 3]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   * @dataProvider clearingData
   *
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testClearing($add, $lock, $count) {
    $this->attrs->add($add);
    $this->assertTrue($this->attrs->isLocked() === false);
    $this->attrs->lock($lock);
    $this->assertTrue(!$this->attrs->isLocked($add));
    $this->assertTrue($this->attrs->isLocked($lock));
    $this->attrs->clear();
    $this->assertTrue($this->attrs->count() === $count);
  }

  /**
   * 
   * @return scalar[]
   */
  public function removingData(): array {
    return [
        ["c1", "", 0],
        ["c1", "l1", 1],
        ["c1 c2 c2", "li l2", 2],
        [["c1", "c2", "c3", "c3"], ["l1", "l2", "l3", "l3"], 3]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::add()
   *
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testRemoving() {
    $this->attrs->add("a b c d");
    $this->attrs->remove("a c");
    $this->assertTrue($this->attrs->contains("b d"));
    $this->attrs->lock("a c");
    try {
      $this->attrs->remove("a c");
    } catch (\Exception $ex) {
      $this->assertTrue($ex instanceof \Sphp\Exceptions\RuntimeException);
      $this->assertTrue($this->attrs->contains("a b c d"));
    }
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\CssClassAttribute::add()
   */
  public function testPrinting() {
    $attr = new MultiValueAttribute("class");
    $attr->add("a b");
    //$this->assertEquals("$attr", 'class="a b"');
    $attr->lock("c d");
    echo "$attr\n";
    //$this->assertEquals("$attr", 'class="a b c d"');
  }

  public function lockMethodData(): array {
    return [
        [1],
        ["a"],
        ["a b c"]
    ];
  }

}
