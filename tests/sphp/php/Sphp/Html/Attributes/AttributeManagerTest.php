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
    $this->attrs = NULL;
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
    $this->assertTrue(!$attrs->isHidden($name));
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
    $this->assertTrue(!$attrs->isHidden($name));
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
      $this->assertTrue(!$attrs->isHidden($name));
    } else {
      $this->assertTrue($attrs->exists($name));
      $this->assertTrue($attrs->isEmpty($name));
      $this->assertTrue(!$attrs->isHidden($name));
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
    $this->assertTrue(!$attrs->isHidden($name));
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
    $this->assertTrue(!$attrs->isHidden($name));
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData() {
    return [
        ["string", ""],
        ["true", true],
        ["true", false],
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
    $attrs->set($name, "shit");
    $this->assertTrue(!$attrs->isLocked($name));
    $attrs->lock($name, $value);
    $this->assertTrue($attrs->get($name) === $value);
    //$this->assertTrue($attrs->exists($name));
    $this->assertTrue($attrs->isLocked($name));
  }

  /**
   *
   * @covers Sphp\Html\Attributes\AttributeManagerTest::set()

    public function testSettingBool() {
    $this->attrs->set("true", TRUE);
    $this->assertEquals("$this->attrs", "true");
    $this->assertTrue($this->attrs->exists("true"));
    $this->assertTrue($this->attrs->get("true") === TRUE);

    $this->attrs->set("false", FALSE);
    $this->assertFalse($this->attrs->exists("false"));
    $this->assertEquals("$this->attrs", "true");

    $this->attrs->set("true", FALSE);
    $this->assertFalse($this->attrs->exists("true"));
    } */
  /**
   *
   * @covers Sphp\Html\Attributes\SimpleAttributeManager::set()

    public function testSettingValues() {
    $this->attrs
    ->set("neg", -1)
    ->set("zero", 0)
    ->set("one", 1);
    echo "\nattrs:$this->attrs\n";
    $this->assertEquals("$this->attrs", 'neg="-1" zero="0" one="1"');
    $this->assertTrue($this->attrs->get("neg") === -1);
    $this->assertTrue($this->attrs->get("zero") === 0);
    $this->assertTrue($this->attrs->get("one") === 1);
    } */
  /**
   *
   * @covers Sphp\Html\Attributes\SimpleAttributeManager::set()

    public function testRequiringValues() {
    $this->attrs
    ->demand("r1")
    ->set("r2", "value")
    ->demand("r2");
    echo "\nattrs:$this->attrs\n";
    $this->assertEquals("$this->attrs", 'r1 r2="value"');
    }
   */
  /**
   *
   * @covers Sphp\Html\Attributes\SimpleAttributeManager::set()

    public function testStyle() {
    $this->attrs["style"]["border"] = "solid 2px black";
    $this->assertEquals($this->attrs["style"]["border"], "solid 2px black");
    }
   */
}
