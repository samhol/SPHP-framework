<?php

namespace Sphp\Html\Attributes;

class AttributeManagerTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var HtmlAttributeManager 
   */
  protected $attrs;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    echo "\nsetUp:\n";
    $this->attrs = new HtmlAttributeManager();
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
   * 
   * @return string[]
   */
  public function identifyingData(): array {
    return [
        ["test", 4],
        [null, 4],
        ["a b c d", 4],
        [null, 4]
    ];
  }

  /**
   *
   * @param string $name
   * @param int $length
   * @dataProvider identifyingData
   */
  public function testIdentifying($name, int $length) {
    $this->attrs->identify($name, $length);
    $this->assertTrue(is_string($this->attrs->get($name)));
    $this->assertTrue($this->attrs->exists($name));
    $this->assertTrue(!$this->attrs->isEmpty($name));
    try {
      $this->attrs->set($name, "foo");
    } catch (\Exception $ex) {
      
    }
  }

  /**
   * 
   * @return string[]
   */
  public function textualData(): array {
    return [
        ["data-empty", " "],
        ["type", "text"],
        ["boolean", "true"],
        ["boolean", "false"],
        ["data-var", "value"],
        ["domain1", "obj"],
        ["style", "border:solid 1px #aaa;left:30px;"],
        ["class", "a b c d"]
    ];
  }

  /**
   *
   * @param string $name
   * @param string $value
   * @dataProvider textualData
   */
  public function testTextualVariableSetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    $this->assertTrue($attrs->exists($name));
    $this->assertTrue(!$attrs->isEmpty($name));
    unset($attrs);
  }

  /**
   * 
   * @return string[]
   */
  public function numericData(): array {
    return [
        ["min", "0"],
        ["max", 10],
        ["negative", -10],
        ["negative", "-1"],
        ["float", "1.04"],
        ["float", 2.801],
        ["zero", 0]
    ];
  }

  /**
   * @covers HtmlAttributeManager::set()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider numericData
   */
  public function testNumericSetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    $this->assertTrue($attrs->exists($name));
    $this->assertTrue(!$attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function booleanData(): array {
    return [
        ["bool1", true],
        ["bool2", false],
        ["bool1", false],
        ["bool2", true]
    ];
  }

  /**
   * @covers HtmlAttributeManager::set()
   * @covers HtmlAttributeManager::get()
   * @covers HtmlAttributeManager::isEmpty()
   * 
   * @param string $name
   * @param boolean $value numeric value
   * @dataProvider booleanData
   */
  public function testBooleanSetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    if ($value === false) {
      $this->assertTrue(!$attrs->exists($name));
      $this->assertTrue(!$attrs->isEmpty($name));
    } else {
      $this->assertTrue($attrs->exists($name));
      $this->assertTrue($attrs->isEmpty($name));
    }
  }

  /**
   * 
   * @return string[]
   */
  public function unsettingData(): array {
    return [
        ["null", null],
        ["false", false]
    ];
  }

  /**
   * @covers HtmlAttributeManager::set()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider unsettingData
   */
  public function testUnsetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === false);
    $this->assertTrue(!$attrs->exists($name));
    $this->assertTrue(!$attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function emptyData(): array {
    return [
        ["string", ""],
        ["boolean", true]
    ];
  }

  /**
   * @covers HtmlAttributeManager::isEmpty()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider emptyData
   */
  public function testEmptySetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    $this->assertTrue($attrs->exists($name));
    $this->assertTrue($attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function objectData(): array {
    return [
        [new MultiValueAttribute("data-foo")],
        [new PropertyAttribute("data-bar")],
        [new PropertyAttribute("style")],
        [(new MultiValueAttribute("class"))->add("a b c")],
    ];
  }

  /**
   * @covers HtmlAttributeManager::setAttributeObject()
   * 
   * @param AttributeInterface $obj
   * @dataProvider objectData
   */
  public function testObjectSetting(AttributeInterface $obj) {
    $name = $obj->getName();
    $this->attrs->set($name, 'foo bar'); //isValidObjectType
    $this->attrs->demand($name);
    $this->attrs->setAttributeObject($obj);
    //$this->assertTrue($attrs->exists($name));
    $this->assertTrue($this->attrs->isAttributeObject($name));
    $this->assertTrue($this->attrs->isDemanded($name));
    $this->assertTrue(is_a($obj, get_class($this->attrs->getAttributeObject($name))));

    echo $this->attrs->__toString();
    $this->assertTrue($this->attrs->getIterator() instanceof \Traversable);
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider lockDemandData
   */
  public function testLocking($name, $value) {
    $this->attrs->set($name, $value);
    $this->assertFalse($this->attrs->isLocked($name));
    $this->attrs->lock($name, $value);
    $this->assertTrue($this->attrs->get($name) === $value);
    //$this->assertTrue($attrs->exists($name));
    $this->assertTrue($this->attrs->isLocked($name));
  }

  /**
   * 
   * @return scalar[]
   */
  public function lockDemandData(): array {
    return [
        ['string1', ''],
        ['string2', 'string'],
        ['bool', true],
        ['int', 0],
        ['float', 0.1],
        ['class', 'a b'],
        ['style', 'a:b;']
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @param string $name
   * @param scalar $value numeric value
   * @dataProvider lockDemandData
   */
  public function testLockDemand($name, $value) {
    $this->attrs->demand($name);
    $this->assertTrue($this->attrs->isDemanded($name));
    $this->attrs->set($name, $value);
    $this->assertEquals($this->attrs->get($name), $value);
    $this->assertFalse($this->attrs->isLocked($name));
    $this->attrs->lock($name, $value);
    $this->assertEquals($this->attrs->get($name), $value);
    $this->assertTrue($this->attrs->isLocked($name));
  }

  /**
   * 
   * @return scalar[]
   */
  public function notExistsData(): array {
    return [
        ["style"],
        ["class"],
        ["foo"],
        [0],
        [1]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @dataProvider notExistsData
   */
  public function testNnotExists($attrName) {
    $this->assertTrue($this->attrs->get($attrName) === false);
    $this->assertTrue($this->attrs->isLocked($attrName) === false);
    $this->assertTrue($this->attrs->isDemanded($attrName) === false);
    $this->assertTrue($this->attrs->exists($attrName) === false);
    $this->assertEquals($this->attrs->count(), 0);
  }

}
