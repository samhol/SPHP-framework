<?php

namespace Sphp\Html\Attributes;

include_once 'AttributeObjectTest.php';

class MultiValueAttributeTest extends \AttributeObjectTest {

  public function createAttr($name = "class") {
    return new MultiValueAttribute($name);
  }

  /**
   * 
   * @return string[]
   */
  public function scalarData() {
    return [
        ["", false, false],
        [" ", false, false],
        [true, true, true],
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
  public function parsingData() {
    return [
        ["", []],
        [" ", []],
        [" c1 ", ["c1"]],
        ["  c1  ", ["c1"]],
        ["c1", ["c1"]],
        ["c1 c2", ["c1", "c2"]],
        [["c1", "c2", "c3"], ["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::parse()
   * @dataProvider parsingData
   */
  public function testParsing($value, $expected) {
    $this->assertEquals(MultiValueAttribute::parse($value), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function settingData() {
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
    $attr = new MultiValueAttribute("class");
    $attr->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($attr->isLocked());
    $this->assertFalse($attr->isLocked($value));
    $this->assertFalse($attr->isDemanded());
    $this->assertEquals($attr->getValue(), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function demandData() {
    return [
        ["c1"],
        [["c1 c2"]],
        [["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   */
  public function testDemanding() {
    $attr = new MultiValueAttribute("class");
    $attr->set(false);
    $attr->demand();
    $this->assertTrue($attr->isDemanded());
    $this->assertEquals("$attr", $attr->getName() . "");
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData() {
    return [
        ["c1"],
        [["c1 c2"]],
        [["c1", "c2", "c3"]]
    ];
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider lockingData
   */
  public function testLocking($value) {
    $attr = new MultiValueAttribute("class");
    $attr->lock($value);
    $this->assertTrue($attr->isLocked($value));
    $this->assertTrue($attr->isLocked());
    $this->assertTrue($attr->contains($value));
  }

  /**
   * 
   * @return string[]
   */
  public function addingData() {
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
    $attr = new MultiValueAttribute("class");
    $attr->add($value);
    $this->assertTrue($attr->contains($value));
    $this->assertTrue($attr->count() === $num);
    $attr->clear();
    $this->assertTrue($attr->count() === 0);
  }

  /**
   * 
   * @return scalar[]
   */
  public function clearingData() {
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
    $attr = new MultiValueAttribute("class");
    $attr->add($add);
    $this->assertTrue($attr->isLocked() === false);
    $attr->lock($lock);
    $this->assertTrue(!$attr->isLocked($add));
    $this->assertTrue($attr->isLocked($lock));
    $attr->clear();
    $this->assertTrue($attr->count() === $count);
  }

  /**
   * 
   * @return scalar[]
   */
  public function removingData() {
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
    $attr = new MultiValueAttribute("class");
    $attr->add("a b c d");
    $attr->remove("a c");
    $this->assertTrue($attr->contains("b d"));
    $attr->lock("a c");
    try {
      $attr->remove("a c");
    } catch (\Exception $ex) {
      $this->assertTrue($ex instanceof UnmodifiableAttributeException);
      $this->assertTrue($attr->contains("a b c d"));
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

}
