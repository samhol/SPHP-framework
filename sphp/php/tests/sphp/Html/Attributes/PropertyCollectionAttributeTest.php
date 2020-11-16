<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

class PropertyCollectionAttributeTest extends TestCase {

  use \Sphp\Tests\ArrayAccessTraversableCountableTestTrait;

  public function createAttr(string $name = 'attr'): MutableAttribute {
    return new PropertyCollectionAttribute($name);
  }

  public function basicInvalidValues(): array {
    return [
        [['p' => '']],
        [['' => 'v']],
        ['p;'],
        ['p1:;p2;'],
        [':v'],
        ['p:'],
    ];
  }

  public function basicValidValues(): array {
    return [
        [['p1' => 'v1', 'p2' => 'v2'], 'p1:v1;p2:v2;'],
        [';p2:v2;p1:v1;', 'p2:v2;p1:v1;'],
    ];
  }

  public function basicTestData(): array {
    return [
        ['foo', ['p1' => 'v1', 'p2' => 'v2'], 'p1:v1;p2:v2;'],
        ['style', ';p2:v2;p1:v1;', 'p2:v2;p1:v1;'],
    ];
  }

  /**
   * @dataProvider basicTestData
   * 
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function testConstructor(string $name, $value): void {
    $attr = new PropertyCollectionAttribute($name);
    $this->assertFalse($attr->isDemanded());
    $this->assertFalse($attr->isVisible());
    $this->assertNull($attr->getValue());
    $attr->setValue($value);
    $this->expectException(BadMethodCallException::class);
    $attr->__construct('foo');
  }

  /**
   * @dataProvider basicInvalidValues
   * 
   * @param string|array $props
   */
  public function testInvalidSetting($props) {
    $attribute = new PropertyCollectionAttribute('style');
    $this->expectException(AttributeException::class);
    $attribute->setValue($props);
  }

  /**
   * @return array[]
   */
  public function validProperties(): array {
    return [
        [['p1' => 'v1', 'p2' => 'v2']],
        ['p1:v1;p2:v2;'],
        [';p2:v2;p1:v1;'],
    ];
  }

  /**
   * @return array[]
   */
  public function props(): array {
    return [
        [['a' => 'b', 'c' => 'd', 'e' => 'f']]
    ];
  }
  /**
   * @param array $props
   */
  public function testSetInvalidPropertyName():void {
    $attribute = new PropertyCollectionAttribute('style');
    $this->expectException(\Sphp\Html\Attributes\Exceptions\AttributeException::class);
    $attribute->setProperty('', 'foo');
  }
  /**
   * @param array $props
   */
  public function testSetInvalidPropertyValue():void {
    $attribute = new PropertyCollectionAttribute('style');
    $this->expectException(\Sphp\Html\Attributes\Exceptions\AttributeException::class);
    $attribute->setProperty('foo', '');
  }

  /**
   * @dataProvider props
   * @param array $props
   */
  public function testSetValue(array $props) {
    $attribute = new PropertyCollectionAttribute('style');
    $string = Arrays::implodeWithKeys($props, ';', ':') . ';';
    $attribute->setValue($string);
    $this->assertSame($string, $attribute->getValue());
    $this->assertTrue($attribute->hasProperty('a'));
    $this->assertSame('b', $attribute->getProperty('a'));
    $this->assertTrue($props == $attribute->toArray());
    $this->assertCount(count($props), $attribute);
    $this->assertSame(count($props), $attribute->count());
    foreach ($attribute as $key => $val) {
      $this->assertTrue(in_array($val, $props));
      $this->assertTrue(array_key_exists($key, $props));
    }
    $attribute->clear();
  }

  public function testSetAndProtectAndUnsetProperties(): void {
    $attr = new PropertyCollectionAttribute('style');
    $attr->setProperty('a', 'b');
    $attr->lockProperty('b', 'c');
    $attr->setProperty('c', 'd');
    $this->assertSame('a:b;b:c;c:d;', $attr->getValue());
    $attr->unsetProperties('a', 'c');
    $this->assertFalse($attr->hasProperty('a'));
    $this->assertTrue($attr->hasProperty('b'));
    $this->assertSame('b:c;', $attr->getValue());
  }

