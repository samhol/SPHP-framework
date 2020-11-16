<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\Attributes\ScalarAttribute;
use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class AttributeContainerTest extends TestCase {

  /**
   * @var AttributeContainer 
   */
  protected $attrs;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->attrs = new AttributeContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    $this->attrs = null;
  }

  public function testProtectingValues(): void {
    $attrs = new AttributeContainer();
    $attrs->protect('class', 'foo bar');
    $this->assertInstanceof(ClassAttribute::class, $attrs->getAttribute('class'));
    $attrs->protect('class', 'baz');
    $this->assertTrue($attrs->classes()->contains('foo bar baz'));
  }

  public function testCloning(): void {
    $attrs = new AttributeContainer();
    $attrs->merge([
        'id' => 'object-id',
        'class' => 'foo bar',
        'style' => 'display: block',
        'data-foo' => 'bar']);
    $clone = clone $attrs;
    $this->assertNotSame($attrs, $clone);
    foreach ($attrs as $attr) {
      $this->assertTrue($clone->contains($attr->getName()));
      $this->assertNotSame($attr, $clone->getAttribute($attr->getName()));
    }
  }

  public function testIteratorAggregate(): void {
    $attrs = new AttributeContainer();
    $attrs->merge([
        'id' => 'object-id',
        'class' => 'foo bar',
        'style' => 'display: block',
        'data-foo' => 'bar']);
    foreach ($attrs as $attr) {
      $this->assertTrue($attrs->contains($attr->getName()));
      $this->assertSame($attr, $attrs->getAttribute($attr->getName()));
    }
  }

  public function testRemove(): void {
    $attrs = new AttributeContainer();
    $attrs->setAttribute('a', 'b');
    $attrs->remove('a');
    $this->assertFalse($attrs->contains('a'));
    $attrs->protect('a', 'b');
    $this->expectException(ImmutableAttributeException::class);
    $attrs->remove('a');
  }

  public function testSetImmutableInstance(): void {
    $attrs = new AttributeContainer();
    $attrs->setAttribute('a', 'b');
    $attrs->setInstance(new ImmutableAttribute('a', 'foo'));
    $this->assertSame('foo', $attrs->getValue('a'));
    $this->expectException(ImmutableAttributeException::class);
    $attrs->remove('a');
  }

  public function testGetters(): void {
    $attrs = new AttributeContainer();
    $this->assertInstanceof(ClassAttribute::class, $classes = $attrs->getAttribute('class'));
    $this->assertSame($classes, $attrs->classes());
    $this->assertInstanceof(PropertyCollectionAttribute::class, $styles = $attrs->getAttribute('style'));
    $this->assertSame($styles, $attrs->styles());
    $attrs1 = new AttributeContainer();
    $this->assertInstanceof(ClassAttribute::class, $attrs1->classes());
    $this->assertInstanceof(PropertyCollectionAttribute::class, $attrs1->styles());
  }

  /**
   * @return mixed[]
   */
  public function mixedData(): array {
    return [
        [''],
        [' '],
        ['foo'],
        [0.231],
        [0.0],
        [1],
        [-1],
        [true],
        [false],
    ];
  }

  /**
   * @param string $value numeric value
   * @dataProvider mixedData
   */
  public function testGeneralSetting($value) {
    $attrs = new AttributeContainer();
    $attrs->setAttribute('data-attr', $value);
    $this->assertInstanceof(ScalarAttribute::class, $attr = $attrs->getAttribute('data-attr'));
    $this->assertSame($value, $attrs->getValue('data-attr'));
    $attr->setValue('foo');
    $this->assertSame('foo', $attrs->getValue('data-attr'));
    $this->assertFalse($attr->isProtected());
  }

  /**
   * @param int $length
   */
  public function testIdentifying(): void {
    $atrs = new AttributeContainer();
    $atrs->id()->identify();
    $this->assertMatchesRegularExpression('/^[^\s]+$/', $atrs->getValue('id'));
    $this->assertTrue($atrs->isVisible('id'));
  }

  /**
   * @param int $length
   */
  public function testSetAria(): AttributeContainer {
    $atrs = new AttributeContainer();
    $atrs->setAttribute('aria-name', 'foo');
    $this->assertSame('foo', $atrs->getValue('aria-name'));
    $atrs->setAria('name', 'aria name');
    $this->assertSame('aria name', $atrs->getValue('aria-name'));
    return $atrs;
  }

  /**
   * @return void
   */
  public function testReplaceAlwaysVisibleInstance(): void {
    $atrs = new AttributeContainer();
    $atrs->demand('data-foo');
    $atrs->setInstance(new ScalarAttribute('data-foo', 'foo'));
    $this->assertTrue($atrs->getAttribute('data-foo')->isVisible());
  }

  /**
   * @return void
   */
  public function testSetInvalidInstanceType(): void {
    $atrs = new AttributeContainer();
    $this->expectException(Exceptions\AttributeException::class);
    $atrs->setInstance(new ScalarAttribute('class', 'foo'));
  }

  /**
   * @return void
   */
  public function testReplaceImmutableInstance(): void {
    $atrs = new AttributeContainer();
    $atrs->protect('data-attr', 'foo');
    $this->expectException(Exceptions\AttributeException::class);
    $atrs->setInstance(new ScalarAttribute('data-attr', 'foo'));
  }

  /**
   * @depends testSetAria
   */
  public function testToArray(AttributeContainer $attrs): void {
    foreach ($attrs->toArray() as $name => $value) {
      $this->assertSame($value, $attrs->getValue($name));
    }
  }

  /**
   * @return string[]
   */
  public function textualData(): array {
    return [
        ["data-empty", ' '],
        ["type", ''],
        ["title", 'foo'],
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
    $attrs = new AttributeContainer();
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
    $attrs = new AttributeContainer();
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
        ['bool1', true],
        ['bool2', false],
    ];
  }

  /**
   * @param string $name
   * @param boolean $value numeric value
   * @dataProvider booleanData
   */
  public function testBooleanSetting($name, $value) {
    $attrs = new AttributeContainer();
    $attrs->setAttribute($name, $value);
    $this->assertTrue($attrs->getValue($name) === $value);
    $this->assertTrue($attrs->contains($name));
    if ($value === false) {
      $this->assertTrue(!$attrs->isVisible($name));
      $this->assertSame('', (string) $attrs);
    } else {
      $this->assertTrue($attrs->isVisible($name));
      $this->assertSame($name, (string) $attrs);
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
    $attrs = new AttributeContainer();
    $attrs->setAttribute($name, $value);
    $this->assertTrue($attrs->getValue($name) === $value);
    $this->assertFalse($attrs->isVisible($name));
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        ["boolean", true]
    ];
  }

  /**
   * @param string $name
   * @param string $value numeric value
   * @dataProvider emptyData
   */
  public function testEmptySetting($name, $value) {
    $attrs = new AttributeContainer();
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
        [new PropertyCollectionAttribute("data-bar")],
        [new PropertyCollectionAttribute("style")],
        [(new ClassAttribute("class"))->add("a b c")],
    ];
  }

  /**
   * @param MutableAttribute $obj
   * @dataProvider objectData
   */
  public function testObjectSetting(MutableAttribute $obj) {
    $this->attrs->setInstance($obj);
    $this->assertTrue($this->attrs->contains($obj->getName()));
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
    ];
  }

  /**
   * @dataProvider notExistsData
   */
  public function testNotExists($attrName) {
    $this->assertTrue($this->attrs->getValue($attrName) === null);
    $this->assertTrue($this->attrs->isProtected($attrName) === false);
    $this->assertTrue($this->attrs->isDemanded($attrName) === false);
    $this->assertTrue($this->attrs->isVisible($attrName) === false);
    $this->assertEquals($this->attrs->count(), 0);
  }

  /**
   * @return scalar[]
   */
  public function styleData(): array {
    return [
        ['border: solid 1px #000'],
        [['boder' => 'solid 1px #000']],
    ];
  }

  /**
   * @dataProvider styleData
   */
  public function testStyleSettings($data) {
    $attrs = new AttributeContainer();
    $this->assertInstanceOf(PropertyCollectionAttribute::class, $attrs->styles()->setValue($data));
  }

  /**
   * @return scalar[]
   */
  public function mergeData(): array {
    $data = [];
    $data[] = [[
    'style' => 'border:solid 1px #000;',
    'foo' => 'bar',
    'true' => true,
    'id' => 'element_id',
    'class' => 'a b c d']];
    return $data;
  }

  /**
   * @dataProvider mergeData
   */
  public function testMerging(iterable $data): void {
    $attrs = new AttributeContainer();
    $attrs->merge($data);
    $this->assertCount(count($data), $attrs);
    foreach ($data as $name => $value) {
      $this->assertTrue($attrs->isVisible($name));
      $this->assertEquals($value, $attrs->getValue($name));
    }
  }

  public function testEmptyOutput() {
    $attrs = new AttributeContainer();
    $attrs->setAttribute('false', false);
    $attrs->setAttribute('null', null);
    $this->assertCount(2, $attrs);
    foreach ($attrs as $attr) {
      $this->assertFalse($attr->isVisible());
      $this->assertSame('', (string) $attr);
    }
    $this->assertSame('', (string) $attrs);
  }

}
