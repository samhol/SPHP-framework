<?php

namespace Sphp\Html\Attributes;

class AttributeManagerTest extends \PHPUnit_Framework_TestCase {

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  public function setUp() {
    print_r($this->textualData());
  }

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
  public function textualData() {
    return [
        ["data-empty", " "],
        ["type", "text"],
        ["boolean", "true"],
        ["boolean", "false"],
        ["data-var", "value"],
        ["domain1", "obj"]
    ];
  }

  /**
   *
   * @param string $name
   * @param string $value
   * @dataProvider textualData
   */
  public function testTextualVariableSetting($name, $value) {
    $attrs = new AttributeManager();
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
  public function numericData() {
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
   * @covers Sphp\Html\Attributes\AttributeManager::set()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider numericData
   */
  public function testNumericSetting($name, $value) {
    $attrs = new AttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    $this->assertTrue($attrs->exists($name));
    $this->assertTrue(!$attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function booleanData() {
    return [
        ["bool1", true],
        ["bool2", false],
        ["bool1", false],
        ["bool2", true]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::set()
   * @covers Sphp\Html\Attributes\AttributeManager::get()
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider booleanData
   */
  public function testBooleanSetting($name, $value) {
    $attrs = new AttributeManager();
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
  public function unsettingData() {
    return [
        ["null", null],
        ["false", false]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::set()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider unsettingData
   */
  public function testUnsetting($name, $value) {
    $attrs = new AttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === false);
    $this->assertTrue(!$attrs->exists($name));
    $this->assertTrue(!$attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function emptyData() {
    return [
        ["string", ""],
        ["boolean", true]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider emptyData
   */
  public function testEmptySetting($name, $value) {
    $attrs = new AttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    $this->assertTrue($attrs->exists($name));
    $this->assertTrue($attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData() {
    return [
        ["string", ""],
        ["boolean", true],
        ["float", 0.1],
        ["zero", 0]
    ];
  }

  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider lockingData
   */
  public function testLocking($name, $value) {
    $attrs = new AttributeManager();
    $attrs->set($name, $value);
    $this->assertTrue(!$attrs->isLocked($name));
    $attrs->lock($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    //$this->assertTrue($attrs->exists($name));
    $this->assertTrue($attrs->isLocked($name));
  }

  /**
   * 
   * @return string[]
   */
  public function lockDemandData() {
    return [
        ["string1", ""],
        ["string2", "string"],
        ["bool", true],
        ["int", 0],
        ["float", 0.1]
    ];
  }
  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   * @param string $name
   * @param string $value numeric value
   * @dataProvider lockDemandData
   */
  public function lockDemandTest($name, $value) {
    $attrs = new AttributeManager();
    $attrs->lock($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    $this->assertTrue(!$attrs->isLocked($name));
    $attrs->demand($name);
    $this->assertTrue($attrs->isDemanded($name));
  }
  
  
  /**
   * @covers Sphp\Html\Attributes\AttributeManager::isEmpty()
   * 
   */
  public function notExistsTest() {
    $attrs = new AttributeManager();
    $this->assertTrue($attrs->get("foo") === false);
    $this->assertTrue(!$attrs->isLocked("foo") === false);
    $this->assertTrue(!$attrs->isDemanded("foo") === false);
    $this->assertTrue(!$attrs->exists("foo") === false);
  }
}
