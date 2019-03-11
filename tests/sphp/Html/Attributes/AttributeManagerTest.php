<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\GeneralAttribute;
use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\ClassAttribute;

class AttributeManagerTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var HtmlAttributeManager 
   */
  protected $attrs;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->attrs = new HtmlAttributeManager();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    $this->attrs = null;
  }

  /**
   * @return mixed[]
   */
  public function mixedData(): array {
    return [
        [0.231],
        [0.0],
        [10],
        [-10],
        [true],
        [false],
    ];
  }

  /**
   * @param string $value numeric value
   * @dataProvider mixedData
   */
  public function testSetting($value) {
    $this->attrs->setAttribute('data-attr', $value);
    $this->attrs->setInstance(new GeneralAttribute('data-obj', $value));
    $this->assertSame($this->attrs->getValue('data-obj'), $this->attrs->getValue('data-attr'));
  }

  /**
   * @return string[]
   */
  public function identifyingData(): array {
    return [
        [4],
        [4],
        [4],
        [4]
    ];
  }

  /**
   * @param int $length
   * @dataProvider identifyingData
   */
  public function testIdentifying(int $length) {
    $this->attrs->identify($length);
    $this->assertTrue(is_string($this->attrs->getValue('id')));
    $this->assertTrue($this->attrs->isVisible('id'));
    $this->assertTrue($this->attrs->isVisible('id'));
  }

  /**
   * @return string[]
   */
  public function textualData(): array {
    return [
        ["data-empty", " "],
        ["type", "text"],
        ["boolean", "true"],
        ["boolean", "false"],
        ['data-var', "value"],
        ["domain1", "obj"],
        ['style', 'border:solid 1px #aaa;left:30px;'],
        ['class', 'a b c d']
    ];
  }

  /**
   * @param string $name
   * @param string $value
   * @dataProvider textualData
   */
  public function testTextualVariableSetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $this->assertFalse($attrs->isVisible($name));
    $attrs->setAttribute($name, $value);
    $this->assertTrue($attrs->getValue($name) === $value);
    $this->assertTrue($attrs->isVisible($name));
    $this->assertTrue($attrs->isVisible($name));
    unset($attrs);
  }

  /**
   * 
   * @return string[]
   */
  public function numericData(): array {
    return [
        ['float', 0.231],
        ["float", 0.0],
        ['int', 10],
        ['int', -10],
        ['zero', 0],
        ['zero', -0]
    ];
  }

  /**
   * @param string $name
   * @param string $value numeric value
   * @dataProvider numericData
   */
  public function testNumericSetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->setAttribute($name, $value);
    $this->assertSame($attrs->getValue($name), $value);
    $this->assertTrue($attrs->isVisible($name));
    $this->assertTrue(!$attrs->isEmpty($name));
  }

  /**
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
   * @param string $name
   * @param boolean $value numeric value
   * @dataProvider booleanData
   */
  public function testBooleanSetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->getObjectMap()->mapType($name, BooleanAttribute::class);
    $attrs->$name = $value;
    $this->assertTrue($attrs->getValue($name) === $value);
    $this->assertTrue($attrs->isInstantiated($name));
    if ($value === false) {
      $this->assertTrue(!$attrs->isVisible($name));
    } else {
      $this->assertTrue($attrs->isVisible($name));
    }
  }

  /**
   * @return string[]
   */
  public function unsettingData(): array {
    return [
        ['null', null],
        ['false', false]
    ];
  }

  /**
   * @param string $name
   * @param string $value numeric value
   * @dataProvider unsettingData
   */
  public function testUnsetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->setAttribute($name, $value);
    $this->assertTrue($attrs->getValue($name) === $value);
    $this->assertFalse($attrs->isVisible($name));
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        ["string", ""],
        ["boolean", true]
    ];
  }

  /**
   * @param string $name
   * @param string $value numeric value
   * @dataProvider emptyData
   */
  public function testEmptySetting($name, $value) {
    $attrs = new HtmlAttributeManager();
    $attrs->setAttribute($name, $value);
    $this->assertTrue($attrs->getValue($name) === $value);
    $this->assertTrue($attrs->isVisible($name));
    $this->assertTrue($attrs->isEmpty($name));
  }

  /**
   * 
   * @return string[]
   */
  public function objectData(): array {
    return [
        [new MultiValueAttribute("data-foo")],
        [new PropertyCollectionAttribute("data-bar")],
        [new PropertyCollectionAttribute("style")],
        [(new ClassAttribute("class"))->add("a b c")],
    ];
  }

  /**
   * @param Attribute $obj
   * @dataProvider objectData
   */
  public function testObjectSetting(Attribute $obj) {
    $this->attrs->setInstance($obj);
    $this->assertTrue($this->attrs->isInstantiated($obj->getName()));
  }

  /**
   * @param string $name
   * @param string $value numeric value
   * @dataProvider lockDemandData
   */
  public function testLocking($name, $value) {
    $this->attrs->setAttribute($name, $value);
    $this->assertFalse($this->attrs->isProtected($name));
    $this->attrs->protect($name, $value);
    $this->assertTrue($this->attrs->getValue($name) === $value);
    //$this->assertTrue($attrs->exists($name));
    $this->assertTrue($this->attrs->isProtected($name));
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
        ['class', 'a b']
    ];
  }

  /**
   * @param string $name
   * @param scalar $value numeric value
   * @dataProvider lockDemandData
   */
  public function testLockDemand($name, $value) {
    $this->attrs->demand($name);
    $this->assertTrue($this->attrs->isDemanded($name));
    $this->attrs->setAttribute($name, $value);
    $this->assertEquals($this->attrs->getValue($name), $value);
    $this->assertFalse($this->attrs->isProtected($name));
    $this->attrs->protect($name, $value);
    $this->assertEquals($this->attrs->getValue($name), $value);
    $this->assertTrue($this->attrs->isProtected($name));
  }

  /**
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
   * @dataProvider notExistsData
   */
  public function testNnotExists($attrName) {
    $this->assertTrue($this->attrs->getValue($attrName) === null);
    $this->assertTrue($this->attrs->isProtected($attrName) === false);
    $this->assertTrue($this->attrs->isDemanded($attrName) === false);
    $this->assertTrue($this->attrs->isVisible($attrName) === false);
    $this->assertEquals($this->attrs->count(), 0);
  }

}