  public function testSetAndProtectPropertiesAndClear(): void {
    $attr = new PropertyCollectionAttribute('style');

    $attr->setProperty('a', 'b');
    $attr->lockProperty('b', 'c');
    $this->assertTrue($attr->hasProperty('a'));
    $this->assertTrue($attr->hasProperty('b'));
    $attr->clear();
    $this->assertFalse($attr->hasProperty('a'));
    $this->assertTrue($attr->hasProperty('b'));
    $this->assertSame('b:c;', $attr->getValue());
  }

  /**
   * @param string|array $props
   */
  public function testArrayAccess() {
    $parser = new \Sphp\Html\Attributes\PropertyParser();
    $attr = new PropertyCollectionAttribute('style');
    $attr['a'] = 1;
    $this->assertTrue(isset($attr['a']));
    $this->assertSame($parser->propertiesToString(['a' => 1]), $attr->getValue());
    $attr['baz'] = 'foobar';
    unset($attr['a']);
    $this->assertFalse(isset($attr['a']));
    $this->assertTrue(isset($attr['baz']));
    $this->assertSame('foobar', $attr['baz']);
    $this->assertFalse(isset($attr['foobar']));
    $this->assertFalse(isset($attr['foobar']));
    $this->assertNull($attr['foobar']);
  }

  /**
   * @dataProvideer props
   * @param array $props
   */
  public function testSingleProperty() {
    $attribute = new PropertyCollectionAttribute('style');
    $attribute->setProperty('a', 'b');
    $this->assertTrue($attribute->hasProperty('a'));
    $this->assertSame('b', $attribute->getProperty('a'));
    $attribute->unsetProperties('a');
    $this->assertFalse($attribute->hasProperty('a'));
    $attribute->lockProperty('a', 'b');
    $this->assertTrue($attribute->hasProperty('a'));
    $this->assertTrue($attribute->isProtected('a'));
    $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
    $this->assertFalse($attribute->setProperty('a', 'foo'));
  }

  /**
   * 
   * @return PropertyCollectionAttribute
   */
  public function testProtectValue(): PropertyCollectionAttribute {
    $attr = new PropertyCollectionAttribute('style');
    $attr->setValue(['s1' => 'v1']);
    $attr->protectValue(' a: b;');
    $this->assertSame('s1:v1;a:b;', $attr->getValue());
    $attr->clear();
    $this->assertSame('a:b;', $attr->getValue());
    $this->assertTrue($attr->hasProperty('a'));
    $this->assertTrue($attr->isProtected('a'));
    $this->assertTrue($attr->isProtected());
    $this->assertTrue($attr->isDemanded());
    $this->assertSame('b', $attr->getProperty('a'));

    return $attr;
  }

  /**
   * @depends testProtectValue
   * 
   * @param PropertyCollectionAttribute $attr
   * @return PropertyCollectionAttribute
   */
  public function testProtectProperties(PropertyCollectionAttribute $attr) {
    $attr->lockProperty('c', 1);
    $this->assertSame('a:b;c:1;', $attr->getValue());
    $this->assertTrue($attr->hasProperty('a'));
    $this->assertTrue($attr->isProtected('a'));
    $this->assertTrue($attr->hasProperty('c'));
    $this->assertTrue($attr->isProtected('c'));
    $this->assertTrue($attr->isProtected());
    $this->assertTrue($attr->isDemanded());
    $this->assertSame('b', $attr->getProperty('a'));
    $this->assertSame(1, $attr->getProperty('c'));

    try {
      $this->expectException(ImmutableAttributeException::class);
      $attr->unsetProperties('a');
    } catch (ImmutableAttributeException $ex) {

      $this->expectException(ImmutableAttributeException::class);
      $this->assertFalse($attr->lockProperty('a', 'foo'));
    }

    $this->expectException(ImmutableAttributeException::class);
    $this->assertFalse($attr->setProperty('a', 'foo'));
    return $attr;
  }

  /**
   * @param array $props
   */
  public function testOutput() {
    $attribute = new PropertyCollectionAttribute('style');
    $this->assertSame('', "$attribute");
    $attribute->forceVisibility();
    $this->assertSame('style', "$attribute");
    $attribute->setProperty('a', 'b');
    $this->assertSame($attribute->getName() . '="a:b;"', "$attribute");
  }

  public function arrayData(): array {
    return [
        'a' => 'b',
        'foo' => 1
    ];
  }

  public function createCollection(): \ArrayAccess {
    return $this->createAttr();
  }

}
