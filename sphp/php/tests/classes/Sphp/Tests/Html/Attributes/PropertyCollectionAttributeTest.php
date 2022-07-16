<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\MapAttribute;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;
use Sphp\Stdlib\Arrays;

class PropertyCollectionAttributeTest extends TestCase {

  public function basicInvalidValues(): iterable {
    return [
        [['p' => '']],
        [['' => 'v']],
        ['p;'],
        ['p1:;p2;'],
        [':v'],
        ['p:'],
            //[['"a"' => 'v']],
    ];
  }

  public function basicValidValues(): iterable {
    return [
        [['p1' => 'v1', 'p2' => 'v2'], 'p1:v1;p2:v2;'],
        [';p2:v2;p1:v1;', 'p2:v2;p1:v1;'],
    ];
  }

  public function basicTestData(): iterable {
    return [
        ['foo', ['a' => 'b', 'c' => 'd'], 'a:b;c:d;'],
        ['style', [], null],
        ['style', ['a' => 'b', 'c' => 'd'], 'a:b;c:d;'],
    ];
  }

  /**
   * @dataProvider basicTestData
   * 
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function testConstructorWithParameters(string $name, $value, ?string $expected): void {
    $attr = new MapAttribute($name);
    $this->assertFalse($attr->isAlwaysVisible());
    $this->assertFalse($attr->isVisible());
    $this->assertNull($attr->getValue());
    $attr->setValue($value);
    $this->assertSame($expected, $attr->getValue());
    //$this->expectException(BadMethodCallException::class);
    // $attr->__construct('foo');
  }

  public function singlePropertyDataProvider(): iterable {
    return [
        ['a', 'url(https://a.b)', 'a:url(https://a.b);'],
        ['-c-b', 'rgba(#222, .2)', '-c-b:rgba(#222, .2);'],
        ['n--n', 1, 'n--n:1;'],
        ['n--n', 1.00, 'n--n:1;'],
        ['n--n', -1.01, 'n--n:-1.01;'],
    ];
  }

  /**
   * @dataProvider singlePropertyDataProvider
   * 
   * @param  string $name
   * @param  string|int|float $value
   * @param  string $expected
   * @return void
   */
  public function testSetProperty(string $name, string|int|float $value, string $expected): void {
    $attr1 = new MapAttribute('style');
    $this->assertFalse(isset($attr1[$name]));
    $this->assertNull($attr1[$name]);
    $this->assertFalse($attr1->hasProperty($name));
    $this->assertNull($attr1->getProperty($name));
    $this->assertSame($attr1, $attr1->setProperty($name, $value));

    $arrayAccess = new MapAttribute('style');
    $arrayAccess[$name] = $value;

    $this->assertSame($value, $attr1[$name]);
    $this->assertEquals($attr1, $arrayAccess);
    $this->assertSame($value, $attr1->getProperty($name));
    $this->assertTrue($attr1->hasProperty($name));
    $this->assertSame($expected, $attr1->getValue());
  }

  public function invalidSinglePropertyDataProvider(): iterable {
    yield ['"', 'url(https://a.b)'];
    yield ['"', '"'];
    yield ['foo', '" title="foo"'];
  }

  /**
   * @dataProvider invalidSinglePropertyDataProvider
   * 
   * @param  string|array $props
   * @return void
   */
  public function testSetInvalidProperty(string $name, string|int|float $value): void {
    $attribute = new MapAttribute('style');
    $this->expectException(InvalidAttributeValueException::class);
    $attribute->setProperty($name, $value);
  }

  /**
   * @dataProvider basicInvalidValues
   * 
   * @param string|array $props
   */
  public function testInvalidSetting($props) {
    $attribute = new MapAttribute('style');
    $this->expectException(AttributeException::class);
    $attribute->setValue($props);
  }

  /**
   * @return array[]
   */
  public function validProperties(): iterable {
    return [
        [['p1' => 'v1', 'p2' => 'v2']],
        ['p1:v1;p2:v2;'],
        [';p2:v2;p1:v1;'],
    ];
  }

  /**
   * @return array[]
   */
  public function props(): iterable {
    return [
        [['a' => 'b', 'c' => 'd', 'e' => 'f']]
    ];
  }

  /**
   * @param array $props
   */
  public function testSetInvalidPropertyName(): void {
    $attribute = new MapAttribute('style');
    $this->expectException(\Sphp\Html\Attributes\Exceptions\AttributeException::class);
    $attribute->setProperty('', 'foo');
  }

  /**
   * @param array $props
   */
  public function testSetInvalidPropertyValue(): void {
    $attribute = new MapAttribute('style');
    $this->expectException(\Sphp\Html\Attributes\Exceptions\AttributeException::class);
    $attribute->setProperty('foo', '');
  }

  /**
   * @dataProvider props
   * 
   * @param array $props
   */
  public function testSetValue(array $props) {
    $attribute = new MapAttribute('style');
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

  public function testSetAndRemoveAndClear(): void {
    $attr = new MapAttribute('style');

    $this->assertSame($attr, $attr->setProperty('a', 'url(ftp://a.b)'));
    $this->assertTrue($attr->hasProperty('a'));
    $this->assertSame('a:url(ftp://a.b);', $attr->getValue());
    $this->assertFalse($attr->hasProperty('b'));
    $attr->setProperty('b', 'c');
    $this->assertTrue($attr->hasProperty('b'));
    $this->assertSame('a:url(ftp://a.b);b:c;', $attr->getValue());
    $attr->clear();
    $this->assertFalse($attr->hasProperty('a'));
    $this->assertFalse($attr->hasProperty('b'));
  }

  /**
   * @param string|array $props
   */
  public function testArrayAccess() {
    $parser = new \Sphp\Html\Attributes\PropertyParser();
    $attr = new MapAttribute('style');
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
    $attribute = new MapAttribute('style');
    $attribute->setProperty('a', 'url(ftp://a.b)');
    $this->assertTrue($attribute->hasProperty('a'));
    $this->assertSame('url(ftp://a.b)', $attribute->getProperty('a'));
    $attribute->unsetProperties('a');
    $this->assertFalse($attribute->hasProperty('a'));
    $this->assertFalse($attribute->hasProperty('a'));
  }

  /**
   * @param array $props
   */
  public function testOutput() {
    $attribute = new MapAttribute('style');
    $this->assertSame('', "$attribute");
    $attribute->forceVisibility();
    $this->assertSame('style', "$attribute");
    $attribute->setProperty('a', 'b');
    $this->assertSame($attribute->getName() . '="a:b;"', "$attribute");
  }

}
