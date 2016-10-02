<?php

namespace Sphp\Html\Attributes;

class MultiValueAttributeTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    echo "\ntearDown:\n";
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
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   * @dataProvider parsingData
   */
  public function testParsing($value, $expected) {
    $this->assertEquals(MultiValueAttribute::parse($value), $expected);
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
        ["c1", "", 0],
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
    $this->assertEquals("$attr", 'class="a b"');
    $attr->lock("c d");
    $this->assertEquals("$attr", 'class="a b c d"');
  }

}
