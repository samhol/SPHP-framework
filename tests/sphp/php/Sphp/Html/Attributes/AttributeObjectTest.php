<?php

use Sphp\Html\Attributes\AttributeInterface;

abstract class AttributeObjectTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   * @var AttributeInterface 
   */
  protected $attrs;
  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    echo "\nsetUp:\n";
    $this->attrs = $this->createAttr();
  }
  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    echo "\ntearDown:\n";
    $this->attrs = null;
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
   * @covers AttributeInterface::set()
   * @dataProvider scalarData
   * @param scalar $value
   * @param scalar $expected
   * @param boolean $visibility
   */
  public function testScalarSetting($value, $expected, $visibility) {
    $this->attrs->set($value);
    $this->assertFalse($this->attrs->isLocked());
    $this->assertFalse($this->attrs->isLocked($value));
    $this->assertFalse($this->attrs->isDemanded());
    $this->assertEquals($this->attrs->isVisible(), $visibility);
    $this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @covers Sphp\Html\Attributes\MultiValueAttribute::lock()
   */
  public function testDemanding() {
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->attrs->set(false);
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName() . "");
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
