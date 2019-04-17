<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Arrays;

class PropertyCollectionAttributeTest extends AbstractAttributeObjectTest {

  use \Sphp\Tests\ArrayAccessTraversableCountableTestTrait;

  public function createAttr(string $name = 'attr'): Attribute {
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

  /**
   * @param array $props
   */
  public function testConstructor() {
    $attribute = new PropertyCollectionAttribute('style');
    $this->hasNoValues($attribute);
    $this->assertFalse($attribute->isDemanded());
    $this->assertFalse($attribute->isVisible());
    $this->expectException(BadMethodCallException::class);
    $attribute->__construct('foo');
  }

  /**
   * @dataProvider basicInvalidValues
   * @param string|array $props
   */
  public function testInvalidSetting($props) {
    $attribute = new PropertyCollectionAttribute('style');
    $this->expectException(InvalidArgumentException::class);
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
   * @dataProvider props
   * @param array $props
   */
  public function testSet(array $props) {
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
    $this->hasNoValues($attribute);
    /* $iteratorMock = $this->getMockBuilder(PropertyCollectionAttribute::class)
      ->disableOriginalConstructor()
      ->setMethods(array('rewind', 'valid', 'current', 'key', 'next'))
      ->getMock();
      $this->mockIterator($attribute, $props, true); */
  }

  /**
   * @param string|array $props
   */
  public function testArrayAccess() {
    $attribute = new PropertyCollectionAttribute('style');
    $attribute['foo'] = 'bar';
    $attribute['baz'] = 'foobar';
    $this->assertTrue(isset($attribute['foo']));
    $this->assertSame('bar', $attribute['foo']);
    unset($attribute['foo']);
    $this->assertFalse(isset($attribute['foo']));
    $this->assertTrue(isset($attribute['baz']));
    $this->assertSame('foobar', $attribute['baz']);
    $this->assertFalse(isset($attribute['foobar']));
    $this->assertFalse(isset($attribute['foobar']));
    $this->assertNull($attribute['foobar']);
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
    $attribute->unsetProperty('a');
    $this->assertFalse($attribute->hasProperty('a'));
    $attribute->lockProperty('a', 'b');
    $this->assertTrue($attribute->hasProperty('a'));
    $this->assertTrue($attribute->isProtected('a'));
    $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
    $this->assertFalse($attribute->setProperty('a', 'foo'));
  }

  /**
   * @dataProvider props
   * @param array $props
   */
  public function testProtecting(array $props) {
    $attribute = new PropertyCollectionAttribute('style');
    $string = Arrays::implodeWithKeys($props, ';', ':');
    $attribute->lockProperties($props);
    $this->assertTrue($attribute->hasProperty('a'));
    $this->assertSame('b', $attribute->getProperty('a'));
    try {
      $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
      $attribute->unsetProperty('a');
    } catch (\Exception $ex) {

      $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
      $this->assertFalse($attribute->lockProperty('a', 'foo'));
    }

    $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
    $this->assertFalse($attribute->setProperty('a', 'foo'));
  }

  /**
   * @param array $props
   */
  public function testOutput() {
    $attribute = new PropertyCollectionAttribute('style');
    $this->assertSame('', "$attribute");
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
