<?php

use Sphp\Html\Attributes\AttributeInterface;

abstract class AttributeObjectTest extends \PHPUnit_Framework_TestCase {

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    echo "\ntearDown:\n";
  }

  /**
   * @return AttributeInterface
   */
  abstract public function createAttr($name = "data-attr");

  /**
   * 
   * @return string[]
   */
  public function scalarData() {
    return [
        ["", true],
        [" ", true],
        [true, true],
        [false, false],
        [0, true]
    ];
  }

  /**
   * 
   * @covers AttributeInterface::set()
   * @dataProvider scalarData
   */
  public function testScalarSetting($value, $expected) {
    $attr = $this->createAttr();
    $attr->set($value);
    var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($attr->isLocked());
    $this->assertFalse($attr->isLocked($value));
    $this->assertFalse($attr->isDemanded());
    $this->assertTrue($attr->isVisible());
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
    $attr = $this->createAttr();
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
  public function testScalarLocking($value) {
    $attr = $this->createAttr();
    $attr->lock($value);
    $this->assertTrue($attr->isLocked($value));
    $this->assertTrue($attr->isLocked());
    $this->assertTrue($attr->contains($value));
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
    $attr = $this->createAttr();
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
    $attr = $this->createAttr();
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
    $attr = $this->createAttr();
    $attr->add("a b");
    $this->assertEquals("$attr", 'class="a b"');
    $attr->lock("c d");
    $this->assertEquals("$attr", 'class="a b c d"');
  }

}
